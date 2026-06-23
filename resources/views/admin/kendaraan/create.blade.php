 @extends('admin.layout.layout')
 @section('content')
<!-- Main Content Area -->
<main class="ml-64 min-h-screen">
    @include('admin.layout.header')
<!-- Top Nav Bar -->
<header class="w-full h-16 sticky top-0 bg-white dark:bg-surface shadow-sm z-40 flex justify-between items-center px-gutter">
<div class="flex items-center gap-4">
    <nav class="flex items-center gap-2 mb-8 text-on-surface-variant font-label-md text-label-md">
        <a class="hover:text-primary transition-colors" href="#">Dashboard</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <a class="hover:text-primary transition-colors" href="{{ route('admin.kendaraan.index') }}">Manajemen Kendaraan</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-primary font-bold">Tambah Kendaraan</span>
    </nav>
</div>
<div class="flex items-center gap-6">
<div class="relative flex items-center bg-surface-container-low rounded-full px-4 py-2 border border-outline-variant">
<span class="material-symbols-outlined text-on-surface-variant mr-2" data-icon="search">search</span>
<input class="bg-transparent border-none focus:ring-0 text-label-md w-48" placeholder="Cari data..." type="text"/>
</div>
<div class="flex gap-3">
<button class="p-2 hover:bg-surface-container-low rounded-full transition-colors relative">
<span class="material-symbols-outlined text-on-surface-variant" data-icon="notifications">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-secondary rounded-full"></span>
</button>
<button class="p-2 hover:bg-surface-container-low rounded-full transition-colors">
<span class="material-symbols-outlined text-on-surface-variant" data-icon="settings">settings</span>
</button>
</div>
<div class="flex items-center gap-3 pl-4 border-l border-outline-variant">
<div class="text-right">
<p class="text-label-md font-bold text-on-surface">Admin Utama</p>
<p class="text-[10px] text-on-surface-variant uppercase">Workshop Manager</p>
</div>
<img alt="Administrator Profile" class="w-10 h-10 rounded-full border border-outline-variant" src="https://lh3.googleusercontent.com/aida-public/AB6AXuClxbcaQ5yGT4j3UtDK8QRf2cKsxEXlVY9gd5hcr_jdITRMFgfQOiQIiTrP71kkTLmrvxj2nkfIdwjrgLZG1BlaRJ174ZnQEbsM7-Mk_ueVX-LK-ijoXtMaJOURzWZOg3uTbWXTgfoVRbOaOmhRwJ2gUa-nNc5zAp3lawXvA6A0BuxXTBCvzCq7QqFkJgaouchyIJ4yvKPr19-y5CiwczEIK9iyHzlh0tJlHTgNe77v1Kr3tMPLVJeS8V-ez-gc-7IA9uxoddvA3-Aa"/>
</div>
</div>
</header>
<!-- Form Content Container -->
<div class="p-10 max-w-[1000px] mx-auto">
<div class="mb-8">
<h2 class="font-headline-lg text-headline-lg text-primary">Registrasi Kendaraan Baru</h2>
<p class="text-on-surface-variant font-body-md mt-2">Silakan lengkapi detail spesifikasi unit kendaraan pelanggan untuk manajemen servis yang lebih akurat.</p>
</div>
<!-- Main Form Card -->
<div class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
<div class="bg-primary px-8 py-4 flex items-center gap-3">
<span class="material-symbols-outlined text-white" data-icon="motorcycle">motorcycle</span>
<h3 class="text-white font-headline-md text-label-md font-bold uppercase tracking-wider">Form Informasi Kendaraan</h3>
</div>
<form action="{{ route('admin.kendaraan.store') }}"
      method="POST"
      class="p-8 space-y-8">
@if ($errors->any())
    <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    @csrf
<!-- Section: Vehicle Identity -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<div class="space-y-2">
<label class="font-label-md text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]" data-icon="pin">pin</span>
                                Nomor Plat
                            </label>
<input
    type="text"
    name="nomor_plat"
    value="{{ old('nomor_plat') }}"
    class="w-full px-4 py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary-fixed outline-none transition-all font-headline-md text-primary tracking-widest uppercase"
    placeholder="Contoh: AB 1234 XY">
</div>
<div class="space-y-2">
<label class="font-label-md text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]" data-icon="branding_watermark">branding_watermark</span>
                                Merk Kendaraan
                            </label>
<select
    name="merk_kendaraan"
    class="w-full px-4 py-3 rounded-lg border border-outline-variant">

    <option value="">Pilih Merk</option>

    <option value="Yamaha">Yamaha</option>
    <option value="Honda">Honda</option>
    <option value="Suzuki">Suzuki</option>
    <option value="Kawasaki">Kawasaki</option>

</select>
</div>
<div class="space-y-2">
<label class="font-label-md text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]" data-icon="settings_input_component">settings_input_component</span>
                                Model Kendaraan
                            </label>
<input
    type="text"
    name="model_kendaraan"
    value="{{ old('model_kendaraan') }}"
    class="w-full px-4 py-3 rounded-lg border border-outline-variant"
    placeholder="Contoh: NMAX 155 ABS">
</div>
<div class="space-y-2">
<label class="font-label-md text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]" data-icon="calendar_month">calendar_month</span>
                                Tahun Kendaraan
                            </label>
<input
    type="number"
    name="tahun_pembuatan"
    value="{{ old('tahun_pembuatan') }}"
    class="w-full px-4 py-3 rounded-lg border border-outline-variant"
    min="1990"
    max="{{ date('Y') }}">
</div>
</div>
<!-- Divider -->
<div class="border-t border-outline-variant opacity-50"></div>
<!-- Section: Technical Detail -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<div class="space-y-2">
<label class="font-label-md text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]" data-icon="memory">memory</span>
                                Nomor Mesin
                            </label>
