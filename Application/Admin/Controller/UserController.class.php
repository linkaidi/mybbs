<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Image;
use Think\Upload;

class UserController extends CommonController {
    // 头像文件保存完整文件名
    // private $filename;
    
    // 添加用户
    public function create()
    {
        $this->display();
    }

    // 保存用户
    public function save()
    {
        // 接收添加用户表单数据
        $user_data_array = $_POST;

        // 用户名不能为空
        if (empty($user_data_array['user_name'])) {
            $this->error('用户名不能为空');
        } else {
            // 规定用户名不能包含空格字符
            $user_name_ptn = '/^[\S]*$/';
            $user_name_check_result = preg_match_all($user_name_ptn,$user_data_array['user_name']);
            if (!$user_name_check_result) {
                $this->error('用户名不能包含空格');
            }
        }

        // 密码不能为空
        if (empty($user_data_array['user_password']) || empty($user_data_array['user_repassword'])) {
            $this->error('密码不能为空');
        } else {
            // 规定密码不能包含空格字符
            $user_password_ptn = '/^[\S]*$/';
            $user_password_check_result = preg_match_all($user_password_ptn,$user_data_array['user_password']);
            $user_repassword_check_result = preg_match_all($user_password_ptn,$user_data_array['user_repassword']);
            if (!($user_password_check_result) || !($user_repassword_check_result)) {
                $this->error('密码不能包含空格');
            }
        }

        // 两次密码是否一致
        if ($user_data_array['user_password'] !== $user_data_array['user_repassword']) {
            $this->error('两次密码不一致');
        } else {
            unset($user_data_array['user_repassword']);
        }


        // 加密密码
        $user_data_array['user_password'] = password_hash($user_data_array['user_password'],PASSWORD_DEFAULT);

        // 如果没有选择权限，则默认选择普通用户权限
        if ( empty($user_data_array['user_level']) ) {
            $user_data_array['user_level'] = 1;
        }
        
        // 如果用户没有选择性别，则默认选择保密
        if ( ! (isset($user_data_array['user_sex'])) ) {
            $user_data_array['user_sex'] = 1;
        }
        
        // 用户初始状态默认为正常状态
        $user_data_array['user_status'] = 1;

        // 用户创建时间
        $user_data_array['user_register_time'] = time();

        // 上传头像  
        if ($_FILES['user_face']['error'] !== 4) {
            $user_data_array['user_face'] = $this->doUpload();
            $this->doSm();
        }

        // 保存用户数据到数据库
        $add_user_result = M('bbs_user')->add($user_data_array);
        
        if ($add_user_result) {
            $this->success('添加用户成功');
        } else {
            $this->error('添加用户失败');
        }
    }

    // 显示用户数据
    public function index()
    {
        // 定义一个条件空数组
        $search_condient = [];

        // 筛选用户性别
        if ( ! (empty($_GET['user_sex'])) ) {
            $search_condient['user_sex'] = ['eq',"{$_GET['user_sex']}"];
        }

        // 筛选用户等级
        if ( ! (empty($_GET['user_level'])) ) {
            $search_condient['user_level'] = ['eq',"{$_GET['user_level']}"];
        }

        // 筛选用户状态
        if ( ! (empty($_GET['user_status'])) ) {
            $search_condient['user_status'] = ['eq',"{$_GET['user_status']}"];
        }

        // 如果传入用户名
        if ( ! (empty($_GET['user_name'])) ) {
            $search_condient['user_name'] = ['like',"%{$_GET['user_name']}%"];
        }

        // 实例化用户表
        $user_object = M('bbs_user');

        // 实现分页功能
        // 查询满足要求的总记录数
        $user_count = $user_object->where($search_condient)->count();
        
        // 实例化分页类 传入总记录数和每页显示的记录数(3)
        $user_page  = new \Think\Page($user_count,4);
        
        // 分页显示输出
        $page_html_show  = $user_page->show();
        
        // 从数据库读取用户数据
        $users_data_array = $user_object->where($search_condient)
                   ->order('user_id')
                   ->limit($user_page->firstRow.','.$user_page->listRows)
                   ->select();

        // 处理显示缩略图
        foreach ($users_data_array as $k=>$user_data_array) {
            $users_data_array[$k]['user_face'] = getSm($user_data_array['user_face']); 
        }

        // 实现再次点击搜索，原筛选条件不变
        $keep_search_condient = $_GET;

        // 在模板中输出变量
        $this->assign('users_data_array',$users_data_array);
        $this->assign('page_html_show',$page_html_show);
        $this->assign('keep_search_condient',$keep_search_condient);
        
        $this->display();
    }

    // 删除用户数据
    public function del()
    {
        // 接收删除用户的ID
        $user_id = $_GET['user_id'];

        // 删除用户数据
        $delete_user_result = M('bbs_user')->delete($user_id);
        
        if ($delete_user_result) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    // 显示修改用户数据表单
    public function edit()
    {
        // 接收修改信息用户ID
        $user_id = $_GET['user_id'];
        
        // 查询用户数据
        $user_data_array = M('bbs_user')->find($user_id);
        
        //  如果用户原来没有头像
        if ($user_data_array['user_face'] == null) {
            $html_user_face = null;
        } else {
            //  如果用户原来有头像
            // 处理显示缩略图
            $user_data_array['user_face'] = getSm($user_data_array['user_face']); 
            $html_user_face = "<img src='/{$user_data_array['user_face']}'>";
        };

        // 输出模板
        $this->assign('user_data_array',$user_data_array);
        $this->assign('html_user_face',$html_user_face);

        $this->display();
    }

    // 接收修改用户数据，完成修改
    public function update()
    {   
        // 接收用户修改信息
        $user_data_array = $_POST;

        // 上传头像
        // 如果有文件上传
        if ($_FILES['user_face']['error'] !== 4) {
            $user_data_array['user_face'] = $this->doUpload();
            $this->doSm();
        }

        // 
        $update_user_result = M('bbs_user')->where("user_id=".$user_data_array['user_id'])->save($user_data_array);
        
        if ($update_user_result) {
            $this->success('修改成功');
        } else {
            $this->error("修改失败");
        }
    }

    // 头像上传
    protected function doUpload()
    {
                // 头像上传
                $config = array(
                    'maxSize'    =>    3145728,
                    'rootPath'   =>    './',
                    'savePath'   =>    'Public/Uploads/',
                    'saveName'   =>    array('uniqid',''),
                    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
                    'autoSub'    =>    true,
                    'subName'    =>    array('date','Ymd'),
                );
                // 实例化上传类
                $upload = new Upload($config);
                // 调用头像上传方法
                $info = $upload->upload();
                if(!$info) {
                    // 上传错误提示错误信息
                    $this->error($upload->getError());
                }
        
                // 处理文件上传成功后的完整文件名
                return $this->filename = $info['user_face']['savepath'].$info['user_face']['savename'];
    }

    // 生成缩略图
    protected function doSm()
    {
        // 实例化图像处理类
        $image = new Image(Image::IMAGE_GD,$this->filename);
        // 生成缩略图
        $image->thumb(150, 150)->save( getSm($this->filename) );
    }

}