<?php

namespace app\index\controller;

use think\Db;
use app\index\controller\Common;
 class Index extends Common {

     //首页
     public function index(){

         return $this->fetch();
     }


     //推广 todo 需要修改
     public function tui()
     {
         return $this->fetch();
     }

     //规则
     public function  gui()
     {
         return $this->fetch();
     }

}
