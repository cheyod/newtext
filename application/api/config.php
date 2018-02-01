<?php

return [
    'view_replace_str'       => [
    	'__PUBLIC__' => '',
        '__PATH__'   => '',
    ],
	

    'cache' => [
	     // 缓存类型为File
	    'type'   => 'File', 
	     // 缓存有效期为永久有效
	    'expire' => 0,
	     // 指定缓存目录
	    'path'   => APP_PATH . 'runtime/cache/', 
	],



];

?>