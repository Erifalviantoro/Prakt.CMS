<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use App\Models\DetailServis;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Ambil kata kunci pencarian jika ada
        $search = $request->input('search');

        // 2. Buat query dasar dengan eager loading relasi berantai
        $query = Transaksi::with([
            'detailServis.booking.pelanggan',
            'detailServis.booking.kendaraan'
        ]);

        // 3. Gabungkan logika pencarian (Bisa cari berdasarkan nomor invoice, nama pelanggan, atau model kendaraan)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhereHas('detailServis.booking.pelanggan', function ($qPelanggan) use ($search) {
                      $qPelanggan->where('nama', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('detailServis.booking.kendaraan', function ($qKendaraan) use ($search) {
                      $qKendaraan->where('model', 'LIKE', "%{$search}%")
                                 ->orWhere('no_polisi', 'LIKE', "%{$search}%")
                                 ->orWhere('nomor_plat', 'LIKE', "%{$search}%");
                  });
            });
        }

        // 4. Eksekusi data dengan pagination
        $transaksi = $query->latest()->paginate(10)->withQueryString();

        // 5. Perhitungan statistik box (Menggunakan format string kapital baru)
        $totalPendapatan = Transaksi::where('status_pembayaran', 'Lunas')
            ->sum('total_biaya');

        $jumlahPending = Transaksi::whereIn('status_pembayaran', [
            'Menunggu Pembayaran',
            'Belum Lunas'
        ])->count();

        $jumlahTransaksi = Transaksi::count();

        $rataRata = $jumlahTransaksi > 0 ? Transaksi::avg('total_biaya') : 0;

        return view('admin.transaksi.index', compact(
            'transaksi',
            'totalPendapatan',
            'jumlahPending',
            'jumlahTransaksi',
            'rataRata'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detailServis = DetailServis::with(['booking.pelanggan'])
            ->where('status_servis', 'selesai')
            ->doesntHave('transaksi')
            ->get();

        return view('admin.transaksi.create', compact('detailServis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'detail_servis_id' => 'required|exists:detail_servis,id',
            'status_pembayaran' => 'required|in:Menunggu Pembayaran,Belum Lunas,Lunas,Gagal', 
            'metode_pembayaran' => 'required',
        ]);

        $detail = DetailServis::with('penggunaanSparepart')->findOrFail($request->detail_servis_id);

        // HITUNG TOTAL
        $totalJasa = $detail->biaya_jasa;
        $totalSparepart = $detail->penggunaanSparepart->sum('subtotal');
        $total = $totalJasa + $totalSparepart;

        // Menyimpan data asli tanpa paksaan strtolower()
        Transaksi::create([
            'detail_servis_id' => $detail->id,
            'total_jasa' => $totalJasa,
            'total_sparepart' => $totalSparepart,
            'total_biaya' => $total,
            'status_pembayaran' => $request->status_pembayaran, 
            'metode_pembayaran' => $request->metode_pembayaran, 
        ]);

        return redirect()
            ->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil dibuat dari detail servis');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::with(['detailServis.booking.pelanggan', 'detailServis.booking.kendaraan'])->findOrFail($id);

        return view('admin.transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::with([
            'detailServis.booking.pelanggan', 
            'detailServis.booking.kendaraan'
        ])->findOrFail($id);

        return view('admin.transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'metode_pembayaran' => 'nullable|string|max:255',
            'status_pembayaran' => 'required|in:Menunggu Pembayaran,Belum Lunas,Lunas,Gagal',
        ]);

        // Menyimpan data asli tanpa paksaan strtolower()
        $transaksi->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Pembayaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('admin.transaksi.index')
                         ->with('success', 'Transaksi berhasil dihapus dari sistem.');
    }
}