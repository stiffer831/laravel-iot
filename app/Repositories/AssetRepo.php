<?php

/**
 * AssetRepo.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-08 10:54:22
 * @modified 2022-04-08 10:54:22
 */

namespace App\Repositories;

class AssetRepo
{
    /**
     * 处理资产分组
     *
     * @param array $assetGroups
     * @return array
     */
    public static function handleAssetGroups(array $assetGroups): array
    {
        if (!$assetGroups) {
            return [];
        }
        $result = [];
        foreach ($assetGroups as $assetGroup) {
            $createdTime = $assetGroup['createdTime'];
            $assetGroup['createdTimeFormat'] = time_format($createdTime);
            $result[] = $assetGroup;
        }
        return $result;
    }
}