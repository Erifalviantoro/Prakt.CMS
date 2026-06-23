@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen">
    @include('admin.layout.header')
<header class="w-full h-16 sticky top-0 bg-white dark:bg-surface shadow-sm flex justify-between items-center px-gutter z-40">
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer">menu_open</span>
<nav class="hidden md:flex gap-6">
<span class="font-label-md text-label-md text-on-surface-variant">Admin Dashboard</span>
<span class="font-label-md text-label-md text-primary font-bold">Edit Pelanggan</span>
</nav>
</div>
<div class="flex items-center gap-6">
<div class="relative hidden sm:block">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
<input class="pl-10 pr-4 py-1.5 bg-surface-container-low border-none rounded-lg text-label-md w-64 focus:ring-2 focus:ring-primary" placeholder="Cari pelanggan..." type="text"/>
</div>
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer relative">
                        notifications
                        <span class="absolute top-0 right-0 w-2 h-2 bg-secondary rounded-full"></span>
</span>
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer">settings</span>
<div class="w-8 h-8 rounded-full overflow-hidden border border-outline-variant">
<img alt="Administrator Profile" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBySk_yTP1SBSvVTeZR8HsKQD52lU_O3RuiD9GJ28q27lC1D9gBDhdrqYd56FwxJyS3mvpSMbMrsktFYMl_4CxD-fjgrgXTsoVnai_zi7A3zeGLsXrlbhDix4HPXgauhsw6-93mPDEZKaoWYwgIty1OW9RjCSZYgzK9VO8d97NwbMRJUd1XcOYF3nRQocU-NLPNT2VWCKxmui8JpTOV6KeDB6vZC80aWpMBQrn5g1DguPFj1wRJt8GPjlbUNyMwWr7cN_aM7iKpq1ph"/>
</div>
</div>
</div>
</header>
<div class="p-8 max-w-[1000px] mx-auto">
<div class="flex items-center gap-2 text-outline mb-6">
<a href="{{ route('admin.pelanggan.index') }}" class="font-label-md text-label-md cursor-pointer hover:text-primary">Customers</a>
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
<a href="{{ route('admin.pelanggan.show', $pelanggan->id) }}" class="font-label-md text-label-md cursor-pointer hover:text-primary">Details</a>
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
<span class="font-label-md text-label-md text-primary font-semibold">Edit Pelanggan</span>
</div>
<div class="mb-8 flex justify-between items-end">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary mb-2 font-bold">Edit Data Pelanggan</h2>
<p class="text-on-surface-variant font-body-md">Perbarui informasi kontak dan alamat pelanggan untuk layanan servis berkala.</p>
</div>
<div class="flex items-center gap-2 px-3 py-1 bg-surface-container-high rounded-lg text-on-surface-variant">
<span class="material-symbols-outlined text-[20px]">info</span>
<span class="font-label-sm text-label-sm">Terakhir diperbarui: {{ $pelanggan->updated_at->translatedFormat('d M Y') }}</span>
</div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<div class="lg:col-span-2 bg-white rounded-xl border border-outline-variant shadow-sm p-8">
    
<form action="{{ route('admin.pelanggan.update', $pelanggan->id) }}" method="POST" class="space-y-6">
@csrf
@method('PUT')

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-primary font-semibold">Nama Lengkap <span class="text-error">*</span></label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">person</span>
<input name="nama" value="{{ old('nama', $pelanggan->nama) }}" class="w-full pl-10 pr-4 py-3 rounded-lg border @error('nama') border-error focus:ring-error/10 @else border-outline-variant focus:border-primary focus:ring-primary/10 @enderror focus:ring-2 transition-all duration-200 outline-none font-body-md bg-white" type="text" required/>
</div>
@error('nama')
    <p class="text-xs text-error mt-1">{{ $message }}</p>
@enderror
</div>
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-primary font-semibold">Nomor Telepon <span class="text-error">*</span></label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">call</span>
<input name="nomor_telepon" value="{{ old('nomor_telepon', $pelanggan->nomor_telepon) }}" class="w-full pl-10 pr-4 py-3 rounded-lg border @error('nomor_telepon') border-error focus:ring-error/10 @else border-outline-variant focus:border-primary focus:ring-primary/10 @enderror focus:ring-2 transition-all duration-200 outline-none font-body-md bg-white" type="tel" required/>
</div>
@error('nomor_telepon')
    <p class="text-xs text-error mt-1">{{ $message }}</p>
@enderror
</div>
</div>
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-primary font-semibold">Alamat Email <span class="text-error">*</span></label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">mail</span>
<input name="email" value="{{ old('email', $pelanggan->email) }}" class="w-full pl-10 pr-4 py-3 rounded-lg border @error('email') border-error focus:ring-error/10 @else border-outline-variant focus:border-primary focus:ring-primary/10 @enderror focus:ring-2 transition-all duration-200 outline-none font-body-md bg-white" type="email" required/>
</div>
@error('email')
    <p class="text-xs text-error mt-1">{{ $message }}</p>
