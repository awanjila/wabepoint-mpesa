<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        \DB::table('tenants')->insert([
            'name' => 'Test Tenant',
            'api_key' => 'sk_test_' . Str::random(32),
            'webhook_secret' => 'whsec_' . Str::random(32),
            'wordpress_url' => 'https://test.example.com',
            'is_active' => true,
            'daily_limit' => 1000000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
