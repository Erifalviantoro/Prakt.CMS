<header class="w-full top-0 sticky z-50 bg-surface shadow-sm border-b border-outline-variant">
<nav class="flex justify-between items-center max-w-container-max-width mx-auto px-margin-desktop h-20">
<div class="flex items-center gap-3">
<img alt="Sumber Baru Motor Logo" class="w-10 h-10 object-contain" src="https://lh3.googleusercontent.com/aida/AP1WRLvz3AXxZDePj6JluPC5MMv4V1yebcoVBcY6WCMOeGpAntRxBzOvY7b2h_tCnOhMEJPSdVldiVKxDWdn__QA6GNSRo39_x6Im8qgjY4pf1XnkEmY8ObmBvYeFPADOdEiIeeg7p6nVfGK7O_PMRepHBMbXneHOGTuoADLHDx5lpufqN3GAu5a36pigkXRhWFD7HA3-YsVNrnPGawdfw0Tkok6axZnYmYXVkZMjXEfrWWVb3jahtpRFUkv3MMg"/>
<span class="font-headline-md text-headline-md font-bold text-primary">Sumber Baru Motor</span>
</div>
<div class="hidden md:flex items-center gap-8">
    <a href="{{ route('front.home') }}" class="font-label-md text-label-md hover:text-primary transition-colors">Home</a>
    <a href="{{ route('front.tentang') }}" class="font-label-md text-label-md hover:text-primary transition-colors">Tentang Kami</a>
    <a href="{{ route('front.layanan.index') }}" class="font-label-md text-label-md hover:text-primary transition-colors">Layanan</a>
    <a href="{{ route('front.berita.index') }}" class="font-label-md text-label-md hover:text-primary transition-colors">Berita</a>
    <div class="relative group">
        <button class="flex items-center gap-1 font-label-md text-label-md hover:text-primary transition-colors">
            Booking
            <span class="material-symbols-outlined text-[18px]">
                expand_more
            </span>
        </button>

    <!-- Dropdown -->
        <div class="absolute top-full left-0 mt-2 w-56 bg-white border border-outline-variant rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
            <a href="{{ route('front.booking.create') }}"
            class="block px-4 py-3 hover:bg-surface-container-low text-sm">
            Booking Servis
            </a>
            <a href="{{ route('front.status.booking') }}"class="block px-4 py-3 hover:bg-surface-container-low text-sm border-t border-outline-variant">
                Cek Status Booking
            </a>
        </div>
    </div>
    <a href="{{ route('front.kontak') }}" class="font-label-md text-label-md hover:text-primary transition-colors">Kontak</a>
</div>
<div class="flex items-center gap-4">
<button class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md text-label-md hover:opacity-90 active:scale-95 transition-all">Login</button>
</div>
</nav>
</header>