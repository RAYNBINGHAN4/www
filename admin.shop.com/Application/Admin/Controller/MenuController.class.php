<?php
namespace Admin\Controller;


use Think\Controller;

class MenuController extends BaseController{
	protected $meta_title = 菜单;

	protected $usePostAllParams = true;

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
		//准备权限页面展示数据提供......
		$result = $this->model->getList();
		$this->assign('nodes',json_encode($result));

		//准备权限页面展示数据提供......
		$permissionModel = D('permission');
		$result = $permissionModel->getList();
		$this->assign('nodes1',json_encode($result));

		$id = I('get.id');
		if(!empty($id)){
			//说明是编辑,展示树结构数据后再添加权限回显数据
			$permission_ids  =  $this->model->getPermissionIdByMenuId($id);
			$this->assign('permission_ids',json_encode($permission_ids));

		}
	}
}
