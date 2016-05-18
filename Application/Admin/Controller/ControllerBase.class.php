<?php
namespace Admin\Controller;
use Think\Controller;

class ControllerBase extends Controller {


  public function _initialize() {
    $this->checkLogin();
  }

  protected function checkLogin() {

  }

}
