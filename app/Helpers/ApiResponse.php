<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * 返回成功响应
     *
     * @param mixed $data 响应数据
     * @param string $message 响应消息
     * @param int $statusCode 状态码
     * @return JsonResponse
     */
    public static function success($data = null, int $statusCode = 200, string $message = '操作成功'): JsonResponse
    {
        return response()->json([
            'code' => $statusCode,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * 返回失败响应
     *
     * @param string $message 响应消息
     * @param int $statusCode 状态码
     * @param mixed $data 响应数据
     * @return JsonResponse
     */
    public static function error(string $message = '操作失败', int $statusCode = 400, $data = null): JsonResponse
    {
        return response()->json([
            'code' => $statusCode,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}
