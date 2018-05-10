<?php
namespace app\index\controller;
use think\View;
use think\Controller;
class Regist extends Controller{
  public function index()
  {
   $view = new View();
   return $view->fetch('index');
  }
     public function regist(){
  //实例化User
  $user = new User;
  //接收前端表单提交的数据
  $user->user_name = input('post.UserName');
  $user->user_sex = input('post.UserSex');
  $user->user_tel = input('post.UserTel');
  $user->user_email = input('post.UserEmail');
  $user->user_address = input('post.UserAddress');
  $user->user_birth = input('post.UserBirth');
  $user->user_passwd = input('post.UserPasswd');
  $user->user_signature = input('post.UserSignature');
  $user->user_hobby = input('post.UserHobby');
  //进行规则验证
  $result = $this->validate(
    [
      'name' => $user->user_name,
      'email' => $user->user_email,
      'sex' => $user->user_sex,
      'tel' => $user->user_tel,
      'address' => $user->user_address,
      'birth' => $user->user_birth,
      'password' => $user->user_passwd,
    ],
    [
      'name' => 'require|max:10',
      'email' => 'email',
      'sex' => 'number|between:0,1',
      'tel' => 'require',
      'address' => 'require',
      'birth' => 'require',
      'password' => 'require',
    ]);
  if (true !== $result) {
    $this->error($result);
  }
  //写入数据库
  if ($user->save()) {
    return $this->success('注册成功');
  } else {
    return $this->success('注册失败');
  }
}
}