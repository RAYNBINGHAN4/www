<?php
namespace Admin\Model;


use Think\Model;

class PermissionModel extends BaseModel
{
// 自动验证
protected $_validate = array(
    array('name',"require",'权限名称不能够为空!'),
array('url',"require",'权限的URL不能够为空!'),
array('parent_id',"require",'父权限不能够为空!'),
array('lft',"require",'左边界不能够为空!'),
array('rght',"require",'右边界不能够为空!'),
array('level',"require",'级别不能够为空!'),
array('intro',"require",'简介不能够为空!'),
array('status',"require",'状态不能够为空!'),
array('sort',"require",'排序不能够为空!'),

);
}