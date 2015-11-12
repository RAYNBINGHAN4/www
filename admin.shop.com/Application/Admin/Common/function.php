<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/31
 * Time: 17:48
 */


/**---
 * 从模型中获取错误信息拼装为ul
 * @param $model (实例化模型对象)
 * @return string(html)
 */
function showErrors($model)
{
    $errors = $model->getError();
    $str = '<ul>';
    if (is_array($errors)) {
        foreach ($errors as $error) {
            $str .= "<li>{$error}</li>";
        }
    } else { //如果不是数组,直接拼装
        $str .= "<li>{$errors}</li>";
    }

    $str .= '</ul>';
    return $str;
}

/**
 * 返回input数组中键值为column_key的列， 如果指定了可选参数index_key，那么input数组中的这一列的值将作为返回数组中对应值的键。
 * @param $rows
 * @param $column_key
 * @return array
 * 就是把二位数组所有索引值为id(or 别的)的值取出来凑一个索引数组.
 */
if (!function_exists('array_column')) {
    function array_column($rows, $column_key)
    {
        $temp = array();
        foreach ($rows as $row) {
            $temp[] = $row[$column_key];
        }
        return $temp;
    }
}


/**
 * 根据传入的name和rows一个下拉列表的html
 * @param $name    表单元素的名字
 * @param $rows    下拉列表中需要的数据
 */
function arr2select($name, $rows, $defaultValue, $fieldValue = 'id', $fieldName = 'name')
{
    $html = "<select name='{$name}' class='{$name}' style='width: 146px'>
             <option value=''>&nbsp;&nbsp;&nbsp;--请选择--</option>";
    foreach ($rows as $row) {
        //根据默认值比对每一行,从而生成selected='selected',然后在option中使用.
        $selected = '';
        if ($row[$fieldValue] == $defaultValue) {
            $selected = "selected='selected'";
        }
        $html .= "<option value='{$row[$fieldValue]}' {$selected}>&nbsp;&nbsp;&nbsp;{$row[$fieldName]}</option>";
    }
    $html .= "</select>";
    echo $html;
}


/**
 * 如果传递的有用户信息, 将用户信息保存到session,
 * 如果没有用户信息,  是从session获取用户信息
 * @param $userinfo
 * @return bool
 */
function login($userinfo = null)
{
    if ($userinfo) {
        session('USERINFO', $userinfo);
    } else {
        return session('USERINFO');
    }
}

/**
 * 判定用户是否登陆
 * @return bool
 */
function isLogin()
{
    return login() !== null;
}

/**
 * 将session中的用户信息请求
 */
function logout()
{
    session('USERINFO', null);
}


function savePermissionURL($urls = null)
{
    if ($urls) {
        session('PERMISSIONURL', $urls);
    } else {
        return session('PERMISSIONURL');
    }
}
