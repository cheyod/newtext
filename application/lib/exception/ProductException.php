<?php
namespace app\lib\exception;

class ProductException extends BaseException
{
    //HTTP 状态码 404， 200
    public $code = 400;
    //错误具体信息
    public $msg = '请求商品不存在';
    //自定义错误码
    public $errCode = 40000;
}

