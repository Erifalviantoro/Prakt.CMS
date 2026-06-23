 @extends('admin.layout.layout')
 @section('content')
<!-- Main Content -->
<main class="ml-64 flex-1 flex flex-col">
    @include('admin.layout.header')
<!-- TopAppBar -->
<header class="w-full h-16 sticky top-0 bg-white dark:bg-surface shadow-sm flex justify-between items-center px-gutter z-40">
<div class="flex items-center gap-4">
    <nav class="flex items-center gap-2 mb-8 text-on-surface-variant font-label-md text-label-md">
        <a class="hover:text-primary transition-colors" href="#">Dashboard</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <a class="hover:text-primary transition-colors" href="{{ route('admin.kendaraan.index') }}">Manajemen Kendaraan</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-primary font-bold">Edit Kendaraan</span>
    </nav>
</div>
<div class="flex items-center gap-6">
<div class="relative group">
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer p-2 rounded-full hover:bg-surface-container-low transition-colors">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-secondary rounded-full"></span>
</div>
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer p-2 rounded-full hover:bg-surface-container-low transition-colors">settings</span>
<div class="flex items-center gap-3 border-l border-outline-variant pl-6">
<div class="text-right">
<p class="font-label-md text-label-md text-primary font-bold">Admin Panel</p>
<p class="text-[10px] text-on-surface-variant">Super Administrator</p>
</div>
<img alt="Administrator Profile" class="w-10 h-10 rounded-full border-2 border-primary-fixed" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQ980uc3_Nc6CDDWm3XFviIja3n44ctcj63Ni1mM4ZQareFIx4PlmFIY8nVS7QgDROq5qf-nysc1rjiYd3s2Pbj9HUBk1j12pP3uBXttfj2jK2sCo_8Ul_sEIL3HtCGGPZIVRfxkLmPs9qKffl58exVphDEqKOt0N88IzEUb_TRkltylhEeCI5-2VZ0n0WqovFWJ-zwORCjnfleIgM57ewDrxB8VeLaDQD84o3Xw0xYWKuNE9V6eveE_oStVsaFR90WHEb8cmWQ1H7"/>
</div>
</div>
</header>
<!-- Content Canvas -->
<div class="p-8 max-w-container-max-width mx-auto w-full">
<div class="flex items-center justify-between mb-8">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary">Edit Kendaraan</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Perbarui informasi kendaraan pelanggan dengan teliti.</p>
</div>
</div>
<!-- Bento Grid Layout for Form -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
<!-- Left Column: Primary Data -->
<div class="lg:col-span-8">
<div class="bg-white border border-outline-variant rounded-xl shadow-sm p-8">
<div class="flex items-center gap-2 mb-6 text-primary">
<span class="material-symbols-outlined">info</span>
<h3 class="font-headline-md text-headline-md">Informasi Utama</h3>
</div>
<form action="{{ route('admin.kendaraan.update', $kendaraan->id) }}"
      method="POST"
      class="grid grid-cols-1 md:grid-cols-2 gap-6">

    @csrf
    @method('PUT')
<!-- Nomor Plat -->
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface-variant" for="nomorPlat">Nomor Plat</label>
<input
    id="nomorPlat"
    name="nomor_plat"
    type="text"
    value="{{ old('nomor_plat', $kendaraan->nomor_plat) }}"
    class="w-full border-outline-variant rounded-lg p-3"
/>
</div>
<!-- Pemilik (Searchable Dropdown Style) -->
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface-variant" for="pemilik">Pemilik</label>
<div class="relative">
<input class="w-full border-outline-variant rounded-lg p-3 font-body-md text-body-md form-input-focus" id="pemilik" placeholder="Cari pelanggan..." type="text" value="Budi Sudarsono"/>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline">search</span>
</div>
</div>
<hr class="md:col-span-2 border-outline-variant my-2"/>
<!-- Merk -->
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface-variant" for="merk">Merk Kendaraan</label>
<select
    id="merk"
    name="merk_kendaraan"
    class="w-full border-outline-variant rounded-lg p-3">

    <option value="Honda"
        {{ $kendaraan->merk_kendaraan == 'Honda' ? 'selected' : '' }}>
        Honda
    </option>

    <option value="Yamaha"
        {{ $kendaraan->merk_kendaraan == 'Yamaha' ? 'selected' : '' }}>
        Yamaha
    </option>

    <option value="Suzuki"
        {{ $kendaraan->merk_kendaraan == 'Suzuki' ? 'selected' : '' }}>
        Suzuki
    </option>

    <option value="Kawasaki"
        {{ $kendaraan->merk_kendaraan == 'Kawasaki' ? 'selected' : '' }}>
        Kawasaki
    </option>
</select>
</div>
<!-- Model -->
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface-variant" for="model">Model</label>
<input
    id="model"
    name="model_kendaraan"
    type="text"
    value="{{ old('model_kendaraan', $kendaraan->model_kendaraan) }}"
    class="w-full border-outline-variant rounded-lg p-3"
/>
</div>
<!-- Tahun -->
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface-variant" for="tahun">Tahun</label>
<input
    id="tahun"
    name="tahun_pembuatan"
    type="number"
    value="{{ old('tahun_pembuatan', $kendaraan->tahun_pembuatan) }}"
    class="w-full border-outline-variant rounded-lg p-3"
