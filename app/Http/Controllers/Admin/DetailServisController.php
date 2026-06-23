<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\DetailServis;
use App\Models\Teknisi;
use App\Models\Transaksi;
use App\Models\Booking;
use Illuminate\Http\Request;

class DetailServisController extends Controller
{
    public function index()
    {
        // Menyertakan relasi booking.pelanggan agar tidak error saat dipanggil di index view
        $detailServis = DetailServis::with([
            'booking.pelanggan', 
            'teknisi',
            'penggunaanSparepart'
        ])->latest()->paginate(10);

        // Perbaikan: Menghitung counter berdasarkan kolom status_servis agar sinkron 100%
        $pending = DetailServis::where('status_servis', 'antrian')
            ->orWhereNull('status_servis')
            ->count();

        $progress = DetailServis::where('status_servis', 'proses')->count();

        $completed = DetailServis::where('status_servis', 'selesai')->count();

        return view('admin.detailservis.index', compact(
            'detailServis',
            'pending',
            'progress',
            'completed'
        ));
    }

    public function create()
    {
        $booking = Booking::with('pelanggan')->get();
        $teknisi = Teknisi::all();

        return view('admin.detailservis.create', compact('booking', 'teknisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id'       => 'required|exists:booking,id',
            'teknisi_id'       => 'required|exists:teknisi,id',
            'jenis_servis'     => 'required',
            'deskripsi'        => 'nullable',
            'catatan'          => 'nullable|max:50',
            'waktu_mulai'      => 'nullable|date',
            'waktu_selesai'    => 'nullable|date',
            'estimasi_selesai' => 'nullable|date',
        ]);

        $data = $request->only([
            'booking_id',
            'teknisi_id',
            'jenis_servis',
            'deskripsi',
            'catatan',
            'waktu_mulai',
            'waktu_selesai',
            'estimasi_selesai',
            'biaya_jasa',
        ]);

        if ($request->waktu_mulai) {
            $data['waktu_mulai'] = Carbon::parse($request->waktu_mulai)->format('Y-m-d H:i:s');
            $data['status_servis'] = 'proses'; // otomatis proses jika waktu mulai langsung diisi
        } else {
            $data['status_servis'] = 'antrian'; // murni antrian jika kosong
        }

        if ($request->waktu_selesai) {
            $data['waktu_selesai'] = Carbon::parse($request->waktu_selesai)->format('Y-m-d H:i:s');
            $data['status_servis'] = 'selesai';
        }

        if ($request->estimasi_selesai) {
            $data['estimasi_selesai'] = Carbon::parse($request->estimasi_selesai)->format('Y-m-d H:i:s');
        }

        DetailServis::create($data);

        return redirect()
            ->route('admin.detailservis.index')
            ->with('success', 'Detail servis berhasil ditambahkan ke antrian');
    }

    public function show($id)
    {
        $detailServis = DetailServis::with([
            'booking.pelanggan',
            'booking.kendaraan',
            'teknisi',
            'penggunaanSparepart.sparepart'
        ])->findOrFail($id);

        return view('admin.detailservis.show', compact('detailServis'));
    }

    public function edit($id)
    {
        $detailServis = DetailServis::findOrFail($id);
        $booking = Booking::with('pelanggan')->get();
        $teknisi = Teknisi::all();

        return view('admin.detailservis.edit', compact(
            'detailServis',
            'booking',
            'teknisi'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi'     => 'nullable',
            'catatan'       => 'nullable|max:50',
            'waktu_mulai'   => 'nullable|date',
            'waktu_selesai' => 'nullable|date',
            'biaya_jasa'    => 'required|numeric|min:0',
        ]);

        $detailServis = DetailServis::findOrFail($id);

        // Menentukan status dinamis berdasarkan input waktu saat edit manual
        $status = $detailServis->status_servis;
        if ($request->waktu_mulai) { $status = 'proses'; }
        if ($request->waktu_selesai) { $status = 'selesai'; }

        $detailServis->update([
            'deskripsi'     => $request->deskripsi,
            'catatan'       => $request->catatan,
            'waktu_mulai'   => $request->waktu_mulai ? Carbon::parse($request->waktu_mulai)->format('Y-m-d H:i:s') : null,
            'waktu_selesai' => $request->waktu_selesai ? Carbon::parse($request->waktu_selesai)->format('Y-m-d H:i:s') : null,
            'biaya_jasa'    => $request->biaya_jasa,
            'status_servis' => $status
        ]);

        return redirect()
            ->route('admin.detailservis.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $detailServis = DetailServis::findOrFail($id);
        $detailServis->delete();

        return redirect()
            ->route('admin.detailservis.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function mulai($id)
    {
        $detail = DetailServis::findOrFail($id);

        $detail->update([
            'waktu_mulai'   => now(),
            'status_servis' => 'proses'
        ]);

        return redirect()
            ->back()
            ->with('success', 'Servis berhasil dimulai');
    }

    public function selesai($id)
    {
        $detail = DetailServis::findOrFail($id);

        $detail->update([
            'waktu_selesai' => now(),
            'status_servis' => 'selesai'
        ]);

        return redirect()
            ->back()
            ->with('success', 'Servis berhasil diselesaikan');
    }
}