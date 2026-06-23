<aside class="h-screen w-64 fixed left-0 top-0 bg-primary dark:bg-on-primary-fixed flex flex-col py-base gap-2 shadow-lg z-50 overflow-y-auto scrollbar-hide">
                <div class="px-6 py-4 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <img src="/images/logo.png" alt="Logo" class="w-8 h-8 object-contain">
                    </div>
                    <div>
                        <h1 class="text-white font-headline-md text-[18px] font-bold leading-tight">Sumber Baru Motor</h1>
                        <p class="text-surface-variant opacity-70 text-label-sm">Repair Management</p>
                    </div>
                </div>
                <nav class="flex-1 mt-4 space-y-1">
                    <!-- Dashboard Active -->
                    <a class="{{ request()->routeIs('admin.dashboard*') ? 'sidebar-active text-label-md' : 'text-surface-variant opacity-80 hover:opacity-100 hover:bg-primary-container/50' }} flex items-center px-6 py-3 transition-all duration-150 text-label-md" 
                        href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined mr-3">dashboard</span> Dashboard
                    </a>
                    <a class="{{ request()->routeIs('admin.booking*') ? 'sidebar-active text-label-md' : 'text-surface-variant opacity-80 hover:opacity-100 hover:bg-primary-container/50' }} flex items-center px-6 py-3 transition-all duration-150 text-label-md" 
                        href="{{ route('admin.booking.index') }}">
                    <span class="material-symbols-outlined mr-3">calendar_month</span> Kelola Booking
                    </a>
                    <a class="{{ request()->routeIs('admin.pelanggan*') ? 'sidebar-active text-label-md' : 'text-surface-variant opacity-80 hover:opacity-100 hover:bg-primary-container/50' }} flex items-center px-6 py-3 transition-all duration-150 text-label-md" 
                        href="{{ route('admin.pelanggan.index') }}">
                    <span class="material-symbols-outlined mr-3">group</span> Kelola Pelanggan
                    </a>
                    <a class="{{ request()->routeIs('admin.kendaraan*') ? 'sidebar-active text-label-md' : 'text-surface-variant opacity-80 hover:opacity-100 hover:bg-primary-container/50' }} flex items-center px-6 py-3 transition-all duration-150 text-label-md" 
                        href="{{ route('admin.kendaraan.index') }}">
                    <span class="material-symbols-outlined mr-3">motorcycle</span> Kelola Kendaraan
                    </a>
                    <a class="{{ request()->routeIs('admin.layanan*') ? 'sidebar-active text-label-md' : 'text-surface-variant opacity-80 hover:opacity-100 hover:bg-primary-container/50' }} flex items-center px-6 py-3 transition-all duration-150 text-label-md" 
                        href="{{ route('admin.layanan.index') }}">
                    <span class="material-symbols-outlined mr-3">home_repair_service</span> Kelola Layanan
                    </a>
                    <a class="{{ request()->routeIs('admin.mekanik*') ? 'sidebar-active text-label-md' : 'text-surface-variant opacity-80 hover:opacity-100 hover:bg-primary-container/50' }} flex items-center px-6 py-3 transition-all duration-150 text-label-md" 
                        href="{{ route('admin.mekanik.index') }}">
                    <span class="material-symbols-outlined mr-3">engineering</span> Kelola Mekanik
                    </a>
                    <a class="{{ request()->routeIs('admin.detailservis*') ? 'sidebar-active text-label-md' : 'text-surface-variant opacity-80 hover:opacity-100 hover:bg-primary-container/50' }} flex items-center px-6 py-3 transition-all duration-150 text-label-md" 
                        href="{{ route('admin.detailservis.index') }}">
                    <span class="material-symbols-outlined mr-3">assignment</span> Detail Servis
                    </a>
                    <a class="{{ request()->routeIs('admin.sparepart*') ? 'sidebar-active text-label-md' : 'text-surface-variant opacity-80 hover:opacity-100 hover:bg-primary-container/50' }} flex items-center px-6 py-3 transition-all duration-150 text-label-md" 
                        href="{{ route('admin.sparepart.index') }}">
                    <span class="material-symbols-outlined mr-3">inventory_2</span> Sparepart
                    </a>
                    <a class="{{ request()->routeIs('admin.penggunaan-sparepart*') ? 'sidebar-active text-label-md' : 'text-surface-variant opacity-80 hover:opacity-100 hover:bg-primary-container/50' }} flex items-center px-6 py-3 transition-all duration-150 text-label-md" 
                        href="{{ route('admin.penggunaan-sparepart.index') }}">
                        <span class="material-symbols-outlined mr-3">build_circle</span> Penggunaan Sparepart
                    </a>
                    <a class="{{ request()->routeIs('admin.transaksi*') ? 'sidebar-active text-label-md' : 'text-surface-variant opacity-80 hover:opacity-100 hover:bg-primary-container/50' }} flex items-center px-6 py-3 transition-all duration-150 text-label-md" 
                        href="{{ route('admin.transaksi.index') }}">
                    <span class="material-symbols-outlined mr-3">receipt_long</span> Kelola Transaksi
                    </a>
                    <a class="{{ request()->routeIs('admin.laporan*') ? 'sidebar-active text-label-md' : 'text-surface-variant opacity-80 hover:opacity-100 hover:bg-primary-container/50' }} flex items-center px-6 py-3 transition-all duration-150 text-label-md" 
                        href="{{ route('admin.laporan.index') }}">
                    <span class="material-symbols-outlined mr-3">assessment</span> Laporan
                    </a>
                </nav>
                <div class="px-6 py-6 border-t border-white/10 space-y-2">
                    <a class="flex items-center text-surface-variant opacity-80 hover:opacity-100 transition-all text-label-md" href="#">
                    <span class="material-symbols-outlined mr-3">help</span> Help Center
                    </a>
                    <div class="pt-4 border-t border-gray-700/30 mt-auto">
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="flex items-center space-x-4 w-full px-6 py-3.5 text-red-500 hover:bg-red-500/10 rounded-xl transition-all duration-200 group text-left">
                            <span class="material-symbols-outlined text-red-500 group-hover:scale-110 transition-transform">logout</span>
                            <span class="font-semibold text-sm tracking-wide">Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>