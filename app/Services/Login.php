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

use App\Library\ThingsBoard;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class Login
{
    /**
     * 登录验证，成功则存入registry, 否则抛出异常
     *
     * @param string $username
     * @param string $password
     *
     * @return \Illuminate\Http\RedirectResponse|void
     *
     * @throws \Exception
     */
    public function verify(string $username, string $password)
    {
        if (!$username || !$password) {
            throw new \Exception(__('login.params_empty'));
        }

        $loginResult = ThingsBoard::getInstance()->login($username, $password);
        $exception = $loginResult['exception'] ?? [];
        if ($exception) {
            $status = $exception['status'] ?? '';
            $statusMessage = '';
            if ($status) {
                $statusMessage = "(#{$status}) ";
            }
            $message = $statusMessage . $exception['message'] ?? '';
            throw new \Exception($message);
        }
        $token = $loginResult['token'] ?? [];
        $refreshToken = $loginResult['refreshToken'] ?? '';
        $customer = $this->parseJwtToken($token);
        $refreshCustomer = $this->parseJwtToken($refreshToken);
        session()->put('token', $token);
        session()->put('refresh_token', $refreshToken);
        session()->put('customer', $customer);
        session()->put('refresh_customer', $refreshCustomer);
    }

    /**
     * 解析jwt 为 object
     *
     * @param $token
     * @return mixed
     */
    private function parseJwtToken($token)
    {
        return json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))));
    }
}
