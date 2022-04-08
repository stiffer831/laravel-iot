<?php

/**
 * Helpers.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-06 10:14:29
 * @modified 2022-04-06 10:14:29
 */

if (!function_exists('register')) {
    /**
     * @param $key
     * @param $value
     * @param $force
     *
     * @return void
     */
    function register($key, $value, $force = false)
    {
        \App\Library\Registry::set($key, $value, $force);
    }
}

if (!function_exists('registry')) {
    /**
     * @param $key
     * @param $default
     *
     * @return mixed|null
     */
    function registry($key, $default = null)
    {
        return \App\Library\Registry::get($key, $default);
    }
}

if (!function_exists('d')) {
    /**
     * @return void
     */
    function d()
    {
        array_map(function ($x) {
            dump($x);
        }, func_get_args());
    }
}

if (!function_exists('parse_jwt')) {
    /**
     * 解析jwt
     *
     * @param string $jwt
     * @return mixed
     */
    function parse_jwt(string $jwt)
    {
        return json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $jwt)[1]))));
    }
}

if (!function_exists('customer_info')) {
    /**
     * 获取用户信息
     *
     * @return array
     */
    function customer_info(): array
    {
        return \App\Repositories\CustomerRepo::infos();
    }
}

if (!function_exists('time_format')) {
    /**
     * 格式化时间， 转换为本地时间字符
     *
     * @param int $timestamp
     * @return string
     */
    function time_format(int $timestamp): string
    {
        return (string)$timestamp;
    }
}