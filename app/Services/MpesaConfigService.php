<?php

namespace App\Services;

class MpesaConfigService
{
    public function getEnv(): string
    {
        return config('mpesa.env', 'sandbox');
    }

    public function getAuthUrl(): string
    {
        $env = $this->getEnv();
        return config("mpesa.urls.{$env}.auth");
    }

    public function getB2CUrl(): string
    {
        $env = $this->getEnv();
        return config("mpesa.urls.{$env}.b2c");
    }

    public function getConsumerKey(): string
    {
        return config('mpesa.consumer_key');
    }

    public function getConsumerSecret(): string
    {
        return config('mpesa.consumer_secret');
    }

    public function getShortcode(): string
    {
        return config('mpesa.shortcode');
    }

    public function getInitiatorName(): string
    {
        return config('mpesa.initiator_name');
    }

    public function getInitiatorPassword(): string
    {
        return config('mpesa.initiator_password');
    }

    public function getResultUrl(): string
    {
        return config('mpesa.result_url');
    }

    public function getTimeoutUrl(): string
    {
        return config('mpesa.timeout_url');
    }

    public function getCertificatePath(): string
    {
        return config('mpesa.certificate_path');
    }
}
