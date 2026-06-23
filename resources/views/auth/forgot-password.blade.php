<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Lupa Password | MotoFix Pro - Sumber Baru Motor</title>
    
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
                        "headline-lg": ["Montserrat", "sans-serif"],
                        "body-md": ["Montserrat", "sans-serif"]
                    },
                    fontSize: {
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
                <h2 class="font-headline-lg text-headline-lg text-primary text-2xl md:text-3xl">Reset Password</h2>
            </div>

            <div class="mb-5 text-sm text-on-surface-variant text-center bg-surface p-4 rounded-lg border border-outline-variant/40 leading-relaxed">
                Jangan khawatir! Masukkan alamat email Anda, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi baru.
            </div>

            @if (session('status'))
                <div class="mb-4 font-semibold text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <label for="email" class="block font-semibold text-sm text-primary">Email Terdaftar</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant/60 group-focus-within:text-primary transition-standard">mail</span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                            placeholder="Masukkan email Anda" 
                            class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline-variant bg-surface/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 font-body-md transition-standard"/>
                    </div>
                    @if($errors->has('email'))
                        <p class="text-sm text-red-600 mt-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-bold py-3 rounded-lg flex items-center justify-center transition-standard active:scale-[0.98] login-card-shadow">
                        Kirim Link Reset Password
                    </button>
                </div>
            </form>

            <div class="mt-5 text-center pt-4 border-t border-outline-variant/30">
                <a class="inline-flex items-center text-secondary font-bold text-sm hover:underline transition-standard" href="{{ route('login') }}">
                    <span class="material-symbols-outlined text-sm mr-1">arrow_back</span>
                    Kembali ke Login
                </a>
            </div>
        </div>

        <div class="mt-6 flex justify-center space-x-6 text-xs text-on-surface-variant/60">
            <span>© 2024 MotoFix Pro</span>
            <a class="hover:text-primary" href="#">Bantuan</a>
            <a class="hover:text-primary" href="#">Kebijakan Privasi</a>
        </div>
    </div>

</body>
</html>