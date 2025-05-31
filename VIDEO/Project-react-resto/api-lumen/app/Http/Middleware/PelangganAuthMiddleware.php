<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PelangganAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        
        if (!$token) {
            return response()->json(['pesan' => 'Token tidak ditemukan'], 401);
        }

        $token = str_replace('Bearer ', '', $token);
        $pelangganData = Cache::get('pelanggan_token_' . $token);
        
        if (!$pelangganData) {
            return response()->json(['pesan' => 'Token tidak valid'], 401);
        }

        // Simpan data langsung ke request object
        $request->merge(['pelanggan_data' => (object) $pelangganData]);
        
        return $next($request);
    }
}