<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    // 验证是否登录
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_info']['flag'])) {
            $this->error('请登录',U('Home/Index/index'),'');
        }
    }
}