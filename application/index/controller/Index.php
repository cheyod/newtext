<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
class Index extends Controller
{
    public function index(){
        
        $goods = db('goods')->select();
        $sumprice = db('goods')->sum('saleprice');
        $profit = 0;
        foreach ($goods as $key => $v) {
        	$profit += $v['saleprice'] - $v['stockprice'] - $v['poundage'] - $v['freight'];
        }

        $this->assign('goods',$goods);
        $this->assign('sumprice',$sumprice);
        $this->assign('profit',$profit);
        return view();
    }

    public function add(){
    	Db::startTrans();
		try{
		    $data = input();
		    $data['creattime'] = date('Y-m-d H:i:s');
		    $data['number'] = 1;

		    $res = db('goods')->insert($data);
		    if($res !== false){
		    	// 提交事务
		    	Db::commit();   
		    	return json('成功');
		    }
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    $this->error('系统错误');
		}

    }

    public function head(){
    	
    	return view();
    }

    public function left(){
    	
    	return view();
    }
    
    /**
     * 发送消息
     */
    public function send(){
        //链接服务器
        $connection = new AMQPStreamConnection('59.110.237.6',5672 ,'guest','guest');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false, false, false);
        
        $msg = new AMQPMessage(date('YmdHis'));
        $channel->basic_publish($msg, '', 'hello');
        
        $channel->close();
        $connection->close();
    }

    /**
     * 接收消息
     */
    public function receive(){
        $connection = new AMQPStreamConnection('59.110.237.6', 5672, 'guest', 'guest');
        
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

         $channel->basic_consume('hello', '', false, true, false, false, array($this,'callback'));

        while(count($channel->callbacks)) {
            $channel->wait();
            $channel->close();
            $connection->close();
        }
        
    }
    
    function callback($msg){
//        echo " [x] Received ". $msg->body. "\n";
        dump($msg->body);
    }
    
}