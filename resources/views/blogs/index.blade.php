@extends('layouts.site')

@php
    $imageUrl = function ($image) {
        if (! $image) {
            return '/images/default-placeholder.jpg';
        }
        if (preg_match('#^https?://#', $image)) {
            return $image;
        }

        return '/'.ltrim($image, '/');
    };
@endphp

@section('content')
<div class="bg-gray-50 min-h-screen">
    <section class="bg-gradient-to-r from-[#1a3a4a] via-[#1e4d64] to-[#2596be] py-14 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <nav class="flex items-center justify-center gap-2 text-sm text-white/70 mb-4">
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

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @if ($blogs->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($blogs as $item)
            <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md border border-gray-100 transition-shadow flex flex-col">
                <a href="{{ route('blogs.show', $item->slug) }}" class="block h-48 overflow-hidden bg-gray-100">
                    <img src="{{ $imageUrl($item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover" loading="lazy">
                </a>
                <div class="p-5 flex flex-col flex-1">
                    <span class="text-xs font-semibold uppercase tracking-wider text-[#2596be] mb-2">
                        {{ $item->category?->category_name ?: 'Uncategorized' }}
                    </span>
                    <h2 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                        <a href="{{ route('blogs.show', $item->slug) }}" class="hover:text-[#2596be] transition-colors">{{ $item->name }}</a>
                    </h2>
                    <div class="flex items-center gap-2 text-xs text-gray-400 mt-auto pt-3">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <time datetime="{{ $item->created_at }}">{{ $item->created_at?->format('d M Y') }}</time>
                        <span class="ml-auto text-[#2596be] font-semibold text-xs">Read More &rarr;</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <nav class="mt-10">
            {{ $blogs->links() }}
        </nav>
        @else
        <div class="text-center py-20">
            <p class="text-gray-500">No blog posts yet. Check back soon!</p>
        </div>
        @endif
    </section>
</div>
@endsection
