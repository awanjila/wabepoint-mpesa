<?php

namespace App\Jobs;

use App\Models\PayoutJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotifyWordPressOfResult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 5;
    public array $backoff = [30, 60, 300, 900, 3600];

    public function __construct(
        public int $payoutJobId
    ) {
        $this->onQueue('callbacks');
    }

    public function handle(): void
    {
        $payoutJob = PayoutJob::with('tenant')->find($this->payoutJobId);

        if (!$payoutJob || !$payoutJob->tenant) {
            Log::error('Payout job or tenant not found', ['id' => $this->payoutJobId]);
            return;
        }

        $payload = [
            'withdrawal_id' => $payoutJob->withdrawal_id,
            'vendor_id' => $payoutJob->vendor_id,
            'status' => $payoutJob->status->value,
            'mpesa_receipt' => $payoutJob->mpesa_receipt,
            'amount_paid' => (float) $payoutJob->amount,
            'phone_number' => $payoutJob->phone,
            'result_code' => $payoutJob->result_code,
            'result_desc' => $payoutJob->result_desc,
            'conversation_id' => $payoutJob->conversation_id,
            'processed_at' => $payoutJob->processed_at?->toISOString(),
        ];

        $signature = hash_hmac('sha256', json_encode($payload), $payoutJob->tenant->webhook_secret);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Payout-Signature' => 'sha256=' . $signature,
        ])->post($payoutJob->callback_url, $payload);

        if (!$response->successful()) {
            Log::warning('WordPress callback failed', [
                'job_id' => $payoutJob->id,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            throw new \Exception('WordPress callback failed with status ' . $response->status());
        }

        Log::info('WordPress callback successful', ['job_id' => $payoutJob->id]);
    }
}
