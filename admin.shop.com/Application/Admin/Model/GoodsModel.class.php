<?php
namespace Admin\Model;


use Think\Model;

class GoodsModel extends BaseModel
{
// 自动验证
    protected $_validate = array(
        array('name', "require", '名称不能够为空!'),
//    array('sn',"require",'货号不能够为空!'),
        array('goods_category_id', "require", '父分类不能够为空!'),
        array('brand_id', "require", '品牌不能够为空!'),
        array('supplier_id', "require", '供货商不能够为空!'),
        array('shop_price', "require", '本店价格不能够为空!'),
        array('market_price', "require", '市场价格不能够为空!'),
        array('stock', "require", '库存不能够为空!'),
        array('is_on_sale', "require", '是否上架不能够为空!'),
//        array('goods_status', "require", '商品状态不能够为空!'),
        array('keywd', "require", '关键字不能够为空!'),
//        array('logo', "require", 'LOGO不能够为空!'),
        array('status', "require", '状态不能够为空!'),
        array('sort', "require", '排序不能够为空!'),

    );


    /**
     * @param mixed|string $requestAll 请求中的所有数据,由于this->data过滤掉了除本数据表之外的所有数据.用此参数获取其他关联表数据
     * @return bool|mixed
     */
    public function add($requestAll)
    {
        $this->startTrans();//开启事务

        //>>1.调用自己封装的handleGoodsStatus()处理商品状态的数据处理.
        $this->handleGoodsStatus();
        //>>2.一定要调用parent上的add,因为先保存后才有id的值
        $id = parent::add();
        if ($id === false) {
            $this->rollback();
            return false;
        }
        //>>3.准备货号 并且将货号更新到数据库中    日期+八位的id   20151107000000id
        $sn = date('Ymd') . str_pad($id, 8, "0", STR_PAD_LEFT);
        $result = parent::save(array('sn' => $sn, 'id' => $id));
//        $result = parent::where('id='.$id)->save(array('sn'=>$sn));
        if ($result === false) {
            $this->error = '保存货号出错!';
            $this->rollback();
            return false;
        }

        //>>4.商品简介的保存处理
        $result = $this->handleGoodsIntro($id,$requestAll['intro']);
        if($result===false){
            return false;
        }

        //>>5.处理商品相册
        $result = $this->handleGoodsGallery($id,$requestAll['gallery_path']);  //$requestData['gallery']
        if($result===false){
            return false;
        }

        //>>6.关联文章的保存处理
        $result = $this-> handleGoodsArticle($id,$requestAll['article_id']);
        if($result===false){
            return false;
        }
//        >>7.处理商品会员价格
        $result = $this->handleGoodsMemberPrice($id,$requestAll['memberPrice']);
        if($result===false){
            return false;
        }



        $this->commit();
        return $id;  //add添加成功之后返回id
    }



    /**
     * 根据请求中的所有数据进行更新
     * @param mixed|string $requestAll 请求中的所有数据
     * @return bool
     */
    public function save($requestAll)
    {
        //>>1.由于多次调用数据库,开启事务处理
        $this->startTrans();
        //调用自己封装的handleGoodsStatus()处理商品状态的数据处理.
        $this->handleGoodsStatus();

        //>>2.调用保存商品简介方法保存
        $result = $this->handleGoodsIntro($this->data['id'],$requestAll['intro']);
        if($result===false){
            return false;
        }

        //>>3.调用保存商品相册方法保存
        $result = $this->handleGoodsGallery($this->data['id'],$requestAll['gallery_path']);
        if($result===false){
            return false;
        }

        //>>4.处理关联文章
        $result = $this->handleGoodsArticle($this->data['id'],$requestAll['article_id']);
        if($result===false){
            return false;
        }

        //>>5.处理会员价格
        $result = $this->handleGoodsMemberPrice($this->data['id'],$requestAll['memberPrice']);
        if($result===false){
            return false;
        }



        //保存更新
        $result = parent::save();
        $this->commit();
        return $result;

    }


//    ---------------------------------------封装方法------------------------------------

    /**
     * 将用户上传上来的图片保存保存到goods_gallery表中
     * @param $id   商品id
     * @param $gallery_paths   图片路径
     * @return bool
     */
    private function handleGoodsGallery($id,$gallery_paths){


        //每准备一个小数组将其放到rows中
        $rows = array();
        foreach($gallery_paths as $gallery_path){
            $rows[]=array('goods_id'=>$id,'path'=>$gallery_path);
        }
        //TP问题,当rows为空的时候会报错故判断之.....
        if(!empty($rows)){
            $goodsGalleryModel = M('GoodsGallery');
            $result = $goodsGalleryModel->addAll($rows);   //一次性保存多行数据(二维数组)
            if($result===false){
                $this->rollback();
                $this->error  = '保存图片出错!';
                return false;
            }
        }
    }



    /**
     * 根据商品的id和选中的关联文章的id保存到goods_article表中
     * @param $id
     * @param $article_ids
     * @return false | NULL
     */
    private function handleGoodsArticle($id,$article_ids){

        $rows = array();
        foreach($article_ids as $article_id){
            $rows[] =  array('goods_id'=>$id,'article_id'=>$article_id);
        }
        $goodsArticleModel = M('GoodsArticle');
        $goodsArticleModel->where(array('goods_id'=>$id))->delete();  //先删除再添加,完成更新的功能
        if(!empty($rows)){
            $result  = $goodsArticleModel->addAll($rows);
            if($result===false){
                $this->rollback();
                $this->error = '保存相关文章失败!';
                return false;
            }
        }
    }



    /**
     * 封装公共方法计算商品状态(goods_status)[按位相与]
     */
    private function handleGoodsStatus()
    {
        //>>1.处理请求中的商品状态 转换为 一个整数
        $goods_status = 0;
        foreach ($this->data['goods_status'] as $v) {
            $goods_status = $goods_status | $v;
        }
        $this->data['goods_status'] = $goods_status;
    }


    /**
     * 处理上面描述
     * @param $goods_id  商品的id
     * @param $intro     商品的简介
     * @return bool
     */
    private function handleGoodsIntro($goods_id, $intro)
    {
        $goodsIntroModel = M('GoodsIntro');
        //先删除原来的,再保存新的, 或者使用setField('intro',$requestData['intro'])进行更新.
        $goodsIntroModel->where(array('goods_id' => $goods_id))->delete();
        $result = $goodsIntroModel->add(array('goods_id' => $goods_id, 'intro' => $intro));
        if ($result === false) {
            $this->rollback();
            $this->error = '保存商品简介失败!';
            return false;
        }
    }

    /**
     * @param $goods_id
     * @param $memberPrices
     * ["memberPrice"] => array(3) {
     *   [1] => string(3) "300"       级别id=>价格
     *   [2] => string(3) "200"
     *   [3] => string(3) "100"
     *  }
     * @return bool
     */
    private function handleGoodsMemberPrice($goods_id,$memberPrices){
        //>>1.准备goods_member_price表中需要的数据
        $rows = array();
        foreach($memberPrices as $member_level_id=>$price){
            $rows[] = array('goods_id'=>$goods_id,'member_level_id'=>$member_level_id,'price'=>$price);
        }
        //>>2.再将rows保存到goods_member_price表中
        $goodsMemberPriceModel = M('GoodsMemberPrice');
        //先删除后添加
        $goodsMemberPriceModel->where(array('goods_id'=>$goods_id))->delete();
        if(!empty($rows)){
            $result = $goodsMemberPriceModel->addAll($rows);
            if($result===false){
                $this->error = '保存会员价格失败!';
                $this->rollback();
                return false;
            }
        }
    }
}