<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vendor_id' => ['required'],
            'withdrawal_id' => ['required'],
            'amount' => ['required', 'numeric', 'min:10', 'max:150000'],
            'phone' => ['required', 'regex:/^254[0-9]{9}$/'],
            'callback_url' => ['required', 'url'],
            'idempotency_key' => ['required'],
            'remarks' => ['nullable'],
        ];
    }
}
