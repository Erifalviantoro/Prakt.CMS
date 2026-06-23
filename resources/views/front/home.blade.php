@extends('front.layout.app')

@section('title', 'Home')

@section('content')
<main>
<!-- Hero Section -->
<section class="relative h-[640px] flex items-center overflow-hidden">
<div class="absolute inset-0 z-0">
<div class="absolute inset-0 bg-gradient-to-r from-primary/90 via-primary/60 to-transparent z-10"></div>
<img alt="Mechanic working on high performance motorcycle" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida/AP1WRLu1AvLKeY44YhujvzXigQZX2O3BkzX8KP2EWGf4zqv6FQfo60GGaRnPMD5dEThPtTyxuZMymvzRmvtVqaZXYcxLd0JbKPsrXLU9wJp2DvkQf1h7LaAJR6O3skEVjQzs2qr_zOpmumBgXRAQAUUBAEcwEEYE_rKa8iiG9l-dkBlsCnAAFdbXcS4K50rsg-xJmk6NaUiGT18k8eyIvRbN1VQ1Ho8JguQL8kEvuElm-qEcYc5xD56dWr2qOzre"/>
</div>
<div class="relative z-20 max-w-container-max-width mx-auto px-margin-desktop w-full">
<div class="max-w-2xl">
<h1 class="font-headline-xl text-headline-xl text-white mb-6 leading-tight">
                        Performa Mesin Maksimal, <br/><span class="text-secondary-fixed-dim">Perjalanan Lebih Aman.</span>
</h1>
<p class="font-body-lg text-body-lg text-white/80 mb-10">
                        Servis resmi dan terpercaya untuk segala jenis motor. Booking online sekarang dan nikmati layanan prima dari teknisi ahli kami.
                    </p>
<div class="flex flex-wrap gap-4">
<button class="bg-secondary text-white px-8 py-4 rounded-lg font-label-md text-label-md flex items-center gap-2 hover:bg-secondary/90 transition-all shadow-lg active:scale-95">
<span class="material-symbols-outlined">calendar_month</span>
                            Book Service Sekarang
                        </button>
<button class="border-2 border-white text-white px-8 py-4 rounded-lg font-label-md text-label-md hover:bg-white hover:text-primary transition-all active:scale-95">
                            Lihat Promo
                        </button>
</div>
</div>
</div>
</section>
<!-- Stats Section -->
<section class="relative z-30 -mt-16 max-w-container-max-width mx-auto px-margin-desktop">
<div class="stats-gradient rounded-xl p-base md:p-10 shadow-xl grid grid-cols-2 md:grid-cols-4 gap-gutter border border-white/10">
<div class="text-center md:border-r border-white/10 last:border-0">
<p class="font-headline-lg text-headline-lg text-white mb-1">25+</p>
<p class="font-label-sm text-label-sm text-on-primary-container uppercase tracking-wider">Tahun Pengalaman</p>
</div>
<div class="text-center md:border-r border-white/10 last:border-0">
<p class="font-headline-lg text-headline-lg text-white mb-1">100k+</p>
<p class="font-label-sm text-label-sm text-on-primary-container uppercase tracking-wider">Motor Terlayani</p>
</div>
<div class="text-center md:border-r border-white/10 last:border-0">
<p class="font-headline-lg text-headline-lg text-white mb-1">50+</p>
<p class="font-label-sm text-label-sm text-on-primary-container uppercase tracking-wider">Mekanik Ahli</p>
</div>
<div class="text-center">
<p class="font-headline-lg text-headline-lg text-white mb-1">10</p>
<p class="font-label-sm text-label-sm text-on-primary-container uppercase tracking-wider">Cabang Resmi</p>
</div>
</div>
</section>
<!-- Featured Services -->
<section class="py-24 max-w-container-max-width mx-auto px-margin-desktop">
<div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary mb-4">Layanan Unggulan Kami</h2>
<p class="text-on-surface-variant max-w-xl">Kami menyediakan berbagai layanan perawatan motor yang dilakukan oleh teknisi bersertifikat menggunakan peralatan modern.</p>
</div>
<a class="text-secondary font-bold flex items-center gap-2 hover:gap-3 transition-all" href="#">
                    Lihat Semua Layanan <span class="material-symbols-outlined">arrow_forward</span>
