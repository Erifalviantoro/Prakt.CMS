@extends('admin.layout.layout')
@section('content')
<main class="pl-64 pt-16 min-h-screen">
    @include('admin.layout.header')
<div class="p-gutter max-w-container-max-width mx-auto">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 mb-8 text-on-surface-variant font-label-md text-label-md">
        <a class="hover:text-primary transition-colors" href="#">Dashboard</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <a class="hover:text-primary transition-colors" href="{{ route('admin.detailservis.index') }}">Detail Servis</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-primary font-bold">Edit</span>
    </nav>

    <!-- Header -->
<div class="flex justify-between items-end mb-8">
    <div>
        <h3 class="font-headline-lg text-headline-lg text-primary mb-2">Edit Detail Servis</h3>
        <p class="text-on-surface-variant text-body-md">Refining service record for
            {{-- Mengubah nomor plat menjadi dinamis --}}
            <span class="font-bold text-on-surface">
                {{ $detailServis->booking?->kendaraan?->nomor_plat ?? 'No Plat -' }}
            </span> 
            {{-- Mengubah tipe/model motor menjadi dinamis --}}
            ({{ $detailServis->booking?->kendaraan?->model ?? $detailServis->booking?->kendaraan?->merk ?? 'Motor' }})
            {{-- Menambahkan nama pelanggan/pemilik (opsional agar informasi lebih lengkap) --}}
            • Pemilik: <span class="font-medium text-on-surface">{{ $detailServis->booking?->pelanggan?->nama ?? '-' }}</span>
        </p>
    </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.detailservis.index') }}"
               class="px-6 py-2.5 font-label-md text-label-md border-2 border-primary text-primary rounded-lg hover:bg-primary/5 transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined">close</span>
                Batal
            </a>
            <button type="submit" form="formEditServis"
                    class="px-8 py-2.5 font-label-md text-label-md bg-secondary-container text-on-secondary-container rounded-lg hover:opacity-90 shadow-md flex items-center gap-2">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">save</span>
                Simpan Perubahan
            </button>
        </div>
    </div>

    @php
        $totalSparepart = $detailServis->penggunaanSparepart->sum('subtotal');
        $total = $detailServis->biaya_jasa + $totalSparepart;
    @endphp

    <form id="formEditServis"
          action="{{ route('admin.detailservis.update', $detailServis->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-12 gap-6">

            <!-- LEFT COLUMN -->
            <div class="col-span-12 lg:col-span-8 space-y-6">

                <!-- Deskripsi Servis -->
                <div class="bg-surface border border-outline-variant rounded-xl p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-4 text-primary">
                        <span class="material-symbols-outlined">description</span>
                        <h4 class="font-headline-md text-[18px]">Deskripsi Servis</h4>
                    </div>
                    <textarea
                        name="deskripsi"
                        class="w-full bg-surface-container-low border border-outline-variant rounded-lg p-4"
                        rows="4">{{ old('deskripsi', $detailServis->deskripsi) }}</textarea>
                </div>

                <!-- Catatan Teknisi -->
                <div class="bg-surface border border-outline-variant rounded-xl p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-4 text-primary">
                        <span class="material-symbols-outlined">assignment_turned_in</span>
                        <h4 class="font-headline-md text-[18px]">Catatan Teknisi</h4>
                    </div>
                    <textarea
                        name="catatan"
                        class="w-full bg-surface-container-low border border-outline-variant rounded-lg p-4"
                        rows="4">{{ old('catatan', $detailServis->catatan) }}</textarea>
                </div>

                <!-- Sparepart -->
                <div class="bg-surface border border-outline-variant rounded-xl p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center gap-2 text-primary">
                            <span class="material-symbols-outlined">settings_input_component</span>
                            <h4 class="font-headline-md text-[18px]">Sparepart Yang Digunakan</h4>
                        </div>
                        <button type="button"
                                class="text-secondary font-label-md text-label-md flex items-center gap-1 hover:underline">
                            <span class="material-symbols-outlined text-[18px]">add</span> Tambah Part
                        </button>
                    </div>
                    <div class="space-y-3">
                        @forelse($detailServis->penggunaanSparepart as $item)
                        <div class="flex items-center gap-4 p-3 bg-surface-container rounded-lg border border-transparent hover:border-outline-variant transition-all">
                            <span class="material-symbols-outlined text-on-surface-variant">oil_barrel</span>
                            <div class="flex-1">
                                <p class="font-label-md text-label-md text-on-surface">{{ $item->sparepart->nama ?? '-' }}</p>
                                <p class="text-[12px] text-on-surface-variant">Qty: {{ $item->jumlah }} Units • Part #{{ $item->sparepart->kode ?? '-' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-label-md text-label-md text-on-surface">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                            <button type="button" class="text-on-surface-variant hover:text-error transition-colors p-1">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                        @empty
                        <p class="text-on-surface-variant text-sm text-center py-4">Belum ada sparepart yang digunakan.</p>
                        @endforelse
                    </div>
                </div>

            </div>
            <!-- END LEFT COLUMN -->

            <!-- RIGHT COLUMN -->
            <div class="col-span-12 lg:col-span-4 space-y-6">

                <!-- Timeline -->
                <div class="bg-surface border border-outline-variant rounded-xl p-6 shadow-sm overflow-hidden relative">
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl"></div>
                    <div class="flex items-center gap-2 mb-6 text-primary">
                        <span class="material-symbols-outlined">schedule</span>
                        <h4 class="font-headline-md text-[18px]">Timeline</h4>
                    </div>
                    <div class="space-y-5">
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-2">Waktu Mulai</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[18px]">play_arrow</span>
                                </span>
                                <input
                                    type="datetime-local"
                                    name="waktu_mulai"
                                    value="{{ old('waktu_mulai', $detailServis->waktu_mulai ? \Carbon\Carbon::parse($detailServis->waktu_mulai)->format('Y-m-d\TH:i') : '') }}"
                                    class="w-full bg-surface-container-low border border-outline-variant rounded-lg pl-10 pr-4 py-2">
                            </div>
                        </div>
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-2">Waktu Selesai</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[18px]">done_all</span>
                                </span>
                                <input
                                    type="datetime-local"
                                    name="waktu_selesai"
                                    value="{{ old('waktu_selesai', $detailServis->waktu_selesai ? \Carbon\Carbon::parse($detailServis->waktu_selesai)->format('Y-m-d\TH:i') : '') }}"
                                    class="w-full bg-surface-container-low border border-outline-variant rounded-lg pl-10 pr-4 py-2">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biaya Jasa -->
                <div class="bg-primary dark:bg-primary-container rounded-xl p-6 shadow-lg text-on-primary">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined">payments</span>
                        <h4 class="font-headline-md text-[18px]">Biaya Jasa</h4>
                    </div>
                    <div class="mb-8">
                        <label class="block font-label-md text-label-md text-primary-fixed-dim mb-2">Estimasi Biaya Jasa (IDR)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-primary-fixed-dim/50">
                                <span class="font-bold">Rp</span>
                            </span>
                            <input
                                type="number"
                                name="biaya_jasa"
                                value="{{ old('biaya_jasa', $detailServis->biaya_jasa) }}"
                                class="w-full bg-primary-container border border-primary-fixed-dim/20 rounded-lg pl-10 pr-4 py-3">
                        </div>
                    </div>
                    <div class="pt-4 border-t border-white/20">
                        <div class="flex justify-between mb-2">
                            <span>Subtotal Sparepart</span>
                            <span>Rp {{ number_format($totalSparepart, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total Estimasi</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Service Status -->
<div class="bg-surface-container border border-outline-variant rounded-xl p-4 flex items-center gap-4">
    <div class="w-12 h-12 rounded-full bg-secondary-container/20 flex items-center justify-center text-secondary">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">build</span>
    </div>
    <div>
        <p class="text-[12px] text-on-surface-variant font-bold uppercase tracking-widest">Service Status</p>
        
        @if($detailServis->status_servis == 'antrian')
            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-bold">Antrian</span>
        @elseif($detailServis->status_servis == 'proses')
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-bold">Proses</span>
        @elseif($detailServis->status_servis == 'selesai')
            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold">Selesai</span>
        @endif

        {{-- Perubahan: Tombol sekarang menggunakan atribut 'form' eksternal --}}
        @if($detailServis->status_servis == 'antrian')
            <button type="submit" form="formMulaiServis" class="mt-3 block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                Mulai Servis
            </button>
        @endif

        @if($detailServis->status_servis == 'proses')
            <button type="submit" form="formSelesaiServis" class="mt-3 block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">
                Selesaikan Servis
            </button>
        @endif
    </div>
</div>

            </div>
            <!-- END RIGHT COLUMN -->

        </div>
    </form>

    <!-- Mobile Action Bar -->
    <div class="fixed bottom-0 left-0 right-0 p-4 bg-surface border-t border-outline-variant flex gap-2 md:hidden z-50">
        <a href="{{ route('admin.detailservis.index') }}"
           class="flex-1 py-3 text-center font-label-md text-label-md border-2 border-primary text-primary rounded-lg">
            Batal
        </a>
        <button type="submit" form="formEditServis"
                class="px-8 py-2.5 font-label-md text-label-md bg-secondary-container text-on-secondary-container rounded-lg hover:opacity-90 shadow-md flex items-center gap-2">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">save</span>
            Simpan Perubahan
        </button>
    </div>

</div>
</main>
{{-- Taruh form ini di bagian paling bawah halaman, di luar form utama --}}
<form id="formMulaiServis" action="{{ route('admin.detailservis.mulai', $detailServis->id) }}" method="POST" class="hidden">
    @csrf
</form>

<form id="formSelesaiServis" action="{{ route('admin.detailservis.selesai', $detailServis->id) }}" method="POST" class="hidden">
    @csrf
</form>
@endsection