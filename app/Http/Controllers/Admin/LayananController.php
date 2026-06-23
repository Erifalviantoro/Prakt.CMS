<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
public function index()
{
    $layanans = Layanan::all();

    $totalLayanan = Layanan::count();

    $layananAktif = Layanan::where('status', 'Aktif')->count();

    $layananNonaktif = Layanan::where('status', 'Nonaktif')->count();

    return view('admin.layanan.index', compact(
        'layanans',
        'totalLayanan',
        'layananAktif',
        'layananNonaktif'
    ));
}

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric',
            'estimasi_waktu' => 'nullable',
            'status' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('gambar')) {

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('layanan', 'public');

        }

        Layanan::create($validated);

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function show(Layanan $layanan)
    {
        return view('admin.layanan.show', compact('layanan'));
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric',
            'estimasi_waktu' => 'nullable',
            'status' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('gambar')) {

            if ($layanan->gambar) {

                Storage::disk('public')
                    ->delete($layanan->gambar);

            }

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('layanan', 'public');
        }

        $layanan->update($validated);

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->gambar) {

            Storage::disk('public')
                ->delete($layanan->gambar);

        }

        $layanan->delete();

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Data berhasil dihapus');
    }
}