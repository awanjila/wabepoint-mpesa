# M-Pesa B2C Payout API Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:dispatching-parallel-agents to implement tasks in parallel.

**Goal:** Build Laravel API to process M-Pesa B2C payouts with async queue processing.

**Architecture:** WordPress → Laravel API → Queue → M-Pesa B2C → Callback → WordPress webhook

**Tech Stack:** Laravel 10, Redis queues, MySQL, Guzzle HTTP

---

## Task Groups (Parallel Execution)

### Group A: Database Layer
1. Create `create_tenants_table` migration
2. Create `create_payout_jobs_table` migration  
3. Create `Tenant` model
4. Create `PayoutJob` model with `PayoutStatus` enum
5. Run migrations

### Group B: Core Services
1. Create `config/mpesa.php`
2. Create `MpesaConfigService`
3. Create `MpesaAuthService` (OAuth token caching)
4. Create `MpesaSecurityService` (certificate encryption)
5. Create `MpesaB2CService` (API calls)

### Group C: API Layer
1. Create `ApiKeyAuth` middleware
2. Create `StorePayoutRequest` form request
3. Create `PayoutController@store`
4. Create `MpesaCallbackController`
5. Register routes in `api.php`

### Group D: Queue Jobs
1. Create `ProcessMpesaB2CPayout` job
2. Create `NotifyWordPressOfResult` job
3. Create `ReconcilePayoutJobs` scheduled command
4. Register schedule in `Kernel.php`

### Group E: Setup & Config
1. Update `.env.example` with M-Pesa variables
2. Create `storage/app/mpesa/.gitkeep`
3. Create test tenant seeder

---

## Files to Create

```
app/Enums/PayoutStatus.php
app/Models/Tenant.php
app/Models/PayoutJob.php
app/Http/Middleware/ApiKeyAuth.php
app/Http/Requests/StorePayoutRequest.php
app/Http/Controllers/Api/V1/PayoutController.php
app/Http/Controllers/MpesaCallbackController.php
app/Jobs/ProcessMpesaB2CPayout.php
app/Jobs/NotifyWordPressOfResult.php
app/Console/Commands/ReconcilePayoutJobs.php
app/Services/MpesaConfigService.php
app/Services/MpesaAuthService.php
app/Services/MpesaSecurityService.php
app/Services/MpesaB2CService.php
config/mpesa.php
database/migrations/*_create_tenants_table.php
database/migrations/*_create_payout_jobs_table.php
database/seeders/TenantSeeder.php
```

## Files to Modify

```
routes/api.php
app/Http/Kernel.php
app/Console/Kernel.php
.env.example
```
