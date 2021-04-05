<?php
namespace Admin\Controller;

use Think\Controller;

class CateController extends CommonController {
    
    // 添加版块
    public function create()
    {
        // 获取以分区编号为下标，分区名为值的数组
        $bbs_parts_info =  M('bbs_part')->order('part_id')
                                        ->getField('part_id,part_name');
                              
        // 获取版主信息
        $bbs_users_info =  M('bbs_user')->where("user_level=3")
                                        ->order('user_id')
                                        ->getField('user_id,user_name');

        // 输出分区数组            
        $this->assign('bbs_parts_info',$bbs_parts_info);
        // 输出版主数组            
        $this->assign('bbs_users_info',$bbs_users_info);
        $this->display();
    }

    // 保存版块
    public function save()
    {
        // 接收新增版块信息
        $cate_data = $_POST;

        // 实例化数据表
        $bbs_cate_model_object = M('bbs_cate');

        // 所属分区不能为空
        if (empty($cate_data['part_id'])) {
            $this->error('请选择所属分区');
        }

        // 版块名不能为空
        if (empty($cate_data['cate_name'])) {
            $this->error('版块名不能为空');
        }
            
        // 定义正则匹配，规定不可传入带空白符的版块名
        $cate_data_name_ptn = '/^[\S]*$/';
        $cate_data_name_check_result = preg_match_all($cate_data_name_ptn,$cate_data['cate_name']);
        
        // 如果返回值为false，则版块名含有空白符
        if (!$cate_data_name_check_result) {
            $this->error('版块名不能包含空白符');
        }
        
        // 判断版块名是否已存在
        // 获取所有版块名
        $bbs_cates_name = $bbs_cate_model_object->where("part_id={$cate_data['part_id']}")->getField('cate_id,cate_name');

        // 判断版块名是否已存在
        if (in_array($cate_data['cate_name'],$bbs_cates_name)) {
            $this->error('版块名已存在');
        }
        
        // 保存版块数据
        $add_cate_data_result = $bbs_cate_model_object->add($cate_data);

        if ($add_cate_data_result) {
            $this->success('添加版块成功');
        } else {
            $this->error('添加版块失败');
        }
        
    }

    // 显示版块数据
    public function index()
    {
        // 接收筛选条件
        $get_cate_data = $_GET;

        // 定义一个条件数组
        $cate_search_condient = [];
        
        // 如果分区不为空
        if (!empty($get_cate_data['part_id'])) {
            $cate_search_condient['part_id'] = ['eq',$get_cate_data['part_id']];
        }
        
        // 如果版块不为空
        if (!empty($get_cate_data['cate_id'])) {
            $cate_search_condient['cate_id'] = ['eq',$get_cate_data['cate_id']];
        }
        
        // 如果版主不为空
        if (!empty($get_cate_data['user_id'])) {
            $cate_search_condient['user_id'] = ['eq',$get_cate_data['user_id']];
        }

        // 实例化版块数据表
        $bbs_cate_model_object = M('bbs_cate');
        
        // 查询满足要求的总记录数
        $bbs_cates_count = $bbs_cate_model_object->where($cate_search_condient)->count();
        // 实例化分页类 传入总记录数和每页显示的记录数(5)
        $cates_page  = new \Think\Page($bbs_cates_count,10);
        // 分页显示输出
        $cates_page_show  = $cates_page->show();
        // 进行分区分页数据查询 注意limit方法的参数要使用Page类的属性
        $bbs_cates =  $bbs_cate_model_object->order('part_id')
                                            ->where($cate_search_condient)
                                            ->limit($cates_page->firstRow.','.$cates_page->listRows)
                                            ->select();
        
        // 获取版块列表
        $bbs_cates_name_list = $bbs_cate_model_object->order('cate_id')->getField('cate_id,cate_name');

        // 获取分区列表
        $bbs_parts_name_list = M('bbs_part')->order('part_id')->getField('part_id,part_name');

        // 获取版主列表
        $bbs_users_name_list = M('bbs_user')->where("user_level=3")->getField('user_id,user_name');
    
        // 输出所有版块信息
        $this->assign('bbs_cates',$bbs_cates);
        // 输出分页按钮
        $this->assign('cates_page_show',$cates_page_show);
        // 输出版块列表
        $this->assign('bbs_cates_name_list',$bbs_cates_name_list);
        // 输出分区列表
        $this->assign('bbs_parts_name_list',$bbs_parts_name_list);
        // 输出用户列表
        $this->assign('bbs_users_name_list',$bbs_users_name_list);
        // 实现再次点击查询按钮，原来的筛选条件不变
        $this->assign('get_cate_data',$get_cate_data);
        
        $this->display();
    }

    // 删除版块数据
    public function del()
    {
        // 接收传入删除版块ID
        $get_cate_id = $_GET['cate_id'];
        
        // 删除指定版块操作
        $delete_cate_info_result = M('bbs_cate')->delete($get_cate_id);
        
        if ($delete_cate_info_result) {
            $this->success('删除版块成功');
        } else {
            $this->error('删除版块失败');
        }
    }

    // 显示修改版块数据表单
    public function edit()
    {
        // 接收修改版块ID
        $get_cate_cid = $_GET['cate_id'];
        
        // 查询修改版块的数据
        $bbs_cate_info = M('bbs_cate')->find($get_cate_cid);

        // 查询分区列表
        $bbs_parts_name_list = M('bbs_part')->order('part_id')->getField('part_id,part_name');

        // 查询版主列表
        $bbs_users_name_list = M('bbs_user')->where("user_level=3")->order('user_id')->getField('user_id,user_name');
        
        $this->assign('bbs_cate_info',$bbs_cate_info);
        $this->assign('bbs_parts_name_list',$bbs_parts_name_list);
        $this->assign('bbs_users_name_list',$bbs_users_name_list);
        $this->display();
    }

    // 接收修改版块数据，完成修改
    public function update()
    {
        // 接收传入修改版块信息
        $post_cate_data = $_POST;
        
        // 所属分区不可为空
        if (empty($post_cate_data['part_id'])) {
            $this->error('请选择所属分区');
        }

        // 版块名不可为空
        if (empty($post_cate_data['cate_name'])) {
            $this->error('版块名不可为空');
        }
        
        // 版块名不可包含空白
        $post_cate_name_ptn = '/^[\S]*$/';
        $post_cate_name_check_result = preg_match_all($post_cate_name_ptn,$post_cate_data['cate_name']);
        if (!$post_cate_name_check_result) {
            $this->error('版块名不可包含空白符');
        }

        // 实例化版块数据表
        $bbs_cate_model_object = M('bbs_cate');
        
        // 同一个分区的版块名是唯一的
        $bbs_part_cate_name_list = $bbs_cate_model_object->where("cate_id NOT IN ({$post_cate_data['cate_id']}) AND part_id={$post_cate_data['part_id']}")
                                                        ->getField('cate_id,cate_name');
        
        if (in_array($post_cate_data['cate_name'],$bbs_part_cate_name_list)) {
            $this->error('版块名已存在');
        }

        // 版主为空时
        if (empty($post_cate_data['user_id'])) {
            $post_cate_data['user_id'] = null;
        }

        // 执行修改操作
        $update_cate_info_result = $bbs_cate_model_object->where("cate_id={$post_cate_data['cate_id']}")->save($post_cate_data);

        if ($update_cate_info_result) {
            $this->success('修改版块成功');
        } else {
            $this->error('修改版块失败');
        }
    }
}