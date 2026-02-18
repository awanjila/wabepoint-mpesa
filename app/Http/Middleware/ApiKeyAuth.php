<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json([
                'error' => 'Missing or invalid Authorization header',
            ], 401);
        }

        $apiKey = substr($authHeader, 7);

        $tenant = Tenant::where('api_key', $apiKey)->first();

        if (!$tenant) {
            return response()->json([
                'error' => 'Invalid API key',
            ], 401);
        }

        if (!$tenant->is_active) {
            return response()->json([
                'error' => 'Tenant is inactive',
            ], 403);
        }

        $request->tenant = $tenant;

        return $next($request);
    }
}
