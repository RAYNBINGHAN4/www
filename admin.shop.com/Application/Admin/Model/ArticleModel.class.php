<?php
namespace Admin\Model;


use Think\Model;

class ArticleModel extends BaseModel
{
// 自动验证
protected $_validate = array(
    array('name',"require",'标题不能够为空!'),
    array('article_category_id',"require",'文章分类不能够为空!'),
    array('content',"require",'内容不能够为空!'),
    array('times',"require",'浏览次数不能够为空!'),
    array('inputtime',"require",'录入时间不能够为空!'),
    array('intro',"require",'摘要不能够为空!'),
    array('status',"require",'状态不能够为空!'),
    array('sort',"require",'排序不能够为空!'),

);

    protected $_auto = array(
        array('inputtime',NOW_TIME)
    );

}