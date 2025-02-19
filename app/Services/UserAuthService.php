<?php

namespace app\Services;

use App\Exceptions\AppException;
use App\Models\UserRole;
use App\Models\Users;
use App\Models\Roles;

/**
 * 后台用户权限
 */
class UserAuthService
{
    /**
     * 添加或修改用户权限
     * @param $params
     * @return mixed
     * @throws AppException
     */
    public function add($params): mixed
    {
        //判断用户id和角色id是否存在
        if (!Users::where('id', '=', $params['user_id'])->exists()) {
            throw new AppException('用户不存在');
        }
        if (!Roles::where('id', '=', $params['role_id'])) {
            throw new AppException('角色不存在');
        }
        return UserRole::updateOrCreate(
            ['user_id' => $params['user_id']], // 查找条件
            ['role_id' => $params['role_id']]// 要更新或创建的属性
        );
    }
}
