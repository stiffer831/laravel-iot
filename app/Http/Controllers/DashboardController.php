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

use App\Repositories\CustomerRepo;
use App\Services\ThingsBoardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(Request $request)
    {
        return view('page.dashboard');
    }
}
