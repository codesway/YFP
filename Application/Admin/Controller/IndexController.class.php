<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\ControllerBase;
use Service\User;
class IndexController extends ControllerBase {


  public function _initialize() {
    parent::_initialize();
  }

  public function index(){
    $this->display();
  }

  public function login() {
    $this->display();
  }

  public function dologin() {

    // if (!IS_POST) {
    //   $this->error('非法请求');
    // }
    // $code = I('code');
    // $userApi = new User\UserService();

    // if (empty($username) || empty($password) || empty($code)) {
    //   $this->error('参数错误, 请重新输入');
    // }

  }

  public function welcome() {

  }

  public function registerUser() {
    if (IS_POST) {
      if (I('password') !== I('checkword')) {
        $this->error('参数错误请重新输入');
      }
      $userApi = new User\UserService();
      return $userApi->addUser(I('username'), I('password'));
    }
    // $this->display();
  }

}
