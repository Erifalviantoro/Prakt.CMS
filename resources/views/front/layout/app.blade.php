<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sumber Baru Motor - Performa Mesin Maksimal</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "primary": "#041627",
                    "on-error": "#ffffff",
                    "tertiary-container": "#2a2a2a",
                    "outline": "#74777d",
                    "tertiary-fixed": "#e4e2e1",
                    "surface-dim": "#d9dadb",
                    "surface-tint": "#4f6073",
                    "on-primary-fixed": "#0b1d2d",
                    "surface-container-high": "#e7e8e9",
                    "primary-container": "#1a2b3c",
                    "on-tertiary": "#ffffff",
                    "tertiary-fixed-dim": "#c8c6c6",
                    "on-secondary-fixed": "#410007",
                    "on-primary-fixed-variant": "#38485a",
                    "inverse-surface": "#2e3132",
                    "on-surface": "#191c1d",
                    "background": "#f8f9fa",
                    "on-secondary-container": "#fffbff",
                    "error-container": "#ffdad6",
                    "tertiary": "#151616",
                    "secondary-fixed": "#ffdad8",
                    "primary-fixed-dim": "#b7c8de",
                    "on-surface-variant": "#44474c",
                    "surface-container-highest": "#e1e3e4",
                    "on-secondary-fixed-variant": "#92001c",
                    "on-tertiary-fixed-variant": "#474747",
                    "surface-container": "#edeeef",
                    "on-primary-container": "#8192a7",
                    "on-error-container": "#93000a",
                    "surface-container-low": "#f3f4f5",
                    "on-tertiary-fixed": "#1b1c1c",
                    "surface": "#f8f9fa",
                    "outline-variant": "#c4c6cd",
                    "surface-container-lowest": "#ffffff",
                    "surface-variant": "#e1e3e4",
                    "surface-bright": "#f8f9fa",
                    "inverse-primary": "#b7c8de",
                    "inverse-on-surface": "#f0f1f2",
                    "secondary-container": "#db313f",
                    "secondary": "#b7102a",
                    "primary-fixed": "#d2e4fb",
                    "error": "#ba1a1a",
                    "secondary-fixed-dim": "#ffb3b1",
                    "on-tertiary-container": "#929191",
                    "on-secondary": "#ffffff",
                    "on-primary": "#ffffff",
                    "on-background": "#191c1d"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "margin-mobile": "16px",
                    "gutter": "24px",
                    "container-max-width": "1280px",
                    "margin-desktop": "64px",
                    "base": "8px"
            },
            "fontFamily": {
                    "headline-lg": ["Montserrat"],
                    "headline-md": ["Montserrat"],
                    "body-lg": ["Inter"],
                    "label-md": ["Inter"],
                    "body-md": ["Inter"],
                    "headline-xl-mobile": ["Montserrat"],
                    "headline-xl": ["Montserrat"],
                    "label-sm": ["Inter"]
            },
            "fontSize": {
                    "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "600"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "headline-xl-mobile": ["32px", {"lineHeight": "38px", "fontWeight": "700"}],
                    "headline-xl": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #041627 0%, #1a2b3c 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .stats-gradient {
            background: linear-gradient(135deg, #041627 0%, #1a2b3c 100%);
        }
        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .hover-lift:hover {
            transform: translateY(-8px);
        }
    </style>
</head>
<body class="flex flex-col min-h-full bg-background text-on-background overflow-x-hidden">

@include('front.layout.navbar')

<!-- Mencegah konten meluber merusak grid sistem -->
<main class="flex-grow w-full overflow-hidden block">
    @yield('content')
</main>

@include('front.layout.footer')

</body>
</html>