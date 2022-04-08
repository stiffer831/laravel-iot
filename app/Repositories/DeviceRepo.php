<?php

/**
 * DeviceRepo.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-08 10:37:32
 * @modified 2022-04-08 10:37:32
 */

namespace App\Repositories;

class DeviceRepo
{
    /**
     * @param array $devices
     * @return array
     */
    public static function handleDeviceGroups(array $devices): array
    {
        if (!$devices) {
            return [];
        }
        $result = [];
        foreach ($devices as $device) {
            $createdTime = $device['createdTime'];
            // d($createdTime, Carbon::createFromTimestamp($createdTime)->toDateTimeString());
            $result[] = $device;
        }
        return $result;
    }
}