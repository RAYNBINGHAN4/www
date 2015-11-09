<?php
namespace Admin\Controller;


use Think\Controller;

class GoodsController extends BaseController{
	protected $meta_title = 商品;

	//页面展示之前被调用,向页面上分配数据
	protected function _before_edit_view()
	{
		//>>1.准备分类数据,分配到页面
		$goodsModel = D('GoodsCategory');
		$goodsCategoryes = $goodsModel->getList();
		$this->assign('nodes', json_encode($goodsCategoryes));

		//>>2.准备品牌数据, 分配到页面
		$brandModel = D('Brand');
		$brands = $brandModel->getShowList();
		$this->assign('brands', $brands);

		//>>3.准备供货商数据, 分配到页面
		$supplierModel = D('Supplier');
		$suppliers = $supplierModel->getShowList();
		$this->assign('suppliers', $suppliers);

		//>>4.准备编辑时回显的数据
		$id = I('get.id');
		if (!empty($id)) {

			//>>4.1准备编辑时商品简介的回显数据
			$introModel = M('GoodsIntro');
			$intro = $introModel->getFieldByGoods_id($id,'intro');
			$this->assign('intro', $intro);

			//>>4.2 准备当前商品对应的商品相册
			$goodsGalleryModel = D('GoodsGallery');
			$goodsGallerys = $goodsGalleryModel->getGalleryByGoods_id($id);
			$this->assign('goodsGallerys',$goodsGallerys);

			//>>4.3准备当前上面相关的文章数据
			$goodsArticleModel = D('GoodsArticle');
			$goodsAritcles = $goodsArticleModel->getArticleByGoodsId($id);
			$this->assign('goodsAritcles',$goodsAritcles);
		}


	}


	public function add()
	{
		if (IS_POST) {
			if ($this->model->create() !== false) {
				$requestAll = I('post.');
				//I('post.intro',false)中第三个参数false表示不做数据处理,保留了intro文本的html代码
				$requestAll['intro'] = I('post.intro','',false);
				if ($this->model->add($requestAll) !== false) {
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
			if ($this->model->create() !== false) {
				$requestAll = I('post.');
				//I('post.intro',false)中第三个参数false表示不做数据处理,保留了intro文本的html代码
				$requestAll['intro'] = I('post.intro','',false);
				if ($this->model->save($requestAll) !== false) {
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
	 * 根据商品相册的id删除图片
	 * @param $gallery_id
	 */
	public function deleteGallery($gallery_id){
		$goodsGalleryModel = D('GoodsGallery');

		$result = array('success'=>false);
		if($goodsGalleryModel->delete($gallery_id)!==false){
			$result['success'] = true;
		}
		//>>TP提供方法将数组转为json返回给html
		$this->ajaxReturn($result);
	}


}
