<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class MainController extends AdminbaseController {
	
    public function index(){
    	$user_id=sp_get_current_admin_id();
    	$work=M('Dyc_user_work')
            ->alias('a')
            ->join('inner join cmf_dyc_work b on a.work_id=b.id')
            ->field('b.id,b.work_name')
            ->where('user_id='.$user_id)
            ->select();
    	$this->assign('work', $work);
        $xh=1;
        $this->assign('xh', $xh);
    	$this->display();
    }
}