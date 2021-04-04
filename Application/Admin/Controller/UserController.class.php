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
        $data = $_POST;

        // 用户名不能为空
        if (empty($data['uname'])) {
            $this->error('用户名不能为空');
        } else {
            // 规定用户名不能包含空格字符
            $ptn = '/^[\S]*$/';
            $res = preg_match_all($ptn,$data['uname']);
            if (!$res) {
                $this->error('用户名不能包含空格');
            }
        }

        // 密码不能为空
        if (empty($data['upwd']) || empty($data['reupwd'])) {
            $this->error('密码不能为空');
        } else {
            // 规定密码不能包含空格字符
            $ptn = '/^[\S]*$/';
            $res1 = preg_match_all($ptn,$data['upwd']);
            $res2 = preg_match_all($ptn,$data['reupwd']);
            if (!($res1) || !($res2)) {
                $this->error('密码不能包含空格');
            }
        }

        // 两次密码是否一致
        if ($data['upwd'] !== $data['reupwd']) {
            $this->error('两次密码不一致');
        } else {
            unset($data['reupwd']);
        }


        // 加密密码
        $data['upwd'] = password_hash($data['upwd'],PASSWORD_DEFAULT);

        // 如果没有选择权限，则默认选择普通用户权限
        if ( empty($data['author']) ) {
            $data['author'] = 'p';
        }
        
        // 如果用户没有选择性别，则默认选择保密
        if ( ! (isset($_POST['sex'])) ) {
            $data['sex'] = 'x';
        }
        
        // 用户创建时间
        $data['ctime'] = time();

        // 上传头像  
        if ($_FILES['uface']['error'] !== 4) {
            $data['uface'] = $this->doUpload();
            $this->doSm();
        }

        // 保存用户数据到数据库
        $row = M('bbs_user')->add($data);
        
        if ($row) {
            $this->success('添加用户成功');
        } else {
            $this->error('添加用户失败');
        }
    }

    // 显示用户数据
    public function index()
    {
        // 定义一个条件空数组
        $condient = [];

        // 如果传入用户性别
        if ( ! (empty($_GET['sex'])) ) {
            $condient['sex'] = ['eq',"{$_GET['sex']}"];
        }

        // 如果传入用户权限
        if ( ! (empty($_GET['author'])) ) {
            $condient['author'] = ['eq',"{$_GET['author']}"];
        }

        // 如果传入用户名
        if ( ! (empty($_GET['uname'])) ) {
            $condient['uname'] = ['like',"%{$_GET['uname']}%"];
        }

        $m = M('bbs_user');

        // 实现分页功能
        // 查询满足要求的总记录数
        $count = $m->where($condient)->count();
        // 实例化分页类 传入总记录数和每页显示的记录数(3)
        $Page  = new \Think\Page($count,3);
        // 分页显示输出
        $show  = $Page->show();
        
        // 从数据库读取用户数据
        $users = $m->where($condient)
                   ->order('uid')
                   ->limit($Page->firstRow.','.$Page->listRows)
                   ->select();

        // 处理显示缩略图
        foreach ($users as $k=>$v) {
            $users[$k]['uface'] = getSm($v['uface']); 
        }

        $cond = $_GET;

        // 在模板中输出变量
        $this->assign('users',$users);
        $this->assign('show',$show);
        $this->assign('cond',$cond);
        
        $this->display();
    }

    // 删除用户数据
    public function del()
    {
        $uid = $_GET['uid'];
        // 删除用户数据
        $row = M('bbs_user')->delete($uid);

        if ($row) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    // 显示修改用户数据表单
    public function edit()
    {
        $uid = $_GET['uid'];
        // 查询用户数据
        $user = M('bbs_user')->find($uid);
        
        // 处理显示缩略图
        $user['uface'] = getSm($user['uface']); 

        // 输出模板
        $this->assign('user',$user);

        $this->display();
    }

    // 接收修改用户数据，完成修改
    public function update()
    {   
        $data = $_POST;

        // 上传头像
        // 如果有文件上传
        if ($_FILES['uface']['error'] !== 4) {
            $data['uface'] = $this->doUpload();
            $this->doSm();
        }

        $row = M('bbs_user')->where("uid=".$data['uid'])->save($data);
        if ($row) {
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
                return $this->filename = $info['uface']['savepath'].$info['uface']['savename'];
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