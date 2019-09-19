<?php

namespace app\index\controller;

use app\index\controller\Common;
use think\Db;

class Member extends Common
{

    //个人中心
    public function index(){
        return $this->fetch();
    }

    //个人资料
    public function info(){
        return $this->fetch();
    }


    //下级页面
    public function xia(){
        return $this->fetch();
    }


    //批准 待升级
    public function pi(){
        return $this->fetch();
    }

    //已升级
    public function shen(){
        return $this->fetch();
    }


    //退出
    public function logout(){
        $this->session->delete('member');
        $this->redirect('login/login');
    }


}