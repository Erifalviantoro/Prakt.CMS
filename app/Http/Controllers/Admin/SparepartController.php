<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $spareparts = Sparepart::latest()->get();
        return view('admin.sparepart.index', compact('spareparts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sparepart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
   {
        $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        Sparepart::create($request->all());

        return redirect()->route('admin.sparepart.index')
                         ->with('success', 'Sparepart berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.sparepart.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
   {
        $sparepart = Sparepart::findOrFail($id);
        return view('admin.sparepart.edit', compact('sparepart'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
   {
        $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $sparepart = Sparepart::findOrFail($id);
        $sparepart->update($request->all());

        return redirect()->route('admin.sparepart.index')
                         ->with('success', 'Data sparepart berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sparepart = Sparepart::findOrFail($id);
        $sparepart->delete();

        return redirect()->route('admin.sparepart.index')
                         ->with('success', 'Sparepart berhasil dihapus!');
    }
}
