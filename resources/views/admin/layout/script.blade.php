<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600&amp;display=swap" rel="stylesheet"/>
        <!-- Material Symbols -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script id="tailwind-config">
            tailwind.config = {
              darkMode: "class",
              theme: {
                extend: {
                  "colors": {
                          "on-secondary-fixed": "#410007",
                          "error": "#ba1a1a",
                          "primary-container": "#1a2b3c",
                          "secondary-container": "#db313f",
                          "inverse-surface": "#2e3132",
                          "inverse-primary": "#b7c8de",
                          "on-surface": "#191c1d",
                          "secondary-fixed": "#ffdad8",
                          "tertiary": "#151616",
                          "secondary-fixed-dim": "#ffb3b1",
                          "surface-dim": "#d9dadb",
                          "on-primary": "#ffffff",
                          "inverse-on-surface": "#f0f1f2",
                          "tertiary-fixed-dim": "#c8c6c6",
                          "outline": "#74777d",
                          "on-secondary": "#ffffff",
                          "surface-bright": "#f8f9fa",
                          "error-container": "#ffdad6",
                          "surface-variant": "#e1e3e4",
                          "on-tertiary-container": "#929191",
                          "on-background": "#191c1d",
                          "primary-fixed-dim": "#b7c8de",
                          "on-tertiary-fixed": "#1b1c1c",
                          "on-primary-fixed": "#0b1d2d",
                          "surface-container-lowest": "#ffffff",
                          "primary-fixed": "#d2e4fb",
                          "primary": "#041627",
                          "on-error": "#ffffff",
                          "secondary": "#b7102a",
                          "outline-variant": "#c4c6cd",
                          "surface-container-highest": "#e1e3e4",
                          "tertiary-fixed": "#e4e2e1",
                          "tertiary-container": "#2a2a2a",
                          "on-surface-variant": "#44474c",
                          "on-secondary-fixed-variant": "#92001c",
                          "on-secondary-container": "#fffbff",
                          "surface-container": "#edeeef",
                          "surface-tint": "#4f6073",
                          "on-primary-fixed-variant": "#38485a",
                          "on-error-container": "#93000a",
                          "on-primary-container": "#8192a7",
                          "on-tertiary-fixed-variant": "#474747",
                          "on-tertiary": "#ffffff",
                          "surface-container-high": "#e7e8e9",
                          "background": "#f8f9fa",
                          "surface": "#f8f9fa",
                          "surface-container-low": "#f3f4f5"
                  },
                  "borderRadius": {
                          "DEFAULT": "0.25rem",
                          "lg": "0.5rem",
                          "xl": "0.75rem",
                          "full": "9999px"
                  },
                  "spacing": {
                          "margin-mobile": "16px",
                          "base": "8px",
                          "gutter": "24px",
                          "margin-desktop": "64px",
                          "container-max-width": "1280px"
                  },
                  "fontFamily": {
                          "headline-xl": ["Montserrat"],
                          "label-sm": ["Inter"],
                          "headline-lg": ["Montserrat"],
                          "headline-md": ["Montserrat"],
                          "body-md": ["Inter"],
                          "label-md": ["Inter"],
                          "body-lg": ["Inter"]
                  },
                  "fontSize": {
                          "headline-xl": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                          "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "600"}],
                          "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "600"}],
                          "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                          "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                          "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}],
                          "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}]
                  }
                },
              },
            }
        </script>