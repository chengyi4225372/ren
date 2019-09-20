<?php

namespace app\index\controller;

use app\index\controller\Common;
use think\Db;

class Member extends Common
{

    protected $member = 'r_member';

    protected $hudong = 'r_hudong';


    //个人中心
    public function index(){
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

    //个人资料
    public function info(){

        if($this->request->isGet()){
            return $this->fetch();
        }

        if($this->request->isPost()){
              return true;
        }

    }

    //发布
    public function fabu(){
        if($this->request->isGet()){
            return $this->fetch();
        }

        if($this->request->isPost()){
           $data['mid']   = input('post.id','','int');
           $data['imgs'] = input('post.imgs','','trim');

           $time = time(); // 当前时间
           $outtime = 24 * 3600; //过期时间

           if(empty($data['mid']) || $data['mid'] != session('member.id')){
               return false;
           }

           $imgcount = Db::name($this->hudong)->where('mid',$data['mid'])->order('create_at desc')->value('create_at');

           $imgcount = strtotime($imgcount);


           if($time - ($imgcount+$outtime) < 0){
             return json(['code'=> 401,'msg'=>'一个会员一个只能发布一次互动图片']);
           }

           $res = Db::name($this->hudong)->insertGetId($data);

           if($res){
               return json(['code'=>200,'msg'=>'提交成功']);
           }else {
               return json(['code'=>400,'msg'=>'提交失败']);
           }

        }


    }


    //修改密码
    public function editpwd(){

        if($this->request->isGet()){
            return $this->fetch();
        }

        if($this->request->isPost()){
            $oldpwd = input('post.oldpwd','','trim');
            $newpwd = input('post.newpwd','','trim');
            $id     = input('post.id','','int');

            if($id != session('member.id') || empty($id)){
                return false;
            }

            $res   = session('member');

            if($res['pwd'] != md5(md5($oldpwd).$res['rand'])){
                return json(['code'=>400,'msg'=>'旧密码不正确']);
            }

            $updates =  Db::name($this->member)->where('id',$id)->update(['pwd'=>md5(md5($newpwd).$res['rand'])]);

           if($updates){
               return json(['code'=>200,'msg'=>'修改成功']);
           }else{
               return json(['code'=>404,'msg'=>'修改失败']);
           }

        }

    }


}