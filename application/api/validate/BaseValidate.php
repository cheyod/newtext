<?php
namespace app\api\validate;

use think\Validate;
use think\Request;
class BaseValidate extends Validate
{
    public function goCheck(){
        $request = Request::instance();
        $parems = $request->parem();
        
        $result = $this->batch()->check($parems);
        if(!$result){
            $e = new ParameterException([
                'msg' => $this->error
            ]);
            throw $e;
        }else{
            return true;
        }
    } 
}

