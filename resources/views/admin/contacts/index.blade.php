@extends('admin.layout.layout')

@section('content')

<div class="p-6 max-w-7xl mx-auto bg-gray-50 min-h-screen">
    
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Data Pesan Kontak</h3>
            <p class="text-sm text-gray-500 mt-1">Daftar semua kritik, saran, dan pertanyaan masuk dari pelanggan.</p>
        </div>
        <div class="bg-white border border-gray-200 px-4 py-2 rounded-xl shadow-sm text-sm font-medium text-gray-700 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
            Total Pesan: <span class="font-bold text-gray-900">{{ count($contacts) }}</span>
        </div>
    </div>

    <!-- Table Container Card -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/70 border-b border-gray-200 text-xs font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-6 text-center w-16">No</th>
                        <th class="py-4 px-6">Pengirim</th>
                        <th class="py-4 px-6">Kontak</th>
                        <th class="py-4 px-6 w-1/3">Isi Pesan</th>
                        <th class="py-4 px-6 text-right">Tanggal Masuk</th>
                        <th class="py-4 px-6 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($contacts as $contact)
                    <tr class="hover:bg-gray-50/50 transition duration-150 group">
                        <!-- No -->
                        <td class="py-4 px-6 text-center font-mono font-medium text-gray-400 group-hover:text-gray-600">
                            {{ $loop->iteration }}
                        </td>
                        
                        <!-- Nama -->
                        <td class="py-4 px-6">
                            <span class="font-bold text-gray-800 tracking-wide block">{{ $contact->nama }}</span>
                        </td>
                        
                        <!-- Kontak -->
                        <td class="py-4 px-6 space-y-1">
                            <div class="flex items-center gap-1.5 text-gray-600">
                                <span class="text-gray-400 text-xs">✉️</span>
                                <a href="mailto:{{ $contact->email }}" class="hover:text-blue-600 hover:underline transition">{{ $contact->email }}</a>
                            </div>
                            <div class="flex items-center gap-1.5 text-gray-600">
                                <span class="text-gray-400 text-xs">💬</span>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->no_hp) }}" target="_blank" class="hover:text-green-600 hover:underline transition font-mono">
                                    {{ $contact->no_hp }}
                                </a>
                            </div>
                        </td>
                        
                        <!-- Pesan -->
                        <td class="py-4 px-6">
                            <p class="text-gray-600 leading-relaxed break-words whitespace-pre-line">
                                {{ $contact->pesan }}
                            </p>
                        </td>
                        
                        <!-- Tanggal -->
                        <td class="py-4 px-6 text-right text-xs text-gray-400 group-hover:text-gray-600 font-medium whitespace-nowrap">
                            <span class="block text-gray-700 font-semibold mb-0.5">
                                {{ \Carbon\Carbon::parse($contact->created_at)->translatedFormat('d F Y') }}
                            </span>
                            <span class="font-mono text-[11px] bg-gray-100 px-1.5 py-0.5 rounded">
                                {{ \Carbon\Carbon::parse($contact->created_at)->format('H:i') }} WIB
                            </span>
                        </td>

                        <!-- Kolom Aksi (Tombol Hapus) -->
                        <td class="py-4 px-6 text-center whitespace-nowrap">
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 px-6 text-center text-gray-400 bg-white">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <span class="text-3xl">📥</span>
                                <p class="text-sm font-medium">Belum ada pesan masuk dari halaman kontak.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection