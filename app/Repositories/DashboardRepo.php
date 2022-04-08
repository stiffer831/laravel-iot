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

use App\Services\ThingsBoardService;

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
            $dashboardGroup['createdTimeFormat'] = time_format($createdTime);
            $result[] = $dashboardGroup;
        }
        return $result;
    }

    /**
     * 获取某一分组的列表数据
     *
     * @param string $token
     * @param string $entityGroupId
     *
     * @return array
     */
    public static function listData(string $token, string $entityGroupId): array
    {
        $listData = (new ThingsBoardService())->entityGroupDashboard($token, $entityGroupId);
        if (empty($listData)) {
            return [];
        }
        $data = $listData['data'] ?? [];
        $dataResult = [];
        foreach ($data as $item) {
            $item['createdTimeFormat'] = time_format($item['createdTime']);
            $dataResult[] = $item;
        }
        $listData['data'] = $dataResult;
        return $listData;
    }

    /**
     * 获取单个数据中台数据
     *
     * @param string $token
     * @param string $id
     *
     * @return array
     */
    public static function currentData(string $token, string $id): array
    {
        $dashboardGroups = (new ThingsBoardService())->entityDashboardGroups($token);
        if (empty($dashboardGroups)) {
            return [];
        }
        $dashboards = [];
        foreach ($dashboardGroups as $dashboardGroup) {
            $currentId = $dashboardGroup['id']['id'] ?? '';
            $dashboards[$currentId] = $dashboardGroup;
        }
        return $dashboards[$id] ?? [];
    }
}