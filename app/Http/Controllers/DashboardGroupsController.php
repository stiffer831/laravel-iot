<?php

/**
 * DashboardGroupsController.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-08 14:49:35
 * @modified 2022-04-08 14:49:35
 */

namespace App\Http\Controllers;

use App\Repositories\CustomerRepo;
use App\Repositories\DashboardRepo;
use App\Services\ExportService;
use App\Services\ThingsBoardService;
use Illuminate\Http\Request;

class DashboardGroupsController extends Controller
{
    /**
     * 数据中台列表
     *
     * @param Request $request
     * @param $groupId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function listInfo(Request $request, $groupId)
    {
        $data['list_data'] = DashboardRepo::listData(CustomerRepo::token(), $groupId);
        $data['current_entity_info'] = DashboardRepo::currentData(CustomerRepo::token(), $groupId);
        return view('page.dashboard_group.list', $data);
    }

    /**
     * 数据中台详情
     *
     * 调用api -> 拿到小部件数据 -> 展示
     *
     * @param Request $request
     * @param $id
     * @return void
     */
    public function detail(Request $request, $id)
    {
        $currentDashboard = (new ThingsBoardService())->entityGroupDashboardDetail(CustomerRepo::token(), $id);
        echo "hello, {$id}";
    }

    /**
     * 数据中台详情导出
     *
     * @param Request $request
     * @param $id
     *
     * @return void
     */
    public function detail_export(Request $request, $id)
    {
        $currentDashboard = (new ThingsBoardService())->entityGroupDashboardDetail(CustomerRepo::token(), $id);
        $fileName = $currentDashboard['name'] ?? '';
        (new ExportService($currentDashboard, $fileName))->toJson();
    }
}