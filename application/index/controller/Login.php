<?php
namespace app\index\controller;

use think\Db;
use app\index\controller\Common;
class Login extends Common
{

    //登录
    public function login(){
        return $this->fetch();
    }


    //注册
    public function reg(){
        return $this->fetch();
    }

}

