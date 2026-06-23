@extends('admin.layout.layout')
@section('content')
<main class="ml-64 min-h-screen">
    @include('admin.layout.header')
    <!-- Top Navigation Bar -->
    <header class="w-full h-16 sticky top-0 bg-white dark:bg-surface shadow-sm flex justify-between items-center px-gutter z-40">
        <div class="flex items-center gap-4">
            <nav class="flex items-center text-sm text-on-surface-variant">
                <span class="font-label-md">Pelanggan</span>
                <span class="material-symbols-outlined mx-2 text-base">chevron_right</span>
                <span class="font-label-md text-primary font-bold">Tambah Pelanggan Baru</span>
            </nav>
        </div>
        <div class="flex items-center gap-6">
            <div class="relative">
                <span class="material-symbols-outlined p-2 text-on-surface-variant hover:bg-surface-container-low rounded-full cursor-pointer transition-colors">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-secondary rounded-full border-2 border-white"></span>
            </div>
            <div class="flex items-center gap-3 pl-6 border-l border-outline-variant">
                <div class="text-right">
                    <p class="text-label-md font-bold text-primary">Administrator</p>
                    <p class="text-[10px] text-on-surface-variant uppercase tracking-tighter">Super User</p>
                </div>
                <img alt="Administrator Profile" class="w-10 h-10 rounded-full border-2 border-primary-fixed" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD-uQvCGIxxZAToYTHuDmhVoqRsSvTLuaVEftZBTatlERtATaw48zehJpwaKRYzsA5SgbCyDjglI7IEGp7mV_7rlLF_D4VkRFOs-BeVPdGocj-2S9AKFUQ3FaVBp84cWGq2PM5YPHAK-yMsXWg1LTl6TEmxDCJS8dwEudLmCOmSzNyc3KbXuS6ZxqDEOy1pt-FswcpiHpeHGgPO8bwyFw4ebPLDe5faQWws3lLxx1aK3iEPIb-tqh1SxnmvNbUaMHdk7lDY8gBLFU9J"/>
            </div>
        </div>
    </header>

    <!-- Form Content Canvas -->
    <div class="p-8 max-w-5xl mx-auto">
        <div class="mb-8">
            <h2 class="font-headline-lg text-headline-lg text-primary font-bold">Tambah Pelanggan</h2>
            <p class="text-on-surface-variant mt-2 font-body-md">Lengkapi data di bawah ini untuk mendaftarkan pelanggan baru ke sistem perbaikan Sumber Baru Motor.</p>
        </div>

        <!-- Bento Grid Layout for Form -->
        <div class="grid grid-cols-12 gap-6">
            <!-- Main Form Card -->
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <div class="glass-panel p-8 rounded-xl shadow-sm bg-white border border-outline-variant">
                    
                    <form action="{{ route('admin.pelanggan.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-2 gap-6">
                            <!-- Nama Pelanggan -->
                            <div class="col-span-2">
                                <label class="block text-label-md font-semibold text-primary mb-2">Nama Pelanggan <span class="text-error">*</span></label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant">person</span>
                                    <input name="nama" value="{{ old('nama') }}" class="w-full pl-10 pr-4 py-3 rounded-lg border @error('nama') border-error focus:ring-error/10 @else border-outline-variant focus:border-primary focus:ring-primary/10 @enderror focus:ring-2 transition-all font-body-md bg-white" placeholder="Masukkan nama lengkap pelanggan" type="text" required/>
                                </div>
                                @error('nama')
                                    <p class="text-xs text-error mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="col-span-1">
                                <label class="block text-label-md font-semibold text-primary mb-2">Nomor Telepon <span class="text-error">*</span></label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant">call</span>
                                    <input name="nomor_telepon" value="{{ old('nomor_telepon') }}" class="w-full pl-10 pr-4 py-3 rounded-lg border @error('nomor_telepon') border-error focus:ring-error/10 @else border-outline-variant focus:border-primary focus:ring-primary/10 @enderror focus:ring-2 transition-all font-body-md bg-white" placeholder="0812-xxxx-xxxx" type="tel" required/>
                                </div>
                                @error('nomor_telepon')
                                    <p class="text-xs text-error mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-span-1">
                                <label class="block text-label-md font-semibold text-primary mb-2">Email</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant">mail</span>
                                    <input name="email" value="{{ old('email') }}" class="w-full pl-10 pr-4 py-3 rounded-lg border @error('email') border-error focus:ring-error/10 @else border-outline-variant focus:border-primary focus:ring-primary/10 @enderror focus:ring-2 transition-all font-body-md bg-white" placeholder="example@domain.com" type="email"/>
                                </div>
                                @error('email')
                                    <p class="text-xs text-error mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="col-span-2">
                                <label class="block text-label-md font-semibold text-primary mb-2">Alamat Lengkap <span class="text-error">*</span></label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-3 text-outline-variant">location_on</span>
                                    <textarea name="alamat" class="w-full pl-10 pr-4 py-3 rounded-lg border @error('alamat') border-error focus:ring-error/10 @else border-outline-variant focus:border-primary focus:ring-primary/10 @enderror focus:ring-2 transition-all font-body-md bg-white" placeholder="Masukkan alamat tempat tinggal pelanggan..." rows="3" required>{{ old('alamat') }}</textarea>
                                </div>
                                @error('alamat')
                                    <p class="text-xs text-error mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Pendaftaran -->
                            <div class="col-span-2">
                                <label class="block text-label-md font-semibold text-primary mb-2">Tanggal Pendaftaran</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant">calendar_today</span>
                                    <input name="tanggal_pendaftaran" value="{{ old('tanggal_pendaftaran', date('Y-m-d')) }}" class="w-full pl-10 pr-4 py-3 rounded-lg border @error('tanggal_pendaftaran') border-error focus:ring-error/10 @else border-outline-variant focus:border-primary focus:ring-primary/10 @enderror focus:ring-2 transition-all font-body-md bg-white" type="date"/>
                                </div>
                                <p class="text-xs text-on-surface-variant mt-2 italic">* Tanggal otomatis tersetting ke hari ini jika tidak diubah.</p>
                                @error('tanggal_pendaftaran')
                                    <p class="text-xs text-error mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons Section -->
                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-outline-variant">
                            <a href="{{ route('admin.pelanggan.index') }}" class="px-8 py-3 rounded-lg font-label-md font-semibold text-primary border border-primary hover:bg-primary-container/10 transition-all active:scale-95 text-center">
                                Batal
                            </a>
                            <button class="px-8 py-3 rounded-lg font-label-md font-semibold text-white bg-secondary hover:bg-secondary/90 shadow-md transition-all active:scale-95 flex items-center gap-2" type="submit">
                                <span class="material-symbols-outlined text-lg">save</span>
                                Simpan Pelanggan
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Sidebar Context Info -->
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <!-- Helper Card -->
                <div class="bg-primary p-6 rounded-xl text-white shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10">
                        <span class="material-symbols-outlined text-[120px]" style="font-variation-settings: 'FILL' 1;">contact_support</span>
                    </div>
                    <h3 class="font-headline-md text-white mb-3 relative z-10 font-bold text-xl">Informasi Penting</h3>
                    <p class="text-on-primary-container font-body-md text-sm mb-4 relative z-10 opacity-90">Pastikan nomor telepon yang dimasukkan aktif untuk pengiriman notifikasi status perbaikan melalui WhatsApp bengkel.</p>
                    <div class="flex items-center gap-3 relative z-10 bg-white/10 p-3 rounded-lg">
                        <span class="material-symbols-outlined text-secondary-container">verified</span>
                        <span class="text-xs font-semibold">Data akan terenkripsi dengan aman dalam database sistem.</span>
                    </div>
                </div>

                <!-- Image Visualization -->
                <div class="rounded-xl overflow-hidden shadow-sm aspect-[4/3] relative group">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDFnDwhwRZ6LNqv16983afpP8mxP3UrVPyIW1dR6MPOVGySL_6YHZ5m0-b4eb8Hanp5zKnnUHjkokCefCuxtDmnwDT_DbmMwX9QmZp2BiuBILUuwDIbdov846BJglzmGkG00mOOFux8onpjP_AQ04jhlz9fvBWGdEnVuYGPqZu2GGX-lhDVCpqsXVmGdyxl8wsojBlmetiSrFQguzs8EU4H5UW45EkGl1LrIzguiVi1L2--1EQCDlwiua6OeQtOoGtzhntakDWuS3IC"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent flex items-end p-6">
                        <div class="text-white">
                            <p class="text-xs font-bold uppercase tracking-widest text-secondary-container">Professional Service</p>
                            <p class="text-sm italic">"Kepercayaan anda adalah prioritas servis kami."</p>
                        </div>
                    </div>
                </div>

                <!-- Statistics/Status Mini Card -->
                <div class="glass-panel p-6 rounded-xl border-l-4 border-secondary bg-white border border-outline-variant">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-label-md font-bold text-primary">Kapasitas Bengkel</span>
                        <span class="text-xs font-bold text-secondary">85% Full</span>
                    </div>
                    <div class="w-full bg-surface-container-highest h-2 rounded-full overflow-hidden bg-gray-100">
                        <div class="bg-secondary h-full" style="width: 85%;"></div>
                    </div>
                    <p class="text-[10px] text-on-surface-variant mt-3">Rata-rata waktu tunggu pendaftaran: <span class="font-bold">5 Menit</span></p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection