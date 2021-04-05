<?php
namespace Admin\Controller;

use Think\Controller;

class PartController extends CommonController {
    
    // 添加分区
    public function create()
    {
        // 查询等级为区主的用户信息
        $part_users = M('bbs_user')->where("user_level=4")->getField('user_id,user_name');

        // 输出等级为区主的用户ID及用户名
        $this->assign('part_users',$part_users);
        $this->display();
    }

    // 保存分区
    public function save()
    {
        // 接收新建分区信息
        $part_info_array = $_POST;

        // 分区名不能为空
        if (empty($part_info_array['part_name'])) {
            $this->error('分区不能为空');
        } else {
            // 规定用户名不能包含空格字符
            $part_name_ptn = '/^[\S]*$/';
            $part_name_check_result = preg_match_all($part_name_ptn,$part_info_array['part_name']);
            if (!$part_name_check_result) {
                $this->error('分区名不能包含空格');
            }
        }

        // 实例化分区表
        $bbs_part_object = M('bbs_part');
        
        // 查询分区数据
        $bbs_parts_data = $bbs_part_object->order('part_id')->getField('part_id,part_name');
        
        // 如果没分区则定义一个空数组
        if (!$bbs_parts_data) {
            $bbs_parts_data = [];
        }

        // 判断新建分区是否存在
        if (in_array($part_info_array['part_name'],$bbs_parts_data)) {
            $this->error('该分区名已存在');
        }

        // 添加分区操作
        $add_part_result = $bbs_part_object->add($part_info_array);

        if ($add_part_result) {
            $this->success('添加分区成功');
        } else {
            $this->error('添加分区失败');
        }
    }

    // 显示分区数据
    public function index()
    {
        // 定义一个空数组
        $part_search_condient = [];

        // 是否筛选分区名称
        if (!(empty($_GET['part_name']))) {
            $part_search_condient['part_name'] = ['like',"%{$_GET['part_name']}%"];
        }

        // 实例化part表
        $bbs_part_object = M('bbs_part');
        // 实例化user表
        $bbs_user_object = M('bbs_user');

        // 是否筛选区主名称
        if (!(empty($_GET['user_name']))) {
            $user_name = $_GET['user_name'];
            // 查询符合区主筛选的区主ID
            $user_name_search_array = $bbs_user_object->where("user_level=4 AND user_name LIKE '%{$user_name}%'")
                                                      ->getField('user_id',true);
            
            // 如果只查询到一条数据则放入数组
            if (is_string($user_name_search_array)) {
                $user_name_search_array[] = $user_name_search_array;
            }

            // 如果有符合筛序条件的区主,则查询part表中对应区主ID
            if ($user_name_search_array) {
                $part_search_condient['user_id'] = ['IN',$user_name_search_array];
            }
        }
        
        // 分页
        
        // 查询满足要求的总记录数
        $parts_count  = $bbs_part_object->where($part_search_condient)->count();
        
        // 实例化分页类 传入总记录数和每页显示的记录数(3)
        $parts_page   = new \Think\Page($parts_count,10);
        
        // 分页显示输出
        $parts_page_show  = $parts_page->show();

        // 查询数据遍历显示
        $bbs_parts_array  = $bbs_part_object->where($part_search_condient)
                                            ->order('part_id')
                                            ->limit($parts_page->firstRow.','.$parts_page->listRows)
                                            ->select();
        
        // 查询区主信息
        // 获取区主用户ID和用户名信息
        $bbs_user_array = $bbs_user_object->where("user_level=4")->getField('user_id,user_name');

        // 实现再次点击搜索，原筛选条件不变
        $keep_search_condient = $_GET;

        // 输出分区信息
        $this->assign('bbs_parts_array',$bbs_parts_array);
        // 输出区主信息
        $this->assign('bbs_user_array',$bbs_user_array);
        // 输出分页功能变量
        $this->assign('parts_page_show',$parts_page_show);
        $this->assign('keep_search_condient',$keep_search_condient);
        
        $this->display();
    }

    // 删除分区数据
    public function del()
    {
        // 接收删除分区传入的分区ID
        $part_id = $_GET['part_id'];

        $delete_bbs_part_info = M('bbs_part')->delete($part_id);
        
        if ($delete_bbs_part_info) {
            $this->success('删除分区成功');
        } else {
            $this->error('删除分区失败');
        }
    }

    // 显示修改分区数据表单
    public function edit()
    {
        // 查询分区信息
        $bbs_part_info = M('bbs_part')->find($_GET['part_id']);
        // 查询等级为区主的用户信息
        $bbs_part_users_info = M('bbs_user')->where("user_level=4")->getField('user_id,user_name');

        $this->assign('bbs_part_info',$bbs_part_info);
        $this->assign('bbs_part_users_info',$bbs_part_users_info);
        $this->display();    
    }

    // 接收修改分区数据，完成修改
    public function update()
    {
        // 接收修改分区信息
        $update_part_data = $_POST;
        
        // 分区名不能为空
        if (empty($update_part_data['part_name'])) {
            $this->error('分区不能为空');
        } else {
            // 规定用户名不能包含空格字符
            $update_part_name_ptn = '/^[\S]*$/';
            $update_part_name_check_result = preg_match_all($update_part_name_ptn,$update_part_data['part_name']);
            if (!$update_part_name_check_result) {
                $this->error('分区名不能包含空格');
            }
        }

        // 实例化分区表
        $bbs_parts_object = M('bbs_part');
        
        // 查询分区数据
        $bbs_parts_info = $bbs_parts_object->order('part_id')
                                           ->where(['part_id'=>['not in',$update_part_data['part_id']]])
                                           ->getField('part_id,part_name');

        // 判断分区是否存在
        if (in_array($update_part_data['part_name'],$bbs_parts_info)) {
            $this->error('该分区名已存在');
        }

        // 判断区主是否选择
        if (empty($update_part_data['user_id'])) {
            $update_part_data['user_id'] = null;
        }

        // 修改分区信息
        $update_part_info_result = $bbs_parts_object->where('part_id='.$update_part_data['part_id'])->save($update_part_data);
        
        if ($update_part_info_result) {
            $this->success('修改分区名成功');
        } else {
            $this->error('修改分区名失败');
        }
    }
}