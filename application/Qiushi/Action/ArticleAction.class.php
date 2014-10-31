<?php

/**
 * 文章内页
 */
namespace Qiushi\Action;
use Common\Action\HomeBaseAction;
class ArticleAction extends HomeBaseAction {
    //文章内页
    public function index() {
    	$this->display(":article");
    }
    
}
?>
