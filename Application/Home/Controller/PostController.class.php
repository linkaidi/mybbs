<?php
namespace Home\Controller;
use Think\Controller;
class PostController extends CommonController {
    // 显示发帖页面
    public function create()
    {
        // 得到发帖版块ID
        $get_cate_id = I('get.cate_id/d',0);

        // 如果传入的版块ID不合法，则跳转至首页选择版块
        if ($get_cate_id === 0) {
            $this->error('请选择版块发帖',U('Home/Index/index','',''),1);
        }

         // 得到发帖版块ID
        $get_part_id = I('get.part_id/d',0);

        // 如果传入的版块ID不合法，则跳转至首页选择版块
        if ($get_part_id === 0) {
            $this->error('请选择分区发帖',U('Home/Index/index','',''),1);
        }
        
        // 获取所属分区的版块信息
        $bbs_cates_name_array = M('bbs_cate')->where('part_id='.$get_part_id)->getField('cate_id,cate_name');

        // 获取所有下标为分区ID，值为分区名的数组
        $bbs_parts_name_array = M('bbs_part')->getField('part_id,part_name');

        // 输出所属分区的版块信息数组
        $this->assign('bbs_cates_name_array',$bbs_cates_name_array);

        // 输出所有分区名数组
        $this->assign('bbs_parts_name_array',$bbs_parts_name_array);

        // 显示发帖页面
        $this->display();
    }

    // 接收发帖数据，保存
    public function save()
    {
        // 得到发帖版块ID
        $post_data_array['cate_id'] = I('post.cate_id/d',0);
        if (empty($post_data_array['cate_id'])) {
            $this->error('请选择版块发帖',U('Home/Index/index','',''),1);
        }

        // 得到发帖分区ID
        $post_data_array['part_id'] = I('get.part_id/d',0);
        if (empty($post_data_array['part_id'])) {
            $this->error('请选择分区发帖',U('Home/Index/index','',''),1);
        }

        // 得到作者ID
        $post_data_array['user_info'] = I('session.user_info/a',[]);
        if (empty($post_data_array['user_info'])) {
            $this->error('请前往登录',U('Home/Index/index','',''),1);
        }
        $post_data_array['user_id'] = $post_data_array['user_info']['user_id'];
        // 删掉多余用户的信息
        unset($post_data_array['user_info']);

        // 得到帖子标题
        $post_data_array['post_title'] = I('post.post_title/s','','/^[\S]+$/');
        if (empty($post_data_array['post_title'])) {
            $this->error('标题不能为空',U('Home/Post/create',['part_id'=>$post_data_array['part_id'],'cate_id'=>$post_data_array['cate_id']],''),1);
        }

        // 得到帖子内容
        $post_data_array['post_content'] = I('post.post_content/s','');
        if (empty($post_data_array['post_content'])) {
            $this->error('内容不能为空',U('Home/Post/create',['part_id'=>$post_data_array['part_id'],'cate_id'=>$post_data_array['cate_id']],''),1);
        }

        // 发帖时间和帖子更新时间是一样的
        $post_data_array['post_create_time'] = $post_data_array['post_update_time'] = time();

        // 将帖子信息数组保存至数据库
        $add_post_result = M('bbs_post')->add($post_data_array);

        if ($add_post_result) {
            $this->success('发帖成功');
        } else {
            $this->error('发帖失败');
        }
    }

    // 显示帖子列表
    public function index()
    {
        // 判断版块ID是否get方式获取
        if (IS_GET) {
            // 获得版块ID
            $get_cate_id = I('get.cate_id/d',0);
            if (empty($get_cate_id)) {
                $this->error('请选择版块');
            }

            // 获取帖子信息数组
            $bbs_posts_array = M('bbs_post')->where('cate_id='.$get_cate_id)->order('post_update_time desc')->select();

            // 获取用户ID为下标，用户名为值的数组
            $bbs_users_array = M('bbs_user')->getField('user_id,user_name');

            // 输出用户名数组
            $this->assign('bbs_users_array',$bbs_users_array);

            // 输出帖子信息数组
            $this->assign('bbs_posts_array',$bbs_posts_array);

            // 输出帖子列表模板
            $this->display();
        } else {
            $this->error('非法进入',U('Home/Index/index','',''),1);
        }
    }

    // 帖子详情页
    
}