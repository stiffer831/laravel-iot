<?php

/**
 * DashboardController.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-06 10:56:03
 * @modified 2022-04-06 10:56:03
 */

namespace App\Http\Controllers;

use App\Repositories\DashboardRepo;
use Illuminate\Http\Request;
use App\Repositories\AssetRepo;
use App\Repositories\DeviceRepo;
use App\Repositories\CustomerRepo;
use App\Services\ThingsBoardService;

class DashboardController extends Controller
{
    public function show(Request $request)
    {
        $data['device_groups'] = $this->deviceGroups();
        $data['asset_groups'] = $this->assetGroups();
        $data['dashboard_groups'] = $this->dashboardGroups();
        return view('page.dashboard', $data);
    }

    /**
     * 分组设备信息
     *
     * @return array
     */
    public function deviceGroups()
    {
        $token = CustomerRepo::token();
        $deviceGroups = (new ThingsBoardService())->entityDeviceGroups($token);
        $deviceGroups = (array)$deviceGroups;
        return DeviceRepo::handleDeviceGroups($deviceGroups);
    }

    /**
     * 资产分组信息
     *
     * @return array
     */
    public function assetGroups(): array
    {
        $token = CustomerRepo::token();
        $assetGroups = (new ThingsBoardService())->entityAssetGroups($token);
        $assetGroups = (array)$assetGroups;
        return AssetRepo::handleAssetGroups($assetGroups);
    }

    /**
     * 数据中台信息
     *
     * @return array
     */
    public function dashboardGroups(): array
    {
        $token = CustomerRepo::token();
        $dashboardGroups = (new ThingsBoardService())->entityDashboardGroups($token);
        $dashboardGroups = (array)$dashboardGroups;
        return DashboardRepo::handleDashboardGroups($dashboardGroups);
    }
}
