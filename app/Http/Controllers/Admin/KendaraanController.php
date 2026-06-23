<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Booking;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $kendaraan = Kendaraan::latest()->get();

    // Total kendaraan
    $totalKendaraan = Kendaraan::count();

    // Kendaraan ditambahkan bulan ini
    $kendaraanBulanIni = Kendaraan::whereMonth(
        'created_at',
        now()->month
    )->whereYear(
        'created_at',
        now()->year
    )->count();

    // Kendaraan ditambahkan hari ini
    $kendaraanHariIni = Kendaraan::whereDate(
        'created_at',
        now()->toDateString()
    )->count();

    // Kendaraan produksi >= 2020
    $kendaraanBaru = Kendaraan::where(
        'tahun_pembuatan',
        '>=',
        2020
    )->count();

    return view(
        'admin.kendaraan.index',
        compact(
            'kendaraan',
            'totalKendaraan',
            'kendaraanBulanIni',
            'kendaraanHariIni',
            'kendaraanBaru'
        )
    );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kendaraan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nomor_plat' => 'required',
        'merk_kendaraan' => 'required',
        'model_kendaraan' => 'required',
        'nomor_mesin' => 'required',
        'tahun_pembuatan' => 'required|numeric'
    ]);

    Kendaraan::create([
        'nomor_plat' => $request->nomor_plat,
        'merk_kendaraan' => $request->merk_kendaraan,
        'model_kendaraan' => $request->model_kendaraan,
        'nomor_mesin' => $request->nomor_mesin,
        'tahun_pembuatan' => $request->tahun_pembuatan,
    ]);

    return redirect()
        ->route('admin.kendaraan.index')
        ->with('success', 'Data kendaraan berhasil ditambahkan');
}

    /**
     * Display the specified resource.
     */
public function show($id)
{
    $kendaraan = Kendaraan::findOrFail($id);

    // Ambil booking terbaru kendaraan ini beserta pelanggan
    $bookingTerakhir = Booking::with('pelanggan')
        ->where('kendaraan_id', $id)
        ->latest()
        ->first();

    // Ambil seluruh riwayat booking kendaraan
    $riwayatServis = Booking::with('pelanggan')
        ->where('kendaraan_id', $id)
        ->latest()
        ->get();

    return view(
        'admin.kendaraan.show',
        compact(
            'kendaraan',
            'bookingTerakhir',
            'riwayatServis'
        )
    );
}

    /**
     * Show the form for editing the specified resource.
     */
public function edit($id)
{
    $kendaraan = Kendaraan::findOrFail($id);

    return view('admin.kendaraan.edit', compact('kendaraan'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nomor_plat' => 'required',
        'merk_kendaraan' => 'required',
        'model_kendaraan' => 'required',
        'nomor_mesin' => 'required',
        'tahun_pembuatan' => 'required|numeric',
    ]);

    $kendaraan = Kendaraan::findOrFail($id);

    $kendaraan->update([
        'nomor_plat' => $request->nomor_plat,
        'merk_kendaraan' => $request->merk_kendaraan,
        'model_kendaraan' => $request->model_kendaraan,
        'nomor_mesin' => $request->nomor_mesin,
        'tahun_pembuatan' => $request->tahun_pembuatan,
    ]);

    return redirect()
        ->route('admin.kendaraan.index')
        ->with('success', 'Data kendaraan berhasil diperbarui');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    Kendaraan::findOrFail($id)->delete();

    return redirect()
        ->route('admin.kendaraan.index')
        ->with('success', 'Kendaraan berhasil dihapus');
}
}
