<?php

namespace plugins\WeixinHelloworld\Controller;
use Api\Controller\PluginController;

class IndexController extends PluginController{
	
	function index(){
		$this->display(":index");
	}

}
