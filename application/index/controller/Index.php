<?php

namespace app\index\controller;

use think\Db;
use app\index\controller\Common;
 class Index extends Common {

     protected $hudong  = 'r_hudong'; //互动

     protected $member  = 'r_member'; //用户

     protected $message = 'r_message'; //留言

     //首页
     public function index(){
         return $this->fetch();
     }

     //推广
     public function  gui()
     {
         return $this->fetch();
     }

     //互动
     public function tui()
     {
         $list    =  Db::name($this->hudong)->order('create_at desc')->select();
         $member  =  Db::name($this->member)->field('id,users')->order('id desc')->select();
         $names   = array_column($member,'users','id');
         $this->assign('names',$names);
         $this->assign('list',$list);
         return $this->fetch();
     }

     //互动详情
     public function hu()
     {
         $id = input('get.id','','int');

         if(empty($id) || $id <= 0){
             return false;
         }

         $info    = Db::name($this->hudong)->where('id',$id)->find();

         $message = Db::name($this->message)->where('hid',$id)->order('create_at desc')->limit(40)->select();

         $member  = Db::name($this->member)->field('id,users')->order('id desc')->select();

         $names   = array_column($member,'users','id');

         $this->assign('info',$info);
         $this->assign('message',$message);
         $this->assign('names',$names);
         return  $this->fetch();
     }

     //评论 提交
     public function tmessage(){

            $data['hid']       = input('post.hid','','int');
            $data['mid']       = input('post.mid','','int');
            $data['content']   = input('post.content','','trim');

            if(empty($data['hid']) || $data['hid'] <= 0){
                return json(['code'=>403,'msg'=>'数据丢失，提交数据不合法']);
            }

            if(empty($data['mid']) || $data['mid'] <= 0){
              return json(['code'=>403,'msg'=>'数据丢失，提交数据不合法']);
            }

            $ret = Db::name($this->message)->insertGetId($data);

            if($ret){
                return  json(['code'=>200,'msg'=>'评论成功']);
            }else{
                return json(['code'=>200,'msg'=>'网络原因，请稍后再评论']);
            }

     }

}
