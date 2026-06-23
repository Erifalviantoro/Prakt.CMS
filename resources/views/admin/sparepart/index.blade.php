@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">
    @include('admin.layout.header')
    <div class="flex-1 p-gutter">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-primary">Manajemen Sparepart</h2>
                <p class="text-on-surface-variant font-body-md">Inventory management and parts tracking system.</p>
            </div>
            <a href="{{ route('admin.sparepart.create') }}" class="bg-secondary hover:bg-secondary-container text-on-secondary px-6 py-3 rounded-lg font-bold flex items-center gap-2 shadow-lg transition-all active:translate-y-1">
                <span class="material-symbols-outlined">add</span>
                Tambah Sparepart
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="md:col-span-2 bg-error-container/20 border border-error/20 p-6 rounded-xl flex items-center justify-between overflow-hidden relative group">
                <div class="relative z-10">
                    <div class="flex items-center gap-2 text-error font-bold mb-2">
                        <span class="material-symbols-outlined">warning</span>
                        <span class="font-label-md uppercase tracking-wider">Notifikasi Stok Menipis</span>
                    </div>
                    <h3 class="text-3xl font-bold text-primary">
                        {{ $spareparts->where('stok', '>', 0)->where('stok', '<', 5)->count() }} Items
                    </h3>
                    <p class="text-on-surface-variant text-sm">Need immediate replenishment.</p>
                </div>
                <div class="bg-error/10 p-4 rounded-full group-hover:scale-110 transition-transform duration-500">
                    <span class="material-symbols-outlined text-5xl text-error">inventory_2</span>
                </div>
            </div>

            <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl flex flex-col justify-between">
                <span class="material-symbols-outlined text-primary-container text-3xl mb-4">analytics</span>
                <div>
                    <h3 class="text-2xl font-bold text-primary">{{ $spareparts->count() }}</h3>
                    <p class="text-on-surface-variant text-sm">Total SKUs Tracked</p>
                </div>
            </div>

            <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl flex flex-col justify-between">
                <span class="material-symbols-outlined text-on-surface-variant text-3xl mb-4">cancel</span>
                <div>
                    <h3 class="text-2xl font-bold text-primary">
                        {{ $spareparts->where('stok', 0)->count() }}
                    </h3>
                    <p class="text-on-surface-variant text-sm">Currently Out of Stock</p>
                </div>
            </div>
        </div>

        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-primary text-on-primary">
                <span class="font-headline-md text-lg">Inventory List</span>
                <div class="flex items-center gap-2">
                    <button class="p-2 hover:bg-primary-container rounded transition-colors">
                        <span class="material-symbols-outlined text-sm">filter_list</span>
                    </button>
                    <button class="p-2 hover:bg-primary-container rounded transition-colors">
                        <span class="material-symbols-outlined text-sm">download</span>
                    </button>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-high/50 text-on-surface-variant font-label-sm border-b border-outline-variant">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">PART NAME</th>
                            <th class="px-6 py-4">STOCK LEVEL</th>
                            <th class="px-6 py-4">UNIT PRICE</th>
                            <th class="px-6 py-4">STATUS</th>
                            <th class="px-6 py-4 text-right">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="font-label-md text-on-surface">
                        @forelse($spareparts as $item)
                            <tr class="border-b border-outline-variant hover:bg-surface-container transition-colors group">
                                <td class="px-6 py-4 font-mono text-xs text-primary font-bold">
                                    SBM-PRT-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded bg-surface-container-high flex items-center justify-center">
                                            <span class="material-symbols-outlined text-primary">settings</span>
                                        </div>
                                        <span class="font-semibold">{{ $item->nama }}</span>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 h-2 bg-gray-100 rounded-full overflow-hidden">
                                            @if($item->stok == 0)
                                                <div class="bg-error h-full" style="width: 0%"></div>
                                            @elseif($item->stok < 5)
                                                <div class="bg-error h-full" style="width: 25%"></div>
                                            @else
                                                <div class="bg-primary h-full" style="width: 100%"></div>
                                            @endif
                                        </div>
                                        <span class="font-bold @if($item->stok < 5) text-error @else text-on-surface-variant @endif">
                                            {{ $item->stok }} pcs
                                        </span>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 font-medium">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    @if($item->stok == 0)
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-[10px] font-bold uppercase tracking-tighter">Out of Stock</span>
                                    @elseif($item->stok < 5)
                                        <span class="px-3 py-1 rounded-full bg-error-container text-on-error-container text-[10px] font-bold uppercase tracking-tighter">Low Stock</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-[10px] font-bold uppercase tracking-tighter">Available</span>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.sparepart.edit', ['sparepart' => $item->id]) }}" class="p-2 hover:bg-primary-container hover:text-on-primary-container rounded transition-all active:scale-90" title="Edit">
                                            <span class="material-symbols-outlined text-xl">edit_note</span>
                                        </a>
                                        <button type="button" 
                                                onclick="openDeleteModal('{{ route('admin.sparepart.destroy', ['sparepart' => $item->id]) }}')" 
                                                class="p-2 hover:text-error rounded transition-all active:scale-90" 
                                                title="Delete">
                                            <span class="material-symbols-outlined text-xl">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-on-surface-variant italic bg-gray-50/50">
                                    Belum ada data barang di inventaris Sumber Baru Motor.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 flex items-center justify-between bg-surface-container-low border-t border-outline-variant">
                <span class="text-sm text-on-surface-variant font-label-md">
                    Showing <span class="font-bold">1 - {{ $spareparts->count() }}</span> of <span class="font-bold">{{ $spareparts->count() }}</span> items
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
            <h3 class="font-bold text-label-lg text-on-surface">Hapus Data Sparepart</h3>
        </div>
        <p class="text-label-md text-on-surface-variant mb-6">Apakah Anda yakin ingin menghapus data sparepart ini? Tindakan ini tidak dapat dibatalkan.</p>
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