<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace plugins\WeixinHelloworld;
use Weixin\Lib\WeixinPlugin;

/**
 * 微信Helloworld
 */
class WeixinHelloworldPlugin extends WeixinPlugin{

        public $info = array(
            'name'=>'WeixinHelloworld',
            'title'=>'世界，你好！',
            'description'=>'WeixinHelloworld',
            'status'=>1,
            'author'=>'无名',
            'version'=>'1.0',
        	'type'=>8
        );

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }
        
        //实现的weixin_msg_text钩子方法
        public function weixin_msg_text($postObj){
        	$response=\Weixin\Lib\Wechat::answer_text($postObj->ToUserName, $postObj->FromUserName, "helloworld");
        	exit($response);
        }

    }