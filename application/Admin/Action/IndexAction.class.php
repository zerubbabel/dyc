<?php

/**
 * 后台首页
 */
namespace Admin\Action;
use Common\Action\AdminbaseAction;
class IndexAction extends AdminbaseAction {
	
	
	function _initialize() {
		parent::_initialize();
	}
    //后台框架首页
    public function index() {exit("dd");
    	$this->initMenu();
        $this->assign("SUBMENU_CONFIG", json_encode(D("Menu")->menu_json()));
       	$this->display();
        
    }

    

}

?>
