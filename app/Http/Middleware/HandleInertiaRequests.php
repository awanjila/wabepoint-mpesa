<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'industries' => collect(
                is_array(config('industries')) && ! empty(config('industries'))
                    ? config('industries')
                    : (is_file(base_path('config/industries.php')) ? require base_path('config/industries.php') : [])
            )
                ->map(fn ($industry, $id) => [
                    'id' => $id,
                    'label' => $industry['label'],
                    'summary' => $industry['summary'] ?? '',
                    'cover' => $industry['cover'] ?? null,
                    'video' => $industry['media']['video'] ?? null,
                    'slug' => $industry['slug'],
                    'path' => '/'.$industry['slug'],
                    'icon' => $industry['icon'],
                ])
                ->values(),
        ];
    }
}
