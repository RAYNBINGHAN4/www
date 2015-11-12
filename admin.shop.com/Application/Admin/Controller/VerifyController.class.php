<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/12
 * Time: 2:07
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Verify;

class VerifyController extends Controller
{
    public function index(){
        $verifyModel = new Verify();
        $verifyModel->entry();
    }
}