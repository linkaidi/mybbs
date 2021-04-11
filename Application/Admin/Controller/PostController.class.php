<?php
namespace Admin\Controller;

use Think\Controller;

class PostController extends CommonController {
    // 查看帖子
    public function index()
    {
        if (IS_GET) {
            // 接收搜索所属分区的分区ID
            $get_part_id = I('get.part_id/d',0);
            if (!empty($get_part_id)) {
                $search_condient['part_id'] = ['eq',$get_part_id];        
            } else {
                unset($get_part_id);
            }

            // 接收搜索所属版块的板块ID
            $get_cate_id = I('get.cate_id/d',0);
            if (!empty($get_cate_id)) {
                $search_condient['cate_id'] = ['eq',$get_cate_id];        
            } else {
                unset($get_cate_id);
            }

            // 接收搜索帖子标题的信息
            $get_post_title = I('get.post_title/s','','/^[\S]+$/');
            if (!empty($get_post_title)) {
                $search_condient['post_title'] = ['LIKE',"%$get_post_title%"];
            } else {
                unset($get_post_title);
            }

            // 接收搜索发帖作者名
            $get_user_name = I('get.user_name/s','','/^[\S]+$/');
            if (!empty($get_user_name)) {
                // 模糊查出带关键字的用户ID
                $bbs_users_result = M('bbs_user')->where("user_name LIKE '%$get_user_name%'")->getField('user_id',true);
                // 如果查出数据
                if (!empty($bbs_users_result)) {
                    $search_condient['user_id'] = ['IN',$bbs_users_result];
                }
            } else {
                unset($get_user_name);
            }   

            // 实例化帖子对象
            $bbs_post_object = M('bbs_post');
            
            // 处理帖子分页
            $bbs_posts_count = $bbs_post_object->where($search_condient)->count();

            // 实例化分页类
            $posts_page = new \Think\Page($bbs_posts_count,10);
            // 分页模板输出
            $html_posts_page = $posts_page->show();

            // 获取帖子数据
            $bbs_posts_array =  $bbs_post_object->where($search_condient)
                                                ->limit($posts_page->firstRow.','.$posts_page->listRows)
                                                ->select();

            // 获取分区数组
            $bbs_parts_array = M('bbs_part')->getField('part_id,part_name,user_id');

            // 获取版块数组
            $bbs_cates_array = M('bbs_cate')->select();

            // 将版块信息加入分区数组
            foreach ($bbs_cates_array as $bbs_cate_array) {
                $bbs_parts_array[$bbs_cate_array['part_id']]['cate_info'][0] = ['cate_id' => $bbs_parts_array[$bbs_cate_array['part_id']]['part_name']];
                $bbs_parts_array[$bbs_cate_array['part_id']]['cate_info'][] = $bbs_cate_array;
            }

            // 将分区数组里的板块信息数组重新组成带分区名的板块数组
            foreach ($bbs_parts_array as $key=>$bbs_part_array) {
                foreach ($bbs_part_array['cate_info'] as $cate_array) {
                        $cates_array[] = $cate_array;
                }
            }

            // 组成下标为版块ID的板块数组
            $cates_array = array_column($cates_array,null,'cate_id');

            // 获取用户名数组
            $bbs_users_name = M('bbs_user')->getField('user_id,user_name');

            // 输出组成下标为版块ID的板块数组
            $this->assign('cates_array',$cates_array);

            // 将分区ID作为下标的分区数组
            $bbs_parts_array = array_column($bbs_parts_array,'part_name','part_id');

            // 实现再次点击查询，原搜索的条件不会清空
            $keep_search_condient = I('get./a',[]);

            // 输出保持不变的查询条件
            $this->assign('keep_search_condient',$keep_search_condient);

            // 重新获取分区数组
            $bbs_parts_array = M('bbs_part')->getField('part_id,part_name,user_id');

            // 输出分区名数组
            $this->assign('bbs_parts_array',$bbs_parts_array);

            // 输出版块名数组
            $this->assign('bbs_cates_name',$bbs_cates_name);

            // 输出用户名数组
            $this->assign('bbs_users_name',$bbs_users_name);

            // 输出帖子信息
            $this->assign('bbs_posts_array',$bbs_posts_array);

            // 分页模板输出
            $this->assign('html_posts_page',$html_posts_page);

            // 输出帖子显示模板
            $this->display();
        } else {
            $this->error('非法请求');
        }
    }

    
}