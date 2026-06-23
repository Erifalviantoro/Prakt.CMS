@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen">
    @include('admin.layout.header')
    <header class="flex justify-between items-center w-full px-gutter py-4 bg-surface dark:bg-surface-dim border-b border-outline-variant dark:border-outline">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.transaksi.index') }}" class="p-2 hover:bg-surface-container-high rounded-full transition-colors flex items-center justify-center">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-headline-md text-headline-md font-bold text-primary dark:text-inverse-primary">Edit Transaksi</h2>
        </div>
    </header>

    <div class="p-gutter max-w-7xl mx-auto">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-error-container/20 border border-error/20 text-error rounded-xl text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 space-y-8">
                <section class="bg-surface-container-lowest border border-outline-variant rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-2 mb-6 text-primary">
                        <span class="material-symbols-outlined">edit_note</span>
                        <h3 class="font-headline-md text-headline-md font-bold">Informasi Transaksi</h3>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl text-sm text-blue-800 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-600">info</span>
                        <div>
                            Transaksi ini dibuat dari: 
                            <strong class="font-mono bg-blue-100 px-1.5 py-0.5 rounded text-blue-900">
                                #Detail Servis {{ $transaksi->detail_servis_id ?? '-' }}
                            </strong>
                        </div>
                    </div>

                    <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="font-label-md block text-on-surface-variant font-medium">Transaction ID</label>
                                <input class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 font-mono opacity-70 cursor-not-allowed" disabled type="text" value="TRX-{{ $transaksi->created_at->format('Ymd') }}-{{ str_pad($transaksi->id, 3, '0', STR_PAD_LEFT) }}"/>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="font-label-md block text-on-surface-variant font-medium">Tanggal Transaksi</label>
                                <div class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 cursor-not-allowed text-on-surface/60 font-medium flex items-center justify-between">
                                    {{ \Carbon\Carbon::parse($transaksi->tanggal_servis)->translatedFormat('d F Y') }}
                                    <span class="material-symbols-outlined text-on-surface-variant text-sm">lock</span>
                                </div>
                            </div>
                        </div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="space-y-2">
        <label class="font-label-md block text-on-surface-variant font-medium">Pelanggan</label>
        <div class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 cursor-not-allowed text-on-surface/60">
            {{-- Mengikuti rute relasi berantai --}}
            {{ $transaksi->detailServis?->booking?->pelanggan?->nama ?? 'Pelanggan Tidak Ditemukan' }}
        </div>
    </div>
    <div class="space-y-2">
        <label class="font-label-md block text-on-surface-variant font-medium">Kendaraan</label>
        <div class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 cursor-not-allowed text-on-surface/60">
            {{-- Mengikuti rute relasi berantai dan properti 'model' berdasarkan pencarian controller --}}
            {{ $transaksi->detailServis?->booking?->kendaraan?->nomor_plat ?? '-' }} - {{ $transaksi->detailServis?->booking?->kendaraan?->model ?? $transaksi->detailServis?->booking?->kendaraan?->merk ?? 'Motor' }}
        </div>
    </div>
</div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="font-label-md block text-on-surface-variant font-medium">Metode Pembayaran <span class="text-error">*</span></label>
                                <select name="metode_pembayaran" class="w-full bg-white border {{ $errors->has('metode_pembayaran') ? 'border-error' : 'border-outline-variant' }} rounded-lg px-4 py-3 outline-none" required>
                                    <option value="Cash" {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'Cash' ? 'selected' : '' }}>Tunai / Cash</option>
                                    <option value="Transfer" {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'Transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                    <option value="QRIS" {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                </select>
                            </div>
<div class="space-y-2">
    <label class="font-label-md block text-on-surface-variant font-medium">Status Pembayaran <span class="text-error">*</span></label>
<select name="status_pembayaran"
        class="w-full bg-white border {{ $errors->has('status_pembayaran') ? 'border-error' : 'border-outline-variant' }} rounded-lg px-4 py-3 outline-none"
        required>

    <option value="Menunggu Pembayaran"
        {{ old('status_pembayaran', $transaksi->status_pembayaran) == 'Menunggu Pembayaran' ? 'selected' : '' }}>
        Menunggu Pembayaran
    </option>

    <option value="Belum Lunas"
        {{ old('status_pembayaran', $transaksi->status_pembayaran) == 'Belum Lunas' ? 'selected' : '' }}>
        Belum Lunas
    </option>

    <option value="Lunas"
        {{ old('status_pembayaran', $transaksi->status_pembayaran) == 'Lunas' ? 'selected' : '' }}>
        Lunas
    </option>

    <option value="Gagal"
        {{ old('status_pembayaran', $transaksi->status_pembayaran) == 'Gagal' ? 'selected' : '' }}>
        Gagal
    </option>
</select>
</div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2 md:col-span-2">
                                <label class="font-label-md block text-on-surface-variant font-medium">Total Biaya (IDR)</label>
                                <div class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 font-bold text-primary text-lg flex items-center justify-between">
                                    <span>Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}</span>
                                    <span class="text-xs font-normal text-on-surface-variant/60 italic">Kalkulasi Otomatis (Jasa + Sparepart)</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-outline-variant">
                            <a href="{{ route('admin.transaksi.index') }}" class="px-8 py-3 rounded-lg border border-primary text-primary font-label-md hover:bg-primary/5 transition-all text-center">Batal</a>
                            <button class="px-8 py-3 rounded-lg bg-secondary text-on-secondary font-label-md hover:bg-secondary/90 shadow-md active:scale-95 transition-all" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </section>
            </div>

            <div class="lg:col-span-4 space-y-8">
                <section class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6">
                    <h3 class="font-label-md text-on-surface-variant uppercase tracking-wider mb-4 font-bold text-xs">Informasi Pelanggan</h3>
        @php
    // Membuat variabel pembantu agar kode di bawah tidak terlalu panjang
    $pelanggan = $transaksi->detailServis?->booking?->pelanggan;
    $kendaraan = $transaksi->detailServis?->booking?->kendaraan;
@endphp

<div class="flex items-center gap-4 mb-6">
    <div class="h-14 w-14 rounded-full bg-primary-fixed flex items-center justify-center text-primary font-bold text-xl">
        {{ $pelanggan ? strtoupper(substr($pelanggan->nama, 0, 2)) : '??' }}
    </div>
    <div>
        <div class="font-bold text-primary">{{ $pelanggan->nama ?? 'Tidak Ditemukan' }}</div>
        <div class="text-xs text-on-surface-variant">ID: CUST-{{ $pelanggan->id ?? '-' }}</div>
    </div>
</div>
<div class="space-y-4">
    <div class="flex items-center gap-3 text-sm">
        <span class="material-symbols-outlined text-primary text-base">phone</span>
        {{ $pelanggan->nomor_telepon ?? '-' }}
    </div>
    <div class="flex items-center gap-3 text-sm">
        <span class="material-symbols-outlined text-primary text-base">motorcycle</span>
        <span class="text-sm font-medium">
            {{ $kendaraan->merk ?? 'Motor' }} {{ $kendaraan->model ?? '' }}
            (<span class="font-mono font-bold text-primary">{{ $kendaraan->nomor_plat ?? '-' }}</span>)
        </span>
    </div>
</div>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection