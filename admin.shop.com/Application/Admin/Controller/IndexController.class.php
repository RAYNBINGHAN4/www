<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function menu()
    {
        //����ҳ��Ӳ˵�������,���ж��ǲ��ǳ�������Ա
        if (isSuperUser()) {
            $menuModel = D('Menu');
            $result = $menuModel->getList('id,url,name,parent_id,level');
        } else {
            $permissionIds = savePermissionID();
//            dump($permissionIds);
            if ($permissionIds) {
                $permissionIdsStr = implode($permissionIds, ',');
                $sql = "select distinct m.id,m.name,m.url,m.level,m.parent_id from menu as m join menu_permission as mp on m.id = mp.menu_id  where mp.permission_id in ($permissionIdsStr)";
//                dump($sql);
                $result = M()->query($sql);
//                dump($result);exit;
            }
        }
        $this->assign('menus', $result);
        $this->display('menu');
    }


}