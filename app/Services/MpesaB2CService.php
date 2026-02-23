<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MpesaB2CService
{
    protected MpesaAuthService $authService;
    protected MpesaSecurityService $securityService;
    protected MpesaConfigService $config;

    public function __construct(
        MpesaAuthService $authService,
        MpesaSecurityService $securityService,
        MpesaConfigService $config
    ) {
        $this->authService = $authService;
        $this->securityService = $securityService;
        $this->config = $config;
    }

    public function sendPayment(array $data): array
    {
        $token = $this->authService->getToken();
        $encryptedPassword = $this->securityService->encryptCredential($this->config->getInitiatorPassword());

        $payload = [
            'InitiatorName' => $this->config->getInitiatorName(),
            'SecurityCredential' => $encryptedPassword,
            'CommandID' => $data['CommandID'] ?? 'BusinessPayment',
            'Amount' => $data['Amount'],
            'PartyA' => $this->config->getShortcode(),
            'PartyB' => $data['PartyB'],
            'Remarks' => $data['Remarks'] ?? 'B2C Payment',
            'QueueTimeOutURL' => $this->config->getTimeoutUrl(),
            'ResultURL' => $this->config->getResultUrl(),
            'Occasion' => $data['Occasion'] ?? '',
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])
        ->withoutVerifying()
        ->timeout(30)
        ->post($this->config->getB2CUrl(), $payload);

        if (!$response->successful()) {
            throw new \Exception('B2C payment request failed: ' . $response->body());
        }

        return $response->json();
    }
}
