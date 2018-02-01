<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Wechat extends Controller
{
    /**
     * 支付信息
     * @return [type] [description]
     */
    public function wechatPayInfo()
    {

        db('')

        $cont = array(
                'appid'         => $this->appid,//微信分配的公众账号ID（企业号corpid即为此appId）必填
                'mch_id'        => $this->mchid,//微信支付分配的商户号必填
                'device_info'   => 'WEB',//终端设备号(门店号或收银设备ID)，注意：PC网页或公众号内支付请传"WEB"
                'nonce_str'     => $this->getNonceStr(),//随机字符串，不长于32位。推荐随机数生成算法 必填
                'sign'          => '',//签名，详见签名生成算法 必填
                'body'          => $data['body'],//商品简单描述，该字段须严格按照规范传递，具体请见参数规定 必填
                'detail'        => $data['detail'],
                'attach'        => $data['attach'],//附加数据，在查询API和支付通知中原样返回，该字段主要用于商户携带订单的自定义数据
                'out_trade_no'  => $data['out_trade_no'],//商户系统内部的订单号,32个字符内、可包含字母, 其他说明见商户订单号 必填
                'fee_type'      => 'CNY',//符合ISO 4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型
                'total_fee'     => $data['total_fee'],//订单总金额，单位为分，详见支付金额 必填
                'spbill_create_ip' => request()->ip(),//APP和网页支付提交用户端ip，Native支付填调用微信支付API的机器IP。 必填
                'time_start'    => date('YmdHis'),//订单生成时间，格式为yyyyMMddHHmmss，如2009年12月25日9点10分10秒表示为20091225091010。其他详见时间规则
                'time_expire'   => date('YmdHis',time()+1800),//订单失效时间，格式为yyyyMMddHHmmss，如2009年12月27日9点10分10秒表示为20091227091010。其他详见时间规则
                'goods_tag'     => $data['goods_tag'],//商品标记，代金券或立减优惠功能的参数，说明详见代金券或立减优惠
                'notify_url'    => $data['notify_url'],//接收微信支付异步通知回调地址，通知url必须为直接可访问的url，不能携带参数。 必填
                'trade_type'    => 'JSAPI',//取值如下：JSAPI，NATIVE，APP，详细说明见参数规定 必填
                'product_id'    => '',//trade_type=NATIVE，此参数必传。此id为二维码中包含的商品ID，商户自行定义。
                'limit_pay'     => 'no_credit',//no_credit--指定不能使用信用卡支付
                'openid'        => $data['openid']//trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识。openid如何获取，可参考【获取openid】。企业号请使用【企业号OAuth2.0接口】获取企业号内成员userid，再调用【企业号userid转openid接口】进行转换
            );
        $cont['sign'] = $this->MakeSign($cont,$this->key);
        return json_encode($cont);
    }


    function MakeSign($data,$key)
    {
        //签名步骤一：按字典序排序参数
        ksort($data);
        $string = $this->ToUrlParams($data);
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=".$key;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }

    function getNonceStr($length = 32) 
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {  
            $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
        } 
        return $str;
    }
}
