<?php

/**
 * 附件上传
 */
namespace Asset\Controller;
use Common\Controller\AdminbaseController;
class AssetController extends AdminbaseController {


    function _initialize() {
    	$adminid=sp_get_current_admin_id();
    	$userid=sp_get_current_userid();
    	if(empty($adminid) && empty($userid)){
    		exit("非法上传！");
    	}
    }

    /**
     * swfupload 上传 
     */
    public function swfupload() {
        if (IS_POST) {
			
            //上传处理类
            $config=array(
                'rootPath' => './' . C("UPLOADPATH"),
                'subName'  => array('date', 'Y-m'),
                'savePath' => '',
                'maxSize'  => 11048576,
                'saveName' => array('uniqid', ''),
                'exts'     => array('jpg', 'gif', 'png', 'jpeg', "txt", 'zip'),
                'autoSub'  => true,
            );
			$upload = new \Think\Upload($config);// 
			$info=$upload->upload();
            //开始上传
            if ($info) {
                //上传成功
                //写入附件数据库信息
                $first=array_shift($info);
                
                $config = array(
                    "thumb"=> $_POST['thumb']? $_POST['thumb'] : 0, //是否产生缩略图
                    "thumb_width"=> $_POST['thumb_width']? $_POST['thumb_width'] : 800,
                    "thumb_height" => $_POST['thumb_height']? $_POST['thumb_height'] : 600, 
                    "max_width"=> $_POST['max_width']? $_POST['max_width'] : 1600,
                    "max_height" => $_POST['max_height']? $_POST['max_height'] : 1200, 
                );
                
                $filename =  str_replace(array('//','/./'),array('/','/'),C("TMPL_PARSE_STRING.__UPLOAD__").$first['savepath'] . $first['savename']);
                $img = new \Think\Image(\Think\Image::IMAGE_GD,SITE_PATH.$filename);
                
                //检查原图是否过大
                if($img->width() > $config['max_width'] || $img->height() > $config['max_height']){
                    $img->thumb($config['max_width'], $config['max_height']);
                    $img->save(SITE_PATH.$filename);
                }
                
                //检测是否需要压缩图片
                if($config['thumb']){
                    $img->thumb($config['thumb_width'], $config['thumb_height']);
                    $img->save(SITE_PATH.$filename.'.thumb.'.$first['ext']);
                }
                
                if($config['thumb']){
                    echo "1," . $filename.'.thumb.'.$first['ext'] .",".'1,'.$first['name'];
                }else{
                    echo "1," . $filename .",".'1,'.$first['name'];
                }
				exit;
            } else {
                //上传失败，返回错误
                exit("0," . $upload->getError());
            }
        } else {
            //上传数量,上传类型,是否产生缩略图,缩略图宽,缩略图高,是否加水印
            //1,jpg|jpeg|gif|png|bmp,1,1280,1024,1
            //10,gif|jpg|jpeg|png|bmp,1.360,300,0
            //echo SITE_PATH;
            $args = explode(',',$_GET['args']);
            $config = array(
                "SWFUPLOADSESSID"=>session_id(),
                "upnum"=>$args[0]? $args[0] :1,  //上传数量
                "filetype_post"=> $args[1]? $args[1] : "jpg|jpeg|gif|png|bmp|zip", //上传类型
                "thumb"=> $args[2]? $args[2] : 0, //是否产生缩略图
                "thumb_width"=> $args[3]? $args[3] : 800,
                "thumb_height" => $args[4]? $args[4] : 600, 
                "watermark_enable"=> $args[5]? $args[5] : 0, //加水印
            );
            $this->assign('config',$config);
            $this->display(':swfupload');
        }
    }

}
