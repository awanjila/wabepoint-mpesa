<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\PayoutStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePayoutRequest;
use App\Jobs\ProcessMpesaB2CPayout;
use App\Models\PayoutJob;
use Illuminate\Http\JsonResponse;

class PayoutController extends Controller
{
    public function store(StorePayoutRequest $request): JsonResponse
    {
        $tenant = $request->tenant;

        $existingJob = PayoutJob::where('tenant_id', $tenant->id)
            ->where('idempotency_key', $request->idempotency_key)
            ->first();

        if ($existingJob) {
            return response()->json([
                'job_id' => $existingJob->id,
                'withdrawal_id' => $existingJob->withdrawal_id,
                'status' => $existingJob->status->value,
                'message' => 'Payout already processed (idempotent request).',
            ], 200);
        }

        $payoutJob = PayoutJob::create([
            'tenant_id' => $tenant->id,
            'withdrawal_id' => $request->withdrawal_id,
            'vendor_id' => $request->vendor_id,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'currency' => 'KES',
            'idempotency_key' => $request->idempotency_key,
            'status' => PayoutStatus::QUEUED,
            'callback_url' => $request->callback_url,
        ]);

        ProcessMpesaB2CPayout::dispatch($payoutJob->id);

        return response()->json([
            'job_id' => $payoutJob->id,
            'withdrawal_id' => $payoutJob->withdrawal_id,
            'status' => $payoutJob->status->value,
            'message' => 'Payout queued. Result will be sent to your callback_url.',
        ], 202);
    }
}
