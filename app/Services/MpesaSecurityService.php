<?php

namespace App\Services;

class MpesaSecurityService
{
    protected MpesaConfigService $config;

    public function __construct(MpesaConfigService $config)
    {
        $this->config = $config;
    }

    public function encryptCredential(string $password): string
    {
        $certificatePath = $this->config->getCertificatePath();

        if (!file_exists($certificatePath)) {
            throw new \Exception("M-Pesa certificate not found at: {$certificatePath}");
        }

        $certificateContent = file_get_contents($certificatePath);
        $publicKey = openssl_pkey_get_public($certificateContent);

        if (!$publicKey) {
            throw new \Exception('Failed to load M-Pesa public certificate.');
        }

        $encrypted = '';
        $success = openssl_public_encrypt($password, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);

        if (!$success) {
            throw new \Exception('Failed to encrypt credential using certificate.');
        }

        return base64_encode($encrypted);
    }
}
