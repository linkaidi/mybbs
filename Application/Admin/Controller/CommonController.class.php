<?php
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller {
    public function __construct()
    {   
        // 重载父类里的构造方法
        parent::__construct();
        // 验证是否登录
        if (empty($_SESSION['flag'])) {
            $this->error('请先登录','/Admin/Login/login');
        }
    }
}