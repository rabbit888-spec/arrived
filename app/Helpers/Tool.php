<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;

/**
 * 工具类函数
 */
class Tool
{

    /**
     * 数据分页
     * @param $data
     * @param $currentPage
     * @return LengthAwarePaginator
     */
    public static function paginatedData($data, $currentPage)
    {
        $perPage = 10;
        $offset = ($currentPage * $perPage) - $perPage;

        return new LengthAwarePaginator(
            array_slice($data, $offset, $perPage, true),
            count($data),
            $perPage,
            $currentPage,
            ['path' => Request::url()]
        );
    }
}
