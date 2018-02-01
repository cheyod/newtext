<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\index\controller;
/**
 * Description of Order
 *
 * @author cheyod
 */
class Order extends Common{
    //put your code here
    
    public function image(){
        $image = \think\Image::open('static/timg.jpg');
        $width = $image->width(); 
        // 返回图片的高度
        $height = $image->height(); 
        // 返回图片的类型
        $type = $image->type(); 
        // 返回图片的mime类型
        $mime = $image->mime(); 
        // 返回图片的尺寸数组 0 图片宽度 1 图片高度
        $size = $image->size(); 
        //裁剪
//        $image->crop(800, 800)->save('static/crop.png');
//        $image->thumb(300, 300)->save('static/thumb.png');
        //缩略图
//        $image->text('cheyod','',20,'#ffffff')->save('static/cheyod.png');
        $image->water('static/thumb.png',\think\Image::WATER_SOUTHEAST,50)->save('static/cheyod.png');
//        dump($height);
    }
}
