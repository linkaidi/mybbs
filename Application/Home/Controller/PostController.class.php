<?php
namespace Home\Controller;
use Think\Controller;
class PostController extends CommonController {
    // 显示发帖页面
    public function create()
    {
        // 是否是GET请求
        if (IS_GET) {
            // 接收从该版块跳转的ID
            $get_cate_id = I('get.cate_id/d',1);
            $get_part_id = I('get.part_id/d',1);

            // 获取下标为版块ID，值为版块名的一维数组
            $bbs_cates_name_array = M('bbs_cate')->order('cate_id')->getField('cate_id,cate_name');

            // 输出版块名数组
            $this->assign('bbs_cates_name_array',$bbs_cates_name_array);

            // 输出版块ID
            $this->assign('get_cate_id',$get_cate_id);
            $this->assign('get_part_id',$get_part_id);
            
            // 输出模板
            $this->display();
        } else {
            $this->error('非法请求');
        }
    }

    // 接收发帖数据，保存
    public function save()
    {
        // 检验是否是表单方式提交
        if (IS_POST) {
            // 接收版块ID
            $post_post_data['cate_id'] = I('post.cate_id/d',0);
            if ($post_post_data['cate_id'] === 0) {
                $this->error('请选择版块发帖');
            }

            // 接收帖子标题
            $post_post_data['post_title'] = I('post.post_title/s','','/^[\S]+$/');
            if (empty($post_post_data['post_title'])) {
                $this->error('帖子标题不能包含空白符');
            }

            // 接收帖子内容
            $post_post_data['post_content'] = I('post.post_content/s','');
            if (empty($post_post_data['post_content'])) {
                $this->error('帖子内容不能为空');
            }

            // 接收用户ID
            $post_post_data['user_info_array'] = I("session.user_info/a",[]);
            if (empty($post_post_data['user_info_array'])) {
                $this->error('请先登录',U('Home/Index/index'));
            }
            // 获取session数组的用户ID
            $post_post_data['user_id'] = $post_post_data['user_info_array']['user_id'];
            // 删除多余的session的用户数组信息
            unset($post_post_data['user_info_array']);

            // 获取发帖时间，更新帖子时间
            $post_post_data['post_update_time'] = $post_post_data['post_create_time'] = time();

            // 将帖子信息保存入数据库
            $bbs_add_post_result = M('bbs_post')->add($post_post_data);

            // 判断是否发帖成功
            if ($bbs_add_post_result) {
                $this->success('发帖成功');
            }else {
                $this->error('发帖失败');
            }
        } else {
            // 不是使用POST请求的
            $this->error('非法请求');
        }
        
    }

    // 显示帖子列表
    public function index()
    {
        $get_part_id = $_GET['part_id'];
        $get_cate_id = $_GET['cate_id'];

        // 获取用户ID、用户名
        $bbs_users_array = M('bbs_user')->order('user_id')
                                        ->getField('user_id,user_name');

        // 获取所属版块的帖子信息
        $bbs_posts_array = M('bbs_post')->where("part_id='{$get_post_id}' AND cate_id='{$get_cate_id}'")
                                        ->order('post_create_time desc')
                                        ->select();
        // echo '<pre>';
        // var_dump($bbs_posts_array);
        // echo '</pre>';
        
        // 输出版块ID 
        $this->assign('get_cate_id',$get_cate_id);
        $this->assign('get_part_id',$get_part_id);
        // 输出帖子列表
        $this->assign('bbs_posts_array',$bbs_posts_array);
        // 输出用户名数组
        $this->assign('bbs_users_array',$bbs_users_array);
        // 显示帖子列表模板
        $this->display();
    }
}