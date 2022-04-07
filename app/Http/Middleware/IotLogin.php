<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IotLogin
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
        $customerInfo = session('customer_info', null);
        if (empty($customerInfo)) {
            return response()->redirectToRoute('login.show');
        }
        register('customer_info', $customerInfo);
        return $next($request);
    }
}
