<?php

/**
 * ThingsBoard.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-06 14:59:30
 * @modified 2022-04-06 14:59:30
 */

namespace App\Library;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class ThingsBoard
{
    protected $registry;
    protected $client;
    protected $baseUri;
    protected $logger;

    public function __construct()
    {
        $this->registry = Registry::getInstance();
        $this->logger = new Logger('things_board');
        $this->baseUri = env('API_BASE_URL', '');
        $this->client = new Client([
            'timeout' => 300
        ]);
        $this->logger->info("Construct ThingsBoard base");
    }

    public static function getInstance()
    {
        return new static();
    }

    public function login($username, $password)
    {
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
                return [
                    'exception' => [
                        'message' => __('login.invalid_token')
                    ]
                ];
            }
            return $result;
        } catch (RequestException $e) {
            $exceptionResponse = $e->getResponse()->getBody()->getContents();
            return [
                'exception' => json_decode($exceptionResponse, true)
            ];
        }
    }
}
