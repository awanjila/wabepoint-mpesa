<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $manifestPath = public_path('build/manifest.json');
        $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : [];
        $cssFiles = [];
        foreach (['resources/js/app.js', 'resources/js/Pages/Blogs/Show.vue'] as $entry) {
            foreach ($manifest[$entry]['css'] ?? [] as $css) {
                $cssFiles[$css] = $css;
            }
        }
        $cssFiles = array_values(array_filter(
            $cssFiles,
            fn ($css) => file_exists(public_path('build/'.ltrim($css, '/')))
        ));

        $defaultTitle = config('app.name', 'WabePoint POS');
        $defaultDesc = 'Modern POS and inventory management system for Kenyan businesses. Streamline sales, track stock, accept M-Pesa, and comply with KRA eTIMS. Built for cosmetics, hardware, paint shops, restaurants, gas companies, and offices.';
        $defaultKeywords = 'pos system kenya, point of sale, inventory management, m-pesa integration, kra etims, wabepoint, gas shop pos, lpg pos kenya, gas company management';
        $pageTitle = $seo['title'] ?? $defaultTitle;
        $pageDescription = $seo['description'] ?? $defaultDesc;
        $pageKeywords = $seo['keywords'] ?? $defaultKeywords;
        $canonical = ! empty($seo['canonical']) ? $seo['canonical'] : url()->current();
    @endphp

    <title>{{ $pageTitle }}</title>

    <meta name="robots" content="{{ $seo['robots'] ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' }}">
    <meta name="google-site-verification" content="{{ config('seo.google_site_verification', '') }}">
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords" content="{{ $pageKeywords }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:type" content="{{ $seo['type'] ?? 'website' }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ asset('images/wabepoint-og.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">

    {{-- Built CSS only: no app entry script, @vite, @inertia or #app shell --}}
    @foreach ($cssFiles as $css)
    <link rel="stylesheet" href="/build/{{ $css }}">
    @endforeach

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
        "description": "Modern POS and inventory management system for Kenyan businesses. Serving cosmetics, hardware, paint shops, restaurants, gas companies, and offices.",
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

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="font-sans antialiased">
    @include('partials.site-header')

    <main>
        @yield('content')
    </main>

    @include('partials.site-footer')
</body>
</html>
