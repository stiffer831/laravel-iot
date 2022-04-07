<?php

/**
 * Login.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-06 16:08:45
 * @modified 2022-04-06 16:08:45
 */

namespace App\Services;

class Login
{
    /**
     * 登录验证，成功则存入registry, 否则抛出异常
     * @param string $username
     * @param string $password
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Exception
     */
    public function verify(string $username, string $password)
    {
        if (!$username || !$password) {
            throw new \Exception(__('login.params_empty'));
        }
        $loginResult = (new ThingsBoard())->login($username, $password);
        $token = $loginResult['token'] ?? [];
        $refreshToken = $loginResult['refreshToken'] ?? '';
        $customer = parse_jwt($token);
        $refreshCustomer = parse_jwt($refreshToken);
        $customerInfo = [
            'token' => $token,
            'refresh_token' => $refreshToken,
            'customer' => $customer,
            'refresh_customer' => $refreshCustomer
        ];
        session()->put('customer_info', $customerInfo);
    }
}
