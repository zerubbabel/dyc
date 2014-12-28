<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace plugins\Helloworld;
use Common\Lib\Plugin;

/**
 * Helloworld
 */
class HelloworldPlugin extends Plugin{

        public $info = array(
            'name'=>'Helloworld',
            'title'=>'世界，你好！',
            'description'=>'helloworld',
            'status'=>1,
            'author'=>'无名',
            'version'=>'1.0'
        );

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }
        
        //实现的footer钩子方法
        public function footer($param){
        	$this->display('widget');
        }

    }