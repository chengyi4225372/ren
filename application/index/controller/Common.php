<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\Request;
class Common extends Controller {

    protected  $request;

    protected  $session = '';


    public function initialize()
   {
       parent::initialize();
       $this->request;
       $this->session = new Session;
       $this->check_login();
   }


    protected function check_login()
    {
        if($this->session->get('member') != ''){
             $this->redirect('index/index');
        }

        if($this->session->get('member') == ''){
             $this->redirect('login/login');
        }


    }

}
