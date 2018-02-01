<?php
namespace app\api\service;

class UserToken
{
    public function __construct($code)
    {
        $this->code = $code;
        $this->appid = config('wechat.appid');
        $this->secret = config('wechat.secret');
        $this->login_url = sprintf(config('wechat.login_url'),$this->appid,$this->secret,$this->code);
    }
    /**
     * 获取Token 记录用户
     * @param unknown $code
     */
    public function get(){
        $result = curl_get($this->login_url);
        $wxRes = json_decode($result);
        if(empty($wxRes)){
            
        }else{
            //判断是否有微信返回的错误码errcode
            $loginFile = array_key_exists('errcode', $wxRes);
            if($loginFile){
//                 throw new Exception('errcode:'.$wxRes['errcode'].' | errmsg:'.$wxRes['errmsg']);
            }else{
                return $wxRes;
            }
        }
    }
}

