<?php
namespace Dyc\Controller;

use Common\Controller\AdminbaseController;

class ReportController extends AdminbaseController {

    protected $report_model;

    public function _initialize() {
        parent::_initialize();
        $this->report_model = D("Common/Dyc_report");
    }

    // 店铺列表
    public function dayly() {
        $sql="select 数据日期 as 日期,b.shop_name as 店铺,客单价,下单转化率 from cmf_dyc_spxg a left join cmf_dyc_shop b on a.店铺id=b.id order by 数据日期 asc";
        $Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
        $data=$Model->query($sql);

        $this->assign("data",$data);
        $this->display();
    }

    public function index(){
        $report_name = I('request.name');
        if($report_name){
            $where['report_name'] = array('like',"%$report_name%");
        }
        $count= $this->report_model->where($where)->count();
        $page = $this->page($count, 20);
        $data = $this->report_model
            ->where($where)
            ->order("id DESC")
            ->limit($page->firstRow, $page->listRows)
            ->select();
        $this->assign("reports", $data);
        $this->display();
    }
    public function add(){
        $tables = M("Dyc_data_tables")->select();
        $defaultRow=array("id" => 0,"table_id" => "null","table_name" => "请选择数据表");
        array_unshift($tables,$defaultRow);
        $this->assign("tables", $tables);
        $this->display();
    }

    // 添加报表提交
    public function add_post() {
        if (IS_POST) {            
            $table_id=I("post.table");
            $where=array("id"=>$table_id);
            $table=M("Dyc_data_tables")->where($where)->select()[0]['table_id'];
            $cols=I("post.cols");
            $sql="select ";
            foreach ($cols as $key => $value) {
                if ($key!=0){
                    $sql.=",";
                }
                $sql.=$table.".".$value;
            }
            $sql.=" from $table";
            
            $data=array('report_name' => I("post.name"),'report_sql'=>$sql);
            $report = M("Dyc_report");
            if ($report->add($data)!==false) {
                $this->success("报表添加成功",U("report/index"));
            } else {
                $this->error("添加失败！");
            }
        }
    }

    public function get_cols(){
        $id=I('get.table_id');
        $where=array("id"=>$id);
        $table = M("Dyc_data_tables")->where($where)->select()[0]['table_id'];
        $sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name='".$table."'";
        $Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
        $cols=array();
        $cols=$Model->query($sql);                
        $this->ajaxReturn($cols);
    }

    public function del(){
        $id = I("get.id",0,'intval');
        if ($id) {
            $where=array("id"=>$id);
            if(M("Dyc_report")->where($where)->delete()!==false){
                $this->success("删除成功！");
            }else{
                $this->error("删除失败！");
            }   
        }
    }

}

