<header class="w-full top-0 sticky z-50 bg-surface shadow-sm border-b border-outline-variant">
<nav class="flex justify-between items-center max-w-container-max-width mx-auto px-margin-desktop h-20">
<div class="flex items-center gap-3">
<img alt="Sumber Baru Motor Logo" class="w-16 h-16 object-contain" src="{{ asset('images/logo.png') }}"/>
<span class="font-headline-md text-headline-md font-bold text-primary">Sumber Baru Motor</span>
</div>
<div class="hidden md:flex items-center gap-2 bg-slate-50/60 p-1.5 rounded-full border border-slate-100 backdrop-blur-md">
    <a href="{{ route('front.home') }}" 
       class="font-label-md text-label-md px-4 py-2 rounded-full transition-all duration-300 font-semibold tracking-wide text-sm
       {{ request()->routeIs('front.home') ? 'bg-primary text-white shadow-md shadow-primary/20 scale-105' : 'text-slate-600 hover:text-primary hover:bg-white' }}">
       Home
    </a>

    <a href="{{ route('front.tentang') }}" 
       class="font-label-md text-label-md px-4 py-2 rounded-full transition-all duration-300 font-semibold tracking-wide text-sm
       {{ request()->routeIs('front.tentang') ? 'bg-primary text-white shadow-md shadow-primary/20 scale-105' : 'text-slate-600 hover:text-primary hover:bg-white' }}">
       Tentang Kami
    </a>

    <a href="{{ route('front.layanan.index') }}" 
       class="font-label-md text-label-md px-4 py-2 rounded-full transition-all duration-300 font-semibold tracking-wide text-sm
       {{ request()->routeIs('front.layanan.*') ? 'bg-primary text-white shadow-md shadow-primary/20 scale-105' : 'text-slate-600 hover:text-primary hover:bg-white' }}">
       Layanan
    </a>

    <a href="{{ route('front.berita.index') }}" 
       class="font-label-md text-label-md px-4 py-2 rounded-full transition-all duration-300 font-semibold tracking-wide text-sm
       {{ request()->routeIs('front.berita.*') ? 'bg-primary text-white shadow-md shadow-primary/20 scale-105' : 'text-slate-600 hover:text-primary hover:bg-white' }}">
       Berita
    </a>

    <div class="relative group">
        <button class="flex items-center gap-1 font-label-md text-label-md px-4 py-2 rounded-full transition-all duration-300 font-semibold tracking-wide text-sm
           {{ request()->routeIs('front.booking.*') || request()->routeIs('front.status.booking') ? 'bg-primary text-white shadow-md shadow-primary/20 scale-105' : 'text-slate-600 hover:text-primary hover:bg-white' }}">
            Booking
            <span class="material-symbols-outlined text-[18px] transition-transform duration-300 group-hover:rotate-180">
                expand_more
            </span>
        </button>

<div class="absolute top-full left-1/2 -translate-x-1/2 mt-3 w-60 bg-white/95 backdrop-blur-md border border-slate-100/80 rounded-2xl shadow-2xl p-1.5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 translate-y-4 group-hover:translate-y-0">
    <a href="{{ route('front.booking.create') }}"
       class="block px-4 py-2.5 text-sm rounded-xl transition-all duration-200
       {{ request()->routeIs('front.booking.create') ? 'text-primary font-bold bg-primary/10' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
        Booking Servis
    </a>

    <a href="{{ route('front.status.booking') }}"
       class="block px-4 py-2.5 text-sm rounded-xl transition-all duration-200 mt-0.5
       {{ request()->routeIs('front.status.booking') ? 'text-primary font-bold bg-primary/10' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
        Cek Status Booking
    </a>
</div>
</div>
    <a href="{{ route('front.kontak') }}" 
       class="font-label-md text-label-md px-4 py-2 rounded-full transition-all duration-300 font-semibold tracking-wide text-sm
       {{ request()->routeIs('front.kontak') ? 'bg-primary text-white shadow-md shadow-primary/20 scale-105' : 'text-slate-600 hover:text-primary hover:bg-white' }}">
       Kontak
    </a>
</div>

<div class="flex items-center gap-4">

    @guest
        <a href="{{ route('login') }}"
           class="bg-primary text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition">
            Login
        </a>
    @endguest

    @auth

    <div class="relative group">

        <button
            class="flex items-center gap-2 px-4 py-2 rounded-xl hover:bg-slate-100 transition">

            <span class="material-symbols-outlined">
                account_circle
            </span>

            Halo, {{ Auth::user()->name }}

            <span class="material-symbols-outlined text-sm">
                expand_more
            </span>

        </button>

        <div
            class="absolute right-0 mt-2 w-60 bg-white rounded-2xl shadow-xl border border-slate-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">

            <a href="{{ route('front.dashboard') }}"
               class="block px-5 py-3 hover:bg-slate-50">
                Dashboard
            </a>

            <a href="{{ route('front.riwayat') }}"
               class="block px-5 py-3 hover:bg-slate-50">
                Riwayat Booking
            </a>

            <a href="{{ route('front.profile') }}"
               class="block px-5 py-3 hover:bg-slate-50">
                Profil Saya
            </a>

            <hr>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="w-full text-left px-5 py-3 text-red-600 hover:bg-red-50">
                    Logout
                </button>

            </form>

        </div>

    </div>

    @endauth
</div>
</nav>
</header>