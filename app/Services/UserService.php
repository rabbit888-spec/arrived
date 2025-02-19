<?php

namespace App\Services;

use App\Exceptions\AppException;
use App\Models\Users;

class UserService
{
    /**
     * 用户登录
     * @param $params
     * @return mixed
     * @throws AppException
     */
    public function login($params): mixed
    {
        //查询用户密码
        $user_info = Users::where('username', '=', $params['username'])
            ->leftJoin('user_role as r', 'users.id', '=', 'r.user_id')
            ->select('users.password', 'users.id', 'r.role_id')
            ->first();
        if (!$user_info) {
            throw new AppException('用户不存在');
        }
        //判断密码是否正确
        if (!password_verify($params['password'], $user_info->password)) {
            throw new AppException('密码错误');
        }

        //登录成功，将用户信息存入session
        session([
            'userInfo' => [
                'user_id' => $user_info->id,
                'username' => $params['username'],
                'role_id' => $user_info->role_id,
            ]
        ]);
        return true;
    }
}
