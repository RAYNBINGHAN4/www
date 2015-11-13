<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function menu(){
        //向首页添加菜单栏数据
        $menuModel = D('Menu');
        $result = $menuModel->getList('id,url,name,parent_id,level');
        $this->assign('menus',$result);
        $this->display('menu');
    }


}