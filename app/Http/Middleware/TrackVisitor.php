<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
            $ipAddress = $request->ip();
            $id = rand();
            $userAgent = $request->header('User-Agent');
            $visitedAt = now()->toDateTimeString();
    
            DB::table('visitors')->insert([
                'id'=>$id,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'visited_at' => $visitedAt,
            ]);
        
        return $next($request);
    }
}
