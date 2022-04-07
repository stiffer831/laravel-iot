<?php

/**
 * ThingsBoard.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-07 08:51:40
 * @modified 2022-04-07 08:51:40
 */

namespace App\Services;

use GuzzleHttp\Client;
use App\Library\Logger;
use App\Library\Registry;
use GuzzleHttp\Exception\RequestException;

class ThingsBoard
{
    private $registry;
    private $client;
    private $baseUri;
    private $logger;

    public function __construct()
    {
        $this->registry = Registry::getInstance();
        $this->logger = new Logger('thingsboard');
        $this->baseUri = env('API_BASE_URL', '');
        $this->client = new Client([
            'timeout' => 300
        ]);
    }

    /**
     * 用户登录
     * @param $username
     * @param $password
     * @return array|array[]|mixed
     * @throws \Exception
     */
    public function login($username, $password)
    {
        if (!$this->baseUri) {
            $this->logger->error('ThingsBoard服务器配置url为空');
            throw new \Exception('server error.');
        }
        $uri = $this->baseUri . 'auth/login';
        $params = [
            'username' => $username,
            'password' => $password
        ];
        $client = $this->client;
        try {
            $response = $client->post($uri, [
                'json' => $params
            ]);
            $result = json_decode((string)$response->getBody(), true);
            $token = $result['token'] ?? '';
            $refreshToken = $result['refreshToken'] ?? '';
            if (!$token || !$refreshToken) {
                throw new \Exception(__('login.invalid_token'));
            }
            return $result;
        } catch (RequestException $e) {
            $exceptionResponse = $e->getResponse()->getBody()->getContents();
            // log exception
            $this->logger->error($exceptionResponse);
            $exceptionArr = json_decode($exceptionResponse, true);
            $exceptionStatus = $exceptionArr['status'] ?? '';
            $exceptionMessage = $exceptionArr['message'] ?? '';
            if ($exceptionStatus) {
                $exceptionMessage = "({$exceptionStatus}) " . $exceptionMessage;
            }
            throw new \Exception($exceptionMessage);
        }
    }
}
