<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
class Common extends Controller {

    protected  $request;

    protected  $session = '';


    public function initialize()
   {
       parent::initialize();
       $this->request;
       $this->check_login();
   }


    protected function check_login()
    {
        if(empty(session('member')) && !is_array(session('member'))){
              $this->redirect('login/login');
        }

    }

}
