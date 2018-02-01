<?php
namespace app\lib\exception;

class ParameterException extends BaseException
{
    //HTTP 状态码 404， 200
    public $code = 400;
    //错误具体信息
    public $msg = '参数错误';
    //自定义错误码
    public $errCode = 10000;
}

