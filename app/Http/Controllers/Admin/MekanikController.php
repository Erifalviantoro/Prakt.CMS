<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teknisi;
use Illuminate\Http\Request;

class MekanikController extends Controller
{
public function index()
{
    $teknisis = Teknisi::all();

    $totalTeknisi = Teknisi::count();

    // Teknisi ditambahkan bulan ini
    $teknisiBulanIni = Teknisi::whereMonth(
        'created_at',
        now()->month
    )->whereYear(
        'created_at',
        now()->year
    )->count();

    // Teknisi ditambahkan hari ini
    $teknisiHariIni = Teknisi::whereDate(
        'created_at',
        now()->toDateString()
    )->count();

    // Jumlah spesialisasi unik
    $jumlahSpesialisasi = Teknisi::distinct('spesialisasi')
        ->count('spesialisasi');

    return view('admin.mekanik.index', compact(
        'teknisis',
        'totalTeknisi',
        'teknisiBulanIni',
        'teknisiHariIni',
        'jumlahSpesialisasi'
    ));
}
public function create()
    {
        return view('admin.mekanik.create');
    }
public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'spesialisasi' => 'required',
        'nomor_telepon' => 'required',
        'alamat' => 'required',
    ]);

    Teknisi::create([
        'nama' => $request->nama,
        'spesialisasi' => $request->spesialisasi,
        'nomor_telepon' => $request->nomor_telepon,
        'alamat' => $request->alamat,
    ]);

    return redirect()
        ->route('admin.mekanik.index')
        ->with('success', 'Data teknisi berhasil ditambahkan');
}

    public function show($id)
    {
        $teknisi = Teknisi::findOrFail($id);

        return view('admin.mekanik.show', compact('teknisi'));
    }

    public function edit($id)
    {
        $teknisi = Teknisi::findOrFail($id);

        return view('admin.mekanik.edit', compact('teknisi'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'spesialisasi' => 'required',
        'nomor_telepon' => 'required',
        'alamat' => 'required',
    ]);

    $teknisi = Teknisi::findOrFail($id);

    $teknisi->update([
        'nama' => $request->nama,
        'spesialisasi' => $request->spesialisasi,
        'nomor_telepon' => $request->nomor_telepon,
        'alamat' => $request->alamat,
    ]);

    return redirect()
        ->route('admin.mekanik.index')
        ->with('success', 'Data mekanik berhasil diperbarui');
}

    public function destroy($id)
    {
        $teknisi = Teknisi::findOrFail($id);

        $teknisi->delete();

        return redirect()->route('admin.mekanik.index');
    }
}