@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">
    @include('admin.layout.header')
    <div class="flex-1 p-gutter">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-primary">Penggunaan Sparepart</h2>
                <p class="text-on-surface-variant font-body-md">Sistem pelacakan dan pencatatan keluar/penggunaan komponen suku cadang.</p>
            </div>
            <a href="{{ route('admin.penggunaan-sparepart.create') }}" class="bg-secondary hover:bg-secondary-container text-on-secondary px-6 py-3 rounded-lg font-bold flex items-center gap-2 shadow-lg transition-all active:translate-y-1">
                <span class="material-symbols-outlined">add</span>
                Catat Penggunaan
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl flex items-center justify-between overflow-hidden relative group">
                <div>
                    <div class="flex items-center gap-2 text-primary font-bold mb-2">
                        <span class="material-symbols-outlined">analytics</span>
                        <span class="font-label-md uppercase tracking-wider">Total Transaksi</span>
                    </div>
                    <h3 class="text-3xl font-bold text-primary">
                        {{ $penggunaan->count() }} Kali
                    </h3>
                    <p class="text-on-surface-variant text-sm">Riwayat pengeluaran barang.</p>
                </div>
                <div class="bg-primary/10 p-4 rounded-full group-hover:scale-110 transition-transform duration-500">
                    <span class="material-symbols-outlined text-5xl text-primary">build_circle</span>
                </div>
            </div>

            <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl flex flex-col justify-between">
                <span class="material-symbols-outlined text-secondary text-3xl mb-4">count</span>
                <div>
                    <h3 class="text-2xl font-bold text-primary">
                        {{ $penggunaan->sum('jumlah') }} pcs
                    </h3>
                    <p class="text-on-surface-variant text-sm">Total Volume Sparepart Keluar</p>
                </div>
            </div>
        </div>

        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-primary text-on-primary">
                <span class="font-headline-md text-lg">Riwayat Penggunaan</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-high/50 text-on-surface-variant font-label-sm border-b border-outline-variant">
                            <th class="px-6 py-4">ID LOG</th>
                            <th class="px-6 py-4">NAMA SPAREPART</th>
                            <th class="px-6 py-4">JUMLAH KELUAR</th>
                            <th class="px-6 py-4">TANGGAL PENGUNAAN</th>
                            <th class="px-6 py-4">SUBTOTAL</th>
                            <th class="px-6 py-4 text-right">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="font-label-md text-on-surface">
                        @forelse($penggunaan as $item)
                            <tr class="border-b border-outline-variant hover:bg-surface-container transition-colors group">
                                <td class="px-6 py-4 font-mono text-xs text-primary font-bold">
                                    LOG-PGN-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded bg-surface-container-high flex items-center justify-center">
                                            <span class="material-symbols-outlined text-primary">settings</span>
                                        </div>
                                        <span class="font-semibold">{{ $item->sparepart->nama ?? 'Sparepart Tidak Ditemukan' }}</span>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 font-bold text-error">
                                    {{ $item->jumlah }} pcs
                                </td>
                                
                                <td class="px-6 py-4 text-on-surface-variant text-sm">
                                    {{ $item->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-primary font-bold">
    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.penggunaan-sparepart.edit', $item->id) }}" class="p-2 hover:bg-primary-container hover:text-on-primary-container rounded transition-all active:scale-90" title="Edit">
                                            <span class="material-symbols-outlined text-xl">edit_note</span>
                                        </a>
                                        <button type="button" 
                                                onclick="openDeleteModal('{{ route('admin.penggunaan-sparepart.destroy', $item->id) }}')" 
                                                class="p-2 hover:text-error rounded transition-all active:scale-90" 
                                                title="Delete">
                                            <span class="material-symbols-outlined text-xl">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-on-surface-variant italic bg-gray-50/50">
                                    Belum ada catatan riwayat penggunaan sparepart.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 flex items-center justify-between bg-surface-container-low border-t border-outline-variant">
                <span class="text-sm text-on-surface-variant font-label-md">
                    Showing <span class="font-bold">1 - {{ $penggunaan->count() }}</span> of <span class="font-bold">{{ $penggunaan->count() }}</span> items
                </span>
            </div>
        </div>
        
    </div>
</main>
{{-- Tempatkan ini di paling bawah file sebelum @endsection --}}

{{-- Custom Elegant Delete Modal Confirmation --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm opacity-0 transition-opacity duration-200">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-xl transform scale-95 transition-transform duration-200">
        <div class="flex items-center gap-3 text-error mb-4">
            <div class="w-10 h-10 rounded-xl bg-error/10 flex items-center justify-center">
                <span class="material-symbols-outlined">warning</span>
            </div>
            <h3 class="font-bold text-label-lg text-on-surface">Hapus Data Penggunaan Sparepart</h3>
        </div>
        <p class="text-label-md text-on-surface-variant mb-6">Apakah Anda yakin ingin menghapus data penggunaan sparepart ini? Tindakan ini tidak dapat dibatalkan.</p>
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