@extends('front.layout.app')

@section('title font-bold', 'Berita & Tips Otomotif - Sumber Baru Motor')

@section('content')
<div class="w-full bg-background py-16">
    <div class="max-w-container-max-width mx-auto px-margin-desktop">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6 border-b border-outline-variant pb-8">
            <div>
                <h1 class="font-headline-xl text-headline-xl text-primary mb-3">Berita & Tips Otomotif</h1>
                <p class="font-body-lg text-on-surface-variant max-w-xl">Dapatkan informasi terkini seputar dunia motor, panduan perawatan dari mekanik ahli, dan info promo menarik.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <button class="bg-primary text-white px-4 py-2 rounded-full font-label-sm text-label-sm">Semua</button>
                <button class="bg-surface-container hover:bg-surface-variant text-primary px-4 py-2 rounded-full font-label-sm text-label-sm transition-colors">Tips Merawat Motor</button>
                <button class="bg-surface-container hover:bg-surface-variant text-primary px-4 py-2 rounded-full font-label-sm text-label-sm transition-colors">Promo Resmi</button>
                <button class="bg-surface-container hover:bg-surface-variant text-primary px-4 py-2 rounded-full font-label-sm text-label-sm transition-colors">Event</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
            
            <div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden shadow-sm hover-lift flex flex-col">
                <div class="relative h-52 w-full bg-slate-200">
                    <img src="https://lh3.googleusercontent.com/aida/AP1WRLu1AvLKeY44YhujvzXigQZX2O3BkzX8KP2EWGf4zqv6FQfo60GGaRnPMD5dEThPtTyxuZMymvzRmvtVqaZXYcxLd0JbKPsrXLU9wJp2DvkQf1h7LaAJR6O3skEVjQzs2qr_zOpmumBgXRAQAUUBAEcwEEYE_rKa8iiG9l-dkBlsCnAAFdbXcS4K50rsg-xJmk6NaUiGT18k8eyIvRbN1VQ1Ho8JguQL8kEvuElm-qEcYc5xD56dWr2qOzre" alt="Tips motor injeksi" class="w-full h-full object-cover">
                    <span class="absolute top-4 left-4 bg-[#b7102a] text-white text-[11px] font-bold uppercase tracking-wide px-3 py-1 rounded">Tips Perawatan</span>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-4 text-xs text-on-surface-variant mb-3">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">calendar_today</span> 12 Juni 2026</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">person</span> Admin SBM</span>
                    </div>
                    <h3 class="font-headline-md text-[18px] text-primary mb-3 leading-snug hover:text-secondary transition-colors">
                        <a href="#">5 Tanda Utama Motor Injeksi Anda Wajib Melakukan Tune-Up</a>
                    </h3>
                    <p class="font-body-md text-on-surface-variant line-clamp-3 mb-6">
                        Mesin injeksi membutuhkan perawatan berkala agar tarikan tetap responsif. Ketahui tanda-tanda sistem injeksi mulai kotor sebelum mogok di jalan.
                    </p>
                    <a href="#" class="mt-auto font-label-md text-label-md text-secondary flex items-center gap-1 hover:gap-2 transition-all font-semibold">
                        Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden shadow-sm hover-lift flex flex-col">
                <div class="relative h-52 w-full bg-slate-200">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCykH4aNUQzY6Reqz1Gw-a4jN268BxVvy-vdHwmMDWrPT39P8Z0R7fudp_9WR_CeLwTs2EDaCW28iG30a5Bhl_kMJuigfZO1CHcc7EMsRcUjzhymovU-Rw9drQahp3mnSYgutqNVVWLeCugn07iWyzwQnWgLE1hVEKY4YVISIjsSe2ECN2vVWnl9thMCY1OhDzbR_i69L3zRj3QEuzrmtgT6w-vvs7NRImKYKwF5fJpBiVdjZy0Qa6QXemXJgk3X36swtxqe1xYbF40" alt="Promo Servis Juni" class="w-full h-full object-cover">
                    <span class="absolute top-4 left-4 bg-primary text-white text-[11px] font-bold uppercase tracking-wide px-3 py-1 rounded">Promo Resmi</span>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-4 text-xs text-on-surface-variant mb-3">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">calendar_today</span> 05 Juni 2026</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">person</span> Tim Promo</span>
                    </div>
                    <h3 class="font-headline-md text-[18px] text-primary mb-3 leading-snug hover:text-secondary transition-colors">
                        <a href="#">Promo Merdeka Servis: Ganti Oli Gratis Check-Up Rem Hidrolik</a>
                    </h3>
                    <p class="font-body-md text-on-surface-variant line-clamp-3 mb-6">
                        Menyambut bulan ini, Sumber Baru Motor memberikan penawaran eksklusif bagi pelanggan setia yang melakukan booking melalui aplikasi online resmi kami.
                    </p>
                    <a href="#" class="mt-auto font-label-md text-label-md text-secondary flex items-center gap-1 hover:gap-2 transition-all font-semibold">
                        Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden shadow-sm hover-lift flex flex-col">
                <div class="relative h-52 w-full bg-slate-200">
                    <img src="https://lh3.googleusercontent.com/aida/AP1WRLvz3AXxZDePj6JluPC5MMv4V1yebcoVBcY6WCMOeGpAntRxBzOvY7b2h_tCnOhMEJPSdVldiVKxDWdn__QA6GNSRo39_x6Im8qgjY4pf1XnkEmY8ObmBvYeFPADOdEiIeeg7p6nVfGK7O_PMRepHBMbXneHOGTuoADLHDx5lpufqN3GAu5a36pigkXRhWFD7HA3-YsVNrnPGawdfw0Tkok6axZnYmYXVkZMjXEfrWWVb3jahtpRFUkv3MMg" alt="Perawatan CVT Matic" class="w-full h-full object-cover">
                    <span class="absolute top-4 left-4 bg-[#b7102a] text-white text-[11px] font-bold uppercase tracking-wide px-3 py-1 rounded">Tips Perawatan</span>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-4 text-xs text-on-surface-variant mb-3">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">calendar_today</span> 28 Mei 2026</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">person</span> Mekanik Senior</span>
                    </div>
                    <h3 class="font-headline-md text-[18px] text-primary mb-3 leading-snug hover:text-secondary transition-colors">
                        <a href="#">Mengapa Sabuk CVT Motor Matic Berbunyi Berdecit? Ini Solusinya</a>
                    </h3>
                    <p class="font-body-md text-on-surface-variant line-clamp-3 mb-6">
                        Bunyi berdecit pada bagian transmisi matic (CVT) sangat mengganggu kenyamanan berkendara. Pelajari penyebab teknis dan cara penanganan terbaiknya di sini.
                    </p>
                    <a href="#" class="mt-auto font-label-md text-label-md text-secondary flex items-center gap-1 hover:gap-2 transition-all font-semibold">
                        Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>

        </div>

        <div class="flex justify-center mt-16 gap-2">
            <button class="w-10 h-10 rounded-lg border border-outline-variant flex items-center justify-center text-primary hover:bg-surface-container transition-colors disabled:opacity-50" disabled>
                <span class="material-symbols-outlined text-[20px]">chevron_left</span>
            </button>
            <button class="w-10 h-10 rounded-lg bg-primary text-white font-label-md flex items-center justify-center">1</button>
            <button class="w-10 h-10 rounded-lg border border-outline-variant text-primary font-label-md hover:bg-surface-container flex items-center justify-center transition-colors">2</button>
            <button class="w-10 h-10 rounded-lg border border-outline-variant flex items-center justify-center text-primary hover:bg-surface-container transition-colors">
                <span class="material-symbols-outlined text-[20px]">chevron_right</span>
            </button>
        </div>

    </div>
</div>
@endsection