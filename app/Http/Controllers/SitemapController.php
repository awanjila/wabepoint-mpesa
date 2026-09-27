<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class SitemapController extends Controller
{
    public function index()
    {
        $static = [
            ['path' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['path' => '/paintshops', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['path' => '/gas', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['path' => '/cosmetics', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/hardware', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/restaurants', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/offices', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/pricing', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/point-of-sale-system-kenya', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/news', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['path' => '/success-stories', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['path' => '/about', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['path' => '/partners', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['path' => '/resources', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['path' => '/support', 'priority' => '0.5', 'changefreq' => 'monthly'],
        ];

        try {
            $posts = Blog::latest()->get();
        } catch (\Throwable $e) {
            $posts = collect();
        }

        return response()->view('sitemap', [
            'static' => $static,
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }
}