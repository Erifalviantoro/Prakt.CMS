@extends('front.layout.app')

@section('title', 'Booking Servis')

@section('content')
<main class="py-24 bg-surface-container-low px-margin-desktop">
    <div class="max-w-3xl mx-auto">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="font-headline-lg text-headline-lg text-primary mb-3">Form Booking Servis</h1>
            <p class="text-on-surface-variant">Isi data diri dan kendaraan Anda untuk mendapatkan antrean prioritas.</p>
        </div>

        <!-- Card Form -->
        <div class="bg-white border border-outline-variant rounded-2xl p-8 shadow-sm">
            <form action="{{ route('front.booking.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Informasi Pelanggan -->
                <div>
                    <h3 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">person</span> Data Pelanggan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-primary mb-2">Nama Lengkap *</label>
                            <input type="text" name="nama" required class="w-full px-4 py-3 border border-outline-variant rounded-xl focus:outline-none focus:border-secondary" placeholder="Contoh: Budi Santoso">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-primary mb-2">Nomor Telepon/WhatsApp *</label>
                            <input type="text" name="nomor_telepon" required class="w-full px-4 py-3 border border-outline-variant rounded-xl focus:outline-none focus:border-secondary" placeholder="Contoh: 081234567xxx">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-primary mb-2">Email (Opsional)</label>
                            <input type="email" name="email" class="w-full px-4 py-3 border border-outline-variant rounded-xl focus:outline-none focus:border-secondary" placeholder="nama@email.com">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-primary mb-2">Alamat (Opsional)</label>
                            <textarea name="alamat" rows="2" class="w-full px-4 py-3 border border-outline-variant rounded-xl focus:outline-none focus:border-secondary" placeholder="Alamat tempat tinggal..."></textarea>
                        </div>
                    </div>
                </div>

                <hr class="border-outline-variant">

                <!-- Informasi Kendaraan -->
                <div>
                    <h3 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">two_wheeler</span> Data Kendaraan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-primary mb-2">Nomor Plat Motor *</label>
                            <input type="text" name="nomor_plat" required class="w-full px-4 py-3 border border-outline-variant rounded-xl focus:outline-none focus:border-secondary" placeholder="Contoh: AB 1234 CD">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-primary mb-2">Merk Kendaraan *</label>
                            <input type="text" name="merk_kendaraan" required class="w-full px-4 py-3 border border-outline-variant rounded-xl focus:outline-none focus:border-secondary" placeholder="Contoh: Honda, Yamaha, Suzuki">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-primary mb-2">Model/Tipe Motor *</label>
                            <input type="text" name="model_kendaraan" required class="w-full px-4 py-3 border border-outline-variant rounded-xl focus:outline-none focus:border-secondary" placeholder="Contoh: Vario 150, NMAX, Satria FU">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-primary mb-2">Tahun Pembuatan (Opsional)</label>
                            <input type="number" name="tahun_pembuatan" class="w-full px-4 py-3 border border-outline-variant rounded-xl focus:outline-none focus:border-secondary" placeholder="Contoh: 2021">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-primary mb-2">Nomor Mesin (Opsional)</label>
                            <input type="text" name="nomor_mesin" class="w-full px-4 py-3 border border-outline-variant rounded-xl focus:outline-none focus:border-secondary" placeholder="Masukkan nomor mesin jika tahu">
                        </div>
                    </div>
                </div>

                <hr class="border-outline-variant">

                <!-- Rencana Servis -->
                <div>
                    <h3 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">build_circle</span> Detail Servis
                    </h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-primary mb-2">Pilih Layanan Utama *</label>
                            <select name="layanan_id" class="w-full px-4 py-3 border border-outline-variant rounded-xl bg-white focus:outline-none focus:border-secondary">
                                <option value="">-- Pilih Jenis Layanan --</option>
                                @foreach($layanans as $layanan)
                                    <option value="{{ $layanan->id }}" {{ request('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                        {{ $layanan->nama_layanan }} (Rp {{ number_format($layanan->harga, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-primary mb-2">Rencana Tanggal Booking *</label>
                            <input type="date" name="tanggal_booking" required min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 border border-outline-variant rounded-xl focus:outline-none focus:border-secondary">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-primary mb-2">Keluhan / Catatan Tambahan *</label>
                            <textarea name="keluhan" rows="4" required class="w-full px-4 py-3 border border-outline-variant rounded-xl focus:outline-none focus:border-secondary" placeholder="Tuliskan gejala kerusakan atau kebutuhan servis motor Anda..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:bg-primary-container transition-all shadow-md flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">send</span> Kirim Permohonan Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection