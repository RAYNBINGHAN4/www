<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/31
 * Time: 16:33
 */

namespace Admin\Model;


use Think\Model;

class SupplierModel extends BaseModel
{
    // 自动验证
    protected $_validate = array(
        array('name', 'require', '供货商名称不能够为空!'),
        //unique唯一性附加规则
        array('name', '', '供货商名称不能重复!', '', 'unique'),
        array('intro', 'require', '供货商简介不能够为空!')
    );
}