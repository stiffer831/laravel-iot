<?php

/**
 * Registry.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-06 10:02:43
 * @modified 2022-04-06 10:02:43
 */

namespace App\Library;

class Registry
{
    private $data = [];
    private static $instance;

    /**
     * Get instance of Registry
     *
     * @return Registry
     */
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $key
     * @param $default
     *
     * @return mixed|null
     */
    public static function get($key, $default = null)
    {
        return self::getInstance()->getValue($key, $default);
    }

    /**
     * @param $key
     * @param $value
     * @param $force
     *
     * @return void
     */
    public static function set($key, $value, $force = false)
    {
        if (self::getInstance()->has($key) && !$force) {
            return;
        }
        self::getInstance()->setValue($key, $value);
    }

    /**
     * @return void
     */
    public function destroy()
    {
        self::$instance = null;
    }

    /**
     * @param $key
     * @param $default
     *
     * @return mixed|null
     */
    public function getValue($key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return void
     */
    public function setValue($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function has($key): bool
    {
        return isset($this->data[$key]);
    }
}
