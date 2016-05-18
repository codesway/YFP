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
}
