<?php
    defined('WEB_URL') or define('WEB_URL','http://admin.shop.com');
//    defined('WEB_URL') or define('WEB_URL','http://admin.shop.net');
return array(
    'TMPL_PARSE_STRING'  =>array(
        '__CSS__' => WEB_URL.'/Public/Admin/css', // 更改默认的/Public 替换规则
        '__JS__'     => WEB_URL.'/Public/Admin/js', // 增加新的JS类库路径替换规则
        '__IMG__' => WEB_URL.'/Public/Admin/images', // 增加新的上传路径替换规则
        '__LAYER__' => WEB_URL.'/Public/Admin/layer/layer.js', // 增加新的上传路径替换规则
        '__UPLOADIFY__'=>WEB_URL.'/Public/Admin/uploadify'
    )
);