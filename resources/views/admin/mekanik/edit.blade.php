 @extends('admin.layout.layout')
 @section('content')
<!-- Main Content Canvas -->
<main class="ml-0 md:ml-64 p-6 lg:p-10 min-h-screen">
    @include('admin.layout.header')
<div class="max-w-container-max-width mx-auto">
<!-- Header Section -->
<div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary mb-2">Edit Data Teknisi</h2>
<p class="text-on-surface-variant font-body-md max-w-2xl">Perbarui informasi profil profesional teknisi untuk memastikan jadwal dan spesialisasi bengkel tetap akurat.</p>
</div>
</div>
<!-- Bento Grid Layout -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- Profile Context (Left Column) -->
<div class="lg:col-span-4 space-y-6">
<div class="bento-card bg-surface-container-lowest p-8 rounded-xl border border-outline-variant shadow-sm text-center">
<div class="relative inline-block mb-6">
<img alt="Technician Profile Photo" class="w-40 h-40 rounded-full object-cover border-4 border-surface-container-high shadow-lg" data-alt="A high-quality professional portrait of a skilled motorcycle mechanic wearing a clean dark blue workshop uniform with the shop logo. The setting is a modern, brightly lit motorcycle service center with high-performance bikes blurred in the background. The aesthetic is clean, professional, and trustworthy, using a palette of deep blues and mechanical grays." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBgEYhIccMj6qxMw8TxA56nJQzEe2DTOD5Et_yuLVDIXmVuPPhAjihEygbpHBsTxcbdw_EXEVxS8wluREXo6guOjmmctX5D1D6RRDiyIvqZZ4vZhAx4b4Qe56A0DRZs_1PZ8M3RWCTS2OFl5NXLzcA2XglNCnCFpX7K9cZs1jtV3G8m1G2EBW7hrAvoKTBJjxgRguA0qLvm8wjaOAiosQ6qy2nxwErD82zA6MxHLdAkKHYA-wINWjwOHz0naMSnd8XHcY0Z-kleVqmH"/>
<button class="absolute bottom-1 right-1 bg-secondary text-on-secondary p-2 rounded-full shadow-lg hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-[20px]">photo_camera</span>
</button>
</div>
<h3 class="font-headline-md text-headline-md text-primary mb-1">
    {{ $teknisi->nama }}
</h3>
<p class="text-secondary font-label-md font-bold tracking-wide uppercase">
    {{ $teknisi->spesialisasi }}
</p>
<div class="mt-8 flex justify-center gap-4 text-on-surface-variant">
<div class="px-4 py-2 bg-surface-container rounded-lg">
<p class="text-label-sm font-bold text-primary">124</p>
<p class="text-[10px] uppercase tracking-tighter">Services</p>
</div>
<div class="px-4 py-2 bg-surface-container rounded-lg">
<p class="text-label-sm font-bold text-primary">4.9</p>
<p class="text-[10px] uppercase tracking-tighter">Rating</p>
</div>
<div class="px-4 py-2 bg-surface-container rounded-lg">
<p class="text-label-sm font-bold text-primary">8yr</p>
<p class="text-[10px] uppercase tracking-tighter">Exp</p>
</div>
</div>
</div>
<div class="bento-card bg-primary p-6 rounded-xl text-on-primary">
<div class="flex items-center gap-3 mb-4">
<span class="material-symbols-outlined text-secondary">verified</span>
<h4 class="font-label-md font-bold uppercase tracking-wider">Certification Status</h4>
</div>
<p class="text-body-md opacity-80 mb-4 text-sm">Certified for Kawasaki Performance Tuning and Electronic Control Systems.</p>
<div class="h-2 w-full bg-white/10 rounded-full overflow-hidden">
<div class="h-full bg-secondary w-[85%]"></div>
</div>
<p class="text-[10px] mt-2 opacity-60 text-right">Verification expiring in 214 days</p>
</div>
</div>
<!-- Form Section (Right Column) -->
<div class="lg:col-span-8">
<form action="{{ route('admin.mekanik.update', $teknisi->id) }}"
      method="POST"
      class="space-y-8 bg-surface-container-lowest p-8 lg:p-12 rounded-xl border border-outline-variant shadow-sm">

    @csrf
    @method('PUT')
