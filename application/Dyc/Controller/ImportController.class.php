<?php
/**
 * Product(产品管理)
 */
namespace Dyc\Controller;

use Common\Controller\AdminbaseController;

class ImportController extends AdminbaseController {

    protected $menu_model;
    protected $auth_rule_model;
    protected $spxg_model;
    protected $shop_model;
    protected $sop_id;
    public function _initialize() {
        parent::_initialize();
        $this->menu_model = D("Common/Menu");
        $this->auth_rule_model = D("Common/AuthRule");
        $this->spxg_model = D("Common/Dyc_spxg");
        $this->shop_model = D("Common/Dyc_shop");
    }
    
    // UI for import excel
    public function index() {
        $shops=$this->shop_model->select();
        $this->assign("shops",$shops);
        $this->display();
    }


    public function upload_post(){
        if (IS_POST) {
            $upload_file=ajax_upload('/Upload/'); 
            $f='.'.trim($upload_file['name']);      
            
            $data=import_excel($f);
            
            $data_date=$_POST['data_date'];
            $shop=$_POST['shop'];
            for($i=0;$i<3;$i++){
                array_shift($data);
            }

            $cols=array_shift($data);//去标题并保存
            
            $Spxg = M("Dyc_spxg"); // 实例化Spxg对象
            $len=count($cols);

            foreach ($data as $k => $v) {
                $map = array();
                for($i=0;$i<$len;$i++){
                    $map[$cols[$i]] = $v[$i];
                }
                
                $map['数据日期'] = $data_date;//date('Y-m-d');             
                $map['数据导入日期'] = date('Y-m-d H:i:s');
                $map['店铺id'] =$shop;//I('request.shop');//$shop_id;

                if (!$Spxg->add($map)){
                    $this->error("保存失败！");
                }
            }
            $this->success("保存成功！");
        }
    }



    public function report() {
        $data = $this->product_model->order(array("id" => "DESC"))->select();
        $this->assign("products", $data);
        $this->display();
    }

}