<input
    type="text"
    name="nomor_mesin"
    value="{{ old('nomor_mesin') }}"
    class="w-full px-4 py-3 rounded-lg border border-outline-variant font-mono"
    placeholder="Masukkan nomor mesin">
</div>
<div class="space-y-2">
<label class="font-label-md text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]" data-icon="person_search">person_search</span>
                                Pemilik Kendaraan
                            </label>
<div class="relative">
<input class="w-full px-4 py-3 rounded-lg border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary-fixed outline-none transition-all pr-12" placeholder="Cari nama atau nomor HP pelanggan..." type="text"/>
<span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-outline" data-icon="search">search</span>
</div>
<p class="text-[11px] text-on-surface-variant italic">Pelanggan tidak ditemukan? <a class="text-secondary font-bold hover:underline" href="#">Tambah Baru</a></p>
</div>
</div>
<!-- Form Image/Visual Reference -->
<div class="bg-surface-container-low rounded-lg p-6 border border-dashed border-outline-variant flex flex-col md:flex-row gap-6 items-center">
<div class="w-full md:w-1/3 aspect-video bg-white rounded-lg overflow-hidden relative group">
<img alt="Motorcycle Reference" class="w-full h-full object-cover grayscale opacity-50 transition-all group-hover:grayscale-0 group-hover:opacity-100" data-alt="A professional studio photograph of a sleek, modern black motorcycle against a minimalist industrial backdrop. The lighting is dramatic and highlights the metallic textures of the engine and the clean lines of the bodywork. The image is captured in a high-key professional style, reflecting the expertise and high-performance standards of a top-tier automotive service center." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaM6-uYEViAVtXOfVgshwHpGMuV5zE8-ZxLqt8WXwCynBBumW1JBnkESEjVSgTpBYzZ5C5E9Is7jt19jA-cuP0BJr6qs03KCh-pK67MSOHZCQ2bYgMsMDW54Bkh9-rA1hdrKARhtROHvGtT_vg0Ga2feiHpduXYXTCmAzkYBmXRpoMO3ZqL8nvprJvxy-oGarLmO2MR960ReXO_hrXxiMXOj4lokDzkhNHMJ6CXP0cg_VUgDf6IFFnpVyjl7ygONJMhVg9kOPNCNsr"/>
<div class="absolute inset-0 flex items-center justify-center bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="bg-white px-4 py-2 rounded-full text-xs font-bold text-primary shadow-lg flex items-center gap-2" type="button">
<span class="material-symbols-outlined text-sm" data-icon="add_a_photo">add_a_photo</span>
                                    Upload Foto
                                </button>
</div>
</div>
<div class="flex-1 text-on-surface-variant text-label-md">
<h4 class="font-bold text-on-surface mb-1">Dokumentasi Unit (Opsional)</h4>
<p>Unggah foto kendaraan untuk mempermudah identifikasi saat antrean servis padat. Format yang didukung: JPG, PNG, WEBP max 2MB.</p>
</div>
</div>
<!-- Form Actions -->
<div class="flex flex-col md:flex-row justify-end gap-4 pt-6">
<a href="{{ route('admin.kendaraan.index') }}"
   class="px-8 py-3 rounded-lg border border-primary text-primary font-bold hover:bg-surface-container-low transition-all">
    Batal
</a>
<button class="px-8 py-3 rounded-lg bg-secondary text-white font-bold shadow-lg hover:brightness-110 active:scale-95 transition-all flex items-center justify-center gap-2" type="submit">
<span class="material-symbols-outlined" data-icon="save">save</span>
                            Simpan Kendaraan
                        </button>
</div>
</form>
</div>
<!-- Helpful Tips Bento Grid -->
<div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
<div class="bg-white p-6 rounded-xl border border-outline-variant">
<div class="w-10 h-10 bg-primary-container rounded-lg flex items-center justify-center mb-4">
<span class="material-symbols-outlined text-on-primary-container" data-icon="verified">verified</span>
</div>
<h5 class="font-bold text-on-surface mb-2">Validasi Data</h5>
<p class="text-label-md text-on-surface-variant">Sistem akan otomatis mengecek duplikasi nomor plat dan nomor mesin.</p>
</div>
<div class="bg-white p-6 rounded-xl border border-outline-variant">
<div class="w-10 h-10 bg-secondary-container rounded-lg flex items-center justify-center mb-4">
<span class="material-symbols-outlined text-white" data-icon="history">history</span>
</div>
<h5 class="font-bold text-on-surface mb-2">Riwayat Servis</h5>
<p class="text-label-md text-on-surface-variant">Registrasi yang benar memastikan riwayat servis kendaraan terlacak selamanya.</p>
</div>
<div class="bg-white p-6 rounded-xl border border-outline-variant">
<div class="w-10 h-10 bg-surface-container-high rounded-lg flex items-center justify-center mb-4">
<span class="material-symbols-outlined text-on-surface-variant" data-icon="info">info</span>
</div>
<h5 class="font-bold text-on-surface mb-2">Bantuan Cepat</h5>
<p class="text-label-md text-on-surface-variant">Tekan (F1) jika Anda mengalami kesulitan dalam pengisian formulir ini.</p>
</div>
</div>
</div>
<!-- Sticky Footer Info -->
<footer class="w-full py-4 px-gutter border-t border-outline-variant text-[12px] text-on-surface-variant flex justify-between items-center bg-white mt-12">
<p>© 2024 Sumber Baru Motor. Professional Repair Management System.</p>
<div class="flex gap-4">
<a class="hover:text-secondary" href="#">Privacy Policy</a>
<a class="hover:text-secondary" href="#">System Status</a>
<span class="text-outline">v2.4.0-stable</span>
</div>
</footer>
</main>
@endsection