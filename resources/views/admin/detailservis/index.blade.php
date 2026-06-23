@extends('admin.layout.layout')
@php
use Illuminate\Support\Str;
@endphp

@section('content')

<main class="pl-64 min-h-screen">
    @include('admin.layout.header')
    
    <div class="p-8 max-w-7xl mx-auto">
        
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            <p class="text-sm font-bold">{{ session('success') }}</p>
        </div>
        @endif
        
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex items-center gap-2 text-on-surface-variant mb-2">
                    <a class="font-label-sm text-label-sm hover:text-secondary" href="#">Dashboard</a>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <span class="font-label-sm text-label-sm text-secondary font-bold">Detail Servis</span>
                </nav>
                <h2 class="font-headline-lg text-headline-lg text-primary">Detail Servis</h2>
                <p class="text-on-surface-variant">Mengelola dan memantau catatan perawatan teknis untuk semua sepeda motor.</p>
            </div>
            <a href="{{ route('admin.detailservis.create') }}"
               class="flex items-center gap-2 px-6 py-3 bg-secondary text-white font-bold rounded-xl shadow-lg shadow-secondary/20 hover:scale-[1.02] transition-transform">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add</span>
                Tambah Detail Servis
            </a>
        </div>

        {{-- Bento Cards - Counter Statis Kini Selaras dengan status_servis dari Controller --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bento-card p-6 bg-white border border-outline-variant rounded-xl flex items-center gap-4">
                <div class="p-3 bg-primary/5 text-primary rounded-lg">
                    <span class="material-symbols-outlined">pending_actions</span>
                </div>
                <div>
                    <p class="text-on-surface-variant text-xs font-bold uppercase">Pending</p>
                    <h4 class="font-headline-md text-headline-md text-primary">{{ $pending }}</h4>
                </div>
            </div>
            <div class="bento-card p-6 bg-white border border-outline-variant rounded-xl flex items-center gap-4">
                <div class="p-3 bg-secondary/5 text-secondary rounded-lg">
                    <span class="material-symbols-outlined">sync</span>
                </div>
                <div>
                    <p class="text-on-surface-variant text-xs font-bold uppercase">In Progress</p>
                    <h4 class="font-headline-md text-headline-md text-primary">{{ $progress }}</h4>
                </div>
            </div>
            <div class="bento-card p-6 bg-white border border-outline-variant rounded-xl flex items-center gap-4">
                <div class="p-3 bg-green-500/5 text-green-600 rounded-lg">
                    <span class="material-symbols-outlined">check_circle</span>
                </div>
                <div>
                    <p class="text-on-surface-variant text-xs font-bold uppercase">Completed</p>
                    <h4 class="font-headline-md text-headline-md text-primary">{{ $completed }}</h4>
                </div>
            </div>
            <div class="bento-card p-6 bg-white border border-outline-variant rounded-xl flex items-center gap-4">
                <div class="p-3 bg-orange-500/5 text-orange-600 rounded-lg">
                    <span class="material-symbols-outlined">schedule</span>
                </div>
                <div>
                    <p class="text-on-surface-variant text-xs font-bold uppercase">Avg Time</p>
                    <h4 class="font-headline-md text-headline-md text-primary">45m</h4>
                </div>
            </div>
        </div>

        <div class="bg-white border border-outline-variant rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-outline-variant flex flex-col md:flex-row gap-4 items-center justify-between bg-surface-container-low">
                <div class="flex flex-wrap items-center gap-4 w-full md:w-auto">
                    <div class="relative w-full md:w-64">
                        <select class="w-full pl-4 pr-10 py-2.5 bg-white border border-outline-variant rounded-lg appearance-none focus:ring-2 ring-secondary/20 font-label-md text-label-md">
                            <option>Filter Teknisi</option>
                            <option>Budi Santoso</option>
                            <option>Agus Pratama</option>
                            <option>Dewi Sartika</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-outline">expand_more</span>
                    </div>
                    <div class="relative w-full md:w-64">
                        <input class="w-full px-4 py-2.5 bg-white border border-outline-variant rounded-lg focus:ring-2 ring-secondary/20 font-label-md text-label-md" type="date"/>
                    </div>
                </div>
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <button class="p-2.5 bg-white border border-outline-variant rounded-lg hover:bg-surface-container transition-colors text-on-surface-variant">
                        <span class="material-symbols-outlined">filter_list</span>
                    </button>
                    <button class="p-2.5 bg-white border border-outline-variant rounded-lg hover:bg-surface-container transition-colors text-on-surface-variant">
                        <span class="material-symbols-outlined">download</span>
                    </button>
                </div>
            </div>

            <div class="table-container overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[1050px]">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider">Booking Pelanggan</th>
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider">Nama Teknisi</th>
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider">Deskripsi Servis</th>
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider">Waktu Mulai</th>
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider">Waktu Selesai</th>
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider text-center">Status</th>
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($detailServis as $item)
                        <tr class="hover:bg-surface-container-lowest transition-colors">
                            <td class="px-6 py-4 font-bold text-primary">
                                #BKG-{{ $item->booking_id }}
                                <span class="block text-xs text-gray-500 font-normal">{{ $item->booking->pelanggan->nama ?? 'Tanpa Nama' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->teknisi->nama ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-800 block">{{ $item->jenis_servis }}</span>
                                <span class="text-xs text-gray-400 block">{{ Str::limit($item->deskripsi, 40) ?? 'Tidak ada deskripsi' }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $item->waktu_mulai ? \Carbon\Carbon::parse($item->waktu_mulai)->format('d M Y H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $item->waktu_selesai ? \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{-- Badge Status Berdasarkan Kolom status_servis --}}
                                @if($item->status_servis == 'selesai')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wider">
                                        Completed
                                    </span>
                                @elseif($item->status_servis == 'proses')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase tracking-wider animate-pulse">
                                        In Progress
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-bold uppercase tracking-wider">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    
                                    {{-- Tombol Aksi Cepat Mengubah Status Langsung dari Tabel --}}
                                    @if($item->status_servis == 'antrian' || !$item->status_servis)
                                        <form action="{{ route('admin.detailservis.mulai', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg flex items-center justify-center transition-colors" title="Mulai Kerja">
                                                <span class="material-symbols-outlined text-[18px]">play_arrow</span>
                                            </button>
                                        </form>
                                    @elseif($item->status_servis == 'proses')
                                        <form action="{{ route('admin.detailservis.selesai', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="p-2 text-green-600 bg-green-50 hover:bg-green-100 rounded-lg flex items-center justify-center transition-colors" title="Selesaikan Kerja">
                                                <span class="material-symbols-outlined text-[18px]">done</span>
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('admin.detailservis.show', $item->id) }}" class="p-2 text-primary hover:bg-primary/5 rounded-lg" title="Detail">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </a>

                                    <a href="{{ route('admin.detailservis.edit', $item->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg" title="Edit">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>

                                    <button type="button" onclick="openDeleteModal('{{ route('admin.detailservis.destroy', $item->id) }}')" class="p-2 text-error hover:bg-error/10 rounded-lg transition-all flex items-center justify-center" title="Hapus">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-gray-400">
                                Tidak ada data detail servis
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-outline-variant flex flex-col md:flex-row items-center justify-between gap-4 bg-surface-container-low">
                <p class="text-on-surface-variant text-sm">Menampilkan data antrian servis aktif</p>
                <div>
                    {{ $detailServis->links() }}
                </div>
            </div>
        </div>

    </div>
</main>

{{-- Custom Elegant Delete Modal Confirmation --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm opacity-0 transition-opacity duration-200">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-xl transform scale-95 transition-transform duration-200">
        <div class="flex items-center gap-3 text-error mb-4">
            <div class="w-10 h-10 rounded-xl bg-error/10 flex items-center justify-center">
                <span class="material-symbols-outlined">warning</span>
            </div>
            <h3 class="font-bold text-label-lg text-on-surface">Hapus Data Detail Servis</h3>
        </div>
        <p class="text-label-md text-on-surface-variant mb-6">Apakah Anda yakin ingin menghapus data detail servis ini? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex items-center justify-end gap-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 border border-outline-variant rounded-xl font-label-md text-on-surface-variant hover:bg-surface-container-low transition-colors">
                Batal
            </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-error hover:bg-error-container text-white font-label-md rounded-xl shadow-sm transition-all active:scale-95">
                    Hapus Data
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Modal Control Script --}}
<script>
    function openDeleteModal(actionUrl) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = actionUrl;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.querySelector('.transform').classList.remove('scale-95');
            modal.querySelector('.transform').classList.add('scale-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('opacity-0');
        modal.querySelector('.transform').classList.remove('scale-100');
        modal.querySelector('.transform').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 200);
    }
</script>
@endsection