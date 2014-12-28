<?php

namespace plugins\Demo\Controller;
use Api\Controller\PluginController;

class IndexController extends PluginController{
	
	function index(){
		$this->display(":index");
	}

}
