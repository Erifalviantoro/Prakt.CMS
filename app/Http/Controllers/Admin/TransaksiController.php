<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
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

        // 3. Logika pencarian terintegrasi dengan penyesuaian nama field model kendaraan (8)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhereHas('detailServis.booking.pelanggan', function ($qPelanggan) use ($search) {
                      $qPelanggan->where('nama', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('detailServis.booking.kendaraan', function ($qKendaraan) use ($search) {
                      // 8. Menyesuaikan field pencarian dengan skema database riil (merk/model)
                      $qKendaraan->where('merk_kendaraan', 'LIKE', "%{$search}%")
                                 ->orWhere('model_kendaraan', 'LIKE', "%{$search}%")
                                 ->orWhere('nomor_plat', 'LIKE', "%{$search}%");
                  });
            });
        }

        // 4. Eksekusi data dengan pagination
        $transaksi = $query->latest()->paginate(10)->withQueryString();

        // 5. Perhitungan statistik box 
        $totalPendapatan = Transaksi::where('status_pembayaran', 'Lunas')->sum('total_biaya');
        $jumlahPending = Transaksi::whereIn('status_pembayaran', ['Menunggu Pembayaran', 'Belum Lunas'])->count();
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
    public function create(Request $request)
    {
        // 2. Jika diakses langsung via tombol "Buat Invoice" di halaman Kelola Servis
        if ($request->has('booking_id')) {
            $detailServisTerpilih = DetailServis::with(['booking.pelanggan', 'booking.kendaraan'])
                ->where('booking_id', $request->booking_id)
                ->where('status_servis', 'selesai')
                ->firstOrFail();

            return view('admin.transaksi.create', [
                'detailServis' => collect([$detailServisTerpilih]), // Dibungkus collect agar format di view seragam (looping)
                'selected_id' => $detailServisTerpilih->id
            ]);
        }

        // Alur fallback biasa (jika admin membuka menu Transaksi -> Tambah)
        $detailServis = DetailServis::with(['booking.pelanggan', 'booking.kendaraan'])
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

        // 6. Eager load relasi booking untuk mempercepat proses update status
        $detail = DetailServis::with(['penggunaanSparepart', 'booking', 'transaksi'])->findOrFail($request->detail_servis_id);

        // 5. Proteksi keamanan: Cegah manipulasi pembuatan data transaksi ganda
        if ($detail->transaksi) {
            return back()->with('error', 'Invoice untuk detail perbaikan servis ini sudah pernah diterbitkan sebelumnya.');
        }

        // HITUNG TOTAL
        $totalJasa = $detail->biaya_jasa;
        $totalSparepart = $detail->penggunaanSparepart->sum('subtotal');
        $total = $totalJasa + $totalSparepart;

        // Simpan data transaksi keuangan resmi bengkel
        $transaksi = Transaksi::create([
            'detail_servis_id' => $detail->id,
            'total_jasa' => $totalJasa,
            'total_sparepart' => $totalSparepart,
            'total_biaya' => $total,
            'status_pembayaran' => $request->status_pembayaran, 
            'metode_pembayaran' => $request->metode_pembayaran, 
        ]);

        // 3 & 4. Sinkronisasi status Booking utama menjadi 'Selesai' secara otomatis
        if ($detail->booking) {
            $detail->booking->update([
                'status' => 'Selesai'
            ]);
        }

        // 7. Redirect langsung ke halaman cetak/detail invoice yang baru dibuat demi efisiensi waktu admin
        return redirect()
            ->route('admin.transaksi.show', $transaksi->id)
            ->with('success', 'Transaksi kasir berhasil dibuat. Invoice siap dicetak.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::with(['detailServis.booking.pelanggan', 'detailServis.booking.kendaraan', 'detailServis.penggunaanSparepart.sparepart'])->findOrFail($id);

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

        $transaksi->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Status realisasi pembayaran berhasil diperbarui');
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