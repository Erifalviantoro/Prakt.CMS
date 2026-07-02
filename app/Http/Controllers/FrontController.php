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

$booking = Booking::create([
    'pelanggan_id'      => $pelanggan->id,
    'kendaraan_id'      => $kendaraan->id,
    'layanan_id'        => $request->layanan_id,
    'tanggal_booking'   => $request->tanggal_booking,
    'keluhan'           => $request->keluhan,
    'status'            => 'Menunggu',
]);

return redirect()
    ->route('front.booking.sukses')
    ->with('success', 'Booking berhasil dikirim')
    ->with('booking_id', $booking->id);
    }

   public function bookingSukses()
    {
        $booking = Booking::find(session('booking_id'));
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
public function dashboard()
{
    $pelanggan = Pelanggan::where('email', auth()->user()->email)->first();

    if (!$pelanggan) {
        return view('front.pelanggan.dashboard', [
            'totalBooking' => 0,
            'menunggu' => 0,
            'diproses' => 0,
            'selesai' => 0,
            'bookingAktif' => null,
            'riwayatBooking' => collect(),
        ]);
    }

    $bookings = Booking::with([
        'kendaraan',
        'layanan',
        'detailServis'
    ])
    ->where('pelanggan_id', $pelanggan->id);

    $totalBooking = $bookings->count();

    $menunggu = (clone $bookings)
        ->where('status','Menunggu')
        ->count();

    $diproses = (clone $bookings)
        ->where('status','Diproses')
        ->count();

    $selesai = (clone $bookings)
        ->where('status','Selesai')
        ->count();

    $bookingAktif = Booking::with([
        'kendaraan',
        'layanan'
    ])
    ->where('pelanggan_id',$pelanggan->id)
    ->whereIn('status',['Menunggu','Diproses'])
    ->latest()
    ->first();

    $riwayatBooking = Booking::with([
        'layanan'
    ])
    ->where('pelanggan_id',$pelanggan->id)
    ->latest()
    ->take(5)
    ->get();

    return view('front.pelanggan.dashboard', compact(
        'totalBooking',
        'menunggu',
        'diproses',
        'selesai',
        'bookingAktif',
        'riwayatBooking'
    ));
}

public function profile()
{
    $pelanggan = Pelanggan::where('email', auth()->user()->email)->first();

    if (!$pelanggan) {
        return view('front.pelanggan.profile', [
            'pelanggan' => null,
            'kendaraan' => null,
            'totalBooking' => 0,
            'bookingSelesai' => 0,
        ]);
    }

    $kendaraan = Kendaraan::whereHas('bookings', function ($q) use ($pelanggan) {
        $q->where('pelanggan_id', $pelanggan->id);
    })->latest()->first();

    $totalBooking = Booking::where('pelanggan_id', $pelanggan->id)->count();

    $bookingSelesai = Booking::where('pelanggan_id', $pelanggan->id)
        ->where('status', 'Selesai')
        ->count();

    return view('front.pelanggan.profile', compact(
        'pelanggan',
        'kendaraan',
        'totalBooking',
        'bookingSelesai'
    ));
}

public function riwayat()
{
    $bookings = Booking::with([
        'kendaraan',
        'layanan',
        'pelanggan'
    ])
    ->latest()
    ->paginate(10);

    return view(
        'front.pelanggan.riwayat',
        compact('bookings')
    );
}
public function detailRiwayat($id)
{
   $booking = Booking::with([
    'layanan',
    'kendaraan',
    'pelanggan',
    'detailServis.teknisi',
    'detailServis.transaksi',
])->findOrFail($id);

    return view('front.pelanggan.detail-riwayat', compact('booking'));
}
public function editProfile()
{
    $pelanggan = Pelanggan::where('email', auth()->user()->email)->first();

    if (!$pelanggan) {
        return view('front.pelanggan.edit-profile', [
            'pelanggan' => null,
            'kendaraan' => null,
        ]);
    }

    $kendaraan = Kendaraan::whereHas('bookings', function ($q) use ($pelanggan) {
        $q->where('pelanggan_id', $pelanggan->id);
    })->latest()->first();

    return view('front.pelanggan.edit-profile', compact(
        'pelanggan',
        'kendaraan'
    ));
}
public function updateProfile(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'nomor_telepon' => 'required',
        'alamat' => 'required',
        'nomor_plat' => 'required',
        'merk_kendaraan' => 'required',
        'model_kendaraan' => 'required',
        'tahun_pembuatan' => 'nullable'
    ]);

    $pelanggan = Pelanggan::where('email', auth()->user()->email)->first();

    $pelanggan->update([
        'nama' => $request->nama,
        'email' => $request->email,
        'nomor_telepon' => $request->nomor_telepon,
        'alamat' => $request->alamat,
    ]);

    $kendaraan = Kendaraan::whereHas('booking', function ($q) use ($pelanggan) {
        $q->where('pelanggan_id', $pelanggan->id);
    })->latest()->first();

    if ($kendaraan) {
        $kendaraan->update([
            'nomor_plat' => $request->nomor_plat,
            'merk_kendaraan' => $request->merk_kendaraan,
            'model_kendaraan' => $request->model_kendaraan,
            'tahun_pembuatan' => $request->tahun_pembuatan,
        ]);
    }

    return redirect()
        ->route('front.profile')
        ->with('success', 'Profil berhasil diperbarui.');
}
}