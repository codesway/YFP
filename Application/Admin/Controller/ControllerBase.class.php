<?php
namespace Admin\Controller;
use Think\Controller;
use Service\User;

class ControllerBase extends Controller {


  public function _initialize() {
    if ($this->checkLogin()) {
      return $this->index();
    }
    return $this->redirect('index/login');
  }

  protected function checkLogin() {
    $cookieCode = cookie('yfp_id');
    if (empty($cookieCode)) {
      return $this->noticeNotLogin();
    }
    $user = new User\UserService();
    $info = $user->decryptSession($cookieCode);
    if (empty($info['uid'])) {
      return $this->noticeNotLogin();
    }
    if ($info['time'] < time()) {
      return $this->noticeNotLogin('已超时，请重新登录');
    }
    $userInfo = $user::getUser($info['uid']);
    if (empty($userInfo)) {
      $this->noticeNotLogin();
    }
    $this->userInfo = $userInfo;
    return true;
  }


  protected function noticeNotLogin($notice = '请登录') {
    return $this->error($notice, U('admin/index/index'));
  }
}
