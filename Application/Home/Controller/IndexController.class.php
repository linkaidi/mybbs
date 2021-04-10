<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    // 显示首页
    public function index()
    {
        // 获取分区信息数组，下标为分区ID
        $bbs_parts_array = M('bbs_part')->getField('part_id,part_name,user_id');

        // 获取用户信息数组，下标为用户ID，值为用户名
        $bbs_users_array = M('bbs_user')->getField('user_id,user_name');

        // 获取版块信息数组
        $bbs_cates_array = M('bbs_cate')->select();

        // 将分区对应的版块信息加入分区信息数组中
        foreach ($bbs_cates_array as $bbs_cate_array) {
            $bbs_parts_array[$bbs_cate_array['part_id']]['cate_info'][] = $bbs_cate_array;
        }

        // 输出用户名数组变量
        $this->assign('bbs_users_array',$bbs_users_array);

        // 输出分区信息数组变量
        $this->assign('bbs_parts_array',$bbs_parts_array);

        // 渲染模板
        $this->display();
    }
}