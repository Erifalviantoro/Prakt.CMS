@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">
    @include('admin.layout.header')
    <!-- Page Content -->
    <div class="flex-1 p-gutter">
        
        <!-- Flash Message Sukses -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg text-label-md flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Breadcrumbs & Title Area -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <nav class="flex items-center gap-2 text-outline mb-2 font-label-sm text-label-sm">
                    <a class="hover:text-primary" href="#">Dashboard</a>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span class="text-on-surface-variant font-semibold">Manajemen Pelanggan</span>
                </nav>
                <h2 class="font-headline-lg text-headline-lg font-bold text-primary">Manajemen Pelanggan</h2>
                <p class="text-on-surface-variant mt-1">Kelola dan pantau seluruh data pelanggan bengkel Sumber Baru Motor.</p>
            </div>
            <a href="{{ route('admin.pelanggan.create') }}" class="bg-secondary text-on-secondary font-bold py-3 px-6 rounded-lg flex items-center justify-center gap-2 shadow-lg shadow-secondary/20 hover:bg-secondary-container transition-all active:scale-95 group shrink-0">
                <span class="material-symbols-outlined group-hover:rotate-90 transition-transform">add</span>
                <span>Tambah Pelanggan</span>
            </a>
        </div>

        <!-- Info Cards Area -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mb-8">
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4 group hover:border-primary transition-colors">
                <div class="w-12 h-12 bg-primary/5 rounded-lg flex items-center justify-center text-primary shrink-0">
                    <span class="material-symbols-outlined text-[32px]">group</span>
                </div>
                <div>
                    <p class="text-on-surface-variant text-label-sm font-label-sm uppercase tracking-wider">Total Pelanggan</p>
                    <h3 class="text-2xl font-bold text-primary">{{ number_format($totalPelanggan) }}</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4 group hover:border-primary transition-colors">
    
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600 shrink-0">
                <span class="material-symbols-outlined text-[32px]">today</span>
            </div>

            <div>
                <p class="text-on-surface-variant text-label-sm font-label-sm uppercase tracking-wider">
                    HARI INI
                </p>

                <h3 class="text-2xl font-bold text-primary">
                    {{ $pelangganHariIni }}
                </h3>
            </div>

        </div>
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4 group hover:border-primary transition-colors">
                <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-green-600 shrink-0">
                    <span class="material-symbols-outlined">person_add</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">BARU (BULAN INI)</p>
                    <h2 class="text-3xl font-bold">
                        {{ $pelangganBaru }}
                    </h2>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4 group hover:border-primary transition-colors">
                <div class="w-12 h-12 bg-secondary/5 rounded-lg flex items-center justify-center text-secondary shrink-0">
                    <span class="material-symbols-outlined">calendar_month</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">TERDAFTAR TAHUN INI</p>
                    <h2 class="text-3xl font-bold">
                        {{ $pelangganTahunIni }}
                    </h2>
                </div>
            </div>

        </div>

        <!-- Filter & Table Card -->
        <div class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden flex flex-col w-full">
            <div class="p-5 flex flex-wrap items-center justify-between gap-4 border-b border-outline-variant bg-surface-container-lowest">
                <div class="flex items-center gap-4 flex-wrap">
                    <div class="relative group">
                        <select class="appearance-none bg-white border border-outline-variant rounded-lg pl-4 pr-10 py-2 font-label-md text-label-md focus:ring-primary focus:border-primary cursor-pointer">
                            <option>Semua Kategori</option>
                            <option>Reguler</option>
                            <option>Premium</option>
                            <option>VIP</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-outline text-[18px]">expand_more</span>
                    </div>
                    <div class="h-8 w-px bg-outline-variant hidden sm:block"></div>
                    <p class="text-label-md font-label-md text-on-surface-variant">
                        Menampilkan <span class="font-bold text-primary">{{ $pelanggan->count() }}</span> pelanggan terbaru
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors">
                        <span class="material-symbols-outlined text-[20px]">filter_list</span>
                    </button>
                    <button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors">
                        <span class="material-symbols-outlined text-[20px]">download</span>
                    </button>
                </div>
            </div>
            
            <!-- Table Data -->
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="bg-primary text-white border-b border-outline-variant">
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider w-16">No</th>
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider">Nama Pelanggan</th>
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider">Nomor Telepon</th>
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider">Alamat</th>
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider">Pendaftaran</th>
                            <th class="px-6 py-4 font-label-md text-label-md uppercase tracking-wider text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($pelanggan as $index => $item)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-6 py-4 font-body-md text-on-surface">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <!-- Inisial Dinamis Dua Huruf Depan -->
                                        <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-primary font-bold shrink-0">
                                            {{ strtoupper(substr($item->nama, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-primary whitespace-nowrap">{{ $item->nama }}</p>
                                            <span class="text-xs px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full font-medium whitespace-nowrap">Customer</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-on-surface-variant">{{ $item->email }}</td>
                                <td class="px-6 py-4 text-on-surface-variant whitespace-nowrap">{{ $item->nomor_telepon }}</td>
                                <td class="px-6 py-4 text-on-surface-variant max-w-xs truncate">{{ $item->alamat }}</td>
                                <td class="px-6 py-4 text-on-surface-variant whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.pelanggan.show', $item->id) }}" class="p-1.5 text-primary hover:bg-primary-fixed-dim rounded transition-colors" title="Detail">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </a>
                                        <a href="{{ route('admin.pelanggan.edit', $item->id) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </a>
                                       <form action="{{ route('admin.pelanggan.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    onclick="openDeleteModal('{{ route('admin.pelanggan.destroy', $item->id) }}')" 
                                                    class="p-1.5 text-error hover:bg-error-container rounded transition-colors" 
                                                    title="Hapus">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-outline text-label-md bg-surface-container-lowest">
                                    Belum ada data pelanggan yang tersimpan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Container (Statis/Dinamis) -->
            <div class="p-5 flex flex-wrap items-center justify-between border-t border-outline-variant bg-surface-container-lowest gap-4">
                <button class="px-4 py-2 flex items-center gap-2 font-label-md text-label-md text-on-surface-variant hover:text-primary disabled:opacity-40 disabled:cursor-not-allowed" disabled>
                    <span class="material-symbols-outlined text-[18px]">chevron_left</span> Previous
                </button>
                <div class="flex items-center gap-1 flex-wrap">
                    <button class="w-10 h-10 rounded-lg bg-primary text-white font-bold text-label-md">1</button>
                </div>
                <button class="px-4 py-2 flex items-center gap-2 font-label-md text-label-md text-on-surface-variant hover:text-primary disabled:opacity-40 disabled:cursor-not-allowed" disabled>
                    Next <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </button>
            </div>
        </div>

        <!-- Bottom Widgets Area -->
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-gutter">
            <!-- Aktivitas Terkini Widget -->
            <div class="lg:col-span-2 glass-card rounded-xl p-6 shadow-sm overflow-hidden relative bg-white border border-outline-variant">
                <div class="flex justify-between items-start mb-6 gap-4">
                    <div>
                        <h4 class="font-headline-md text-headline-md font-bold text-primary">Aktivitas Terkini</h4>
                        <p class="text-on-surface-variant">Log pendaftaran dan perubahan data pelanggan terbaru.</p>
                    </div>
                    <button class="text-primary font-semibold text-label-md flex items-center gap-1 hover:underline shrink-0">
                        Lihat Semua Log <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </div>
                <div class="space-y-4">
                    @if($pelanggan->isNotEmpty())
                        <div class="flex gap-4 p-3 rounded-lg hover:bg-surface-container-low transition-colors group">
                            <div class="mt-1 w-2 h-2 rounded-full bg-green-500 shrink-0"></div>
                            <div>
                                <p class="text-primary font-medium">{{ $pelanggan->first()->nama }} <span class="text-on-surface-variant font-normal">berhasil didaftarkan ke dalam sistem bengkel.</span></p>
                                <span class="text-xs text-outline">Baru Saja • Sistem</span>
                            </div>
                        </div>
                    @endif
                    <div class="flex gap-4 p-3 rounded-lg hover:bg-surface-container-low transition-colors group border-l-2 border-transparent hover:border-blue-500">
                        <div class="mt-1 w-2 h-2 rounded-full bg-blue-500 shrink-0"></div>
                        <div>
                            <p class="text-primary font-medium">Informasi Alamat <span class="text-on-surface-variant font-normal">Pelanggan diperbarui.</span></p>
                            <span class="text-xs text-outline">5 jam yang lalu • Oleh System</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- IT Support Card -->
            <div class="bg-primary text-white rounded-xl p-6 shadow-lg relative overflow-hidden flex flex-col justify-between min-h-[250px]">
                <div class="relative z-10">
                    <h4 class="font-headline-md text-headline-md font-bold mb-2">Butuh Bantuan?</h4>
                    <p class="text-surface-variant opacity-80 font-body-md">Kesulitan mengelola database pelanggan atau butuh fitur tambahan? Hubungi IT Support kami.</p>
                </div>
                <div class="mt-8 space-y-3 relative z-10">
                    <div class="flex items-center gap-3 p-3 bg-white/10 rounded-lg backdrop-blur-sm">
                        <span class="material-symbols-outlined">mail</span>
                        <span class="font-label-md truncate">support@sumberbaru.com</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/10 rounded-lg backdrop-blur-sm">
                        <span class="material-symbols-outlined">headset_mic</span>
                        <span class="font-label-md">021-9988-7766</span>
                    </div>
                </div>
                <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-[160px] opacity-10 pointer-events-none">engineering</span>
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
            <h3 class="font-bold text-label-lg text-on-surface">Hapus Data Pelanggan</h3>
        </div>
        <p class="text-label-md text-on-surface-variant mb-6">Apakah Anda yakin ingin menghapus data pelanggan ini? Tindakan ini tidak dapat dibatalkan.</p>
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