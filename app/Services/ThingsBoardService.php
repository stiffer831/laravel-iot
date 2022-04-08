<?php

/**
 * ThingsBoardService.php
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

class ThingsBoardService
{
    private $registry;
    private $client;
    private $baseUri;
    private $logger;
    private $tokenPrefix = 'Bearer ';

    // 用户授权信息
    private $authUser = null;
    // 设备分组信息
    private $entityDeviceGroup = null;
    // 资产分组信息
    private $entityAssetGroups = null;
    // 数据中台(看板信息)
    private $entityDashboardGroups = null;
    // 设备列表
    private $deviceInfos = [];

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
        if (isset($this->deviceInfos[$pageSize][$page][$sortProperty][$sortOrder])) {
            return $this->deviceInfos[$pageSize][$page][$sortProperty][$sortOrder];
        }
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
        $token = $this->tokenPrefix . $customerToken;
        $headers = [
            'X-Authorization' => $token
        ];
        $this->deviceInfos[$pageSize][$page][$sortProperty][$sortOrder] = $this->handleRequestGet($uri, $headers);
        return $this->deviceInfos[$pageSize][$page][$sortProperty][$sortOrder];
    }

    /**
     * 获取用户的授权信息
     *
     * @param string $token
     * @return mixed|void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function authUser(string $token)
    {
        if (!is_null($this->authUser)) {
            return $this->authUser;
        }

        $uri = $this->baseUri . 'auth/user';
        $token = $this->tokenPrefix . $token;
        $headers = [
            'X-Authorization' => $token
        ];
        $this->authUser = $this->handleRequestGet($uri, $headers);
        return $this->authUser;
    }

    /**
     * 获取设备分组信息
     *
     * @param string $token
     * @return void
     */
    public function entityDeviceGroups(string $token)
    {
        if (!is_null($this->entityDeviceGroup)) {
            return $this->entityDeviceGroup;
        }

        $uri = $this->baseUri . 'entityGroups/DEVICE';
        $token = $this->tokenPrefix . $token;
        $headers = [
            'X-Authorization' => $token
        ];
        $this->entityDeviceGroup = $this->handleRequestGet($uri, $headers);
        return $this->entityDeviceGroup;
    }

    /**
     * 获取资产分组
     *
     * @param string $token
     * @return void
     */
    public function entityAssetGroups(string $token)
    {
        if (!is_null($this->entityAssetGroups)) {
            return $this->entityAssetGroups;
        }
        $uri = $this->baseUri . 'entityGroups/ASSET';
        $token = $this->tokenPrefix . $token;
        $headers = [
            'X-Authorization' => $token
        ];
        $this->entityAssetGroups = $this->handleRequestGet($uri, $headers);
        return $this->entityAssetGroups;
    }

    /**
     * 数据中台信息
     *
     * @param string $token
     * @return void
     */
    public function entityDashboardGroups(string $token)
    {
        if (!is_null($this->entityDeviceGroup)) {
            return $this->entityDashboardGroups;
        }
        $uri = $this->baseUri . 'entityGroups/DASHBOARD';
        $token = $this->tokenPrefix . $token;
        $headers = [
            'X-Authorization' => $token
        ];
        $this->entityDashboardGroups = $this->handleRequestGet($uri, $headers);
        return $this->entityDashboardGroups;
    }

    /**
     * 发送get请求
     *
     * @param string $uri
     * @param array $headers
     *
     * @return void
     */
    private function handleRequestGet(string $uri, array $headers)
    {
        try {
            $client = $this->client;
            $response = $client->get($uri, [
                'headers' => $headers
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
