<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/10
 * Time: 14:03
 */

namespace Admin\Model;


use Think\Model;

class GoodsMemberPriceModel extends Model
{

     /**
     * ������Ʒid��ѯ����Ӧ�Ļ�Ա����ͼ۸�
     * @param $goods_id
     * @return array   ���ػ�Ա�����Ӧ�ļ۸�
     *  array(
        1=>100,
        2=>200
        3=>300
        )
      */
    public function getMemberPrice($goods_id){
        $goodsMemberPrices = $this->field('member_level_id,price')->where(array('goods_id'=>$goods_id))->select();
        $member_level_ids = array_column($goodsMemberPrices,'member_level_id');
        $prices = array_column($goodsMemberPrices,'price');
        return  array_combine($member_level_ids,$prices);
    }
}