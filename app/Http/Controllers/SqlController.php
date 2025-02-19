<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\SqlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * sql相关
 */
class SqlController extends Controller
{
    /**
     * sql列表，导出sql文件
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Pagination\LengthAwarePaginator|string|null
     */
    public function sqlQuery(Request $request): mixed
    {
        $search = $request->input('search');
        $page = $request->input('page', 1);
        //无搜索sql，直接显示页面
        if (empty($search)) {
            return view('query_logs.index');
        }
        //搜索sql
        if (!str_starts_with(trim(strtolower($search)), 'select')) {
            return ApiResponse::error('仅允许 SELECT 语句');
        }

        $sqlService = new SqlService();
        //获取路由，根据路由执行不同功能
        $routeName = Route::currentRouteName();
        if ($routeName == 'sqlQuery' || $routeName == 'query_logs.index') {
            //列表展示
            $queryLogs = $sqlService->log($search, 'list', $page);
            return view('query_logs.index', compact('queryLogs', 'search'));
        } elseif ($routeName == 'sqlQueryExportExcel') {
            //导出excel文件
            return $sqlService->log($search, 'excel');
        } else {
            //导出json文件
            return $sqlService->log($search, 'json');
        }
    }
}
