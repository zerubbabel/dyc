<?php
namespace Dyc\Controller;

use Common\Controller\AdminbaseController;

class SettingController extends AdminbaseController {

    //protected $dep_model;

    public function _initialize() {
        parent::_initialize();
        //$this->shop_model = D("Common/Dyc_shop");
    }

    // 部门列表
    public function department() {
        $dep_name = I('request.name');
        if($dep_name){
            $where['dep_name'] = array('like',"%$dep_name%");
        }
        
        $dep_model = M("Dyc_departments");
        $count= $dep_model->where($where)->count();
        $page = $this->page($count, 20);
        $data = $dep_model
            ->where($where)
            ->order("id DESC")
            ->limit($page->firstRow, $page->listRows)
            ->select();
        $this->assign("deps", $data);
        $this->display();
    }

    // 添加部门
    public function depadd() {
        $this->display();
    }
    
    // 添加部门提交
    public function depadd_post() {
    	if (IS_POST) {
            $dep = M("Dyc_departments");
            $data=array('dep_name' => I("post.dep_name"));
            
            if ($dep->add($data)!==false) {
                $this->success("部门添加成功",U("setting/department"));
            } else {
                $this->error("添加失败！");
            }
    	}
    }

    // 删除
    public function depdelete() {
        $id = I("get.id",0,'intval');            
    	$status = M("Dyc_departments")->delete($id);
    	if ($status!==false) {
    		$this->success("删除成功！", U('setting/department'));
    	} else {
    		$this->error("删除失败！");
    	}                
    }

    // 编辑
    public function depedit() {
        $id = I("get.id",0,'intval');        
        $data = M("Dyc_departments")->where(array("id" => $id))->find();
        if (!$data) {
        	$this->error("该部门不存在！");
        }
        $this->assign("data", $data);
        $this->display();
    }
    
    // 编辑提交
    public function depedit_post() {
    	$id = I("request.id",0,'intval');
    	if (IS_POST) {
            $dep = M("Dyc_departments");
            $data=array('dep_name' => I("request.name"));
            $result=$dep->where(array("id" => $id))->save($data);
            if ($result!==false) {
                $this->success("修改成功！", U('Setting/department'));
            } else {
                $this->error("修改失败！");
            }   
    	}
    }


    // 日常工作列表
    public function work() {
        $work_name = I('request.name');
        if($work_name){
            $where['work_name'] = array('like',"%$work_name%");
        }
        
        $work_model = M("Dyc_work");

        $count= $work_model->where($where)->count();
        $page = $this->page($count, 20);
        $data = $work_model
            ->where($where)
            ->order("id DESC")
            ->limit($page->firstRow, $page->listRows)
            ->select();
        $this->assign("work", $data);
        $this->display();
    }

    // 添加日常工作
    public function workadd() {
        $this->display();
    }
    
    // 添加部门提交
    public function workadd_post() {
        if (IS_POST) {
            $work = M("Dyc_work");
            $data=array('work_name' => I("post.work_name"));
            
            if ($work->add($data)!==false) {
                $this->success("日常工作添加成功",U("setting/work"));
            } else {
                $this->error("添加失败！");
            }
        }
    }

    // 删除
    public function workdelete() {
        $id = I("get.id",0,'intval');            
        $status = M("Dyc_work")->delete($id);
        if ($status!==false) {
            $this->success("删除成功！", U('setting/work'));
        } else {
            $this->error("删除失败！");
        }                
    }

    // 编辑
    public function workedit() {
        $id = I("get.id",0,'intval');        
        $data = M("Dyc_work")->where(array("id" => $id))->find();
        if (!$data) {
            $this->error("该日常工作不存在！");
        }
        $this->assign("data", $data);
        $this->display();
    }
    
    // 编辑提交
    public function workedit_post() {
        $id = I("request.id",0,'intval');
        if (IS_POST) {
            $work = M("Dyc_work");
            $data=array('work_name' => I("request.name"));
            $result=$work->where(array("id" => $id))->save($data);
            if ($result!==false) {
                $this->success("修改成功！", U('Setting/work'));
            } else {
                $this->error("修改失败！");
            }   
        }
    }

}

