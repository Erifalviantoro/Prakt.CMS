@extends('front.layout.app')

@section('title', 'Profil Saya')

@section('content')

<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">

    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">
            Profil Saya
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Kelola informasi akun, data kendaraan, dan pantau aktivitas Anda di MotoFix.
        </p>
    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        <!-- KOLOM KIRI (2/3): Data Utama Profil -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                
                <!-- Avatar Header -->
                <div class="flex flex-col sm:flex-row items-center gap-5 pb-6 border-b border-gray-100 mb-6 text-center sm:text-left">
                    <div class="w-20 h-20 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-3xl shadow-inner group-hover:scale-105 transition duration-200">
                        👤
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">
                            {{ $pelanggan?->nama ?? 'Belum melakukan booking' }}
                        </h3>
                        <p class="text-xs font-semibold text-blue-600 bg-blue-50 px-2.5 py-0.5 rounded-full inline-block mt-1">
                            Pelanggan Setia MotoFix
                        </p>
                    </div>
                </div>

                <!-- Informasi Detail -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-sm">
                    <div class="p-3 bg-gray-50/60 rounded-xl border border-gray-100">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Nama Lengkap</p>
                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $pelanggan?->nama ?? '-' }}
                        </p>
                    </div>

                    <div class="p-3 bg-gray-50/60 rounded-xl border border-gray-100">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Alamat Email</p>
                        <p class="font-semibold text-gray-800 mt-1 break-all">
                            {{ $pelanggan?->email ?? '-' }}
                        </p>
                    </div>

                    <div class="p-3 bg-gray-50/60 rounded-xl border border-gray-100">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Nomor Telepon</p>
                        <p class="font-semibold text-gray-800 mt-1 font-mono">
                            {{ $pelanggan?->nomor_telepon ?? '-' }}
                        </p>
                    </div>

                    <div class="p-3 bg-gray-50/60 rounded-xl border border-gray-100">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Alamat Rumah</p>
                        <p class="font-semibold text-gray-700 mt-1 text-xs leading-relaxed">
                            {{ $pelanggan?->alamat ?? '-' }}
                        </p>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-8 pt-4 border-t border-gray-50 flex justify-end">
                    <a href="{{ route('front.profile.edit') }}"
                        class="px-5 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition">
                        Edit Profil
                    </a>
                </div>

            </div>
        </div>

        <!-- KOLOM KANAN (1/3): Sidebar Kendaraan & Statistik -->
        <div class="space-y-6">

            <!-- Card Kendaraan Saya -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5 pointer-events-none text-5xl">🏍️</div>
                
                <h3 class="font-bold text-gray-800 text-base mb-4 flex items-center gap-2">
                    <span>🏍️</span> Kendaraan Saya
                </h3>

                <div class="space-y-3.5 text-sm">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-50">
                        <span class="text-xs text-gray-400 uppercase tracking-wider">Nomor Plat</span>
                        <span class="font-mono font-bold text-xs bg-gray-950 text-white px-2.5 py-0.5 rounded tracking-wide shadow-sm border-r-4 border-amber-400">
                            {{ $kendaraan?->nomor_plat ?? '-' }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center pb-2 border-b border-gray-50">
                        <span class="text-xs text-gray-400 uppercase tracking-wider">Merk</span>
                        <span class="font-semibold text-gray-800">
                            {{ $kendaraan?->merk_kendaraan ?? '-' }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center pb-2 border-b border-gray-50">
                        <span class="text-xs text-gray-400 uppercase tracking-wider">Model Motor</span>
                        <span class="font-semibold text-gray-800">
                            {{ $kendaraan?->model_kendaraan ?? '-' }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 uppercase tracking-wider">Tahun Rakit</span>
                        <span class="font-semibold text-gray-600 font-mono">
                            {{ $kendaraan?->tahun_pembuatan ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Ringkasan Statistik Aktivitas -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <h3 class="font-bold text-gray-800 text-base mb-4 flex items-center gap-2">
                    <span>📊</span> Ringkasan Aktivitas
                </h3>

                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-3 bg-blue-50/50 rounded-xl border border-blue-100/60">
                        <p class="text-2xl font-extrabold text-blue-600 font-mono tracking-tight">
                            {{ $totalBooking ?? 0 }}
                        </p>
                        <p class="text-[10px] font-bold text-blue-500 uppercase tracking-wider mt-0.5">Total Hadir</p>
                    </div>

                    <div class="text-center p-3 bg-green-50/50 rounded-xl border border-green-100/60">
                        <p class="text-2xl font-extrabold text-green-600 font-mono tracking-tight">
                            {{ $bookingSelesai ?? 0 }}
                        </p>
                        <p class="text-[10px] font-bold text-green-500 uppercase tracking-wider mt-0.5">Selesai</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection