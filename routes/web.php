<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SqlController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//后台管理
Route::prefix('admin')->group(function () {
    //用户权限
    Route::prefix('userAuth')->group(function () {
        Route::get('/add', [UserAuthController::class, 'add']);//添加权限
    });

    //后台用户相关
    Route::prefix('user')->group(function () {
        Route::get('login', [UserController::class, 'login']);//登录
    });

    Route::middleware(['adminAuthority'])->prefix('dev')->group(function () {
        Route::get('sqlQuery', [SqlController::class, 'sqlQuery'])->name('query_logs.index');//列表
        Route::get('sqlQueryExportExcel', [SqlController::class, 'sqlQuery'])->name('sqlQueryExportExcel');//导出excel文件
        Route::get('sqlQueryExportJson', [SqlController::class, 'sqlQuery'])->name('sqlQueryExportJson');//导出json文件
    });
});

Route::get('/', function () {
});
