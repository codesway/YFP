<?php
namespace Admin\Controller;
use Think\Controller;
use Service\User;

class ControllerBase extends Controller {
  protected $userInfo = [];

  public function _initialize() {
    $cookieCode = cookie('yfp_id');
    $user = new User\UserService();
    $info = $user::decryptSession($cookieCode);
    if (!empty($info) && $info['time'] > time()){
      $this->userInfo = $info;
    }
  }

  protected function checkLogin() {
    $uri = '';

    if (empty($this->userInfo)) {
      return $this->redirect('account/login?jump=' . urlencode($uri), '请先登录');
    }

  }

}
