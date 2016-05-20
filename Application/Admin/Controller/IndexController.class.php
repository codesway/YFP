<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\ControllerBase;
use Service\User;
class IndexController extends ControllerBase {

  public function _initialize() {
    parent::_initialize();
    $this->checkLogin();
  }

  public function index(){
    return $this->welcome();
  }

  protected function welcome() {
    return $this->display('index/index');
  }

}
