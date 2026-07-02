<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
{
    $contacts = Contact::latest()->get();

    return view('admin.contacts.index', compact('contacts'));
}
    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'pesan' => 'required',
        ]);

        Contact::create([
            'nama'  => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'pesan' => $request->pesan,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
public function destroy(Contact $contact)
{
    $contact->delete();

    return redirect()->route('admin.contacts')
                     ->with('success', 'Pesan berhasil dihapus.');
}
}
