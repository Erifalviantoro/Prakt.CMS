<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Ditambahkan untuk menangkap filter data dari view
use App\Models\Booking;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use App\Models\Layanan;
use App\Models\Teknisi;
use App\Models\DetailServis;
use App\Models\Sparepart;
use App\Models\PenggunaanSparepart;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index()
    {
        // Halaman utama indeks laporan berupa grid menu/card laporan
        return view('admin.laporan.index');
    }

    public function booking(Request $request)
    {
        $query = Booking::with(['pelanggan', 'kendaraan']);

        // Filter rentang tanggal berdasarkan tanggal booking dibuat
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('created_at', [
                $request->tanggal_awal . ' 00:00:00',
                $request->tanggal_akhir . ' 23:59:59'
            ]);
        }

        $data = $query->orderBy('created_at', 'desc')->get();

        // Statistik tambahan untuk laporan booking
        $totalBooking = $data->count();
        $bookingSelesai = $data->where('status', 'Selesai')->count();

        return view('admin.laporan.booking', compact('data', 'totalBooking', 'bookingSelesai'));
    }

    public function pelanggan()
    {
        // Master data tidak membutuhkan filter tanggal kronologis mendalam
        $data = Pelanggan::all();
        return view('admin.laporan.pelanggan', compact('data'));
    }

    public function kendaraan()
    {
        $data = Kendaraan::with('pelanggan')->get(); // Ditambahkan eager loading ke pemiliknya jika diperlukan di view
        return view('admin.laporan.kendaraan', compact('data'));
    }

    public function layanan()
    {
        $data = Layanan::all();
        return view('admin.laporan.layanan', compact('data'));
    }

    public function mekanik()
    {
        $data = Teknisi::all();
        return view('admin.laporan.mekanik', compact('data'));
    }

    public function detailServis(Request $request)
    {
        // FIX: Menggunakan Eager Loading agar tidak terjadi N+1 Query Problem saat render relasi di view
        $query = DetailServis::with(['booking.pelanggan', 'booking.kendaraan', 'teknisi']);

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('created_at', [
                $request->tanggal_awal . ' 00:00:00',
                $request->tanggal_akhir . ' 23:59:59'
            ]);
        }

        $data = $query->orderBy('created_at', 'desc')->get();
        $totalServis = $data->count();

        return view('admin.laporan.detailservis', compact('data', 'totalServis'));
    }

    public function sparepart()
    {
        $data = Sparepart::all();
        return view('admin.laporan.sparepart', compact('data'));
    }

    public function penggunaanSparepart(Request $request)
    {
        // FIX: Menggunakan Eager Loading agar tahu sparepart apa yang digunakan dan untuk unit servis mana
        $query = PenggunaanSparepart::with(['sparepart', 'detailServis.booking.pelanggan']);

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('created_at', [
                $request->tanggal_awal . ' 00:00:00',
                $request->tanggal_akhir . ' 23:59:59'
            ]);
        }

        $data = $query->orderBy('created_at', 'desc')->get();
        $totalItemTerpakai = $data->sum('jumlah');

        return view('admin.laporan.penggunaan_sparepart', compact('data', 'totalItemTerpakai'));
    }

    public function transaksi(Request $request)
    {
        // FIX: Menggunakan relasi berantai ter-eager-load dengan rapi
        $query = Transaksi::with([
            'detailServis.booking.pelanggan', 
            'detailServis.booking.kendaraan'
        ]);

        // Filter rentang tanggal transaksi
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('created_at', [
                $request->tanggal_awal . ' 00:00:00',
                $request->tanggal_akhir . ' 23:59:59'
            ]);
        }

        $data = $query->orderBy('created_at', 'desc')->get();

        // FIX & PENINGKATAN STATISTIK: Menggunakan PascalCase 'Lunas'/'Belum Lunas' agar konsisten dengan TransaksiController
        $totalTransaksi = $data->count();
        $totalPendapatan = $data->where('status_pembayaran', 'Lunas')->sum('total_biaya');
        $totalLunas = $data->where('status_pembayaran', 'Lunas')->count();
        $totalBelumLunas = $data->whereIn('status_pembayaran', ['Belum Lunas', 'Menunggu Pembayaran'])->count();

        return view('admin.laporan.transaksi', compact(
            'data', 
            'totalTransaksi', 
            'totalPendapatan', 
            'totalLunas', 
            'totalBelumLunas'
        ));
    }
}