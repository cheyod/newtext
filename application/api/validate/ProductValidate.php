<?php
namespace app\api\validate;

class ProductValidate extends BaseValidate
{
    private $rult = [
        'id' => 'isEmpty'
    ];
    private $message = [
        'id' => 'ID不能为空'
    ];
    
    private function isEmpty($id){
        if(empty($id)){
            return false;
        }
        
        return true;
    }
}

