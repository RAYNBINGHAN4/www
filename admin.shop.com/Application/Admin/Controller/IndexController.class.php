<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function menu(){
        //����ҳ��Ӳ˵�������
        $menuModel = D('Menu');
        $result = $menuModel->getList('id,url,name,parent_id,level');
        $this->assign('menus',$result);
        $this->display('menu');
    }


}