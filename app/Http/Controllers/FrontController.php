<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Booking;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use App\Models\DetailServis;

class FrontController extends Controller
{
    public function home()
    {
        return view('front.home');
    }

    public function tentang()
    {
        return view('front.tentang');
    }

    public function layanan()
    {
        $layanans = Layanan::where('status', 'Aktif')
                    ->latest()
                    ->get();

        return view('front.layanan.index', compact('layanans'));
    }

    public function detailLayanan($id)
    {
        $layanan = Layanan::findOrFail($id);

        return view('front.layanan.show', compact('layanan'));
    }

    public function berita()
    {
        return view('front.berita.index');
    }

    public function kontak()
    {
        return view('front.kontak');
    }

    public function booking()
    {
        $layanans = Layanan::where('status', 'Aktif')->get();

        return view('front.booking.create', compact('layanans'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'nama'              => 'required',
            'nomor_telepon'     => 'required',
            'nomor_plat'        => 'required',
            'merk_kendaraan'    => 'required',
            'model_kendaraan'   => 'required',
            'layanan_id'        => 'required',
            'tanggal_booking'   => 'required|date',
            'keluhan'           => 'required',
        ]);

        $pelanggan = Pelanggan::create([
            'nama'                  => $request->nama,
            'nomor_telepon'         => $request->nomor_telepon,
            'email'                 => $request->email,
            'alamat'                => $request->alamat,
            'tanggal_pendaftaran'   => now(),
        ]);

        $kendaraan = Kendaraan::create([
            'nomor_plat'        => $request->nomor_plat,
            'merk_kendaraan'    => $request->merk_kendaraan,
            'model_kendaraan'   => $request->model_kendaraan,
            'nomor_mesin'       => $request->nomor_mesin,
            'tahun_pembuatan'   => $request->tahun_pembuatan,
        ]);

        Booking::create([
            'pelanggan_id'      => $pelanggan->id,
            'kendaraan_id'      => $kendaraan->id,
            'layanan_id'        => $request->layanan_id,
            'tanggal_booking'   => $request->tanggal_booking,
            'keluhan'           => $request->keluhan,
            'status'            => 'Menunggu',
        ]);

        // Perbaikan: Diarahkan ke front.booking.sukses
        return redirect()
            ->route('front.booking.sukses')
            ->with('success', 'Booking berhasil dikirim')
            ->with('nama_pelanggan', $request->nama)
            ->with('booking_id', Booking::latest()->first()->id);
    }

    public function bookingSukses()
    {
        $booking = Booking::latest()->first();
        return view('front.booking.sukses', compact('booking'));
    }

    public function statusBooking()
{
    return view('front.status-booking');
}

public function cariStatusBooking(Request $request)
{
    $request->validate([
        'nomor_telepon' => 'required'
    ]);

    $bookings = Booking::with([
        'pelanggan',
        'kendaraan',
        'layanan',
        'detailServis.teknisi'
    ])
    ->whereHas('pelanggan', function ($q) use ($request) {
        $q->where('nomor_telepon', $request->nomor_telepon);
    })
    ->latest()
    ->get();

    return view('front.status-booking', compact(
        'bookings'
    ));
}
}