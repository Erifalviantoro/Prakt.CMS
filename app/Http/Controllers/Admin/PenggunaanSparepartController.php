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
        $penggunaan = PenggunaanSparepart::with(['sparepart', 'detailServis.booking.pelanggan'])->latest()->get();
        return view('admin.penggunaan_sparepart.index', compact('penggunaan'));
    }

    /**
     * Menampilkan form untuk menambah data dengan dukungan auto-select (Poin 1)
     */
    public function create(Request $request)
    {
        $spareparts = Sparepart::where('stok', '>', 0)->get(); // Hanya mengambil sparepart yang ready stock

        // 1. Jika diakses langsung via tombol dari halaman detail servis tertentu
        if ($request->has('detail_servis_id')) {
            $detailServisTerpilih = DetailServis::with('booking.pelanggan')->findOrFail($request->detail_servis_id);

            return view('admin.penggunaan_sparepart.create', [
                'spareparts' => $spareparts,
                'detailServis' => collect([$detailServisTerpilih]), // Dibungkus collection agar format loop di view seragam
                'selected_id' => $detailServisTerpilih->id
            ]);
        }

        $detailServis = DetailServis::with('booking.pelanggan')->where('status_servis', '!=', 'selesai')->get();
        return view('admin.penggunaan_sparepart.create', compact('spareparts', 'detailServis'));
    }

    /**
     * Menyimpan data penggunaan sparepart baru dengan manajemen stok (Poin 2, 3, 8, 9)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'detail_servis_id' => 'required|exists:detail_servis,id',
            'id_sparepart'     => 'required|exists:sparepart,id',
            'jumlah'           => 'required|integer|min:1'
        ]);

        // 8. Validasi Duplikasi: Cegah item yang sama diinput berulang kali pada satu nota servis
        $exists = PenggunaanSparepart::where('detail_servis_id', $request->detail_servis_id)
            ->where('id_sparepart', $request->id_sparepart)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Sparepart tersebut sudah ada di daftar servis ini. Silakan edit jumlahnya jika ada penambahan.');
        }

        $sparepart = Sparepart::findOrFail($request->id_sparepart);

        // 3. Validasi Batas Pengambilan: Cegah kuantitas keluar melebihi sisa fisik di gudang
        if ($sparepart->stok < $request->jumlah) {
            return back()->withInput()->with('error', "Stok tidak mencukupi. Sisa stok saat ini: {$sparepart->stok} unit.");
        }

        // Hitung subtotal otomatis
        $data['subtotal'] = $sparepart->harga * $request->jumlah;

        // Simpan data log penggunaan
        PenggunaanSparepart::create($data);

        // 2. Potong stok sparepart di gudang secara otomatis
        $sparepart->decrement('stok', $request->jumlah);

        // Rekalkulasi keuangan invoice jika data transaksi sudah terbentuk
        $detailServis = DetailServis::findOrFail($request->detail_servis_id);
        $this->updateTotalTransaksi($detailServis);

        // 9. UX Redirect: Kembali ke halaman Detail Servis terkait agar alur kerja mekanik/admin lebih cepat
        return redirect()->route('admin.detailservis.show', $request->detail_servis_id)
            ->with('success', 'Sparepart sukses dialokasikan ke unit kendaraan.');
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
        $penggunaan = PenggunaanSparepart::findOrFail($id);
        $spareparts = Sparepart::all();

        return view('admin.penggunaan_sparepart.edit', compact('penggunaan', 'spareparts'));
    }

    /**
     * Memperbarui data penggunaan sparepart dengan penyesuaian selisih stok (Poin 4)
     */
    public function update(Request $request, $id)
    {
        $penggunaan = PenggunaanSparepart::findOrFail($id);

        $request->validate([
            'id_sparepart' => 'required|exists:sparepart,id',
            'jumlah'       => 'required|integer|min:1'
        ]);

        $sparepartBaru = Sparepart::findOrFail($request->id_sparepart);

        // 4. Manajemen Pengembalian & Kalkulasi Ulang Stok Fisik Gudang
        // Langkah A: Kembalikan alokasi stok lama ke gudang terlebih dahulu
        $sparepartLama = Sparepart::findOrFail($penggunaan->id_sparepart);
        $sparepartLama->increment('stok', $penggunaan->jumlah);

        // Langkah B: Segarkan data instans sparepart baru pasca pengembalian stok lama (antisipasi jika itemnya sama)
        $sparepartBaru->refresh();

        // Langkah C: Validasi kecukupan stok untuk kuantitas yang baru
        if ($sparepartBaru->stok < $request->jumlah) {
            // Rollback status jika gagal (batalkan penambahan di Langkah A agar data tidak pincang)
            $sparepartLama->decrement('stok', $penggunaan->jumlah);
            return back()->with('error', "Gagal memperbarui. Sisa stok fisik di gudang saat ini tidak mencukupi ({$sparepartBaru->stok} unit).");
        }

        // Langkah D: Kurangi stok gudang berdasarkan kuantitas baru yang valid
        $sparepartBaru->decrement('stok', $request->jumlah);

        // Hitung ulang nominal subtotal belanja baru
        $subtotal = $sparepartBaru->harga * $request->jumlah;

        // Update record penggunaan sparepart
        $penggunaan->update([
            'id_sparepart' => $request->id_sparepart,
            'jumlah'       => $request->jumlah,
            'subtotal'     => $subtotal
        ]);

        // Rekalkulasi total transaksi induknya jika terikat invoice
        if ($penggunaan->detailServis) {
            $this->updateTotalTransaksi($penggunaan->detailServis);
        }

        return redirect()->route('admin.detailservis.show', $penggunaan->detail_servis_id)
            ->with('success', 'Kuantitas penggunaan sparepart berhasil disesuaikan.');
    }

    /**
     * Menghapus data penggunaan sparepart & Mengembalikan hak stok ke gudang (Poin 5)
     */
    public function destroy($id)
    {
        $penggunaan = PenggunaanSparepart::with('sparepart')->findOrFail($id);
        $detailServis = $penggunaan->detailServis;
        
        // 5. Sebelum data log dihapus, kembalikan kuantitas barang yang batal dipakai ke inventory gudang
        if ($penggunaan->sparepart) {
            $penggunaan->sparepart->increment('stok', $penggunaan->jumlah);
        }

        $penggunaan->delete();
        
        // Perbarui total tagihan nota pasca item dihapus
        if ($detailServis) {
            $this->updateTotalTransaksi($detailServis);
        }

        return back()->with('success', 'Item sparepart dicabut dan kuantitas stok dikembalikan ke gudang.');
    }

    /**
     * Logika hitung otomatis total nominal transaksi secara komprehensif (Poin 6 & 7)
     */
    private function updateTotalTransaksi($detailServis)
    {
        $totalSparepart = $detailServis->penggunaanSparepart()->sum('subtotal');
        $total = $detailServis->biaya_jasa + $totalSparepart;

        // 6 & 7. Sinkronisasi penuh seluruh komponen finansial pada tabel transaksi kasir
        if ($detailServis->transaksi) {
            $detailServis->transaksi->update([
                'total_jasa'      => $detailServis->biaya_jasa,
                'total_sparepart' => $totalSparepart,
                'total_biaya'     => $total
            ]);
        }
    }
}