@extends('front.layout.app')

@section('title', 'Edit Profil')

@section('content')

<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">

    <!-- Header -->
    <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between border-b border-gray-200 pb-6 gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                Pengaturan Profil
            </h2>
            <p class="text-sm text-gray-500 mt-1.5">
                Perbarui informasi akun personal dan spesifikasi data kendaraan Anda untuk sinkronisasi layanan otomatis.
            </p>
        </div>
        <div>
            <a href="{{ route('front.profile') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-gray-600 bg-white hover:bg-gray-50 border border-gray-200 px-4 py-2.5 rounded-xl shadow-sm transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Profil
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-xl flex items-center gap-3 shadow-sm animate-fade-in-down">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('front.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- ================= DATA PELANGGAN ================= -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 md:p-8">
                    
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">
                            Informasi Data Pelanggan
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
                                Nama Lengkap
                            </label>
                            <input
                                type="text"
                                name="nama"
                                value="{{ old('nama', $pelanggan?->nama) }}"
                                placeholder="Masukkan nama lengkap"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 transition bg-gray-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none placeholder:text-gray-300">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
                                Alamat Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $pelanggan?->email) }}"
                                placeholder="nama@email.com"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 transition bg-gray-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none placeholder:text-gray-300">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
                                Nomor Telepon / WhatsApp
                            </label>
                            <input
                                type="text"
                                name="nomor_telepon"
                                value="{{ old('nomor_telepon', $pelanggan?->nomor_telepon) }}"
                                placeholder="Contoh: 08123456789"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono text-gray-800 transition bg-gray-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none placeholder:text-gray-300">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
                                Alamat Tempat Tinggal
                            </label>
                            <textarea
                                name="alamat"
                                rows="4"
                                placeholder="Tuliskan alamat lengkap pengiriman/penjemputan..."
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 transition bg-gray-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none leading-relaxed placeholder:text-gray-300">{{ old('alamat', $pelanggan?->alamat) }}</textarea>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ================= SIDEBAR STATUS AKUN ================= -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 text-center">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 text-left mb-4">
                        Status Akun
                    </h3>
                    
                    <div class="flex flex-col items-center py-4">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-600 p-0.5 shadow-md">
                            <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-4xl shadow-inner">
                                👤
                            </div>
                        </div>
                        <h4 class="mt-4 font-extrabold text-gray-900 tracking-tight">
                            {{ $pelanggan?->nama ?? 'Belum melakukan booking' }}
                        </h4>
                        <span class="mt-1.5 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                            Verified Member
                        </span>
                    </div>
                </div>

                <div class="bg-amber-50/60 border border-amber-200/60 rounded-2xl p-5 text-xs text-amber-800 leading-relaxed">
                    <h5 class="font-bold flex items-center gap-1.5 mb-1.5 text-amber-900">
                        💡 Tips Sinkronisasi
                    </h5>
                    Pastikan nomor telepon aktif WhatsApp untuk memudahkan mekanik kami mengirimkan pembaruan status pengerjaan servis secara berkala.
                </div>
            </div>

        </div>

        <!-- ================= DATA KENDARAAN ================= -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 md:p-8 mt-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-8 opacity-[0.03] pointer-events-none text-9xl font-bold select-none">
                MOTO
            </div>

            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-slate-900 text-amber-400 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Spesifikasi Kendaraan Utama</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Sesuaikan dengan identitas fisik kendaraan Anda saat ini</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="lg:col-span-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
                        Nomor Plat Kendaraan
                    </label>
                    <div class="relative rounded-xl shadow-sm border border-gray-200 bg-slate-950 p-1 flex items-center group focus-within:ring-2 focus-within:ring-blue-500/30">
                        <div class="w-1.5 h-10 bg-amber-400 rounded-l-md ml-0.5"></div>
                        <input
                            type="text"
                            name="nomor_plat"
                            value="{{ old('nomor_plat', $kendaraan?->nomor_plat) }}"
                            placeholder="B 1234 ABC"
                            class="w-full bg-transparent border-0 text-white placeholder:text-gray-700 font-mono font-bold tracking-widest uppercase text-center focus:ring-0 focus:outline-none py-2 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
                        Merk Pabrikan
                    </label>
                    <input
                        type="text"
                        name="merk_kendaraan"
                        value="{{ old('merk_kendaraan', $kendaraan?->merk_kendaraan) }}"
                        placeholder="Honda / Yamaha / Suzuki"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 transition bg-gray-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none placeholder:text-gray-300">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
                        Model / Tipe Motor
                    </label>
                    <input
                        type="text"
                        name="model_kendaraan"
                        value="{{ old('model_kendaraan', $kendaraan?->model_kendaraan) }}"
                        placeholder="Vario 160cc / NMAX"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 transition bg-gray-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none placeholder:text-gray-300">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
                        Tahun Pembuatan
                    </label>
                    <input
                        type="number"
                        name="tahun_pembuatan"
                        value="{{ old('tahun_pembuatan', $kendaraan?->tahun_pembuatan) }}"
                        placeholder="2026"
                        min="1990"
                        max="2035"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm font-mono text-gray-800 transition bg-gray-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none placeholder:text-gray-300">
                </div>
            </div>
        </div>

        <!-- ================= PANEL ACTION TOMBOL ================= -->
        <div class="flex items-center justify-end gap-4 mt-10 pt-6 border-t border-gray-200">
            <a href="{{ route('front.profile') }}"
                class="px-6 py-3 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition shadow-sm">
                Batalkan
            </a>

            <button
                type="submit"
                class="px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-xl shadow-md shadow-blue-600/10 hover:shadow-lg transition">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>

@endsection