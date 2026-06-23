 @extends('admin.layout.layout')
 @section('content')
<!-- Main Content Area -->
<main class="ml-64 min-h-screen flex flex-col">
    @include('admin.layout.header')
<!-- View Content -->
<div class="flex-1 p-margin-desktop">
<!-- Page Header & Actions -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
<div>
<nav class="flex items-center gap-2 text-on-surface-variant mb-2">
<span class="font-label-sm text-label-sm">Dashboard</span>
<span class="material-symbols-outlined text-[16px]" data-icon="chevron_right">chevron_right</span>
<span class="font-label-sm text-label-sm text-primary font-bold">Technicians</span>
</nav>
<h2 class="font-headline-lg text-headline-lg text-primary">Manajemen Teknisi</h2>
<p class="text-on-surface-variant mt-1">Kelola data teknisi, keahlian khusus, dan ketersediaan jadwal servis.</p>
</div>
<a href="{{ route('admin.mekanik.create') }}"
   class="px-6 py-3 bg-secondary text-on-secondary font-bold rounded-lg flex items-center gap-2 shadow-md">
    <span class="material-symbols-outlined">
        person_add
    </span>
    <span>Tambah Teknisi</span>
</a>
</div>
<!-- Dashboard Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
<div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4">
<div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary">
<span class="material-symbols-outlined" data-icon="group">group</span>
</div>
<div>
<p class="font-label-md text-label-md text-on-surface-variant">Total Teknisi</p>
<p class="font-headline-md text-headline-md font-bold text-primary">{{ $totalTeknisi }}</p>
</div>
</div>
<div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4">
<div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-700">
<span class="material-symbols-outlined" data-icon="check_circle">person_add</span>
</div>
<div>
<p class="font-label-md text-label-md text-on-surface-variant">
    Bulan Ini
</p>
<p class="font-headline-md text-headline-md font-bold text-green-700">
    {{ $teknisiBulanIni }}
