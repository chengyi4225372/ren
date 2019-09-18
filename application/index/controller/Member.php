<?php

namespace app\index\controller;

use app\index\controller\Common;
use think\Db;
use think\Session;

class Member extends Common
{

    //检测用户是否登录
    /*
    public function initialize()
    {
      parent::initialize();
      if(!check_login()){
          $this->redirect('login/login');
      }
    }
    */


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
        session('member',null);
        session_destroy();
        $this->redirect('login/login');
    }


}