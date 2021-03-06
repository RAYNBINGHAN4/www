<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/3
 * Time: 13:01
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BaseModel extends Model
{
    // 批处理
    protected $patchValidate = true;

    public function getPageResult($wheres = array())
    {
        //>>3.准备一个数组专门来存放条件
        $wheres['status'] = array('neq', -1);
        //>>1.提供分页工具条
        $totalRows = $this->where($wheres)->count();  //获取总条数
        $listRows = C('PAGE_SIZE') ? C('PAGE_SIZE') : 10;
        $page = new Page($totalRows, $listRows);  //自己获取请求中的页面直接使用
        $pageHtml = $page->show();

        //>>2.提供当前列表数据
        $rows = $this->where($wheres)->limit($page->firstRow, $page->listRows)->select();
        //>>3.返回包含分页工具条和分页列表数据的数组
        return array('pageHtml' => $pageHtml, 'rows' => $rows);
    }

    /**
     * 根据id将status修改为传递过来的status的值
     * @param $id
     * @param $status
     * @return bool
     */
    public function changeStatus($id, $status)
    {
        $data = array('status' => $status);

        if ($status == -1) {
            //表示删除, 将name原始值修改为 xxxx_del
            $data['name'] = array('exp', "concat(name,'_del' )");//>>SQL:name = concat(name,'_del' )
        }
        //>>设置更新条件
        $this->where(array('id' => array('in', $id)));
        return parent::save($data);  //update supplier set  status = -1  ,  name = concat(name,'_del' ) where id = 6;
    }

    /**
     * 获取status=1并且通过sort排序的数据
     * @return mixed
     */
    public function getShowList($wheres=array(),$field="*"){
        $wheres['status'] = 1;
        return $this->where($wheres)->field($field)->order('sort')->select();
    }
}