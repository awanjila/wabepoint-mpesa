<?php

use App\Http\Controllers\Api\V1\PayoutController;
use App\Http\Controllers\MpesaCallbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api.key')->prefix('v1')->group(function () {
    Route::post('/payouts', [PayoutController::class, 'store']);
});

Route::post('/mpesa/callback', MpesaCallbackController::class);
Route::post('/mpesa/timeout', [MpesaCallbackController::class, 'timeout']);

Route::post('/b2c/result', [MpesaCallbackController::class, 'result']);
Route::post('/b2c/queue', [MpesaCallbackController::class, 'queueTimeout']);
