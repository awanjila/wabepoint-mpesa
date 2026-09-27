<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($static as $url)
    <url>
        <loc>{{ url($url['path']) }}</loc>
        <priority>{{ $url['priority'] }}</priority>
        <changefreq>{{ $url['changefreq'] }}</changefreq>
    </url>
    @endforeach
    @foreach ($posts as $post)
    <url>
        <loc>{{ url('/blogs/' . $post->slug) }}</loc>
        <priority>0.6</priority>
        <changefreq>monthly</changefreq>
        @if($post->updated_at)
        <lastmod>{{ $post->updated_at->toW3cString() }}</lastmod>
        @endif
    </url>
    @endforeach
</urlset>