 @extends('admin.layout.layout')
 @section('content')
<!-- Page Content: Create Technician Form -->
<main class="flex-1 p-margin-desktop">
@include('admin.layout.header')
<div class="max-w-4xl mx-auto">
<div class="flex items-center justify-between mb-8">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary tracking-tight">Tambah Teknisi</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Daftarkan personel mekanik baru ke dalam sistem bengkel.</p>
</div>
<div class="flex items-center gap-2 px-4 py-2 bg-secondary/10 text-secondary rounded-lg font-bold">
<span class="material-symbols-outlined">badge</span>
<span class="text-label-md">Staff Registration</span>
</div>
</div>
<!-- Bento Grid Style Form Container -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<!-- Sidebar Info / Graphic -->
<div class="md:col-span-1 space-y-gutter">
<div class="glass-card p-6 rounded-2xl shadow-sm overflow-hidden relative group">
<div class="relative z-10">
<span class="material-symbols-outlined text-secondary text-4xl mb-4" style="font-variation-settings: 'FILL' 1;">engineering</span>
<h3 class="font-headline-md text-headline-md text-primary mb-2">Profil Profesional</h3>
<p class="font-label-md text-label-md text-on-surface-variant leading-relaxed">
                                    Pastikan data yang dimasukkan sesuai dengan dokumen identitas resmi untuk keperluan penggajian dan manajemen tugas.
                                </p>
</div>
<!-- Subtle abstract bg -->
<div class="absolute -right-10 -bottom-10 opacity-5 group-hover:scale-110 transition-transform duration-700">
<span class="material-symbols-outlined text-[12rem]">build</span>
</div>
</div>
<div class="bg-primary p-6 rounded-2xl shadow-lg text-on-primary">
<h4 class="font-label-md text-label-md font-bold mb-4 flex items-center gap-2">
<span class="material-symbols-outlined text-sm">info</span> Petunjuk Pengisian
                            </h4>
<ul class="space-y-3 font-label-sm text-label-sm text-on-primary-container">
<li class="flex gap-2">
<span class="material-symbols-outlined text-xs">check_circle</span>
<span>Gunakan nama lengkap sesuai KTP.</span>
</li>
<li class="flex gap-2">
<span class="material-symbols-outlined text-xs">check_circle</span>
<span>Pilih spesialisasi utama teknisi.</span>
</li>
<li class="flex gap-2">
<span class="material-symbols-outlined text-xs">check_circle</span>
<span>No. telepon wajib aktif (WhatsApp).</span>
</li>
</ul>
</div>
</div>
<!-- Main Form Section -->
<div class="md:col-span-2">
<form action="{{ route('admin.mekanik.store') }}" method="POST"
      class="glass-card p-8 rounded-2xl shadow-sm space-y-6">
    @csrf
<div class="grid grid-cols-1 gap-6">
<!-- Full Name -->
<div class="space-y-2">
<label class="block font-label-md text-label-md text-primary font-bold">Nama Teknisi (Full Name)</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">person</span>
<input
    type="text"
    name="nama"
    value="{{ old('nama') }}"
    class="w-full pl-12 pr-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-body-md font-body-md"
    placeholder="Contoh: Budi Darmawan"
    required
/>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
<!-- Specialization Dropdown -->
<div class="space-y-2">
<label class="block font-label-md text-label-md text-primary font-bold">Spesialisasi</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">psychology</span>
<select
    name="spesialisasi"
    class="w-full pl-12 pr-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-4 focus:ring-primary/5 appearance-none transition-all text-body-md font-body-md"
    required
>
    <option value="">Pilih Spesialisasi</option>
    <option value="Mesin">Mesin (Engine)</option>
    <option value="Kelistrikan">Kelistrikan (Electrical)</option>
    <option value="Body & Rangka">Body & Rangka</option>
    <option value="Overhaul Master">Overhaul Master</option>
    <option value="Tune Up & Service Ringan">Tune Up & Service Ringan</option>
</select>
<span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
</div>
</div>
<!-- Phone Number -->
<div class="space-y-2">
 <label class="block font-label-md text-label-md text-primary font-bold">Nomor Telepon (Phone)</label>
 <div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">call</span>
<input
    type="text"
    name="nomor_telepon"
    value="{{ old('nomor_telepon') }}"
    class="w-full pl-12 pr-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-body-md font-body-md"
    placeholder="0812-xxxx-xxxx"
    required
/>
</div>
</div>
</div>
<!-- Address Textarea -->
<div class="space-y-2">
<label class="block font-label-md text-label-md text-primary font-bold">Alamat Lengkap</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-4 text-on-surface-variant">location_on</span>
<textarea
    name="alamat"
    rows="4"
    class="w-full pl-12 pr-4 py-3 rounded-xl border border-outline-variant focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-body-md font-body-md resize-none"
    placeholder="Masukkan alamat tinggal saat ini..."
    required
>{{ old('alamat') }}</textarea>
</div>
</div>
</div>
<div class="h-px bg-outline-variant my-8"></div>
<!-- Action Buttons -->
<div class="flex flex-col sm:flex-row items-center justify-end gap-4">
<a href="{{ route('admin.mekanik.index') }}"
   class="w-full sm:w-auto px-8 py-3 rounded-xl font-bold text-on-surface-variant hover:bg-surface-container-high transition-colors flex items-center justify-center gap-2">
    <span class="material-symbols-outlined">close</span>
    Batal
</a>
<button class="w-full sm:w-auto px-10 py-3 rounded-xl font-bold bg-secondary text-on-secondary shadow-lg hover:brightness-110 active:scale-95 transition-all flex items-center justify-center gap-2" type="submit">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">save</span> Simpan Teknisi
                                </button>
</div>
</form>
</div>
</div>
</div>
</main>
@endsection