@enderror
</div>
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-primary font-semibold">Alamat Lengkap <span class="text-error">*</span></label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-3 text-outline">location_on</span>
<textarea name="alamat" class="w-full pl-10 pr-4 py-3 rounded-lg border @error('alamat') border-error focus:ring-error/10 @else border-outline-variant focus:border-primary focus:ring-primary/10 @enderror focus:ring-2 transition-all duration-200 outline-none resize-none font-body-md bg-white" rows="4" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
</div>
@error('alamat')
    <p class="text-xs text-error mt-1">{{ $message }}</p>
@enderror
</div>

<input type="hidden" name="tanggal_pendaftaran" value="{{ $pelanggan->tanggal_pendaftaran }}">

<div class="pt-6 flex flex-col sm:flex-row gap-4 justify-end border-t border-outline-variant">
<a href="{{ route('admin.pelanggan.index') }}" class="px-8 py-3 rounded-lg font-label-md text-label-md text-primary border border-primary hover:bg-surface-container-low transition-colors duration-200 active:scale-95 text-center">
                                Batal
</a>
<button class="px-8 py-3 rounded-lg font-label-md text-label-md bg-primary text-white shadow-md hover:bg-primary-container transition-all duration-200 active:scale-95 flex items-center justify-center gap-2" type="submit">
<span class="material-symbols-outlined text-[20px]">save</span>
                                Simpan Perubahan
                            </button>
</div>
</form>
</div>
<div class="flex flex-col gap-6">
<div class="bg-primary text-white rounded-xl shadow-lg p-6 overflow-hidden relative">
<div class="absolute -right-12 -top-12 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
<div class="relative z-10 flex flex-col items-center text-center">
<div class="w-24 h-24 rounded-full border-4 border-secondary overflow-hidden mb-4 shadow-xl bg-primary-container flex items-center justify-center font-bold text-3xl">
    {{ strtoupper(substr($pelanggan->nama, 0, 2)) }}
</div>
<h3 class="font-headline-md text-headline-md mb-1 font-bold text-lg">{{ $pelanggan->nama }}</h3>
<span class="px-3 py-1 bg-secondary-container text-white text-label-sm font-bold rounded-full mb-4">MEMBER BENGKEL</span>
<div class="w-full grid grid-cols-2 gap-4 mt-4 pt-4 border-t border-white/20">
<div>
<p class="text-white/60 text-[10px] uppercase tracking-wider mb-1">Total Servis</p>
<p class="font-headline-md text-[18px]">12 Kali</p>
</div>
<div>
<p class="text-white/60 text-[10px] uppercase tracking-wider mb-1">Pendaftaran</p>
<p class="font-headline-md text-[13px] mt-1">{{ \Carbon\Carbon::parse($pelanggan->tanggal_pendaftaran)->translatedFormat('d M Y') }}</p>
</div>
</div>
</div>
</div>
<div class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
<div class="p-4 border-b border-outline-variant flex items-center justify-between">
<span class="font-label-md text-label-md text-primary font-bold">Lokasi Pelanggan</span>
<span class="material-symbols-outlined text-secondary">map</span>
</div>
<div class="h-48 bg-surface-container-highest relative group cursor-pointer">
<img class="w-full h-full object-cover" data-location="Yogyakarta" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxKP33P74-Dl1KDpQp45dQG2kg__yqfdOEBU_6ul1cC9h4CXcIQLhSbNle799dllnGpymbhpY7-2tyXKRi1aC3XnNJrLn43PKhCVuX74YPqXP6LuGrSDuQGrWGyhj1tDj_q-5QEo0blDVrSAymvwdmgkK8OkpQ8qzUXVvnFibqTj6NRr8mgS31hsjqxt0IbcHW7b9lmcF1a7b0U1ODuJXkPerhraJCuPTCMZCfdqflFDh56tzniHb8Ow98DANSB6qaRq8Thi6cM5YC"/>
<div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-all duration-300 flex items-center justify-center">
<span class="bg-white px-4 py-2 rounded-full text-label-md font-bold text-primary shadow-lg scale-90 group-hover:scale-100 transition-transform">Buka Maps</span>
</div>
</div>
<div class="p-4 bg-surface-container-low">
<p class="text-label-sm text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-[16px]">info</span>
                                Radius 3.2km dari Bengkel Pusat
                            </p>
</div>
</div>
<div class="bg-white rounded-xl border border-outline-variant shadow-sm p-4 space-y-3">
<p class="font-label-md text-label-md text-primary font-bold mb-2">Tindakan Cepat</p>
<a href="#" class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-surface-container-low text-primary transition-all active:scale-95">
<span class="material-symbols-outlined p-2 bg-primary-fixed rounded-lg text-primary">history</span>
<span class="font-label-md text-label-md font-semibold text-sm">Lihat Riwayat Servis</span>
</a>
<a href="{{ route('admin.kendaraan.index') }}" class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-surface-container-low text-primary transition-all active:scale-95">
<span class="material-symbols-outlined p-2 bg-secondary/10 rounded-lg text-secondary">motorcycle</span>
<span class="font-label-md text-label-md font-semibold text-sm">Daftar Kendaraan</span>
</a>
</div>
</div>
</div>
</div>
</main>
@endsection