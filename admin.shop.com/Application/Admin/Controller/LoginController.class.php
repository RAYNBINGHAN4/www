<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/12
 * Time: 2:11
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Verify;

class LoginController extends Controller
{
    public function index()
    {
        if (IS_POST) {
            //验证码验证
//            $captcha = I('post.captcha');
//            $verifyModel = new Verify();
//            if ($verifyModel->check($captcha) === flase) {
//                $this->error('验证码错误!');
//            }
            //验证用户名和密码
            //>>1.接收请求参数
            $username = I('post.username');
            $password = I('post.password');
            //>>2.再进行验证登陆
            $loginService = D('Login', 'Service');
            //根据用户名和密码进行验证
            $result = $loginService->login($username, $password);
            if (is_array($result)) {  //是数组, 表示用户信息
                //登陆成功,将用户信息保存到session中
                login($result);
                //需要将当前用户能够访问的url地址保存到session中
                $permissions = $loginService->getPermissions($result['id']);
                savePermissionURL($permissions['urls']);
                savePermissionID($permissions['ids']);

                //完成自动登录信息的保存
                $remember = I('post.remember');
                if (!empty($remember)) {
                    //保存用户信息,saveAutoLogin(传入用户ID)
                    $loginService->saveAutoLogin($result['id']);
                }


                header('Content-Type: text/html;charset=utf-8');
                $this->success('登陆成功!', U('Index/index'));
            } else { //如果不是数组, 就是错误信息
                $this->error($result);
            }

        } else {
            $this->display('login');
        }
    }

    //>>登出账户
    public function logout()
    {
        logout();
        $this->success('退出成功！', U('index'));
    }


}