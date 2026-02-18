<?php

namespace App\Http\Controllers;

use App\Enums\PayoutStatus;
use App\Jobs\NotifyWordPressOfResult;
use App\Models\PayoutJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MpesaCallbackController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $originatorConvId = $request->input('Result.OriginatorConversationID');
        $resultCode = $request->input('Result.ResultCode');
        $resultDesc = $request->input('Result.ResultDesc');
        $conversationId = $request->input('Result.ConversationID');
        $transactionId = $request->input('Result.TransactionID');

        $payoutJob = PayoutJob::where('originator_conv_id', $originatorConvId)->first();

        if (!$payoutJob) {
            return response()->json([
                'ResultCode' => 1,
                'ResultDesc' => 'Transaction not found',
            ]);
        }

        $payoutJob->update([
            'result_code' => $resultCode,
            'result_desc' => $resultDesc,
            'conversation_id' => $conversationId,
            'mpesa_receipt' => $transactionId,
            'status' => $resultCode === 0 ? PayoutStatus::COMPLETED : PayoutStatus::FAILED,
            'processed_at' => now(),
        ]);

        NotifyWordPressOfResult::dispatch($payoutJob->id);

        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'Accepted',
        ]);
    }

    public function timeout(Request $request): JsonResponse
    {
        $originatorConvId = $request->input('Result.OriginatorConversationID');

        $payoutJob = PayoutJob::where('originator_conv_id', $originatorConvId)->first();

        if ($payoutJob) {
            $payoutJob->update([
                'status' => PayoutStatus::FAILED,
                'result_desc' => 'Request timed out',
                'processed_at' => now(),
            ]);

            NotifyWordPressOfResult::dispatch($payoutJob->id);
        }

        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'Timeout acknowledged',
        ]);
    }
}
