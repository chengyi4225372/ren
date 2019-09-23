<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

class Login extends Controller
{
   protected  $member = 'r_member';


    //登录
    public function login(){

        if($this->request->isGet()){

             if($this->request->action() == 'login'){
                 if(!empty(session('member')) && is_array(session('member'))){
                    return $this->redirect('member/index');
                 }
             }

             return $this->fetch();
        }

        if($this->request->isPost()){
            $user = input('post.user');
            $pwd  = input('post.pwd');

            $res  = Db::name($this->member)->field('id,users,orderNo,level,status,pwd,rand')->where('users',$user)->find();

            if(empty($res)){
                return json(['code'=>401,'msg'=>'账号不存在']);
            }

            if($res['pwd'] != md5(md5($pwd).$res['rand'])){
                return  json(['code'=>401,'msg'=>'密码不正确']);
            }

            if($res && $res['pwd'] ==md5(md5($pwd).$res['rand'])){
                session('member',$res);
                return json(['code'=>200,'msg'=>'登陆成功']);
            }

        }

    }

    //注册
    public function reg(){

        if($this->request->isGet()){
            return $this->fetch();
        }

        if($this->request->isPost()){

           $orderNo = input('post.orderNo','','trim');
           $user    = input('post.user','','trim');
           $pwd     = input('post.pwd','','trim');
           $rand    = mt_rand('1000','9999');

           $res = Db::name($this->member)->insertGetId(array(
                'orderNo'=> $orderNo ?$orderNo:'',
                'users' =>$user,
                'pwd'  =>md5(md5($pwd).$rand),
                'rand' =>$rand,
           ));

           if($res){
               return json(['code'=>200,'msg'=>'注册成功']);
           }else{
               return json(['code'=>400,'msg'=>'注册失败']);
           }

        }

    }

    //检查用户名
    public function check()
    {
        $user = input('post.user','','trim');

        if(empty($user) || !isset($user)){
            return false;
        }

        $ret = Db::name($this->member)->where('users',$user)->find();

        if($ret){
           return json(['code'=>404,'msg'=>'用户名或手机号已经注册']);
        }else {
            return json(['code'=>200,'msg'=>'用户名可以使用']);
        }
    }



    //退出
    public function logout(){
        if(!empty(session('member')) && is_array(session('member'))){
            session('member',null);
            $this->redirect('login/login');
        }
    }

}

