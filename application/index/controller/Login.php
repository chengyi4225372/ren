<?php
namespace app\index\controller;

use think\Db;
use app\index\controller\Common;
class Login extends Common
{

    public function login(){
        return $this->fetch();
    }


}

