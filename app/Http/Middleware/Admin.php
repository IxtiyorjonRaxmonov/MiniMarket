<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // if (!$request->user() || $request->user()->role->role !== 'Admin') {
        //     return response()->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        // }
        // return $next($request);
    
        
            Log::info('Admin middleware triggered'); // Logs middleware execution
            return response()->json(['message' => 'Middleware trigge']); // Stops execution
            //     Log::info('Auth Middleware: User = ' . json_encode(auth()->user()));
            
            //     if (!auth()->check()) {
            //         return response()->json(['error' => 'Unauthenticated'], 401);
            //     }
            
            //     return $next($request);
            // }
            
        
    
    }
}
