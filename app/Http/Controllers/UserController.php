<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\UserService;
use Illuminate\Http\Request;

/**
 * 后台用户相关
 */
class UserController extends Controller
{
    /**
     * 用户登录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \App\Exceptions\AppException
     */
    public function login(Request $request)
    {
        $params = $request->all();
        if (empty($params['username']) || empty($params['password'])) {
            return ApiResponse::error('参数错误');
        }

        $userService = new UserService();
        return ApiResponse::success($userService->login($params));
    }
}
