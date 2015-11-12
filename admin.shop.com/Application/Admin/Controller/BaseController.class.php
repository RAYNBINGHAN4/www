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

    /**
     * add方法中是否使用到post请求中的所有数据
     * @var bool
     */
    protected $usePostAllParams = false;

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
        $this->assign('meta_title', $this->meta_title);
        cookie('__FORWARD__', $_SERVER['REQUEST_URI']);
        $this->display('index');
    }

    public function add()
    {
        if (IS_POST) {
            if ($this->model->create() !== false) {
                if ($this->model->add($this->usePostAllParams?I('post.'):'') !== false) {
                    $this->success('添加成功', cookie('__FORWARD__'));
                    return;
                }
            }
            $this->error('添加失败' . showErrors($this->model));
        } else {
            $this->_before_edit_view();
            $this->assign('meta_title', $this->meta_title);
            $this->display('edit');
        }

    }

    /**
     * 主要是被子类覆盖..  在编辑页面展示之前向编辑页面上分配数据
     */
    protected function _before_edit_view(){

    }

    public function edit($id)
    {
        if (IS_POST) {
            if ($this->model->create() !== false) {
                if ($this->model->save($this->usePostAllParams?I('post.'):'') !== false) {
                    $this->success('更新成功', cookie('__FORWARD__'));
                    return;
                }
            }
            $this->error('更新失败' . showErrors($this->model));
        } else {
            $result = $this->model->find($id);
            $this->assign($result);
            $this->assign('meta_title', $this->meta_title);
            $this->_before_edit_view();
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