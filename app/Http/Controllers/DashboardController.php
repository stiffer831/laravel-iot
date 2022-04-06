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

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(Request $request)
    {
        $this->devices();
        return view('page.dashboard');
    }

    private function devices()
    {

    }
}
