<?php
namespace Admin\Controller;


use Think\Controller;

class MenuController extends BaseController{
	protected $meta_title = 菜单;

	public function index(){
		//>>查询Permission表中的数据提供给index页面展示.....
		$result = $this->model->getList($field="*");
		$this->assign('meta_title',$this->meta_title);
		$this->assign('rows',$result);
		//>>加载html的页面
		cookie('__FORWARD__', $_SERVER['REQUEST_URI']);
		$this->display('index');
	}


	protected function _before_edit_view(){
		//添加权限页面展示数据提供......
		$result = $this->model->getList('id,parent_id,name');
		$this->assign('meta_title',$this->meta_title);
		$this->assign('nodes',json_encode($result));
	}
}
