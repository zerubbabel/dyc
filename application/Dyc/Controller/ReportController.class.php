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
        $sql="select 数据日期 as 日期,b.shop_name as 店铺,客单价,下单转化率 from cmf_dyc_spxg a left join cmf_dyc_shop b on a.店铺id=b.id order by 数据日期 asc";
        $Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
        $data=$Model->query($sql);

        $this->assign("data",$data);
        $this->display();
    }

}

