<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Daftar Akun | MotoFix Pro - Sumber Baru Motor</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#041627",
                        "secondary": "#b7102a",
                        "surface": "#f8f9fa",
                        "on-surface": "#191c1d",
                        "on-surface-variant": "#44474c",
                        "outline-variant": "#c4c6cd",
                        "surface-container": "#edeeef",
                        "surface-container-lowest": "#ffffff"
                    },
                    fontFamily: {
                        "sans": ["Montserrat", "ui-sans-serif", "system-ui"],
                        "headline-xl": ["Montserrat", "sans-serif"],
                        "headline-lg": ["Montserrat", "sans-serif"],
                        "body-md": ["Montserrat", "sans-serif"]
                    },
                    fontSize: {
                        "headline-xl": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            line-height: 1;
        }
        .workshop-overlay {
            background: linear-gradient(135deg, rgba(4, 22, 39, 0.9) 0%, rgba(4, 22, 39, 0.6) 100%);
        }
        .login-card-shadow {
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.08);
        }
        .transition-standard {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-surface font-sans antialiased selection:bg-secondary/30 selection:text-secondary">

    <main class="min-h-screen flex flex-col md:flex-row overflow-hidden">
        
        <section class="hidden md:flex md:w-1/2 lg:w-3/5 relative items-center justify-center p-16 overflow-hidden bg-primary">
            <div class="absolute inset-0 z-0">
                <img alt="Modern Workshop Hero" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1616788494707-ec28f08d05a1?q=80&w=1200&auto=format&fit=crop"/>
                <div class="absolute inset-0 workshop-overlay"></div>
            </div>
            
            <div class="relative z-10 max-w-xl text-white">
                <h1 class="font-headline-xl text-headline-xl mb-12 leading-tight">
                    Solusi Digital Pelayanan <span class="text-secondary">Bengkel Motor</span> Modern
                </h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center backdrop-blur-sm">
                            <span class="material-symbols-outlined text-secondary">calendar_month</span>
                        </div>
                        <span class="font-medium text-lg">Booking Online</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center backdrop-blur-sm">
                            <span class="material-symbols-outlined text-secondary">monitoring</span>
                        </div>
                        <span class="font-medium text-lg">Monitoring Servis</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center backdrop-blur-sm">
                            <span class="material-symbols-outlined text-secondary">history</span>
                        </div>
                        <span class="font-medium text-lg">Riwayat Servis</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center backdrop-blur-sm">
                            <span class="material-symbols-outlined text-secondary">handyman</span>
                        </div>
                        <span class="font-medium text-lg">Manajemen Sparepart</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="flex-1 flex flex-col justify-center items-center p-6 md:p-12 bg-surface-container overflow-y-auto">
            <div class="w-full max-w-md my-auto py-6">
                
                <div class="bg-white p-8 md:p-10 rounded-xl login-card-shadow border border-outline-variant/30">
                    
                    <div class="text-center mb-6">
                        <div class="inline-block mb-3">
                            <img alt="Sumber Baru Motor Logo" class="h-12 object-contain mx-auto" src="{{ asset('images/logo.png') }}" onerror="this.src='https://placehold.co/150x50?text=LOGO+SBM'"/>
                        </div>
                        <p class="text-secondary font-bold text-xs tracking-widest uppercase mb-1">Repair Management System</p>
                        <h2 class="font-headline-lg text-headline-lg text-primary text-2xl md:text-3xl">Daftar Akun Baru</h2>
                        <p class="text-on-surface-variant text-sm mt-1">Lengkapi data Anda untuk mendaftar</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <div class="space-y-1">
                            <label for="name" class="block font-semibold text-sm text-primary">Nama Lengkap</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 group-focus-within:text-primary transition-standard">person</span>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap Anda" 
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline-variant bg-surface/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 font-body-md transition-standard"/>
                            </div>
                            @if($errors->has('name'))
                                <p class="text-sm text-red-600 mt-1">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div class="space-y-1">
                            <label for="email" class="block font-semibold text-sm text-primary">Email</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 group-focus-within:text-primary transition-standard">mail</span>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Masukkan email aktif" 
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline-variant bg-surface/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 font-body-md transition-standard"/>
                            </div>
                            @if($errors->has('email'))
                                <p class="text-sm text-red-600 mt-1">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="space-y-1">
                            <label for="password" class="block font-semibold text-sm text-primary">Password</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 group-focus-within:text-primary transition-standard">lock</span>
                                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Buat kata sandi minimal 8 karakter" 
                                    class="w-full pl-10 pr-12 py-2.5 rounded-lg border border-outline-variant bg-surface/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 font-body-md transition-standard"/>
                                <button type="button" onclick="togglePassword('password', 'passwordIcon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 hover:text-primary transition-standard p-1">
                                    <span class="material-symbols-outlined text-lg" id="passwordIcon">visibility</span>
                                </button>
                            </div>
                            @if($errors->has('password'))
                                <p class="text-sm text-red-600 mt-1">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="space-y-1">
                            <label for="password_confirmation" class="block font-semibold text-sm text-primary">Konfirmasi Password</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 group-focus-within:text-primary transition-standard">lock_reset</span>
                                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi Anda" 
                                    class="w-full pl-10 pr-12 py-2.5 rounded-lg border border-outline-variant bg-surface/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 font-body-md transition-standard"/>
                                <button type="button" onclick="togglePassword('password_confirmation', 'confirmPasswordIcon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 hover:text-primary transition-standard p-1">
                                    <span class="material-symbols-outlined text-lg" id="confirmPasswordIcon">visibility</span>
                                </button>
                            </div>
                            @if($errors->has('password_confirmation'))
                                <p class="text-sm text-red-600 mt-1">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-bold py-3 rounded-lg flex items-center justify-center transition-standard active:scale-[0.98] login-card-shadow">
                                Register
                            </button>
                        </div>
                    </form>

                    <div class="mt-5 text-center pt-4 border-t border-outline-variant/30">
                        <p class="text-on-surface-variant text-sm">
                            Sudah punya akun? 
                            <a class="text-secondary font-bold hover:underline transition-standard ml-1" href="{{ route('login') }}">Masuk Disini</a>
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex justify-center space-x-6 text-xs text-on-surface-variant/60">
                    <span>© 2024 MotoFix Pro</span>
                    <a class="hover:text-primary" href="#">Bantuan</a>
                    <a class="hover:text-primary" href="#">Kebijakan Privasi</a>
                </div>

            </div>
        </section>
    </main>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                passwordIcon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>