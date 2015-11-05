<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/3
 * Time: 12:21
 */

namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller
{
    protected $model;
    public function _initialize()
    {
        //>>0.创建模型,该方法被Controller构造函数调用执行CONTROLLER_NAME要在有实例化对象$this只后才会有,处理URL方法在thinkPHP的model类中.
        $this->model = D(CONTROLLER_NAME);
    }
    public function index()
    {
        //>>1.获取搜索条件,拼凑sql条件语句like %搜索词%
        $keyWord = (I('get.keyword'));
        $wheres = array();
        if (!empty($keyWord)) {
            $wheres['name'] = array('like', "%$keyWord%");
        }
        //>>2.发送过滤条件语句,查询再分页
        $pageResult = $this->model->getPageResult($wheres);
        //>>3.需要将查询出来的数据分配到页面 assign
        $this->assign($pageResult);
        $this->assign('meta_supplier', $this->meta_title);
        cookie('__FORWARD__', $_SERVER['REQUEST_URI']);
        $this->display('index');
    }

    public function add()
    {
        if (IS_POST) {
            if ($this->model->create() !== false) {
                if ($this->model->add() !== false) {
                    $this->success('添加成功', cookie('__FORWARD__'));
                    return;
                }
            }
            $this->error('添加失败' . showErrors($this->model));
        } else {
            $this->assign('meta_supplier', $this->meta_title);
            $this->display('edit');
        }

    }


    public function edit($id)
    {
        if (IS_POST) {
            if ($this->model->create() !== false) {
                if ($this->model->save() !== false) {
                    $this->success('更新成功', cookie('__FORWARD__'));
                    return;
                }
            }
            $this->error('更新失败' . showErrors($this->model));
        } else {
            $result = $this->model->find($id);
            $this->assign($result);
            $this->assign('meta_supplier', $this->meta_title);
            $this->display('edit');
        }

    }

    public function changeStatus($id, $status = -1)
    {
        $result = $this->model->changeStatus($id, $status);
        if ($result !== false) {
            $this->success('修改成功', cookie('__FORWARD__'));
        } else {
            $this->error('修改失败');
        }

    }
}