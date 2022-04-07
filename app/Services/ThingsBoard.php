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
use GuzzleHttp\Exception\ClientException;

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
        } catch (ClientException $e) {
            $this->handleException($e);
        }
    }

    /**
     * 获取客户设备列表数据
     *
     * @param string $customerId
     * @param string $customerToken
     * @param int $pageSize
     * @param int $page
     * @param string $sortProperty
     * @param string $sortOrder
     * @return void
     */
    public function deviceInfos(string $customerId, string $customerToken, int $pageSize = 10, int $page = 0, string $sortProperty = 'createdTime', string $sortOrder = 'DESC')
    {
        $pageSize = max(1, $pageSize);
        $page = max(0, $page);
        $sortOrder = strtoupper($sortOrder);
        $queryArr = [
            "pageSize={$pageSize}",
            "page={$page}",
            "sortProperty={$sortProperty}",
            "sortOrder={$sortOrder}",
            "deviceProfileId="
        ];
        $queryString = implode("&", $queryArr);
        $uri = $this->baseUri . "customer/{$customerId}/deviceInfos?{$queryString}";
        $token = "Bearer " . $customerToken;

        try {
            $client = $this->client;
            $response = $client->get($uri, [
                'headers' => [
                    'X-Authorization' => $token
                ]
            ]);
            return json_decode((string)$response->getBody(), true);
        } catch (ClientException $e) {
            $this->handleException($e);
        }
    }

    private function handleException(ClientException $e)
    {
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
