<?php
namespace Dyc\Controller;

use Common\Controller\AdminbaseController;

class ReportController extends AdminbaseController {

    //protected $shop_model;

    public function _initialize() {
        parent::_initialize();
        //$this->shop_model = D("Common/Dyc_shop");
    }

    // 店铺列表
    public function dayly() {
        echo "day";
        /*
        $shop_name = I('request.name');
        if($shop_name){
            $where['shop_name'] = array('like',"%$shop_name%");
        }
        $count= $this->shop_model->where($where)->count();
        $page = $this->page($count, 20);
        $data = $this->shop_model
            ->where($where)
            ->order("id DESC")
            ->limit($page->firstRow, $page->listRows)
            ->select();
        $this->assign("shops", $data);
        $this->display();*/
    }

 
    


}

