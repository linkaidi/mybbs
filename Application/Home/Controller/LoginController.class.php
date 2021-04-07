<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    // 显示注册页面
    public function signUp()
    {
        $this->display();
    }

    // 接收用户注册信息，添加用户
    public function register()
    {
        if (IS_POST) {
            // 接收注册表单传入值
            $post_user_data['user_name'] = I('post.user_name/s','','/^[\S]+$/');
            $post_user_data['user_password'] = I('post.user_password/s','','/^[\S]{9,}+$/');
            $post_user_data['user_repassword'] = I('post.user_repassword/s','','/^[\S]{9,}$/');
            $post_user_data['user_phone'] = I('post.user_phone/d',0,'/^[\d]{11}$/');
            
            $home_login_signUp_url = U('Home/Login/signUp','','');

            // 判断传入数值是否合法
            if ( empty($post_user_data['user_name']) ) {
                $this->error('用户名不合法',$home_login_signUp_url,1);
            } else if ( empty($post_user_data['user_password']) ) {
                $this->error('密码不合法',$home_login_signUp_url,1);
            } else if ( $post_user_data['user_password'] !== $post_user_data['user_repassword'] ) {
                $this->error('两次密码不一致',$home_login_signUp_url,1);
            } else if ( empty($post_user_data['user_phone']) ) {
                $this->error('手机号码不合法',$home_login_signUp_url,1);
            }

            // 密码加密
            $post_user_data['user_password'] = password_hash($post_user_data['user_password'],PASSWORD_DEFAULT);
            unset($post_user_data['user_repassword']);
            
            // 注册时间
            $post_user_data['user_register_time'] = time();

            // 实例化用户表
            $bbs_user_object = M('bbs_user');

            // 查询用户表所有用户名,如果返回null，则没有同名
            if ( !is_null($bbs_user_object->where("user_phone='{$post_user_data['user_phone']}' OR user_name='{$post_user_data['user_name']}'")->find()) ) {
                $this->error('用户名或手机号已存在');
            }
            
            // 添加入用户表
            $add_user_result = $bbs_user_object->add($post_user_data);
            
            if ($add_user_result) {
                $this->success('注册成功',U('Home/index/index','',''),1);
            } else {
                $this->error('注册失败',$home_login_signUp_url,1);
            }

        } else {
            $this->error('非法请求');
        }
    }

    // 验证用户登录信息，登录操作
    public function doLogin()
    {   
        // 接收用户登录信息  
        $post_user_data['user_name'] = I('post.user_name/s','','/^[\S]+$/');
        $post_user_data['user_password'] = I('post.user_password/s','','/^[\S]{9,}+$/');

        // 判断用户登录信息是否合法
        if ( empty($post_user_data['user_name']) ) {
            $this->error('用户名不合法');
        } else if ( empty($post_user_data['user_password']) ) {
            $this->error('密码不合法');
        }

        // 查询用户名相同的用户信息
        $bbs_user_info = M('bbs_user')->where("user_name='{$post_user_data['user_name']}'")
                            ->field('user_id,user_name,user_password,user_level')
                            ->find();
        
        if ( password_verify($post_user_data['user_password'],$bbs_user_info['user_password']) ) {
            $_SESSION['user_info']['user_name'] = $bbs_user_info['user_name'];
            $_SESSION['user_info']['user_id'] = $bbs_user_info['user_id'];
            $_SESSION['user_info']['flag'] = true;
            // 如果用户等级大于2，则是管理员
            if ($bbs_user_info['user_level'] > 2) {
                $_SESSION['user_info']['user_level'] = 'admin';
            }
            $this->success('登录成功');
        } else {
            $this->error('用户名或密码错误');
        }

    } 

    // 退出登录
    public function logout()
    {
        unset($_SESSION['user_info']);
        $this->error('退出登录。。。',U('Home/Index/index'),1);
    }
}