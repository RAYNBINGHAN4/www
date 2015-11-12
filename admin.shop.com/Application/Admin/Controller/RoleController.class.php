<?php
namespace Admin\Controller;


use Think\Controller;

class RoleController extends BaseController
{
    protected $meta_title = 角色;

    protected $usePostAllParams = true;

    protected function _before_edit_view()
    {
        //>>为add页面分配Permission数据
        $PermissionModel = D('Permission');
        $result = $PermissionModel->getList();
        $this->assign('nodes', json_encode($result));

        $id = I('get.id');
        if (!empty($id)) {
            //当编辑的时候
            //>>1.准备当前角色已经选择的权限
            $permission_ids = $this->model->getPermissionIdByRoleId($id);
            //>>2.因为页面上需要的是json数据,所以说需要先将改权限转换为json
            $this->assign('permission_ids', json_encode($permission_ids));
        }
    }

}