/>
</div>
<!-- Nomor Mesin -->
<div class="flex flex-col gap-2">
<label class="font-label-md text-label-md text-on-surface-variant" for="nomorMesin">Nomor Mesin</label>
<input
    id="nomorMesin"
    name="nomor_mesin"
    type="text"
    value="{{ old('nomor_mesin', $kendaraan->nomor_mesin) }}"
    class="w-full border-outline-variant rounded-lg p-3 uppercase"
/>
</div>
<div class="md:col-span-2 mt-8 flex flex-col md:flex-row gap-4">
<button class="flex-1 bg-primary text-white py-4 rounded-lg font-bold flex items-center justify-center gap-2 hover:bg-primary-container transition-all shadow-md active:scale-95" type="submit">
<span class="material-symbols-outlined">save</span>
                                    Simpan Perubahan
                                </button>
<button class="px-8 border-2 border-primary text-primary py-4 rounded-lg font-bold flex items-center justify-center gap-2 hover:bg-surface-container-low transition-all active:scale-95" onclick="history.back()" type="button">
                                    Batal
                                </button>
</div>
</form>
</div>
</div>
<!-- Right Column: Visual Preview & Status -->
<div class="lg:col-span-4 flex flex-col gap-gutter">
<!-- Vehicle Card Preview -->
<div class="bg-primary text-on-primary rounded-xl overflow-hidden shadow-lg border border-primary-container">
<div class="relative h-48 w-full bg-primary-container">
<img class="w-full h-full object-cover opacity-60" data-alt="A high-performance modern Yamaha scooter in a pristine, brightly lit automotive workshop setting. The motorcycle is positioned against a clean white backdrop with professional studio lighting, emphasizing its sleek metallic blue finish and engineering details. The aesthetic is modern, corporate, and clean, using a palette of deep automotive blues and whites to reflect high-performance professionalism." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrphKMoLTapfvnS7Qjm_4TuYHuZxlf2SfHHfQnxQDBnsC8zELd5m-TqVuJnOyPCnJfk0HhAQh80G0lmC2RViS2AScGLGAbGmjgcaVxxKb_p-dy1dFEW8vBKzwugHJ2Rab2otvNuJddx-_FqyR1jj_47qhrFg2JPeVtEa5mxtD4rMHcYUSCAJob5qi4mH3sasSi_4J-1OuNkbglI-13WvpK3rtJUY0NLReNeSneKALhaYMHvTtztjkE4pasILm4uEUDvYnT3iTYdSMR"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary to-transparent"></div>
<div class="absolute bottom-4 left-6">
<span class="bg-secondary px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase">Premium Service</span>
<h4 class="font-headline-md text-headline-md text-white mt-1">Yamaha NMAX</h4>
</div>
</div>
<div class="p-6 space-y-4">
<div class="flex justify-between items-center text-sm border-b border-primary-container pb-2">
<span class="opacity-70">Status Garansi</span>
<span class="text-green-400 font-bold flex items-center gap-1">
<span class="material-symbols-outlined text-sm">verified</span> Aktif
                                </span>
</div>
<div class="flex justify-between items-center text-sm border-b border-primary-container pb-2">
<span class="opacity-70">Terakhir Servis</span>
<span>12 Okt 2023</span>
</div>
<div class="flex justify-between items-center text-sm">
<span class="opacity-70">Total Kunjungan</span>
<span>8 Kali</span>
</div>
</div>
</div>
<!-- Guidelines Card -->
<div class="bg-surface-container-low rounded-xl border border-outline-variant p-6">
<div class="flex items-center gap-2 mb-4 text-primary">
<span class="material-symbols-outlined text-secondary">assignment_late</span>
<h4 class="font-bold font-headline-md text-[18px]">Panduan Pengisian</h4>
</div>
<ul class="space-y-3 text-sm text-on-surface-variant font-Inter">
<li class="flex gap-2">
<span class="text-secondary font-bold">•</span>
<span>Pastikan Nomor Plat sesuai dengan STNK asli kendaraan.</span>
</li>
<li class="flex gap-2">
<span class="text-secondary font-bold">•</span>
<span>Nomor Mesin bersifat unik dan tidak boleh ada duplikasi di sistem.</span>
</li>
<li class="flex gap-2">
<span class="text-secondary font-bold">•</span>
<span>Jika pemilik baru, gunakan menu 'Cari pelanggan' untuk menghubungkan.</span>
</li>
</ul>
</div>
<!-- Quick Actions -->
<div class="bg-white border border-outline-variant rounded-xl p-6 shadow-sm">
<h4 class="font-bold text-primary mb-4 font-headline-md text-[16px]">Tindakan Tambahan</h4>
<div class="flex flex-col gap-2">
<button class="w-full text-left p-3 rounded-lg hover:bg-surface-container-low flex items-center justify-between text-on-surface-variant transition-colors">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-outline">history</span>
<span>Lihat Riwayat Servis</span>
</div>
<span class="material-symbols-outlined">chevron_right</span>
</button>
<button class="w-full text-left p-3 rounded-lg hover:bg-error-container/20 flex items-center justify-between text-error transition-colors">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined">delete_forever</span>
<span>Hapus Kendaraan</span>
</div>
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
</div>
</div>
</div>
</div>
</main>
@endsection