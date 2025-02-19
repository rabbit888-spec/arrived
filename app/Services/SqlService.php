<?php

namespace App\Services;

use App\Helpers\Tool;
use App\Models\SqlLog;
use App\Models\Users;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * sql相关
 */
class SqlService
{
    /**
     * sql列表
     * @param $sql
     * @param string $type
     * @param int $page
     * @return array|LengthAwarePaginator|string|null
     */
    public function log($sql, string $type = 'list', int $page = 1): mixed
    {
        $sqlLogModel = new SqlLog();
        //只返回love_sql_log表数据
        if (!str_contains(trim(strtolower($sql)), env('DB_PREFIX', '') . $sqlLogModel->getTable())) {
            return [];
        }

        try {
            $result = DB::select($sql);
            //写入sql查询日志
            $this->logger($sql);
            if (empty($result)) {
                return [];
            }

            //处理查询结果，查询用户名称
            $userIds = array_unique(array_column($result, 'user_id'));
            $username = Users::whereIn('id', $userIds)
                ->select('id', 'username')
                ->get();
            if (empty($username)) {
                return [];
            }
            $username = array_column($username->toArray(), 'username', 'id');

            //结果集中加入用户名
            foreach ($result as $value) {
                $value->username = '';
                if (isset($username[$value->user_id])) {
                    $value->username = $username[$value->user_id];
                }
            }

            if ($type == 'list') {
                return Tool::paginatedData($result, $page);//列表
            } elseif ($type == 'excel') {
                return $this->exportExcel($result);
            } else {
                return $this->exportJson($result);//导出excel文件
            }
        } catch (\Exception $e) {
            //写入sql查询日志
            $this->logger($sql, $e->getMessage());//导出json文件
            return [];
        }
    }

    /**
     * 将sql列表数据导出为excel文件
     * @param $data
     * @return true
     */
    public function exportExcel($data): bool
    {
        // 设置响应头，告诉浏览器这是一个 CSV 文件
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="sqlList.csv"');

        // 打开一个输出流
        $output = fopen('php://output', 'w');

        // 定义表头（标题）
        $headers = ['ID', '用户', '时间', 'sql语句', '错误'];
        // 写入表头
        fputcsv($output, $headers);

        // 遍历用户数组，提取指定元素并写入 CSV 文件
        foreach ($data as $datum) {
            $row = [
                $datum->id,
                $datum->username,
                $datum->created_at,
                $datum->sql,
                $datum->error
            ];
            fputcsv($output, $row);
        }

        // 关闭输出流
        fclose($output);
        return true;
    }

    /**
     * 将sql列表数据导出为json文件
     * @param $result
     * @return string|void
     */
    public function exportJson($result): mixed
    {
        // 将数组转换为 JSON 字符串
        $jsonData = json_encode($result, JSON_PRETTY_PRINT);
        // 检查 JSON 编码是否成功
        if ($jsonData === false) {
            die("JSON 编码失败: " . json_last_error_msg());
        }
        // 设置 HTTP 响应头
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="data.json"');
        header('Content-Length: ' . strlen($jsonData));

        // 输出 JSON 数据
        return $jsonData;
    }

    /**
     * 将查询写入日志
     * @param $sql
     * @param string $error
     * @return mixed
     */
    public function logger($sql, string $error = ''): mixed
    {
        $data['user_id'] = session('userInfo')['user_id'];
        $data['sql'] = $sql;
        $data['error'] = $error;
        return SqlLog::insert($data);
    }
}
