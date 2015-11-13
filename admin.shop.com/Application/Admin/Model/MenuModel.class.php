<?php
namespace Admin\Model;


use Admin\Service\NestedSetsService;
use Think\Model;

class MenuModel extends BaseModel
{
// 自动验证
    protected $_validate = array(
        array('name', "require", '菜单名称不能够为空!'),
        array('url', "require", '菜单URL不能够为空!'),
//        array('parent_id', "require", '父菜单不能够为空!'),
        array('intro', "require", '简介不能够为空!'),
        array('status', "require", '状态不能够为空!'),
        array('sort', "require", '排序不能够为空!'),

    );

    public function getList($field = 'id,parent_id,name')
    {
        return $this->where('status>=0')->field($field)->order('lft')->select();
    }

    public function add($requestAll)
    {
        //>>1.计算左右边界
        $dbMysqlInterfaceImplModel = D('DbMysqlInterfaceImpl');
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel, 'menu', 'lft', 'rght', 'parent_id', 'id', 'level');
        //>>2.再进行保存
        $id = $nestedSetService->insert($this->data['parent_id'], $this->data, 'bottom');
        if ($id === false) {
            return false;
        }

        //>>3.保存权限到menu_permission关系表中
        $result = $this->handlePermission($id, $requestAll['permission_ids']);
        if ($result === false) {
            return false;
        }
        return $id;
    }

    public function save($requestAll)
    {
        //>>1.计算左右边界
        $dbMysqlInterfaceImplModel = D('DbMysqlInterfaceImpl');
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel, 'menu', 'lft', 'rght', 'parent_id', 'id', 'level');

        //根据当前id查询出父权限的id(数据库中的id)  和  请求中的父权限的id进行对应

        //>>2.进行移动
        $result = $nestedSetService->moveUnder($this->data['id'], $this->data['parent_id']);
        if ($result === false) {
            $this->error = '移动权限失败!';
            return false;
        }

        //>>3.将原来的删除,现在的添加进去
        $result = $this->handlePermission($this->data['id'], $requestAll['permission_ids']);
        if ($result === false) {
            return false;
        }

        return parent::save($this->data);
    }


    ////////////////////////////////封装方法////////////////////////////////////////////////////
    /**
     * @param $menu_id 菜单id
     * @param $permission_ids 权限id集合
     * @return bool
     */
    private function handlePermission($menu_id, $permission_ids)
    {
        $rows = array();
        foreach ($permission_ids as $permission_id) {
            $rows[] = array('permission_id' => $permission_id, 'menu_id' => $menu_id);
        }
        $menuPermissionModel = M('MenuPermission');
        $menuPermissionModel->where(array('menu_id' => $menu_id))->delete();
        if (!empty($rows)) {
            $result = $menuPermissionModel->addAll($rows);
            if ($result === false) {
                $this->error = '保存权限失败!';
                return false;
            }
        }
    }


    /**
     * 根据菜单id查找到该菜单的权限
     * @param $menu_id 菜单ID
     * @return bool
     */
    public function getPermissionIdByMenuId($menu_id)
    {
        $sql = "select permission_id from menu_permission where menu_id = $menu_id";
        $rows = $this->query($sql);
        return array_column($rows, 'permission_id');
    }
}