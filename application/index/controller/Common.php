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

    //上传图片
    public function  uploads()
    {
        $file = request()->file('file');
        // 移动到框架应用根目录
        $path = 'static/upimgs/';

        if (!is_dir($path)){
             mkdir($path,0755,true);
        }

        $info  = $file->move($path);
        if($info){
             $str = $info->getSaveName();
             $str = str_replace('\\','/',$str);
             return  json(['code'=>200,'msg'=>'上传成功','path'=>'/'.$path.$str]);
        }else{
            /* 上传失败获取错误信息
            $file->getError();*/
            return json(['code'=>400,'msg'=>'上传失败']);
        }
    }


}
