<?php
namespace Admin\Controller;

use Think\Controller;

class ReplyController extends CommonController {
    // 显示对应帖子回复数据列表
    public function index()
    {
        if (IS_GET) {
            // 获取帖子ID
            $get_post_id = I('get.post_id/d',0);
            if (empty($get_post_id)) {
                $this->error('请选择帖子');
            }
            $bbs_post_data_result = M('bbs_post')->find($get_post_id);
            if (empty($bbs_post_data_result)) {
                $this->error('查无此贴');
            }
            $search_condient['post_id'] = ['eq',$get_post_id]; 
            
            // 接收查询回复作者的数据
            $get_reply_user_name = I('get.user_name/s','');
            if (empty($get_reply_user_name)) {
                unset($get_reply_user_name);
            } else {
                $keep_search_condient['user_name'] = $get_reply_user_name;
            }
            // 实例化用户对象
            $bbs_user_object = M('bbs_user');
            // 模糊查询包含用户名数组
            $bbs_user_name_result = $bbs_user_object->where("user_name LIKE '%$get_reply_user_name%'")->getField('user_id,user_name');
            // 查询是否有包含关键字的用户名
            // 查无用户数据
            if (empty($bbs_user_name_result)) {
                unset($get_reply_user_name);
                unset($bbs_user_name_result);
            } else {
                // 获取数组中所有键
                $bbs_user_id_array = array_keys($bbs_user_name_result);
                $search_condient['user_id'] = ['IN',$bbs_user_id_array];
            }

            // 接收查询回复内容数据
            $get_reply_content = I('get.reply_content/s','');
            if (empty($get_reply_content)) {
                unset($get_reply_content);
            } else {
                $keep_search_condient['reply_content'] = $get_reply_content;
                $search_condient['reply_content'] = ['like',"%$get_reply_content%"];
            }

            // 查询分区名称数组
            $bbs_part_name_array = M('bbs_part')->getField('part_id,part_name');
            // 查询版块名称数组
            $bbs_cate_name_array = M('bbs_cate')->getField('cate_id,cate_name');
            // 查询用户名称数组
            $bbs_user_name_array = $bbs_user_object->getField('user_id,user_name');
            
            // 实例化帖子对象
            $bbs_reply_object = M('bbs_reply');
            // 查询满足条件的总记录数
            $bbs_reply_count = $bbs_reply_object->where($search_condient)->count();
            // 实例化分页类 传入总记录数和每页显示的记录数(25)
            $reply_page = new \Think\Page($bbs_reply_count,10);
            // 分页显示输出
            $reply_list_show  = $reply_page->show();
            // 查询帖子回复数据
            $bbs_reply_data_array =    $bbs_reply_object->where($search_condient)
                                                        ->limit($reply_page->firstRow.','.$reply_page->listRows)
                                                        ->select();

            // 输出帖子数据
            $this->assign('bbs_post_data_result',$bbs_post_data_result);
            // 输出分区名称数组
            $this->assign('bbs_part_name_array',$bbs_part_name_array);
            // 输出版块名称数组
            $this->assign('bbs_cate_name_array',$bbs_cate_name_array);
            // 输出用户名称数组
            $this->assign('bbs_user_name_array',$bbs_user_name_array);
            // 输出帖子回复数据
            $this->assign('bbs_reply_data_array',$bbs_reply_data_array);
            // 分页显示输出
            $this->assign('reply_list_show',$reply_list_show);
            // 搜索条件输出
            $this->assign('keep_search_condient',$keep_search_condient);
            // 显示模板
            $this->display();
        } else {
            $this->error('非法访问');
        }
    }

    // 删除回复
    public function delete()
    {
        if (IS_GET) {   
            // 接收要删除回复的ID
            $get_reply_id = I('get.reply_id/d',0);
            if (empty($get_reply_id)) {
                $this->error('请选择回复删除');
            }

            $bbs_delete_reply_result = M('bbs_reply')->delete($get_reply_id);
            
            if ($get_reply_id) {
                $this->success('删除回复成功');
            } else {
                $rhis->error('删除回复失败');
            }
        } else {
            $this->error('非法操作');
        }
    }

    // 显示编辑回复内容表单
    public function edit()
    {
        if (IS_GET) {
            // 接收要编辑的回复ID
            $get_reply_id = I('get.reply_id/d',0);
            if (empty($get_reply_id)) {
                $this->error('请选择回复编辑');
            }

            // 获取源回复数据
            $bbs_reply_data = M('bbs_reply')->where('reply_id='.$get_reply_id)->find();
            // 如果返回null
            if (empty($bbs_reply_data)) {
                $this->error('查无此回复');
            }
            // 输出回复数据
            $this->assign('bbs_reply_data',$bbs_reply_data);
            // 输出编辑回复模板
            $this->display();
        } else {    
            $this->error('非法操作');
        }
    }

    // 保存回复的编辑内容
    public function update()
    {
        if (IS_POST) {
            // 接收修改的回复的ID
            $get_reply_id = I('get.reply_id/d',0);
            if (empty($get_reply_id)) {
                $this->error('请选择回复编辑');
            }

            // 接收修改的回复内容
            $post_reply_content = I('post.reply_content/s','','/^[\S]+$/');
            if (empty($post_reply_content)) {
                $this->error('回复不能为空');
            }

            $bbs_update_reply_result = M('bbs_reply')->where('reply_id='.$get_reply_id)->save(['reply_content'=>$post_reply_content]);
            
            if ($bbs_update_reply_result) {
                $this->success('编辑回复成功');
            } else {
                $this->error('编辑回复失败');
            }
        } else {
            $this->error('非法操作');
        }
    } 
}