<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/8
 * Time: 17:15
 */

namespace Admin\Model;


use Think\Model;

class GoodsArticleModel extends Model
{

    /**
     * ������Ʒ��id��ѯ�����������
     * @param $goods_id
     * @return bool
     */
    public function getArticleByGoodsId($goods_id){
        $sql = "SELECT  a.id,a.name  FROM goods_article as ga  join article as a on ga.article_id = a.id  where  ga.goods_id = $goods_id;";
        return $this->query($sql);
    }

}