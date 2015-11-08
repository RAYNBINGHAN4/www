<?php
namespace Admin\Controller;


use Think\Controller;

class GoodsCategoryController extends BaseController{
	protected $meta_title = 商品分类;


	public function index(){
		//>>查询goods_category表数据
		$result = $this->model->getList();

		//>>将数据使用assign方法加载到html页面
		$this->assign('meta_title',$this->meta_title);
		$this->assign('rows',$result);
		//>>加载html的页面
		cookie('__FORWARD__', $_SERVER['REQUEST_URI']);
		$this->display('index');
	}

	//在编辑页面展示之前向页面传递分类数据
	protected function _before_edit_view(){
		//为准备ztree树数据
		$result = $this->model->getList();
		$this->assign('nodes',json_encode($result));  //因为ztree中需要的是json字符串
	}
}
