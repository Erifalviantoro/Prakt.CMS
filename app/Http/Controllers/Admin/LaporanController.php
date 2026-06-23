<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.laporan.index');
    }

    public function booking()
    {
        $data = Booking::with(['pelanggan', 'kendaraan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.laporan.booking', compact('data'));
    }

    public function pelanggan()
    {
        $data = Pelanggan::all();
        return view('admin.laporan.pelanggan', compact('data'));
    }

    public function kendaraan()
    {
        $data = Kendaraan::all();
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

    public function detailServis()
    {
        $data = DetailServis::all();
        return view('admin.laporan.detailservis', compact('data'));
    }

    public function sparepart()
    {
        $data = Sparepart::all();
        return view('admin.laporan.sparepart', compact('data'));
    }

    public function penggunaanSparepart()
    {
        $data = PenggunaanSparepart::all();
        return view('admin.laporan.penggunaan_sparepart', compact('data'));
    }

    public function transaksi()
    {
        // FIX: Mengubah ke relasi berantai karena model Transaksi tidak terhubung langsung ke pelanggan & kendaraan
        $data = Transaksi::with([
            'detailServis.booking.pelanggan', 
            'detailServis.booking.kendaraan'
        ])
        ->orderBy('created_at', 'desc')
        ->get();

        // FIX: Mengubah string 'Lunas' menjadi lowercase 'lunas' demi kecocokan check constraint Oracle
        $totalPendapatan = Transaksi::where('status_pembayaran', 'lunas')->sum('total_biaya');

        return view('admin.laporan.transaksi', compact('data', 'totalPendapatan'));
    }
}