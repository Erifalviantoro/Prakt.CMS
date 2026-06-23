<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailServis;
use App\Models\PenggunaanSparepart;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class PenggunaanSparepartController extends Controller
{
    /**
     * Menampilkan semua data penggunaan sparepart
     */
    public function index()
    {
        $penggunaan = PenggunaanSparepart::with('sparepart')->latest()->get();
        return view('admin.penggunaan_sparepart.index', compact('penggunaan'));
    }

    /**
     * Menampilkan form untuk menambah data
     */
public function create()
{
    $spareparts = Sparepart::all();
    $detailServis = DetailServis::all();

    return view('admin.penggunaan_sparepart.create', compact(
        'spareparts',
        'detailServis'
    ));
}

    /**
     * Menyimpan data penggunaan sparepart baru
     */
    public function store(Request $request)
    {

    $data = $request->validate([
        'detail_servis_id' => 'required|exists:detail_servis,id',
        'id_sparepart'     => 'required|exists:sparepart,id',
        'jumlah'           => 'required|integer|min:1'
    ]);

        $sparepart = Sparepart::findOrFail($request->id_sparepart);

        // Hitung subtotal otomatis
        $data['subtotal'] = $sparepart->harga * $request->jumlah;

        PenggunaanSparepart::create($data);

        $detailServis = DetailServis::findOrFail($request->detail_servis_id);
        $this->updateTotalTransaksi($detailServis);

        // Diseragamkan menggunakan underscore (_)
        return redirect()->route('admin.penggunaan-sparepart.index')
            ->with('success', 'Sparepart berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Menampilkan form edit data
     */
    public function edit($id)
    {
        // Mengambil data log penggunaan yang ingin diedit
        $penggunaan = PenggunaanSparepart::findOrFail($id);
        
        // Mengambil semua list sparepart untuk dropdown select
        $spareparts = Sparepart::all();

        // PERBAIKAN: Pastikan 'penggunaan' dimasukkan ke dalam compact
        return view('admin.penggunaan_sparepart.edit', compact('penggunaan', 'spareparts'));
    }

    /**
     * Memperbarui data penggunaan sparepart
     */
    public function update(Request $request, $id)
    {
        $penggunaan = PenggunaanSparepart::findOrFail($id);

        // Validasi input data dari form edit
        $request->validate([
            'id_sparepart' => 'required|exists:sparepart,id',
            'jumlah'       => 'required|integer|min:1'
        ]);

        // Ambil data harga sparepart terbaru untuk kalkulasi ulang subtotal
        $sparepart = Sparepart::findOrFail($request->id_sparepart);
        $subtotal = $sparepart->harga * $request->jumlah;

        // Update data di database
        $penggunaan->update([
            'id_sparepart' => $request->id_sparepart,
            'jumlah'       => $request->jumlah,
            'subtotal'     => $subtotal
        ]);

        // Rekalkulasi total transaksi induknya
        if ($penggunaan->detailServis) {
            $this->updateTotalTransaksi($penggunaan->detailServis);
        }

        // Redirect kembali ke halaman utama dengan pesan sukses
        return redirect()->route('admin.penggunaan-sparepart.index')
            ->with('success', 'Data penggunaan sparepart berhasil diperbarui.');
    }

    /**
     * Menghapus data penggunaan sparepart
     */
    public function destroy($id)
    {
        $penggunaan = PenggunaanSparepart::findOrFail($id);
        $detailServis = $penggunaan->detailServis;
        
        $penggunaan->delete();
        
        if ($detailServis) {
            $this->updateTotalTransaksi($detailServis);
        }

        // Diseragamkan menggunakan underscore (_)
        return redirect()->route('admin.penggunaan-sparepart.index')
            ->with('success', 'Data penggunaan sparepart berhasil dihapus.');
    }

    /**
     * Logika hitung otomatis total biaya pada transaksi terkait
     */
    private function updateTotalTransaksi($detailServis)
    {
        $totalSparepart = $detailServis->penggunaanSparepart()->sum('subtotal');
        $total = $detailServis->biaya_jasa + $totalSparepart;

        if ($detailServis->transaksi) {
            $detailServis->transaksi->update([
                'total_biaya' => $total
            ]);
        }
    }
}