<!-- Name & Specialty -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="space-y-2">
<label class="block font-label-md text-on-surface-variant">Nama Teknisi</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-body-md">person</span>
<input
    type="text"
    name="nama"
    value="{{ old('nama', $teknisi->nama) }}"
    class="w-full pl-10 pr-4 py-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body-md transition-all outline-none">
</div>
</div>
<div class="space-y-2">
<label class="block font-label-md text-on-surface-variant">Update Spesialisasi</label>
<select
    name="spesialisasi"
    class="w-full px-4 py-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">

    <option value="Mesin"
        {{ $teknisi->spesialisasi == 'Mesin' ? 'selected' : '' }}>
        Mesin
    </option>

    <option value="Kelistrikan"
        {{ $teknisi->spesialisasi == 'Kelistrikan' ? 'selected' : '' }}>
        Kelistrikan
    </option>

    <option value="Body & Rangka"
        {{ $teknisi->spesialisasi == 'Body & Rangka' ? 'selected' : '' }}>
        Body & Rangka
    </option>

    <option value="Overhaul Master"
        {{ $teknisi->spesialisasi == 'Overhaul Master' ? 'selected' : '' }}>
        Overhaul Master
    </option>

    <option value="Tune Up & Service Ringan"
        {{ $teknisi->spesialisasi == 'Tune Up & Service Ringan' ? 'selected' : '' }}>
        Tune Up & Service Ringan
    </option>

</select>
</div>
</div>
<!-- Contact -->
<div class="space-y-2">
<label class="block font-label-md text-on-surface-variant">Nomor Telepon</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-body-md">call</span>
<input
    type="text"
    name="nomor_telepon"
    value="{{ old('nomor_telepon', $teknisi->nomor_telepon) }}"
    class="w-full pl-10 pr-4 py-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
</div>
</div>
<!-- Address -->
<div class="space-y-2">
<label class="block font-label-md text-on-surface-variant">Alamat Lengkap</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-4 text-outline text-body-md">location_on</span>
<textarea
    name="alamat"
    rows="4"
    class="w-full pl-10 pr-4 py-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary resize-none">{{ old('alamat', $teknisi->alamat) }}</textarea>
</div>
</div>
<!-- Action Buttons Mobile Fallback -->
<div class="pt-6 border-t border-outline-variant flex flex-col sm:flex-row justify-end gap-4">
<a href="{{ route('admin.mekanik.index') }}"
   class="order-2 sm:order-1 px-8 py-3 font-label-md font-bold text-on-surface-variant hover:text-primary hover:bg-surface-container-high rounded-lg transition-colors text-center">
    Batal
</a>
<button class="order-1 sm:order-2 px-8 py-3 bg-secondary text-on-primary font-label-md font-bold rounded-lg shadow-lg hover:brightness-110 active:scale-95 transition-all" type="submit">Simpan Perubahan</button>
</div>
</form>
<!-- Auxiliary Performance Card -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="p-6 bg-surface-container rounded-xl border border-outline-variant flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center">
<span class="material-symbols-outlined text-secondary">speed</span>
</div>
<div>
<p class="text-label-sm text-on-surface-variant">Efficiency Rate</p>
<p class="font-headline-md text-primary">94% <span class="text-sm font-normal text-green-600">+2%</span></p>
</div>
</div>
<div class="p-6 bg-surface-container rounded-xl border border-outline-variant flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
<span class="material-symbols-outlined text-primary">thumb_up</span>
</div>
<div>
<p class="text-label-sm text-on-surface-variant">Customer Trust</p>
<p class="font-headline-md text-primary">Gold Level</p>
</div>
</div>
</div>
</div>
</div>
</div>
</main>
@endsection