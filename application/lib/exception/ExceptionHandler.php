<?php
namespace app\lib\exception;

use Exception;
use think\exception\Handle;
use think\Request;
use think\Log;
use think\Config;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errCode;
    public function render(Exception $e)
    {
        if($e instanceof BaseException){
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errCode = $e->errCode;
        }else{
            if(config('app_debug')){
                return parent::render($e);
            }else{
                $this->code = 500;
                $this->msg = '我的内心是奔溃的';
                $this->errCode = 666;
                $this->recordErrorLog($e);
            }
        }
        $request = Request::instance();
        
        $result = [
            'msg' => $this->msg,
            'err_code' => $this->errCode,
            'request_url' => $request->url()
         ];
        return json($result,$this->code);
    }
    
    private function recordErrorLog(Exception $e){
        Log::init([
            // 日志记录方式，内置 file socket 支持扩展
            'type'  => 'File',
            'path'  => LOG_PATH,
            'level' => ['error']
        ]);
        Log::record($e->getMessage(),'error');
    }
}

