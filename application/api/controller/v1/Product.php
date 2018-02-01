<?php
namespace app\api\controller\v1;

use app\lib\exception\ProductException;
class Product
{
    public function selProduct(){
//        phpinfo();
        echo 123;
        1 / 0;
        echo 321;
        throw new ProductException(['msg' => '测试一下']);
    }
}

