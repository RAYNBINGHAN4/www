<?php
namespace Admin\Model;


use Admin\Service\NestedSetsService;
use Think\Model;

class GoodsCategoryModel extends BaseModel
{
// 自动验证
    protected $_validate = array(
        array('name', "require", '名称不能够为空!'),
//        array('parent_id', "require", '父分类不能够为空!'),
        array('lft', "require", '左边界不能够为空!'),
        array('rght', "require", '右边界不能够为空!'),
        array('level', "require", '级别不能够为空!'),
        array('intro', "require", '简介不能够为空!'),
        array('status', "require", '状态不能够为空!'),
        array('sort', "require", '排序不能够为空!'),
    );

    public function getList($wheres = array())
    {
        //>>过滤掉status=-1的数据和name不以_del结尾的数据
        $wheres['status']=array('neq',-1);
        $wheres['name'] = array('notlike','%_del%' );//>>可不要,添加这个为了解决treegrid的bug
        return $this->where($wheres)->order('lft')->select();
    }

    /**
     * 覆盖add方法加入自己的业务逻辑
     */
    public function add()
    {
        //>>1.使用NestedSetService业务类完成 边界的运算
        $dbMysqlInterfaceImplModel = new DbMysqlInterfaceImplModel();
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel, 'goods_category', 'lft', 'rght', 'parent_id', 'id', 'level');
        //>>2.才将数据添加到数据表中
        return $nestedSetService->insert($this->data['parent_id'], $this->data, 'bottom');
    }

    /**
     * 覆盖save方法加入自己的逻辑
     */
    public function save(){
        //>>1.使用NestedSetService业务类完成 边界的运算
        $dbMysqlInterfaceImplModel = new DbMysqlInterfaceImplModel();
        $nestedSetService = new NestedSetsService($dbMysqlInterfaceImplModel, 'goods_category', 'lft', 'rght', 'parent_id', 'id', 'level');
        //>>调用$nestedSetService工具对象中的moveUnder方法来完成移动类的规范(人家已经写好了规则* ^ *)
        $result = $nestedSetService->moveUnder($this->data['id'],$this->data['parent_id']);
        if($result===false){
            $this->error='不能添加到自己的子类中!^ . ^';
            return false;
        }
        //>>调用Model中save方法更新数据
       return parent::save();
    }


    /**
     * 将id以及id的子分类的状态修改掉
     * @param $id
     * @param $status
     */
    public function changeStatus($id, $status){ //>>这里需要排除一下status=-1的数据,以后补上
        //>>1.找到id以及子分类的id
        $sql = "select  child.id   from goods_category as parent,goods_category as child where child.lft>=parent.lft and child.rght<=parent.rght and parent.id = $id";
        $rows = $this->query($sql);
        //>>array_column方法支持>php5.5,自己定义了该方法在common下的function.php中.
        $ids =  array_column($rows,"id");
        //>>2.然后再修改其状态
        return parent::changeStatus($ids,$status);
    }
}