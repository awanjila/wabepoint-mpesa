<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MpesaAuthService
{
    protected MpesaConfigService $config;

    public function __construct(MpesaConfigService $config)
    {
        $this->config = $config;
    }

    public function getToken(): string
    {
        $cacheKey = 'mpesa_access_token';

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        return $this->fetchNewToken();
    }

    public function fetchNewToken(): string
    {
        $credentials = base64_encode($this->config->getConsumerKey() . ':' . $this->config->getConsumerSecret());

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $credentials,
        ])->get($this->config->getAuthUrl());

        if (!$response->successful()) {
            throw new \Exception('Failed to fetch M-Pesa access token: ' . $response->body());
        }

        $data = $response->json();
        $token = $data['access_token'];
        $expiresIn = $data['expires_in'] ?? 3600;

        Cache::put('mpesa_access_token', $token, now()->addSeconds($expiresIn - 300));

        return $token;
    }
}
