<?php

namespace plugins\Helloworld\Controller;
use Api\Controller\PluginController;

class IndexController extends PluginController{
	
	function index(){
		$this->display(":index");
	}

}
