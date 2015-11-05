<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/31
 * Time: 17:48
 */


/**
 * 从模型中获取错误信息拼装为ul
 * @param $model(实例化模型对象)
 * @return string(html)
 */
function showErrors($model)
{
    $errors = $model->getError();
    $str = '<ul>';
    if(is_array($errors)){
        foreach ($errors as $error) {
            $str .= "<li>{$error}</li>";
        }
    }else{ //如果不是数组,直接拼装
        $str .= "<li>{$errors}</li>";
    }

    $str .= '</ul>';
    return $str;
}