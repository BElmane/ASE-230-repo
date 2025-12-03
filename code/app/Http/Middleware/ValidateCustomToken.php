<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateCustomToken
{
    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');
        
        if (empty($authHeader)) {
            return response()->json(['error' => 'Authorization header missing'], 401);
        }
        
        if (preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
            $token = $matches[1];
            $validTokens = ['secret_bebba_key_2025', 'super_secure_token'];
            
            if (in_array($token, $validTokens)) {
                return $next($request);
            }
        }
        
        return response()->json(['error' => 'Invalid token'], 403);
    }
}
