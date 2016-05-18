<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\ControllerBase;
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
    echo 'aa'; exit();
    if (!IS_POST) {
      $this->error('非法请求');
    }

    $username = I('username', '');
    $password = I('password', '');
    $code = I('code');
    if (empty($username) || empty($password) || empty($code)) {
      $this->error('参数错误, 请重新输入');
    }


  }
}
