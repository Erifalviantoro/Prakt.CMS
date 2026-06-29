<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Masuk | MotoFix Pro - Sumber Baru Motor</title>
    
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
                        "surface-container": "#edeeef"
                    },
                    fontFamily: {
                        "sans": ["Montserrat", "ui-sans-serif", "system-ui"]
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
        .login-card-shadow {
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.06);
        }
        .transition-standard {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-surface-container font-sans antialiased min-h-screen flex items-center justify-center p-4 selection:bg-secondary/30 selection:text-secondary">

    <div class="w-full max-w-md">
        
        <div class="bg-white p-8 md:p-10 rounded-xl login-card-shadow border border-outline-variant/30">
            
            <div class="text-center mb-6">
                <div class="inline-block mb-3">
                    <img alt="Sumber Baru Motor Logo" class="h-12 object-contain mx-auto" src="{{ asset('images/logo.png') }}" onerror="this.src='https://placehold.co/150x50?text=LOGO+SBM'"/>
                </div>
                <p class="text-secondary font-bold text-xs tracking-widest uppercase mb-1">Repair Management System</p>
                <h2 class="text-xl font-semibold text-primary">Selamat Datang</h2>
                <p class="text-on-surface-variant text-sm mt-1">Silakan masuk ke akun Anda</p>
            </div>
@if(session('success'))
    <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-700 text-center">
        {{ session('success') }}
    </div>
@endif
            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-lg text-center border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <label for="email" class="block font-semibold text-sm text-primary">Email</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 group-focus-within:text-primary transition-standard">mail</span>
                        <input id="email" type="email" name="email"value="{{ old('email') }}" required autofocus placeholder="Masukkan email"
                        class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline-variant bg-surface/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-standard font-medium text-sm"/>
                    </div>
                    @if($errors->has('email'))
                        <p class="text-xs text-red-600 mt-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="space-y-1">
                    <label for="password" class="block font-semibold text-sm text-primary">Password</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 group-focus-within:text-primary transition-standard">lock</span>
                        <input id="password" type="password" name="password" required placeholder="••••••••" 
                            class="w-full pl-10 pr-12 py-2.5 rounded-lg border border-outline-variant bg-surface/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-standard font-medium text-sm"/>
                        
                        <button type="button" onclick="togglePassword('password', 'passwordIcon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 hover:text-primary transition-standard p-1 flex items-center">
                            <span class="material-symbols-outlined text-xl" id="passwordIcon">visibility</span>
                        </button>
                    </div>
                    @if($errors->has('password'))
                        <p class="text-xs text-red-600 mt-1">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="flex items-center justify-between text-sm pt-1">
                    <label class="flex items-center text-on-surface-variant text-xs md:text-sm cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="rounded border-outline-variant text-primary focus:ring-primary/30 mr-2 cursor-pointer">
                        <span>Remember me</span>
                    </label>
                    <a class="text-xs md:text-sm text-on-surface-variant hover:text-secondary underline" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-bold py-2.5 rounded-lg flex items-center justify-center transition-standard active:scale-[0.98] tracking-wider text-sm login-card-shadow uppercase">
                        Log In
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center pt-4 border-t border-outline-variant/30 text-sm">
                <p class="text-on-surface-variant">
                    Belum punya akun? 
                    <a class="text-secondary font-bold hover:underline ml-1" href="{{ route('register') }}">Daftar Sekarang</a>
                </p>
            </div>
        </div>

        <div class="mt-6 flex justify-center space-x-6 text-xs text-on-surface-variant/60">
            <span>© 2024 MotoFix Pro</span>
            <a class="hover:text-primary" href="#">Bantuan</a>
            <a class="hover:text-primary" href="#">Kebijakan Privasi</a>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>