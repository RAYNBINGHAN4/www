<?php
namespace Admin\Controller;


use Think\Controller;

class ArticleController extends BaseController{
	protected $meta_title = 文章分类;

	protected function _before_edit_view(){
		//>>1.准备文章分类数据
		$articleCategoryModel = D('ArticleCategory');
		$articleCategorys  = $articleCategoryModel->getShowList();
		$this->assign('articleCategorys',$articleCategorys);


	}


	public function add()
	{
		if (IS_POST) {
			if (($data = $this->model->create()) !== false) {
				$data['content'] = I('post.content','',false);
				if ($this->model->add($data) !== false) {
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


	public function edit($id)
	{
		if (IS_POST) {
			if (($data = $this->model->create()) !== false) {
				$data['content'] = I('post.content','',false);
				if ($this->model->save($data) !== false) {
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

	/**
	 * 根据关键字搜索
	 * @param $keyword
	 */
	public function search($keyword){
		$articleModel = D('Article');
		$wheres = array();
		$wheres['name'] = array('like',"%".$keyword."%");
		$rows = $articleModel->getShowList($wheres,"id,name");
		$this->ajaxReturn($rows);
	}


}