</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
<!-- Card 1 -->
<div class="bg-white p-8 rounded-xl border border-outline-variant hover-lift shadow-sm flex flex-col items-center text-center">
<div class="w-16 h-16 bg-primary/5 rounded-full flex items-center justify-center text-primary mb-6">
<span class="material-symbols-outlined text-[32px]">ev_station</span>
</div>
<h3 class="font-headline-md text-[20px] mb-4">Tune Up Injeksi</h3>
<button class="mt-auto w-full py-3 text-secondary border border-secondary rounded-lg font-label-md hover:bg-secondary hover:text-white transition-all">Booking Sekarang</button>
</div>
<!-- Card 2 -->
<div class="bg-white p-8 rounded-xl border border-outline-variant hover-lift shadow-sm flex flex-col items-center text-center">
<div class="w-16 h-16 bg-primary/5 rounded-full flex items-center justify-center text-primary mb-6">
<span class="material-symbols-outlined text-[32px]">oil_barrel</span>
</div>
<h3 class="font-headline-md text-[20px] mb-4">Ganti Oli &amp; Filter</h3>
<button class="mt-auto w-full py-3 text-secondary border border-secondary rounded-lg font-label-md hover:bg-secondary hover:text-white transition-all">Booking Sekarang</button>
</div>
<!-- Card 3 -->
<div class="bg-white p-8 rounded-xl border border-outline-variant hover-lift shadow-sm flex flex-col items-center text-center">
<div class="w-16 h-16 bg-primary/5 rounded-full flex items-center justify-center text-primary mb-6">
<span class="material-symbols-outlined text-[32px]">settings_input_component</span>
</div>
<h3 class="font-headline-md text-[20px] mb-4">Servis CVT</h3>
<button class="mt-auto w-full py-3 text-secondary border border-secondary rounded-lg font-label-md hover:bg-secondary hover:text-white transition-all">Booking Sekarang</button>
</div>
<!-- Card 4 -->
<div class="bg-white p-8 rounded-xl border border-outline-variant hover-lift shadow-sm flex flex-col items-center text-center">
<div class="w-16 h-16 bg-primary/5 rounded-full flex items-center justify-center text-primary mb-6">
<span class="material-symbols-outlined text-[32px]">precision_manufacturing</span>
</div>
<h3 class="font-headline-md text-[20px] mb-4">Overhaul Mesin</h3>
<button class="mt-auto w-full py-3 text-secondary border border-secondary rounded-lg font-label-md hover:bg-secondary hover:text-white transition-all">Booking Sekarang</button>
</div>
<!-- Card 5 -->
<div class="bg-white p-8 rounded-xl border border-outline-variant hover-lift shadow-sm flex flex-col items-center text-center">
<div class="w-16 h-16 bg-primary/5 rounded-full flex items-center justify-center text-primary mb-6">
<span class="material-symbols-outlined text-[32px]">bolt</span>
</div>
<h3 class="font-headline-md text-[20px] mb-4">Kelistrikan &amp; Aki</h3>
<button class="mt-auto w-full py-3 text-secondary border border-secondary rounded-lg font-label-md hover:bg-secondary hover:text-white transition-all">Booking Sekarang</button>
</div>
</div>
</section>
<!-- Why Choose Us Section -->
<section class="py-24 bg-surface-container-low overflow-hidden">
<div class="max-w-container-max-width mx-auto px-margin-desktop grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
<div class="relative">
<div class="absolute -top-10 -left-10 w-40 h-40 bg-secondary/10 rounded-full blur-3xl"></div>
<h2 class="font-headline-lg text-headline-lg text-primary mb-8">Kenapa Memilih Sumber Baru Motor?</h2>
<div class="space-y-10">
<div class="flex gap-6">
<div class="shrink-0 w-12 h-12 bg-white rounded-lg shadow-sm flex items-center justify-center text-secondary">
<span class="material-symbols-outlined">verified</span>
</div>
<div>
<h4 class="font-headline-md text-[18px] text-primary mb-2">Suku Cadang Asli</h4>
<p class="text-on-surface-variant">Kami menjamin 100% keaslian suku cadang untuk menjaga performa dan keawetan motor Anda.</p>
</div>
</div>
<div class="flex gap-6">
<div class="shrink-0 w-12 h-12 bg-white rounded-lg shadow-sm flex items-center justify-center text-secondary">
<span class="material-symbols-outlined">engineering</span>
</div>
<div>
<h4 class="font-headline-md text-[18px] text-primary mb-2">Teknisi Bersertifikat</h4>
<p class="text-on-surface-variant">Tim mekanik kami memiliki sertifikasi resmi dan pengalaman bertahun-tahun di dunia otomotif.</p>
</div>
</div>
<div class="flex gap-6">
<div class="shrink-0 w-12 h-12 bg-white rounded-lg shadow-sm flex items-center justify-center text-secondary">
<span class="material-symbols-outlined">build</span>
</div>
<div>
<h4 class="font-headline-md text-[18px] text-primary mb-2">Peralatan Modern</h4>
<p class="text-on-surface-variant">Penggunaan alat diagnostik digital terbaru untuk hasil yang lebih akurat dan presisi.</p>
</div>
</div>
<div class="flex gap-6">
<div class="shrink-0 w-12 h-12 bg-white rounded-lg shadow-sm flex items-center justify-center text-secondary">
<span class="material-symbols-outlined">payments</span>
</div>
<div>
<h4 class="font-headline-md text-[18px] text-primary mb-2">Transparansi Harga</h4>
<p class="text-on-surface-variant">Estimasi biaya diberikan di awal secara jujur tanpa biaya tersembunyi yang merugikan.</p>
</div>
</div>
</div>
</div>
<div class="relative">
<div class="aspect-square rounded-3xl overflow-hidden border-8 border-white shadow-2xl relative z-10">
<div class="w-full h-full bg-cover bg-center" data-alt="Close up high-quality photography of a motorcycle engine being serviced with precision tools, bright workshop lighting, professional navy and white aesthetic." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCykH4aNUQzY6Reqz1Gw-a4jN268BxVvy-vdHwmMDWrPT39P8Z0R7fudp_9WR_CeLwTs2EDaCW28iG30a5Bhl_kMJuigfZO1CHcc7EMsRcUjzhymovU-Rw9drQahp3mnSYgutqNVVWLeCugn07iWyzwQnWgLE1hVEKY4YVISIjsSe2ECN2vVWnl9thMCY1OhDzbR_i69L3zRj3QEuzrmtgT6w-vvs7NRImKYKwF5fJpBiVdjZy0Qa6QXemXJgk3X36swtxqe1xYbF40')"></div>
</div>
<div class="absolute -bottom-10 -right-10 w-full h-full bg-secondary/10 rounded-3xl -z-0"></div>
</div>
</div>
</section>
<!-- Call to Action Banner -->
<section class="py-20 max-w-container-max-width mx-auto px-margin-desktop">
<div class="bg-primary rounded-3xl p-12 text-center relative overflow-hidden">
<div class="absolute top-0 right-0 w-64 h-64 bg-secondary/20 rounded-full blur-[100px] -mr-32 -mt-32"></div>
<div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary/10 rounded-full blur-[100px] -ml-32 -mb-32"></div>
<div class="relative z-10 max-w-3xl mx-auto">
<h2 class="font-headline-lg text-headline-lg text-white mb-6">Siap Memberikan yang Terbaik untuk Motor Anda.</h2>
<p class="font-body-lg text-white/70 mb-10">Hubungi kami via WhatsApp atau Booking Langsung untuk mendapatkan antrean prioritas.</p>
<div class="flex flex-wrap justify-center gap-6">
<button class="bg-secondary text-white px-10 py-4 rounded-xl font-label-md text-label-md flex items-center gap-3 hover:scale-105 transition-all shadow-lg">
<span class="material-symbols-outlined">calendar_add_on</span>
                            Booking Servis Sekarang
                        </button>
<button class="bg-white text-primary px-10 py-4 rounded-xl font-label-md text-label-md flex items-center gap-3 hover:scale-105 transition-all shadow-lg">
<span class="material-symbols-outlined">chat</span>
                            Hubungi WhatsApp
                        </button>
</div>
</div>
</div>
</section>
</main>
@endsection