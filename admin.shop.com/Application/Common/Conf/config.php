<?php
defined('WEB_URL') or define('WEB_URL', 'http://admin.shop.com');
//    defined('WEB_URL') or define('WEB_URL','http://admin.shop.net');
return array(
    'TMPL_PARSE_STRING' => array(
        '__CSS__' => WEB_URL . '/Public/Admin/css', // 更改默认的/Public 替换规则
        '__JS__' => WEB_URL . '/Public/Admin/js', // 增加新的JS类库路径替换规则
        '__IMG__' => WEB_URL . '/Public/Admin/images', // 增加新的上传路径替换规则
        '__LAYER__' => WEB_URL . '/Public/Admin/layer/layer.js', // 增加新的上传路径替换规则
        '__UPLOADIFY__' => WEB_URL . '/Public/Admin/uploadify',//文件上传工具
        '__TREEGRID__' => WEB_URL . '/Public/Admin/treegrid',//嵌套树分类插件
        '__ZTREE__' => WEB_URL . '/Public/Admin/zTree',   //ztree插件
        '__UEDITOR__' => WEB_URL . '/Public/Admin/ueditor',   //ueditor插件
        '__UPYUN__' => 'http://raynbinghan-brand.b0.upaiyun.com',//又拍云空间地址
        '__GOODS__' => WEB_URL . "/Uploads", // goods又拍云空间中的地址
    ),

    ////////////////////配置Redis为Session的驱动  开始///////////////////////
    'SESSION_AUTO_START' => true,    // 是否自动开启Session
    'SESSION_TYPE' => 'Redis',    //session类型
    'SESSION_PERSISTENT' => 1,        //是否长连接(对于php来说0和1都一样)
    'SESSION_CACHE_TIME' => 1,        //连接超时时间(秒)
    'SESSION_EXPIRE' => 0,        //session有效期(单位:秒) 0表示永久缓存
    'SESSION_PREFIX' => '',        //session前缀
    'SESSION_REDIS_HOST' => '127.0.0.1', //分布式Redis,默认第一个为主服务器
    'SESSION_REDIS_PORT' => '6379',           //端口,如果相同只填一个,用英文逗号分隔
    // 'SESSION_REDIS_AUTH'    =>  'redis123',    //Redis auth认证(密钥中不能有逗号),如果相同只填一个,用英文逗号分隔

    /////////////////////cookie的配置/////////////////////////////
//    'COOKIE_DOMAIN' => '.shop.com', // Cookie有效域名   可以被所有的子域名网站所共享
);
