<header class="w-full h-16 sticky top-0 bg-white dark:bg-surface shadow-sm z-40 flex justify-between items-center px-gutter">
    <div class="flex items-center">
    <div>
        <h1 class="text-xl font-bold text-slate-800 dark:text-white">Sistem Informasi Bengkel</h1>
        <p class="text-xs text-slate-500">Dashboard Administrator</p>
    </div>
    </div>

    <div class="flex items-center gap-6">
        <div class="relative">
            <button id="notifButton" class="relative p-2 rounded-full text-slate-600 dark:text-slate-300">
                <span class="material-symbols-outlined">notifications</span>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] min-w-[18px] h-[18px] rounded-full flex items-center justify-center font-bold">
                    {{ $jumlahNotifikasi ?? 0 }}
                </span>
            </button>

            <div id="notifMenu" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border z-50 text-slate-800">
                <div class="p-3 font-bold border-b bg-slate-50 rounded-t-lg">
                    Notifikasi Booking
                </div>
                @forelse($bookingTerbaru ?? [] as $booking)
                    <div class="p-3 border-b text-sm hover:bg-slate-50 transition-colors">
                        Booking baru dari <b>Booking #{{ $booking->id }}{{ $booking->pelanggan->nama }}</b>
                    </div>
                @empty
                    <div class="p-4 text-sm text-center text-slate-400">
                        Tidak ada notifikasi baru
                    </div>
                @endforelse
            </div>
        </div>

        <button id="darkModeBtn" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-gray-800 transition-colors">
            <span id="darkIcon"class="material-symbols-outlined">dark_mode</span>
        </button>

        <div class="h-8 w-[1px] bg-slate-200 dark:bg-gray-700"></div>

        <div class="relative">
            <button id="profileButton" class="flex items-center gap-3 cursor-pointer group">
                <div class="text-right hidden lg:block">
                    <p class="text-sm font-bold text-slate-800 dark:text-white">
                        {{ auth()->user()?->name ?? 'Guest' }}
                    </p>
                    <p class="text-[10px] text-slate-400 uppercase tracking-wider font-medium">
                        Administrator
                    </p>
                </div>
                
                <img 
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()?->name ?? 'Guest') }}&background=0D8ABC&color=fff" 
                    class="w-10 h-10 rounded-full border-2 border-slate-200 dark:border-gray-700"
                    alt="Avatar">
            </button>

            <div id="profileMenu" class="hidden absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg border z-50 text-slate-800 text-sm">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 hover:bg-slate-50 rounded-t-lg transition-colors">
                    Edit Profil
                </a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 hover:bg-slate-50 transition-colors">
                    Ganti Password
                </a>
                <hr class="border-slate-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 hover:bg-red-50 text-red-600 rounded-b-lg transition-colors font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
    <script>
        document.addEventListener('click', function(e){
          if(!profileButton.contains(e.target) &&
            !profileMenu.contains(e.target))
            {
                profileMenu.classList.add('hidden');
            }
            if(!notifButton.contains(e.target) &&
            !notifMenu.contains(e.target))
            {
                notifMenu.classList.add('hidden');
            }
        });
        const notifButton = document.getElementById('notifButton');
        const notifMenu = document.getElementById('notifMenu');
        notifButton.addEventListener('click', () => {
            notifMenu.classList.toggle('hidden');
        });

        const profileButton = document.getElementById('profileButton');
        const profileMenu = document.getElementById('profileMenu');
        profileButton.addEventListener('click', () => {
            profileMenu.classList.toggle('hidden');
        });
        const darkIcon =
        document.getElementById('darkIcon');
        function updateIcon() {
            if(document.documentElement.classList.contains('dark')){
                darkIcon.textContent = 'light_mode';
            } else {
                darkIcon.textContent = 'dark_mode';
            }
        }
        updateIcon();
        darkModeBtn.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            updateIcon();
        });
    </script>