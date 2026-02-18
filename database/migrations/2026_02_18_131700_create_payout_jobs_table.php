<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payout_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->string('withdrawal_id');
            $table->string('vendor_id');
            $table->string('phone');
            $table->decimal('amount', 15, 2);
            $table->string('currency')->default('KES');
            $table->string('idempotency_key')->unique();
            $table->string('status')->default('queued');
            $table->string('conversation_id')->nullable();
            $table->string('originator_conv_id')->nullable();
            $table->string('mpesa_receipt')->nullable();
            $table->integer('result_code')->nullable();
            $table->text('result_desc')->nullable();
            $table->string('callback_url');
            $table->integer('attempts')->default(0);
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();

            $table->index(['tenant_id', 'status'], 'payout_jobs_lookup_idx');
            $table->index('conversation_id', 'payout_jobs_conv_idx');
            $table->index('idempotency_key', 'payout_jobs_idempotency_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payout_jobs');
    }
};
