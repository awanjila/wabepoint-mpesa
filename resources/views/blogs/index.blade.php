@extends('layouts.site')

@php
    $imageUrl = function ($image) {
        if (! $image) {
            return '/images/wabepoint-og.jpg';
        }
        if (preg_match('#^https?://#', $image)) {
            return $image;
        }

        return '/'.ltrim($image, '/');
    };
@endphp

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Banner -->
    <section class="bg-gradient-to-r from-[#1a3a4a] via-[#1e4d64] to-[#2596be] py-14 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <nav class="flex items-center justify-center gap-2 text-sm text-white/70 mb-4" aria-label="Breadcrumb">
                <a href="/" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <span class="text-white font-medium">Blog</span>
            </nav>
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-3">Our Blog</h1>
            <p class="text-white/80 max-w-2xl mx-auto text-sm sm:text-base">
                POS and inventory management tips, business insights and industry news from WabePoint.
            </p>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if ($blogs->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($blogs as $item)
            @php
                $excerpt = \App\Support\SeoDescription::plain($item->content ?: $item->description, 140);
            @endphp
            <article class="group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md border border-gray-200/80 transition-all duration-200 flex flex-col">
                <a href="{{ route('blogs.show', $item->slug) }}" class="block h-52 overflow-hidden bg-gray-100 relative">
                    <img src="{{ $imageUrl($item->image) }}"
                         alt="{{ $item->name }}"
                         onerror="this.onerror=null;this.src='/images/wabepoint-og.jpg';"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                         loading="lazy">
                </a>
                <div class="p-6 flex flex-col flex-1">
                    <div class="mb-2.5">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-sm text-xs font-semibold uppercase tracking-wider bg-[#2596be]/10 text-[#2596be]">
                            {{ $item->category?->category_name ?: 'POS & Business' }}
                        </span>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900 mb-2.5 line-clamp-2 leading-snug">
                        <a href="{{ route('blogs.show', $item->slug) }}" class="hover:text-[#2596be] transition-colors">{{ $item->name }}</a>
                    </h2>
                    @if ($excerpt)
                    <p class="text-sm text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                        {{ $excerpt }}
                    </p>
                    @endif
                    <div class="flex items-center gap-2 text-xs text-gray-400 mt-auto pt-4 border-t border-gray-100">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <time datetime="{{ $item->created_at }}">{{ $item->created_at?->format('d M Y') }}</time>
                        <a href="{{ route('blogs.show', $item->slug) }}" class="ml-auto text-[#2596be] hover:text-[#1a6d8a] font-semibold text-xs inline-flex items-center gap-1 transition-colors">
                            Read More &rarr;
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        @if ($blogs->lastPage() > 1)
        <nav class="flex items-center justify-center gap-1.5 mt-12" aria-label="Pagination">
            @if ($blogs->onFirstPage())
            <span class="px-3 py-2 text-sm font-medium text-gray-400 opacity-40 cursor-not-allowed">&larr;</span>
            @else
            <a href="{{ $blogs->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] transition-colors" rel="prev">&larr;</a>
            @endif

            @for ($page = 1; $page <= $blogs->lastPage(); $page++)
            <a href="{{ $blogs->url($page) }}"
               class="w-9 h-9 inline-flex items-center justify-center text-sm font-medium rounded-md border border-gray-200 transition-colors {{ $blogs->currentPage() === $page ? 'bg-[#2596be] text-white border-[#2596be]' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                {{ $page }}
            </a>
            @endfor

            @if ($blogs->hasMorePages())
            <a href="{{ $blogs->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] transition-colors" rel="next">&rarr;</a>
            @else
            <span class="px-3 py-2 text-sm font-medium text-gray-400 opacity-40 cursor-not-allowed">&rarr;</span>
            @endif
        </nav>
        @endif
        @else
        <div class="text-center py-20">
            <p class="text-gray-500">No blog posts yet. Check back soon!</p>
        </div>
        @endif
    </section>
</div>
@endsection
