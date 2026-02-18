<?php

namespace App\Jobs;

use App\Enums\PayoutStatus;
use App\Models\PayoutJob;
use App\Services\MpesaB2CService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessMpesaB2CPayout implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public array $backoff = [60, 300, 900];

    public function __construct(
        public int $payoutJobId
    ) {
        $this->onQueue('payouts');
    }

    public function handle(MpesaB2CService $b2cService): void
    {
        $payoutJob = PayoutJob::find($this->payoutJobId);

        if (!$payoutJob) {
            Log::error('Payout job not found', ['id' => $this->payoutJobId]);
            return;
        }

        $payoutJob->increment('attempts');

        try {
            $response = $b2cService->sendPayment([
                'Amount' => (int) $payoutJob->amount,
                'PartyB' => $payoutJob->phone,
                'Remarks' => 'Payout for withdrawal ' . $payoutJob->withdrawal_id,
            ]);

            if (isset($response['ResponseCode']) && $response['ResponseCode'] === '0') {
                $payoutJob->update([
                    'conversation_id' => $response['ConversationID'] ?? null,
                    'originator_conv_id' => $response['OriginatorConversationID'] ?? null,
                    'status' => PayoutStatus::PROCESSING,
                ]);

                Log::info('Payout submitted to M-Pesa', [
                    'job_id' => $payoutJob->id,
                    'conversation_id' => $payoutJob->conversation_id,
                ]);
            } else {
                throw new \Exception($response['errorMessage'] ?? 'M-Pesa request failed');
            }
        } catch (\Exception $e) {
            Log::error('Payout failed', [
                'job_id' => $payoutJob->id,
                'attempt' => $payoutJob->attempts,
                'error' => $e->getMessage(),
            ]);

            if ($payoutJob->attempts >= $this->tries) {
                $payoutJob->update([
                    'status' => PayoutStatus::FAILED,
                    'result_desc' => $e->getMessage(),
                    'processed_at' => now(),
                ]);
            } else {
                throw $e;
            }
        }
    }
}
