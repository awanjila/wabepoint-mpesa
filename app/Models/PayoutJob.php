<?php

namespace App\Models;

use App\Enums\PayoutStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'withdrawal_id',
        'vendor_id',
        'phone',
        'amount',
        'currency',
        'idempotency_key',
        'status',
        'conversation_id',
        'originator_conv_id',
        'mpesa_receipt',
        'result_code',
        'result_desc',
        'callback_url',
        'attempts',
        'processed_at',
    ];

    protected $casts = [
        'status' => PayoutStatus::class,
        'amount' => 'decimal:2',
        'attempts' => 'integer',
        'result_code' => 'integer',
        'processed_at' => 'datetime',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
