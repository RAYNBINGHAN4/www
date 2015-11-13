<?php
namespace Admin\Model;


use Think\Model;

class RoleModel extends BaseModel
{
// 自动验证
    protected $_validate = array(
        array('name', "require", '角色名称不能够为空!'),
        array('intro', "require", '角色描述不能够为空!'),

    );

    /**
     * ($role_id = parent::add()失败可能性小故不用事务了)
     * @param mixed|string $requestAll  所有的请求参数
     * this->data  是create收集到的当前表中的数据
     * @return bool
     */
    public function add($requestAll) {
        //>>1.将请求中的数据保存到role表中
        $role_id = parent::add();
        if($role_id===false){
            return false;
        }
        //>>2.将用户选中的权限保存到role_permission的关系表中
        $result = $this->handlePermission($role_id,$requestAll['permission_ids']);
        if($result===false){
            return false;
        }
        return  $role_id;
    }

    /**
     * @param mixed|string $requestAll
     * @return bool
     */
    public function save($requestAll){
        //>>1.需要将this->data中的数据更新到role表中
        $result = parent::save();
        if($result===false){
            return false;
        }
        //>>2.需要将请求中的权限数据更新到中间表(原来的删除, 现在的添加进去)
        $result1 = $this->handlePermission($requestAll['id'],$requestAll['permission_ids']);
        if($result1===false){
            return false;
        }
        return $result;
    }





    /**
     * @param $role_id 角色ID
     * @param $permission_ids 权限ID集
     * @return bool
     */
    private function handlePermission($role_id,$permission_ids){
        $rows = array();
        foreach($permission_ids as $permission_id){
            $rows[] = array('role_id'=>$role_id,'permission_id'=>$permission_id);
        }
        $rolePermissionModel = M('RolePermission');
        $rolePermissionModel->where(array('role_id'=>$role_id))->delete();
        if(!empty($rows)){
            $result = $rolePermissionModel->addAll($rows);
            if($result===false){
                $this->error = '保存权限失败!';
                return false;
            }
        }
    }

    /**
     * 根据角色的id获取所有的权限id
     * @param $role_id
     * @return array
     */
    public function getPermissionIdByRoleId($role_id){
        $sql  = "select permission_id from role_permission where role_id=".$role_id;
        $rows = $this->query($sql);
        $permission_ids = array_column($rows,'permission_id');
        return $permission_ids;
    }


}