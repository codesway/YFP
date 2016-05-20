<?php
namespace Admin\Controller;
use Think\Controller;
use Service\User;

class ControllerBase extends Controller {


  public function _initialize() {
    if (!$this->checkLogin()) {
      return $this->redirect('account/login?redirect_uri=');
    }
  }

  protected function checkLogin() {
    $cookieCode = cookie('yfp_id');
    if (empty($cookieCode)) {
      return false;
    }
    $user = new User\UserService();
    $info = $user->decryptSession($cookieCode);
    if (empty($info['uid'])) {
      return false;
    }
    if ($info['time'] < time()) {
      return false;
    }
    $userInfo = $user::getUser($info['uid']);
    if (empty($userInfo)) {
      false;
    }
    $this->userInfo = $userInfo;
    return true;
  }
}