</p>
</div>
</div>
<div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4">
<div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center text-amber-700">
<span class="material-symbols-outlined" data-icon="engineering">today</span>
</div>
<div>
<p class="font-label-md text-label-md text-on-surface-variant">Teknisi Yang Bekerja Hari Ini</p>
<p class="font-headline-md text-headline-md font-bold text-amber-700">{{ $teknisiHariIni }}</p>
</div>
</div>
<div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4">
<div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-700">
<span class="material-symbols-outlined" data-icon="verified">handyman</span>
</div>
<div>
<p class="font-label-md text-label-md text-on-surface-variant">Jumlah Spesialisasi</p>
<p class="font-headline-md text-headline-md font-bold text-blue-700">{{ $jumlahSpesialisasi }}</p>
</div>
</div>
</div>
<!-- Filters & Search -->
<div class="glass-panel p-4 rounded-xl mb-6 flex flex-col md:flex-row gap-4 items-center">
<div class="relative flex-1 w-full">
<span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline" data-icon="search">search</span>
<input class="w-full pl-12 pr-4 py-3 bg-white border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-body-md transition-all" placeholder="Cari nama teknisi..." type="text"/>
</div>
<div class="flex items-center gap-4 w-full md:w-auto">
<div class="relative w-full md:w-56">
<span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline" data-icon="filter_list">filter_list</span>
<select class="w-full pl-12 pr-4 py-3 bg-white border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-body-md appearance-none transition-all">
<option>Semua Spesialisasi</option>
<option>Engine Specialist</option>
<option>Electrical</option>
<option>Suspension</option>
<option>Braking System</option>
</select>
</div>
<button class="p-3 bg-surface-container-high rounded-lg text-on-surface hover:bg-surface-variant transition-colors">
<span class="material-symbols-outlined" data-icon="refresh">refresh</span>
</button>
</div>
</div>
<!-- Data Table Card -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-lg overflow-hidden">
<div class="overflow-x-auto custom-scrollbar">
<table class="w-full border-collapse">
<thead>
<tr class="bg-primary text-on-primary">
<th class="px-6 py-4 text-left font-label-md text-label-md uppercase tracking-wider">Teknisi</th>
<th class="px-6 py-4 text-left font-label-md text-label-md uppercase tracking-wider">Spesialisasi</th>
<th class="px-6 py-4 text-left font-label-md text-label-md uppercase tracking-wider">Kontak</th>
<th class="px-6 py-4 text-left font-label-md text-label-md uppercase tracking-wider">Tingkat</th>
<th class="px-6 py-4 text-left font-label-md text-label-md uppercase tracking-wider">Status</th>
<th class="px-6 py-4 text-center font-label-md text-label-md uppercase tracking-wider">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
    @forelse($teknisis as $teknisi)
    <tr class="hover:bg-surface-container-low transition-colors group">

        <td class="px-6 py-4">
            <div>
                <p class="font-bold text-primary">
                    {{ $teknisi->nama }}
                </p>
                <p class="text-on-surface-variant text-sm">
                    ID: TK-{{ str_pad($teknisi->id, 4, '0', STR_PAD_LEFT) }}
                </p>
            </div>
        </td>

        <td class="px-6 py-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary/5 text-primary text-xs font-bold border border-primary/20">
                {{ $teknisi->spesialisasi }}
            </span>
        </td>

        <td class="px-6 py-4">
            {{ $teknisi->nomor_telepon }}
        </td>

        <td class="px-6 py-4">
            {{ $teknisi->alamat }}
        </td>

        <td class="px-6 py-4">
            <span class="text-green-600 font-semibold">
                Aktif
            </span>
        </td>

        <td class="px-6 py-4">
            <div class="flex items-center justify-center gap-2">

                <a href="{{ route('admin.mekanik.show', $teknisi->id) }}"
                   class="p-2 text-on-surface-variant hover:text-primary">
                    <span class="material-symbols-outlined">
                        visibility
                    </span>
                </a>

                <a href="{{ route('admin.mekanik.edit', $teknisi->id) }}"
                   class="p-2 text-on-surface-variant hover:text-blue-600">
                    <span class="material-symbols-outlined">
                        edit
                    </span>
                </a>

                <form id="delete-form-{{ $teknisi->id }}" action="{{ route('admin.mekanik.destroy', $teknisi->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="button" 
                            onclick="openDeleteModal('{{ route('admin.mekanik.destroy', $teknisi->id) }}')" 
                            class="p-2 text-on-surface-variant hover:text-red-600" 
                            title="Hapus">
                        <span class="material-symbols-outlined">
                            delete
                        </span>
                    </button>
                </form>

            </div>
        </td>

    </tr>
    @empty
    <tr>
        <td colspan="6" class="text-center py-5">
            Data teknisi belum tersedia
        </td>
    </tr>
    @endforelse
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="px-6 py-4 border-t border-outline-variant flex items-center justify-between bg-surface-container-lowest">
<p class="font-label-sm text-label-sm text-on-surface-variant">Showing 1-3 of 24 Technicians</p>
<div class="flex items-center gap-1">
<button class="p-2 rounded-lg border border-outline-variant text-on-surface hover:bg-surface-container-high disabled:opacity-50 transition-all" disabled="">
<span class="material-symbols-outlined" data-icon="keyboard_arrow_left">keyboard_arrow_left</span>
</button>
<button class="w-10 h-10 rounded-lg bg-primary text-on-primary font-bold transition-all">1</button>
<button class="w-10 h-10 rounded-lg hover:bg-surface-container-high text-on-surface transition-all">2</button>
<button class="w-10 h-10 rounded-lg hover:bg-surface-container-high text-on-surface transition-all">3</button>
<span class="px-2 text-outline">...</span>
<button class="w-10 h-10 rounded-lg hover:bg-surface-container-high text-on-surface transition-all">8</button>
<button class="p-2 rounded-lg border border-outline-variant text-on-surface hover:bg-surface-container-high transition-all">
<span class="material-symbols-outlined" data-icon="keyboard_arrow_right">keyboard_arrow_right</span>
</button>
</div>
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
            <h3 class="font-bold text-label-lg text-on-surface">Hapus Data Mekanik</h3>
        </div>
        <p class="text-label-md text-on-surface-variant mb-6">Apakah Anda yakin ingin menghapus data mekanik ini? Tindakan ini tidak dapat dibatalkan.</p>
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