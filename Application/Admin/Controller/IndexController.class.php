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
    return $this->welcome();
  }

  public function login() {
    if (IS_POST) {
      $userApi = new User\UserService();
      $userInfo = $userApi::login(I('username'), I('password'));
      if (empty($userInfo)) {
        $this->error('用户名或密码错误，请重新输入');
      }
      //注册COOKIE
      $cookieCode = $userApi::encryptSession($userInfo['id']);
      cookie('yfp_id', $cookieCode);
      return $this->success('恭喜，登录成功', U('admin/index/index'));
    }
    return $this->display();
  }

  public function welcome() {
    return $this->display('index/index');
  }

  public function register() {
    if (IS_POST) {
      if (I('password') !== I('checkword')) {
        return $this->error('参数错误请重新输入');
      }
      $userApi = new User\UserService();
      if ($userApi::addUser(I('username'), I('password'))) {
        return $this->success('恭喜，注册成功', U('admin/index/index'));
      }
    }
    return $this->display();
  }

}
