<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'api_key',
        'webhook_secret',
        'wordpress_url',
        'is_active',
        'daily_limit',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'daily_limit' => 'decimal:2',
    ];

    public function payoutJobs()
    {
        return $this->hasMany(PayoutJob::class);
    }
}
