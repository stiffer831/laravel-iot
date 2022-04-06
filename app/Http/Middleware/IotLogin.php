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
        $token = session('token', null);
        $refreshToken = session('refresh_token', null);
        $customer = session('customer', null);
        $refreshCustomer = session('refresh_customer', null);

        if (empty($token) || empty($refreshToken) || empty($customer) || empty($refreshCustomer)) {
            return response()->redirectToRoute('login.show');
        }

        register('token', $token);
        register('refresh_token', $refreshToken);
        register('customer', $customer);
        register('refresh_customer', $refreshCustomer);

        return $next($request);
    }
}
