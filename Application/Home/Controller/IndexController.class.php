<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    // 显示首页
    public function index(){
        // 获取分区ID、分区名、区主ID
        $bbs_parts_array = M('bbs_part')->order('part_id')
                                        ->getField('part_id,part_name,user_id');
        
        // 获取所属分区的版块
        $bbs_cates_array = M('bbs_cate')->select();
        
        // 将分区的版块信息加入分区信息数组
        foreach ($bbs_cates_array as $k=>$bbs_cate_array) {
            $bbs_parts_array[$bbs_cate_array['part_id']]['cate_info'][] = $bbs_cate_array;
        }

        // 获取等级为区主的用户
        $bbs_parters_array = M('bbs_user')->order('user_id')->where('user_level=4')->getField('user_id,user_name');

        $this->assign('bbs_parts_array',$bbs_parts_array);
        $this->assign('bbs_parters_array',$bbs_parters_array);
        $this->display();
    }

    // 
}