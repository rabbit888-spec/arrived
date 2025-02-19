<?php

namespace App\Http\Controllers;

use app\Helpers\ApiResponse;
use app\Services\UserAuthService;
use Illuminate\Http\Request;

/**
 * 后台用户权限
 */
class UserAuthController extends Controller
{
    /**
     * 添加权限
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\AppException
     */
    public function add(Request $request): ApiResponse
    {
        $params = $request->all();
        if (empty($params['user_id']) || empty($params['role_id'])
            || !is_numeric($params['user_id']) || !is_numeric($params['role_id'])) {
            return ApiResponse::error('参数错误');
        }

        $userAuthService = new UserAuthService();
        $result = $userAuthService->add($params);
        if ($result) {
            return ApiResponse::success();
        }
        return ApiResponse::error();
    }
}
