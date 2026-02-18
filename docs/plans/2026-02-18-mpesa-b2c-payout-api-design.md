# M-Pesa B2C Payout API Design

**Date**: 2026-02-18
**Status**: Approved
**Type**: Feature

## Overview

Laravel API that processes vendor payouts via Safaricom M-Pesa B2C. WordPress sites send payout requests, we queue them, call M-Pesa, receive async callbacks, and notify WordPress of results.

## Architecture

```
WordPress → POST /api/v1/payouts → Queue Job → M-Pesa B2C API
                                                        ↓
WordPress ← Webhook ← Queue Job ← M-Pesa Callback ←────┘
```

---

## Database Schema

### tenants
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| name | string | Client name |
| api_key | string | Unique, starts with `sk_` |
| webhook_secret | string | Starts with `whsec_` |
| wordpress_url | string | Client's WordPress URL |
| is_active | boolean | Can disable tenant |
| daily_limit | decimal | Nullable, max KES/day |
| created_at, updated_at | timestamps | |

### payout_jobs
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| tenant_id | bigint | FK to tenants |
| withdrawal_id | string | WordPress withdrawal ID |
| vendor_id | string | WordPress vendor ID |
| phone | string | Format: 254XXXXXXXXX |
| amount | decimal | KES amount |
| currency | string | Default: KES |
| idempotency_key | string | Unique, prevents duplicates |
| status | enum | queued, processing, completed, failed |
| conversation_id | string | From M-Pesa |
| originator_conv_id | string | From M-Pesa |
| mpesa_receipt | string | M-Pesa transaction code |
| result_code | int | 0 = success |
| result_desc | string | M-Pesa message |
| callback_url | string | WordPress webhook URL |
| attempts | int | Retry count |
| processed_at | timestamp | Nullable |
| created_at, updated_at | timestamps | |

**Indexes**: `idempotency_key`, `tenant_id`, `status`, `conversation_id`

---

## API Routes

| Method | URI | Controller | Auth |
|--------|-----|------------|------|
| POST | /api/v1/payouts | PayoutController@store | API Key |
| POST | /api/mpesa/callback | MpesaCallbackController | Public (IP whitelist) |
| POST | /api/mpesa/timeout | MpesaCallbackController@timeout | Public |

### POST /api/v1/payouts

**Request**:
```json
{
  "vendor_id": 42,
  "withdrawal_id": "WD-2025-00871",
  "amount": 1500.00,
  "phone": "254712345678",
  "callback_url": "https://client-site.com/wp-json/payout/v1/result",
  "idempotency_key": "WD-2025-00871-v42",
  "remarks": "Vendor payout"
}
```

**Response (202 Accepted)**:
```json
{
  "job_id": 123,
  "withdrawal_id": "WD-2025-00871",
  "status": "queued",
  "message": "Payout queued. Result will be sent to your callback_url."
}
```

### POST /api/mpesa/callback

Receives async result from Safaricom. Matches via `OriginatorConversationID`.

---

## Queue Jobs

### ProcessMpesaB2CPayout
- **Queue**: `payouts`
- **Tries**: 3 (backoff: 60s, 5min, 15min)
- **Steps**:
  1. Fetch payout_job
  2. Get OAuth token (cached)
  3. Encrypt initiator password
  4. Call M-Pesa B2C API
  5. Save conversation IDs, set status "processing"

### NotifyWordPressOfResult
- **Queue**: `callbacks`
- **Tries**: 5 (backoff: 30s, 1min, 5min, 15min, 1hr)
- **Steps**:
  1. Fetch payout_job
  2. Build JSON payload
  3. Sign with HMAC-SHA256
  4. POST to callback_url

### ReconcilePayoutJobs (Scheduled)
- **Schedule**: Daily
- Finds `processing` jobs older than 2 hours
- Calls M-Pesa Transaction Status API
- Updates status, notifies WordPress

---

## Service Classes

### MpesaAuthService
- `getToken()`: Returns cached OAuth token (55 min cache)
- Handles 401 by refreshing

### MpesaSecurityService
- `encryptCredential($password)`: RSA encrypts with Safaricom certificate

### MpesaB2CService
- `sendPayment($payload)`: Makes B2C API call

### MpesaConfigService
- Returns environment-appropriate URLs

---

## Configuration

### config/mpesa.php
```php
return [
    'env' => env('MPESA_ENV', 'sandbox'),
    'consumer_key' => env('MPESA_CONSUMER_KEY'),
    'consumer_secret' => env('MPESA_CONSUMER_SECRET'),
    'shortcode' => env('MPESA_SHORTCODE'),
    'initiator_name' => env('MPESA_INITIATOR_NAME'),
    'initiator_password' => env('MPESA_INITIATOR_PASSWORD'),
    'result_url' => env('MPESA_RESULT_URL'),
    'timeout_url' => env('MPESA_TIMEOUT_URL'),
    'certificate_path' => env('MPESA_CERTIFICATE_PATH'),
];
```

### .env additions
```
MPESA_ENV=sandbox
MPESA_CONSUMER_KEY=
MPESA_CONSUMER_SECRET=
MPESA_SHORTCODE=
MPESA_INITIATOR_NAME=
MPESA_INITIATOR_PASSWORD=
MPESA_RESULT_URL=
MPESA_TIMEOUT_URL=
MPESA_CERTIFICATE_PATH=storage/app/mpesa/SandboxCertificate.cer
QUEUE_CONNECTION=redis
CACHE_DRIVER=redis
```

---

## Security

1. **API Key Auth**: Custom middleware validates `Bearer sk_xxx` against tenants table
2. **IP Whitelist**: Nginx restricts `/api/mpesa/*` to Safaricom IPs
3. **Webhook Signing**: HMAC-SHA256 signature in `X-Payout-Signature` header
4. **Rate Limiting**: 100 requests/minute per tenant
5. **Idempotency**: Duplicate requests return cached result
6. **Logging**: Never log API keys, passwords, or full phone numbers

---

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/V1/PayoutController.php
│   │   └── MpesaCallbackController.php
│   ├── Middleware/
│   │   └── ApiKeyAuth.php
│   └── Requests/
│       └── StorePayoutRequest.php
├── Jobs/
│   ├── ProcessMpesaB2CPayout.php
│   ├── NotifyWordPressOfResult.php
│   └── ReconcilePayoutJobs.php
├── Models/
│   ├── Tenant.php
│   └── PayoutJob.php
├── Services/
│   ├── MpesaAuthService.php
│   ├── MpesaSecurityService.php
│   ├── MpesaB2CService.php
│   └── MpesaConfigService.php
└── Enums/
    └── PayoutStatus.php

config/
└── mpesa.php

database/
└── migrations/
    ├── create_tenants_table.php
    └── create_payout_jobs_table.php

storage/
└── app/mpesa/
    └── SandboxCertificate.cer
```
