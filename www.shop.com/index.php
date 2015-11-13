<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//
//// 应用入口文件
//
//// 检测PHP环境
//if (version_compare(PHP_VERSION, '5.3.0', '<')) {
//    die('require PHP > 5.3.0 !');
//}
//
//// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
//define('APP_DEBUG', true);
//
////define('BIND_MODULE','Admin');
//// 定义应用目录
//define('APP_PATH', './Application/');
//
//// 引入ThinkPHP入口文件
//require './ThinkPHP/ThinkPHP.php';
//// 亲^_^ 后面不需要任何代码了 就是如此简单



//>>入口文件修改为绝对路径 提高效率
//>>1.对比当前PHP运行的环境
version_compare(PHP_VERSION,'5.3.0','>=')  or exit('版本太低');
//>>2.定义项目的运行根目录
define('ROOT_PATH',dirname($_SERVER['SCRIPT_FILENAME']).'/');
//>>3.将ThinkPHP的框架目录定义为常量
define('THINK_PATH',dirname(ROOT_PATH).'/ThinkPHP'.'/');
//>>4.定义APP_PATH,指定应用目录
define('APP_PATH',ROOT_PATH.'Application'.'/');
//>>5.定义RUNTIME_PATH,指定运行目录
define('RUNTIME_PATH',ROOT_PATH.'Runtime'.'/');
//>>6.定义是否在调试模式下
define('APP_DEBUG',true);
//>>7.绑定模型
define('BIND_MODULE','Home');
//>>2.加载框架代码
require THINK_PATH.'ThinkPHP.php';
