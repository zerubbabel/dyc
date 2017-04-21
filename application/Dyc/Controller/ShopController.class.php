<?php
namespace Dyc\Controller;

use Common\Controller\AdminbaseController;

class ShopController extends AdminbaseController {

    protected $shop_model;

    public function _initialize() {
        parent::_initialize();
        $this->shop_model = D("Common/Dyc_shop");
    }

    // 店铺列表
    public function index() {
        $data = $this->shop_model->order(array("id" => "DESC"))->select();
        $this->assign("shops", $data);
        $this->display();
    }

    // 添加店铺
    public function shopadd() {
        $this->display();
    }
    
    // 添加店铺提交
    public function shopadd_post() {
    	if (IS_POST) {
            $shop = M("Dyc_shop");
            $data=array('shop_name' => I("post.name"));
            
            if ($shop->add($data)!==false) {
                $this->success("店铺添加成功",U("shop/index"));
            } else {
                $this->error("添加失败！");
            }
    	}
    }

    // 删除
    public function shopdelete() {
        $id = I("get.id",0,'intval');            
    	$status = $this->shop_model->delete($id);
    	if ($status!==false) {
    		$this->success("删除成功！", U('Shop/index'));
    	} else {
    		$this->error("删除失败！");
    	}                
    }

    // 编辑
    public function shopedit() {
        $id = I("get.id",0,'intval');        
        $data = $this->shop_model->where(array("id" => $id))->find();
        if (!$data) {
        	$this->error("该店铺不存在！");
        }
        $this->assign("data", $data);
        $this->display();
    }
    
    // 编辑提交
    public function shopedit_post() {
    	$id = I("request.id",0,'intval');
    	if (IS_POST) {
            $shop = M("Dyc_shop");
            $data=array('shop_name' => I("request.name"));
            $result=$shop->where(array("id" => $id))->save($data);
            if ($result!==false) {
                $this->success("修改成功！", U('Shop/index'));
            } else {
                $this->error("修改失败！");
            }   
    	}
    }

}

