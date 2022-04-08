<?php

/**
 * DashboardRepo.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-08 11:13:50
 * @modified 2022-04-08 11:13:50
 */

namespace App\Repositories;

class DashboardRepo
{
    /**
     *
     * @param array $dashboardGroups
     * @return array
     */
    public static function handleDashboardGroups(array $dashboardGroups): array
    {
        if (!$dashboardGroups) {
            return [];
        }
        $result = [];
        foreach ($dashboardGroups as $dashboardGroup) {
            $createdTime = $dashboardGroup['createdTime'];
            $result[] = $dashboardGroup;
        }
        return $result;
    }
}