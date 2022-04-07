<?php

/**
 * Logger.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-06 14:05:40
 * @modified 2022-04-06 14:05:40
 */

namespace App\Library;

use Illuminate\Support\Str;
use Monolog\Logger as MonoLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class Logger
{
    private $log = null;

    public function __construct($name, $frequently = 'day')
    {
        $this->log = new MonoLogger(Str::camel($name));
        $fileName = $this->getLogName($name, $frequently);
        $logFile = storage_path('/logs/' . $fileName . '.log');
        $level = config('app.log_level', MonoLogger::DEBUG);
        $handler = new StreamHandler($logFile, $level, true, 0777);
        $lineFormatter = new LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n");
        $handler->setFormatter($lineFormatter);
        $this->log->pushHandler($handler);
    }

    /**
     * @param $logName
     * @param $frequently
     *
     * @return string
     */
    private function getLogName($logName, $frequently)
    {
        $frequently = strtolower($frequently);
        if ($frequently == 'day') {
            $fileName = Str::snake($logName) . '/' . date('Ymd');
        } elseif ($frequently == 'month') {
            $fileName = Str::snake($logName) . '/' . date('Ym');
        } elseif ($frequently == 'year') {
            $fileName = Str::snake($logName) . '/' . date('Y');
        } else {
            $fileName = Str::snake($logName);
        }
        return $fileName;
    }

    /**
     * @param $message
     *
     * @return false|string
     */
    private function handleMessage($message)
    {
        if (PHP_SAPI == 'cli') {
            d($message);
        }
        if (!is_string($message)) {
            return json_encode($message);
        }
        return $message;
    }

    /**
     * @param ...$message
     *
     * @return void
     */
    public function error(...$message)
    {
        foreach ($message as $item) {
            $this->log->error($this->handleMessage($item));
        }
    }

    /**
     * @param ...$message
     *
     * @return void
     */
    public function warning(...$message)
    {
        foreach ($message as $item) {
            $this->log->warning($this->handleMessage($item));
        }
    }

    /**
     * @param ...$message
     *
     * @return void
     */
    public function notice(...$message)
    {
        foreach ($message as $item) {
            $this->log->notice($this->handleMessage($item));
        }
    }

    /**
     * @param ...$message
     *
     * @return void
     */
    public function info(...$message)
    {
        foreach ($message as $item) {
            $this->log->info($this->handleMessage($item));
        }
    }

    /**
     * @param ...$message
     *
     * @return void
     */
    public function debug(...$message)
    {
        foreach ($message as $item) {
            $this->log->debug($this->handleMessage($item));
        }
    }
}
