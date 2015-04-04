<?php

/**
 * 验证码处理
 */
namespace Api\Controller;
use Think\Controller;
class CheckcodeController extends Controller {

    public function index() {
    	
    	$length=4;
    	if (isset($_GET['length']) && intval($_GET['length'])){
    		$length = intval($_GET['length']);
    	}
    		
    	//设置验证码字符库
    	$code_set="";
    	if(isset($_GET['charset'])){
    		$code_set= trim($_GET['charset']);
    	}
    	
    	$use_noise=1;
    	if(isset($_GET['use_noise'])){
    		$use_noise= intval($_GET['use_noise']);
    	}
    	
    	$use_curve=1;
    	if(isset($_GET['use_curve'])){
    		$use_curve= intval($_GET['use_curve']);
    	}
    	
    	$font_size=25;
    	if (isset($_GET['font_size']) && intval($_GET['font_size'])){
    		$font_size = intval($_GET['font_size']);
    	}
    	
    	$width=0;
    	if (isset($_GET['width']) && intval($_GET['width'])){
    		$width = intval($_GET['width']);
    	}
    	
    	$height=0;
    		
    	if (isset($_GET['height']) && intval($_GET['height'])){
    		$height = intval($_GET['height']);
    	}
    	
    	$background="";
    	if (isset($_GET['background']) && trim(urldecode($_GET['background'])) && preg_match('/(^#[a-z0-9]{6}$)/im', trim(urldecode($_GET['background'])))){
    		$background=trim(urldecode($_GET['background']));
    	}
    	
    	$config = array(
	        'codeSet'   =>  !empty($code_set)?$code_set:"2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY",             // 验证码字符集合
	        'expire'    =>  1800,            // 验证码过期时间（s）
	        'useImgBg'  =>  false,           // 使用背景图片 
	        'fontSize'  =>  !empty($font_size)?$font_size:25,              // 验证码字体大小(px)
	        'useCurve'  =>  $use_curve===0?false:true,           // 是否画混淆曲线
	        'useNoise'  =>  $use_noise===0?false:true,            // 是否添加杂点	
	        'imageH'    =>  $height,               // 验证码图片高度
	        'imageW'    =>  $width,               // 验证码图片宽度
	        'length'    =>  !empty($length)?$length:4,               // 验证码位数
	        'bg'        =>  array(243, 251, 254),  // 背景颜色
	        'reset'     =>  true,           // 验证成功后是否重置
    	);
    	$Verify = new \Think\Verify($config);
    	$Verify->entry();
    }
    
    public function test(){
    	import("Checkcode");
        $checkcode = new \Checkcode();
        if (isset($_GET['code_len']) && intval($_GET['code_len']))
            $checkcode->code_len = intval($_GET['code_len']);
        if ($checkcode->code_len > 8 || $checkcode->code_len < 2) {
            $checkcode->code_len = 4;
        }
        //设置验证码字符库
        if(isset($_GET['charset'])){
        	$checkcode->charset = trim($_GET['charset']);
        }
        //强制验证码不得小于4位
        if($checkcode->code_len < 4){
            $checkcode->code_len = 4;
        }
        if (isset($_GET['font_size']) && intval($_GET['font_size']))
            $checkcode->font_size = intval($_GET['font_size']);
        if (isset($_GET['width']) && intval($_GET['width']))
            $checkcode->width = intval($_GET['width']);
        if ($checkcode->width <= 0) {
            $checkcode->width = 130;
        }
        if (isset($_GET['height']) && intval($_GET['height']))
            $checkcode->height = intval($_GET['height']);
        if ($checkcode->height <= 0) {
            $checkcode->height = 50;
        }
        if (isset($_GET['font_color']) && trim(urldecode($_GET['font_color'])) && preg_match('/(^#[a-z0-9]{6}$)/im', trim(urldecode($_GET['font_color']))))
            $checkcode->font_color = trim(urldecode($_GET['font_color']));
        if (isset($_GET['background']) && trim(urldecode($_GET['background'])) && preg_match('/(^#[a-z0-9]{6}$)/im', trim(urldecode($_GET['background']))))
            $checkcode->background = trim(urldecode($_GET['background']));
        $checkcode->doimage();
        
        $verify = new \Think\Verify();
        
        //验证码类型
        $type = I("get.type");
        $type = $type?strtolower($type):"verify";
        $verify = session("_verify_");
        if(empty($verify)){
            $verify = array();
        }
        $verify[$type] = $checkcode->get_code();
        session("_verify_",$verify);
    }

}

