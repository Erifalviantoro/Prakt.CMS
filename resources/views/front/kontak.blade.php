@extends('front.layout.app')

@section('title', 'Hubungi Kami - Sumber Baru Motor')

@section('content')
<div class="w-full bg-background py-16">
    <div class="max-w-container-max-width mx-auto px-margin-desktop">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h1 class="font-headline-xl text-headline-xl text-primary mb-4">Hubungi Kami</h1>
            <p class="font-body-lg text-on-surface-variant">
                Punya pertanyaan mengenai layanan servis atau suku cadang? Tim kami siap membantu Anda kapan saja.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter items-start">
            
            <!-- Kolom Kiri: Informasi Kontak & Jam Operasional -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant shadow-sm">
                    <h3 class="font-headline-md text-[20px] text-primary mb-6">Informasi Kontak</h3>
                    
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 bg-primary/5 rounded-lg flex items-center justify-center text-secondary">
                                <span class="material-symbols-outlined">location_on</span>
                            </div>
                            <div>
                                <h4 class="font-label-md text-primary font-bold mb-1">Alamat Bengkel</h4>
                                <p class="font-body-md text-on-surface-variant">Jl. Utama No. 123, Komplek Otomotif, Jakarta</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 bg-primary/5 rounded-lg flex items-center justify-center text-secondary">
                                <span class="material-symbols-outlined">call</span>
                            </div>
                            <div>
                                <h4 class="font-label-md text-primary font-bold mb-1">Telepon & WhatsApp</h4>
                                <p class="font-body-md text-on-surface-variant">+62 812-3456-7890</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 bg-primary/5 rounded-lg flex items-center justify-center text-secondary">
                                <span class="material-symbols-outlined">mail</span>
                            </div>
                            <div>
                                <h4 class="font-label-md text-primary font-bold mb-1">Email Resmi</h4>
                                <p class="font-body-md text-on-surface-variant">info@sumberbarumotor.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-primary text-on-primary p-8 rounded-xl shadow-sm relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-secondary/20 rounded-full blur-2xl"></div>
                    <h3 class="font-headline-md text-[20px] mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined">schedule</span> Jam Operasional
                    </h3>
                    <div class="space-y-3 font-body-md border-t border-white/10 pt-4">
                        <div class="flex justify-between">
                            <span class="text-on-primary-container">Senin - Jumat</span>
                            <span class="font-semibold">08:00 - 16:30</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-on-primary-container">Sabtu</span>
                            <span class="font-semibold">08:00 - 15:00</span>
                        </div>
                        <div class="flex justify-between text-secondary-fixed-dim font-medium">
                            <span>Minggu / Tanggal Merah</span>
                            <span>Libur</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Form Kirim Pesan -->
            <div class="lg:col-span-2 bg-surface-container-lowest p-8 md:p-10 rounded-xl border border-outline-variant shadow-sm">
                <h3 class="font-headline-md text-headline-md text-primary mb-2">Kirim Pesan</h3>
                <p class="font-body-md text-on-surface-variant mb-8">Isi formulir di bawah ini untuk mengirimkan kritik, saran, atau pertanyaan khusus.</p>
                
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg font-body-md flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-label-md text-primary mb-2 font-semibold">Nama Lengkap</label>
                            <input type="text" name="nama" placeholder="Masukkan nama Anda" class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-background focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-primary" required />
                        </div>
                        <div>
                            <label class="block font-label-md text-primary mb-2 font-semibold">Nomor WhatsApp</label>
                            <input type="tel" name="no_hp" placeholder="Contoh: 0812345678" class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-background focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-primary" required />
                        </div>
                    </div>

                    <div>
                        <label class="block font-label-md text-primary mb-2 font-semibold">Alamat Email</label>
                        <input type="email" name="email" placeholder="nama@email.com" class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-background focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-primary" required />
                    </div>

                    <div>
                        <label class="block font-label-md text-primary mb-2 font-semibold">Isi Pesan</label>
                        <textarea name="pesan" rows="6" placeholder="Tuliskan detail pertanyaan atau pesan Anda disini..." class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-background focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-primary" required></textarea>
                    </div>

                    <button type="submit" class="bg-secondary text-white px-8 py-4 rounded-lg font-label-md text-label-md hover:bg-secondary/90 transition-all shadow-md flex items-center gap-2 active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">send</span> Kirim Pesan Sekarang
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection