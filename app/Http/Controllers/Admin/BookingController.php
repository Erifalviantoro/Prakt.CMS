<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\DetailServis;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->status;

        $bookings = Booking::with(['pelanggan', 'kendaraan', 'layanan'])
            ->when($status, function ($q) use ($status) {
                return $q->where('status', $status);
            })
            ->latest()
            ->get();

        $totalBooking = Booking::count();
        $bookingHariIni = Booking::whereDate('tanggal_booking', now())->count();
        $bookingMenunggu = Booking::where('status', 'Menunggu')->count();
        $bookingDikonfirmasi = Booking::where('status', 'Dikonfirmasi')->count();
        $bookingSelesai = Booking::where('status', 'Selesai')->count();
        $bookingDibatalkan = Booking::where('status', 'Dibatalkan')->count();

        return view('admin.booking.index', compact(
            'bookings',
            'totalBooking',
            'bookingHariIni',
            'bookingMenunggu',
            'bookingDikonfirmasi',
            'bookingSelesai',
            'bookingDibatalkan'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = Booking::with([
            'pelanggan',
            'kendaraan',
            'layanan'
        ])->findOrFail($id);

        return view('admin.booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $booking = Booking::with([
            'pelanggan',
            'kendaraan',
            'layanan'
        ])->findOrFail($id);

        return view('admin.booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        // 7. Menggunakan Eager Loading untuk mencegah N+1 Query saat membaca relasi di bawah
        $booking = Booking::with(['pelanggan', 'kendaraan', 'layanan'])->findOrFail($id);

        $booking->update([
            'status' => $request->status
        ]);

        // 9. Proteksi ganda agar Detail Servis tidak duplikat
        if ($request->status == 'Dikonfirmasi' && 
            !DetailServis::where('booking_id', $booking->id)->exists()) {

            // 1, 2, 3, 5, 6, 10. Penerapan struktur data baru sesuai standarisasi sistem
            DetailServis::create([
                'booking_id'       => $booking->id,
                'teknisi_id'       => null, // Pastikan migration Anda sudah di-set ->nullable()
                'jenis_servis'     => $booking->layanan->nama_layanan ?? ($booking->layanan->nama ?? 'Servis Reguler'),
                'deskripsi'        => $booking->keluhan,
                'status_servis'    => 'antrian', // 1. Menggunakan 'antrian' (bukan 'menunggu') agar sinkron
                'biaya_jasa'       => 0,         // 5. Inisialisasi awal mencegah nilai NULL di perhitungan matematika Blade
                'estimasi_selesai' => $booking->tanggal_booking ?? null, // 6. Memakai basis tanggal booking awal
            ]);
        }

        return redirect()
            ->route('admin.booking.index')
            ->with('success', 'Status booking berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return back()->with('success', 'Booking berhasil dihapus');
    }
}