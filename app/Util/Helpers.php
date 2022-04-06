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
