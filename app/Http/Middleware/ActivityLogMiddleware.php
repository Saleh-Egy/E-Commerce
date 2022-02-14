<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;

class ActivityLogMiddleware
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
        ActivityLog::create([
            'method'  =>  $request->method(),
            'url'     =>  $request->path(),
            'body'    =>  $request->all(),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
            'user_ip' =>$request->server('REMOTE_ADDR'),
            'user_id' =>  auth()->user()->id ?? null,
        ]);
        return $next($request);
    }
}
