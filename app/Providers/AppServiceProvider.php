<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->ensureIndustriesConfigLoaded();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->ensureIndustriesConfigLoaded();
    }

    private function ensureIndustriesConfigLoaded(): void
    {
        if (! is_array(config('industries')) || empty(config('industries'))) {
            $path = base_path('config/industries.php');
            if (is_file($path)) {
                config(['industries' => require $path]);
            }
        }
    }
}
