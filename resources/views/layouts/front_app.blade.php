<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @php
    $seo = (object) ($seo ?? []);
    $seoConfig = config('seo.defaults', []);
    $siteName = config('app.name', 'WabePoint POS');
    $title = $seo->title ?? $seoConfig['title'] ?? 'WabePoint - Modern POS & Inventory Management System';
    $description = $seo->description ?? $seoConfig['description'] ?? 'WabePoint is a powerful cloud-based POS and inventory management system for businesses. Track sales, manage stock, generate invoices, and grow your business with real-time analytics.';
    $keywords = $seo->keywords ?? $seoConfig['keywords'] ?? 'pos system, inventory management, online pos, stock tracking, business management, sales analytics, wabepoint';
    $canonical = $seo->canonical ?? url()->current();
    $image = $seo->image ?? asset($seoConfig['image'] ?? 'images/wabepoint-og.jpg');
    $type = $seo->type ?? $seoConfig['type'] ?? 'website';
  @endphp

  {{-- Primary Meta Tags --}}
  <title>{{ $title }}</title>
  <meta name="title" content="{{ $title }}">
  <meta name="description" content="{{ $description }}">
  <meta name="keywords" content="{{ $keywords }}">
  <meta name="author" content="{{ $siteName }}">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <meta name="google-site-verification" content="{{ config('seo.google_site_verification', '') }}">
  <link rel="canonical" href="{{ $canonical }}">

  {{-- Open Graph / Facebook --}}
  <meta property="og:type" content="{{ $type }}">
  <meta property="og:url" content="{{ $canonical }}">
  <meta property="og:title" content="{{ $title }}">
  <meta property="og:description" content="{{ $description }}">
  <meta property="og:image" content="{{ $image }}">
  <meta property="og:site_name" content="{{ $siteName }}">
  <meta property="og:locale" content="en_US">

  {{-- Twitter --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="{{ $canonical }}">
  <meta name="twitter:title" content="{{ $title }}">
  <meta name="twitter:description" content="{{ $description }}">
  <meta name="twitter:image" content="{{ $image }}">

  {{-- Favicons --}}
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

  {{-- Structured Data (JSON-LD) --}}
  <script type="application/ld+json">
    {!! json_encode([
      '@context' => 'https://schema.org',
      '@type' => 'SoftwareApplication',
      'name' => $siteName,
      'description' => $description,
      'url' => $canonical,
      'image' => $image,
      'applicationCategory' => 'BusinessApplication',
      'operatingSystem' => 'Web',
      'offers' => [
        '@type' => 'Offer',
        'price' => '0',
        'priceCurrency' => 'KES',
      ],
      'provider' => [
        '@type' => 'Organization',
        'name' => $siteName,
        'url' => url('/'),
      ],
    ], JSON_UNESCAPED_SLASHES) !!}
  </script>
  <script type="application/ld+json">
    {!! json_encode([
      '@context' => 'https://schema.org',
      '@type' => 'Organization',
      'name' => 'WabePoint',
      'url' => url('/'),
      'logo' => asset('assets/images/logo/logo.png'),
      'description' => 'Modern POS and inventory management system for Kenyan businesses. Serving cosmetics, hardware, paint shops, restaurants, and offices.',
      'contactPoint' => [
        '@type' => 'ContactPoint',
        'telephone' => '+254-781-312-070',
        'contactType' => 'sales',
        'availableLanguage' => ['English'],
      ],
      'sameAs' => [
        'https://facebook.com/wabepoint',
      ],
      'address' => [
        '@type' => 'PostalAddress',
        'addressCountry' => 'KE',
      ],
    ], JSON_UNESCAPED_SLASHES) !!}
  </script>
  <script type="application/ld+json">
    {!! json_encode([
      '@context' => 'https://schema.org',
      '@type' => 'WebSite',
      'name' => $siteName,
      'url' => url('/'),
      'description' => $description,
      'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => url('/') . '/?s={search_term_string}',
        'query-input' => 'required name=search_term_string',
      ],
    ], JSON_UNESCAPED_SLASHES) !!}
  </script>

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

  @vite('resources/js/app.js')
</head>
<body>
  @inertia
</body>
</html>
