<!-- Tailwind CSS via CDN -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Tailwind Configuration -->
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                "colors": {
                    "surface-container-low": "#f4f3f6",
                    "inverse-on-surface": "#f1f0f3",
                    "surface-variant": "#e3e2e5",
                    "on-primary-container": "#87a4cc",
                    "inverse-surface": "#2f3033",
                    "on-surface-variant": "#43474e",
                    "on-error-container": "#93000a",
                    "surface-container-lowest": "#ffffff",
                    "on-error": "#ffffff",
                    "background": "#F5F7FA",
                    "primary": "#1B3A5C",
                    "outline": "#DDE3EC",
                    "secondary-container": "#8ac3ff",
                    "on-tertiary-container": "#c49b5f",
                    "on-tertiary-fixed": "#291800",
                    "surface-dim": "#dad9dd",
                    "secondary": "#2E6DA4",
                    "on-background": "#1A2332",
                    "on-surface": "#1A2332",
                    "on-secondary-fixed": "#001d34",
                    "surface-container": "#eeedf1",
                    "primary-fixed": "#d2e4ff",
                    "surface-container-high": "#e9e8eb",
                    "primary-fixed-dim": "#abc9f2",
                    "inverse-primary": "#abc9f2",
                    "surface-bright": "#faf9fc",
                    "tertiary-fixed": "#ffddb1",
                    "tertiary-fixed-dim": "#ecbf80",
                    "on-tertiary": "#ffffff",
                    "on-tertiary-fixed-variant": "#5f410c",
                    "outline-variant": "#c3c6cf",
                    "error": "#C0392B",
                    "primary-container": "#1b3a5c",
                    "surface-container-highest": "#e3e2e5",
                    "tertiary-container": "#4f3300",
                    "on-primary-fixed": "#001c38",
                    "secondary-fixed-dim": "#9bcbff",
                    "on-secondary-container": "#005084",
                    "secondary-fixed": "#d0e4ff",
                    "surface": "#faf9fc",
                    "on-primary-fixed-variant": "#2b486b",
                    "surface-tint": "#436084",
                    "on-secondary-fixed-variant": "#004a7a",
                    "on-secondary": "#ffffff",
                    "on-primary": "#ffffff",
                    "tertiary": "#331f00",
                    "error-container": "#ffdad6",
                    "success": "#2D9E6B",
                    "warning": "#E8A020"
                },
                "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
                },
                "spacing": {
                    "stack-md": "1rem",
                    "margin-desktop": "2rem",
                    "margin-mobile": "1rem",
                    "container-max": "1440px",
                    "gutter": "1.5rem",
                    "stack-lg": "1.5rem",
                    "stack-sm": "0.5rem"
                },
                "fontFamily": {
                    "display-sm": ["Plus Jakarta Sans", "sans-serif"],
                    "body-lg": ["Inter", "sans-serif"],
                    "label-md": ["Inter", "sans-serif"],
                    "body-md": ["Inter", "sans-serif"],
                    "label-sm": ["Inter", "sans-serif"],
                    "display-md": ["Plus Jakarta Sans", "sans-serif"],
                    "display-lg": ["Plus Jakarta Sans", "sans-serif"]
                },
                "fontSize": {
                    "display-sm": ["22px", { "lineHeight": "28px", "fontWeight": "600" }],
                    "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                    "label-md": ["13px", { "lineHeight": "18px", "fontWeight": "500" }],
                    "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                    "label-sm": ["12px", { "lineHeight": "16px", "letterSpacing": "0.02em", "fontWeight": "600" }],
                    "display-md": ["24px", { "lineHeight": "32px", "fontWeight": "700" }],
                    "display-lg": ["28px", { "lineHeight": "36px", "fontWeight": "700" }]
                }
            }
        }
    }
</script>
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    .custom-input:focus {
        border-color: #2E6DA4 !important;
        outline: none;
        box-shadow: none;
    }
    .custom-radio:checked + div {
        background-color: #1B3A5C;
        border-color: #1B3A5C;
        color: white;
    }
</style>
