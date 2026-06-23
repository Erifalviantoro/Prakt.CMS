<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $pelanggan = Pelanggan::latest()->get();

    // Total pelanggan
    $totalPelanggan = Pelanggan::count();

    // Pelanggan baru bulan ini
    $pelangganBaru = Pelanggan::whereMonth(
        'tanggal_pendaftaran',
        now()->month
    )->whereYear(
        'tanggal_pendaftaran',
        now()->year
    )->count();

    // Pelanggan terdaftar tahun ini
    $pelangganTahunIni = Pelanggan::whereYear(
        'tanggal_pendaftaran',
        now()->year
    )->count();

 $pelangganHariIni = Pelanggan::whereDate(
    'tanggal_pendaftaran',
    now()->toDateString()
)->count();

    return view('admin.pelanggan.index', compact(
    'pelanggan',
    'totalPelanggan',
    'pelangganBaru',
    'pelangganTahunIni',
    'pelangganHariIni'
));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'                => 'required|string|max:255',
            'nomor_telepon'       => 'required|string|max:20',
            'email'               => 'required|email|max:255',
            'alamat'              => 'required|string',
            'tanggal_pendaftaran' => 'required|date',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'                => 'required|string|max:255',
            'nomor_telepon'       => 'required|string|max:20',
            'email'               => 'required|email|max:255',
            'alamat'              => 'required|string',
            'tanggal_pendaftaran' => 'required|date',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pelanggan::findOrFail($id)->delete();
        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus');
    }
}
