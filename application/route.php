<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::any(':version/selProduct', 'api/:version.Product/selProduct');


Route::any('Send', 'index/Index/send');
Route::any('Receive', 'index/Index/receive');

//处理图片
Route::any('Order', 'index/order/image');

//即时通讯
Route::any('Push', 'index/push/suju');

Route::any('ser', '/server.php');
