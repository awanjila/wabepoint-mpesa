<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Tighten\Ziggy\BladeRouteGenerator;

class PrerenderPages extends Command
{
    protected $signature = 'site:prerender';

    protected $description = 'Save server-rendered HTML for public pages into public/ so search engines can read them';

    protected array $pages = [
        '/',
        '/pricing',
        '/about',
        '/support',
        '/point-of-sale-system-kenya',
        '/success-stories',
        '/pos-systems-in-kenya-news',
    ];

    public function handle(Kernel $kernel): int
    {
        $paths = $this->pages;

        foreach (config('industries') as $industry) {
            $paths[] = '/'.$industry['slug'];
        }

        foreach (Blog::pluck('slug') as $slug) {
            $paths[] = '/blogs/'.$slug;
        }

        $failed = 0;

        foreach ($paths as $path) {
            BladeRouteGenerator::$generated = false;

            $request = Request::create(rtrim(config('app.url'), '/').$path, 'GET');
            $response = $kernel->handle($request);
            $body = str_replace(rtrim(config('app.url'), '/').'/build/', '/build/', $response->getContent());

            if ($response->getStatusCode() !== 200 || ! str_contains($body, '<h1')) {
                $this->error("Skipped {$path}: no server-rendered content. Is `php artisan inertia:start-ssr` running?");
                $failed++;
            } else {
                $relative = trim($path, '/');
                $directory = $relative === '' ? public_path() : public_path($relative);

                if (! is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }

                file_put_contents($directory.DIRECTORY_SEPARATOR.'index.html', $body);
                $this->info("Saved {$path}");
            }

            $kernel->terminate($request, $response);
        }

        return $failed === 0 ? self::SUCCESS : self::FAILURE;
    }
}
