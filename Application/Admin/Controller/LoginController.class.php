<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller {
    // 显示登陆页面
    public function login(){
        $this->display();
    }

    // 验证登录
    public function doLogin()
    {
        // 接收表单数据
        $uname = $_POST['uname'];
        $upwd  = $_POST['upwd'];
        $code  = $_POST['code'];

        // 验证验证码
        $verify = new \Think\Verify();
        
        if (!( $verify->check($code) )) {
            $this->error('验证码错误');
        }

        // 从数据表获取用户数据
        $user = M('bbs_user')->where("uname='{$uname}'")->find();
        
        // 验证是否有输入的用户名对应的用户数据，验证密码是否正确
        if ($user && password_verify($upwd,$user['upwd'])) {
            // 保存用户名在SESSION超全局数组
            $_SESSION['userInfo'] = $user;
            // 保存登录成功的标识
            $_SESSION['flag']  =  true;
            // 登录成功跳转后台首页
            $this->success('登录成功','/Admin');
        } else {
            $this->error('用户名或密码错误');
        }
    }

    // 退出登录
    public function logout()
    {
        unset($_SESSION['userInfo']);
        unset($_SESSION['flag']);
        $this->success('退出登录','/Admin/Login/login');
    }
    
    // 生成验证码
    public function code()
    {
        $config =    array(
            'fontSize' => 15,    // 验证码字体大小
            'length'   => 4,     // 验证码位数
            'useNoise' => false, // 关闭验证码杂点
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
}