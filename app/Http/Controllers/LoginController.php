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

use App\Services\LoginService;
use Illuminate\Http\Request;
use App\Library\ThingsBoard;

class LoginController extends Controller
{
    /**
     * 登录页面展示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        return view('page.login');
    }

    /**
     * 退出登录
     *
     * @param Request $request
     * @return void
     */
    public function out(Request $request)
    {
        $request->session()->forget('customer_info');
        $request->session()->flash('success', __('login.success_logout'));
        return response()->redirectToRoute('login.show');
    }

    /**
     * 登录表单提交
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function submit(Request $request)
    {
        try {
            $username = $request->post('username', '');
            $password = $request->post('password', '');
            // 验证
            (new LoginService())->verify((string)$username, (string)$password);
            // 跳转
            return response()->redirectToRoute('dashboard');
        } catch (\Exception $e) {
            $request->session()->flash('warning', $e->getMessage());
            return back()->withInput();
        }
    }
}
