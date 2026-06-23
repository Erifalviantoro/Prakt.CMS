@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">
    @include('admin.layout.header')
    <div class="flex-1 p-gutter">
        
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg text-label-md flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <nav class="flex items-center gap-2 mb-8 text-on-surface-variant font-label-md text-label-md">
                    <a class="hover:text-primary transition-colors" href="#">Dashboard</a>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <a class="hover:text-primary transition-colors" href="{{ route('admin.kendaraan.index') }}">Manajemen Kendaraan</a>
                </nav>
                <h2 class="font-headline-md text-headline-md text-primary">Manajemen Kendaraan</h2>
            </div>
            <a href="{{ route('admin.kendaraan.create') }}" class="bg-secondary hover:bg-secondary-container text-on-secondary px-6 py-2.5 rounded-lg font-label-md flex items-center gap-2 shadow-md transition-all active:scale-95">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Tambah Kendaraan
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">motorcycle</span>
                </div>
                <div>
                    <p class="text-label-sm text-outline">Total Unit</p>
                    <p class="text-headline-md font-bold text-primary">{{ $totalKendaraan }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-secondary-fixed flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined">add_circle</span>
                </div>
                <div>
                    <p class="text-label-sm text-outline">Ditambah Bulan Ini</p>
                    <p class="text-headline-md font-bold text-primary">{{ $kendaraanBulanIni }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center text-tertiary">
                    <span class="material-symbols-outlined">today</span>
                </div>
                <div>
                    <p class="text-label-sm text-outline">Selesai Hari Ini</p>
                    <p class="text-headline-md font-bold text-primary">{{ $kendaraanHariIni }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center text-on-surface-variant">
                    <span class="material-symbols-outlined">new_releases</span>
                </div>
                <div>
                    <p class="text-label-sm text-outline">Produksi ≥ 2020</p>
                    <p class="text-headline-md font-bold text-primary">{{ $kendaraanBaru }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-outline-variant shadow-sm mb-6">
            <div class="p-6 border-b border-outline-variant flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4 w-full md:w-auto">
                    <div class="relative flex-1 md:flex-initial">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                        <input class="pl-10 pr-4 py-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg w-full md:w-80 focus:ring-2 focus:ring-primary transition-all text-label-md" placeholder="Cari Plat Nomor..." type="text"/>
                    </div>
                    <button class="px-4 py-2.5 border border-outline-variant rounded-lg font-label-md text-on-surface-variant hover:bg-surface-container-low flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">filter_list</span>
                        Filter
                    </button>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-label-sm text-outline">Urutkan:</span>
                    <select class="border-none bg-transparent font-label-md text-primary focus:ring-0 cursor-pointer">
                        <option>Terbaru</option>
                        <option>Plat Nomor (A-Z)</option>
                        <option>Tahun</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-primary text-white font-label-md">
                        <tr>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-[11px]">No</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-[11px]">Nomor Plat</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-[11px]">Merk</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-[11px]">Model</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-[11px]">No. Mesin</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-[11px]">Tahun Pembuatan</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-[11px] text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($kendaraan as $index => $item)
                            <tr class="data-table-row hover:bg-primary-container/5 transition-colors group">
                                <td class="px-6 py-4 text-label-md text-on-surface-variant">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-bold text-primary font-mono tracking-wider">{{ $item->nomor_plat }}</td>
                                <td class="px-6 py-4 text-label-md">{{ $item->merk_kendaraan }}</td>
                                <td class="px-6 py-4 text-label-md">{{ $item->model_kendaraan }}</td>
                                <td class="px-6 py-4 text-label-md font-mono text-xs">{{ $item->nomor_mesin }}</td>
                                <td class="px-6 py-4 text-label-md">{{ $item->tahun_pembuatan }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.kendaraan.show', $item->id) }}" class="p-2 text-primary hover:bg-primary-container/10 rounded-lg transition-all flex items-center justify-center" title="Detail">
                                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        </a>
                                        <a href="{{ route('admin.kendaraan.edit', $item->id) }}" class="p-2 text-on-surface-variant hover:bg-surface-container-highest rounded-lg transition-all flex items-center justify-center" title="Edit">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </a>
                                        <form action="{{ route('admin.kendaraan.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kendaraan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="openDeleteModal('{{ route('admin.kendaraan.destroy', $item->id) }}')" class="p-2 text-error hover:bg-error/10 rounded-xl transition-all flex items-center justify-center" title="Hapus">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-outline text-label-md">
                                    Belum ada data kendaraan yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-outline-variant flex flex-col md:flex-row md:items-center justify-between gap-4">
                <p class="text-label-md text-outline">Menampilkan {{ $kendaraan->count() }} dari {{ $totalKendaraan }} data</p>
                <div class="flex items-center gap-2">
                    {{-- Navigasi halaman statis bawaan layout asli --}}
                    <button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors disabled:opacity-50" disabled="">
                        <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                    </button>
                    <button class="w-10 h-10 bg-primary text-white font-bold rounded-lg transition-all">1</button>
                    <button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors" disabled="">
                        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 bg-white p-6 rounded-xl border border-outline-variant shadow-sm relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-label-md font-bold text-primary mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">insights</span>
                        Analisis Populasi Merk
                    </h3>
                    <div class="flex flex-wrap gap-6 items-end">
                        <div class="flex-1 min-w-[120px]">
                            <div class="flex justify-between items-end mb-1">
                                <span class="text-[12px] font-bold text-on-surface">Honda</span>
                                <span class="text-[11px] text-outline">45%</span>
                            </div>
                            <div class="w-full h-2 bg-surface-container-low rounded-full overflow-hidden">
                                <div class="h-full bg-primary" style="width: 45%;"></div>
                            </div>
                        </div>
                        <div class="flex-1 min-w-[120px]">
                            <div class="flex justify-between items-end mb-1">
                                <span class="text-[12px] font-bold text-on-surface">Yamaha</span>
                                <span class="text-[11px] text-outline">35%</span>
                            </div>
                            <div class="w-full h-2 bg-surface-container-low rounded-full overflow-hidden">
                                <div class="h-full bg-secondary" style="width: 35%;"></div>
                            </div>
                        </div>
                        <div class="flex-1 min-w-[120px]">
                            <div class="flex justify-between items-end mb-1">
                                <span class="text-[12px] font-bold text-on-surface">Lainnya</span>
                                <span class="text-[11px] text-outline">20%</span>
                            </div>
                            <div class="w-full h-2 bg-surface-container-low rounded-full overflow-hidden">
                                <div class="h-full bg-outline" style="width: 20%;"></div>
                            </div>
                        </div>
                    </div>
                    <p class="mt-6 text-[12px] text-outline leading-relaxed italic">
                        *Data berdasarkan statistik servis kumulatif 6 bulan terakhir.
                    </p>
                </div>
            </div>
            <div class="bg-primary text-white p-6 rounded-xl shadow-lg flex flex-col justify-between group overflow-hidden relative">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <span class="material-symbols-outlined text-[120px]">speed</span>
                </div>
                <div class="relative z-10">
                    <h4 class="text-label-md font-bold text-secondary-fixed mb-1 uppercase tracking-widest">Target Servis</h4>
                    <p class="text-headline-lg font-bold">150 Unit</p>
                    <p class="text-[12px] opacity-70">Sisa 28 unit untuk mencapai target bulan ini.</p>
                </div>
                <div class="mt-4 relative z-10">
                    <button class="text-[12px] font-bold underline decoration-secondary decoration-2 underline-offset-4 hover:text-secondary-fixed transition-colors">
                        Lihat Detail Laporan
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
<div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm opacity-0 transition-opacity duration-200">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-xl transform scale-95 transition-transform duration-200">
        <div class="flex items-center gap-3 text-error mb-4">
            <div class="w-10 h-10 rounded-xl bg-error/10 flex items-center justify-center">
                <span class="material-symbols-outlined">warning</span>
            </div>
            <h3 class="font-bold text-label-lg text-on-surface">Hapus Data Kendaraan</h3>
        </div>
        <p class="text-label-md text-on-surface-variant mb-6">Apakah Anda yakin ingin menghapus data kendaraan ini? Tindakan ini tidak dapat dibatalkan.</p>
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