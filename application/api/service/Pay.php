<?php
/**
 * Created by PhpStorm.
 * User: cheyod
 * Date: 2017/8/30
 * Time: 9:32
 */

namespace app\admin\service;

use app\lib\exception\ParameterException;
use Wxpay\WxPayApi;
use Wxpay\WxPayJsApiPay;
use Wxpay\WxPayUnifiedOrder;


class Pay
{
    private $infoID;
    private $appid;

    function __construct($infoID)
    {
        $this->infoID = $infoID;
    }

    private function checkValid(){
        $info = PayInfo::where('id','=',$this->infoID)->find()->toArray();
        if(!$info){
            throw new ParameterException([
                'msg' => '支付信息不存在',
                'error_code' => 8000
            ]);
        }
    }

    /**
     * @param $data['appid','mch_id','bodys','openid','key']
     * @return Url
     */
    public function qrCodePay($data){
        $this->key = $data['key'];
        $this->appid = $data['appid'];

        $pay = new WxPayUnifiedOrder();
        $pay->SetAppid($data['appid']);  /* 支付微信平台 */
        $pay->SetMch_id($data['mch_id']);  /* 支付商户 */
        $pay->SetKey($data['key']);  /* 签名KEY */
        $pay->SetAttach($data['appid']);
        $pay->SetBody($data['bodys']);  /* 支付信息 */
        $pay->SetGoods_tag($data['bodys']);
        $pay->SetNotify_url(config('host_url').'/pay/notify');  /* 回调地址 */
        $pay->SetOut_trade_no(time());  /* 订单编号 */
        $pay->SetTotal_fee('1');  /* 订单总金额 */
        $pay->SetTrade_type('NATIVE'); /* 支付类型 */
        $pay->SetProduct_id($this->infoID);

        $result = $this->getNativePaySign($pay);
        $url = $result["code_url"];

        return "http://paysdk.weixin.qq.com/example/qrcode.php?data=".urlencode($url);
    }

    //NATIVE Sign检测
    private function getNativePaySign($pay)
    {
        $wxOrder = WxPayApi::unifiedOrder($pay);
        if($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] != 'SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
        }
        return $wxOrder;
    }


    /**
     * @param $data['appid','mch_id','bodys','openid','key']
     * @return array
     */
    public function jsApiPay($data){
//        $data = [
//            'appid' => '',
//            'mch_id' => '',
//            'bodys' => '',
//            'openid' => ''
//        ];
        $this->key = $data['key'];
        $pay = new WxPayUnifiedOrder();
        $pay->SetAppid($data['appid']);  /* 支付微信平台 */
        $pay->SetMch_id($data['mch_id']);  /* 支付商户 */
        $pay->SetKey($data['key']);  /* 签名KEY */
        $pay->SetBody($data['bodys']);  /* 支付信息 */
        $pay->SetNotify_url(config('host_url').'/pay/notify');  /* 回调地址 */
        $pay->SetOpenid($data['openid']);  /* 用户Openid */
        $pay->SetOut_trade_no(time());  /* 订单编号 */
        $pay->SetTotal_fee('1');  /* 订单总金额 */
        $pay->SetTrade_type('JSAPI'); /* 支付类型 */

        $order = $this->getJsApiPaySign($pay);

        return $order;
    }


    //NATIVE
    private function getJsApiPaySign($pay)
    {
//        $wxOrder = new \WxPayApi::unifiedOrder($pay);
        $wxOrder = WxPayApi::unifiedOrder($pay);
        if($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] != 'SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
        }

        $this->recordPreOrder($wxOrder);
        return $this->sign($wxOrder);
    }

    private function recordPreOrder(){
        return true;
    }

    private function sign($pay){
        $sign = new WxPayJsApiPay();
        $sign->SetAppid($this->appid);
        $sign->SetTimeStamp((string)time());
        $sign->SetNonceStr(md5(time().mt_rand(0,1000)));
        $sign->SetPackage('prepay_id='.$pay['prepay_id']);
        $sign->SetSignType('md5');
        $s = $this->MakeSign($sign);
        $sign->SetPaySign($s);
        $value = $sign->GetValues();
        return $value;
    }

    private function MakeSign($sign){
        $val = $sign->GetValues();
        //签名步骤一：按字典序排序参数
        ksort($val);
        $string = $this->ToUrlParams($val);
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=".$this->key;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }

    /**
     * 格式化参数格式化成url参数
     */
    private function ToUrlParams($val)
    {
        $buff = "";
        foreach ($val as $k => $v)
        {
            if($k != "sign" && $v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }
}