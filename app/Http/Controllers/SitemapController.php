<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class SitemapController extends Controller
{
    public function index()
    {
        $static = [
            ['path' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
        ];

        $industries = config('industries');
        if (! is_array($industries) || empty($industries)) {
            $industriesFile = base_path('config/industries.php');
            $industries = is_file($industriesFile) ? require $industriesFile : [];
        }

        foreach ($industries as $industry) {
            $static[] = ['path' => '/'.$industry['slug'], 'priority' => $industry['priority'], 'changefreq' => 'monthly'];
        }

        $static = array_merge($static, [
            ['path' => '/point-of-sale-system-kenya', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/pricing', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/pos-systems-in-kenya-news', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['path' => '/success-stories', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['path' => '/about', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['path' => '/support', 'priority' => '0.5', 'changefreq' => 'monthly'],
        ]);

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
