<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'WabePoint POS') }}</title>

    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="google-site-verification" content="{{ config('seo.google_site_verification', '') }}">

    @php
        $seo = $page['props']['seo'] ?? [];
        $defaultTitle = config('app.name', 'WabePoint POS');
        $defaultDesc = 'Modern POS and inventory management system for Kenyan businesses. Streamline sales, track stock, accept M-Pesa, and comply with KRA eTIMS.';
        $defaultKeywords = 'pos system kenya, point of sale, inventory management, m-pesa integration, kra etims, wabepoint';
    @endphp

    <meta name="description" content="{{ $seo['description'] ?? $defaultDesc }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? $defaultKeywords }}">
    @if(!empty($seo['canonical']))
    <link rel="canonical" href="{{ $seo['canonical'] }}">
    @else
    <link rel="canonical" href="{{ url()->current() }}">
    @endif
    <meta property="og:title" content="{{ $seo['title'] ?? $defaultTitle }}">
    <meta property="og:description" content="{{ $seo['description'] ?? $defaultDesc }}">
    <meta property="og:type" content="{{ $seo['type'] ?? 'website' }}">
    <meta property="og:url" content="{{ $seo['canonical'] ?? url()->current() }}">
    <meta property="og:image" content="{{ asset('images/wabepoint-og.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo['title'] ?? $defaultTitle }}">
    <meta name="twitter:description" content="{{ $seo['description'] ?? $defaultDesc }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Favicons --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    {{-- Google tag (gtag.js) --}}
    @if(config('services.google.analytics_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ config('services.google.analytics_id') }}');
    </script>
    @endif

    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "WabePoint",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/wabepoint-og.jpg') }}",
        "description": "Modern POS and inventory management system for Kenyan businesses.",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+254-781-312-070",
            "contactType": "sales"
        },
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "KE"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "WabePoint",
        "url": "{{ url('/') }}"
    }
    </script>

    {{-- Scripts --}}
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="font-sans antialiased">
    @inertia
</body>
</html>
