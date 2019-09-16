<?php

namespace app\index\controller;

use app\index\controller\Common;
use think\Db;


class Member extends Common
{
    public function index(){
        return $this->fetch();
    }
}