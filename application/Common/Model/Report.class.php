<?php
namespace Common\Model;
use Common\Model\CommonModel;
class Dyc_reportModel extends CommonModel
{
	
	protected $_validate = array(
		array('report_name', 'require', '报表名称不能为空！', 1, 'regex', CommonModel:: MODEL_INSERT  ),
		
	);
	
	protected $_auto = array(
	    array('create_time','mGetDate',CommonModel:: MODEL_INSERT,'callback')
	);
	
	//用于获取时间，格式为2012-02-03 12:12:12,注意,方法不能为private
	function mGetDate() {
		return date('Y-m-d H:i:s');
	}
	
	protected function _before_write(&$data) {
		parent::_before_write($data);
		
		if(!empty($data['user_pass']) && strlen($data['user_pass'])<25){
			$data['user_pass']=sp_password($data['user_pass']);
		}
	}
	
}

