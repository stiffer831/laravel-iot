<?php

/**
 * LoginController.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-06 10:43:54
 * @modified 2022-04-06 10:43:54
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show(Request $request)
    {
        return view('page.login');
    }

    public function submit(Request $request)
    {
        $username = $request->post('username', '');
        $password = $request->post('password', '');
        if (!$username || !$password) {
            $request->session()->flash('warning', __('login.params_empty'));
            return back()->withInput();
        }

    }
}
