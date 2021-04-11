<?php
namespace Home\Controller;
use Think\Controller;
class ReplyController extends CommonController {
    // 显示帖子详情，显示回复帖子表单
    public function create()
    {
        if (IS_GET) {
            // 获取帖子ID
            $get_post_id = I('get.post_id/d',0);
            if (empty($get_post_id)) {
                $this->error('请选择帖子发表');
            }

            // 获取帖子信息，增加帖子浏览量
            $bbs_post_object = M('bbs_post');

            // 获取帖子信息
            $bbs_post_array = $bbs_post_object->where('post_id='.$get_post_id)->find();

            // 如果通过GET接收的帖子ID找不到则调走
            if (empty($bbs_post_array)) {
                $this->error('帖子不存在');
            }

            // 查询帖子所属分区名
            $bbs_part_name = M('bbs_part')->where('part_id='.$bbs_post_array['part_id'])->find();
            
            // 查询帖子所属版块名
            $bbs_cate_name = M('bbs_cate')->where('cate_id='.$bbs_post_array['cate_id'])->find();

            // 帖子浏览量 + 1
            $bbs_post_object->where('post_id='.$get_post_id)->setInc('post_visit_count',1);

            // 获取用户信息
            $bbs_users_array = M('bbs_user')->getField('user_id,user_name,user_face');

            // 实例化帖子表
            $bbs_reply_object = M('bbs_reply');
            // 帖子总数
            $bbs_replys_count = $bbs_reply_object->where('post_id='.$get_post_id)->count();
            // 实例化分页类
            $replys_page = new \Think\Page($bbs_replys_count,5);
            // 分页显示输出
            $html_replys_page = $replys_page->show();
            // 获取帖子回复信息
            $bbs_replys_array = $bbs_reply_object->where('post_id='.$get_post_id)
                                                 ->order('reply_create_time')
                                                 ->limit($replys_page->firstRow.','.$replys_page->listRows)
                                                 ->select();

            // 输出帖子所属分区名
            $this->assign('html_replys_page',$html_replys_page);
            // 输出帖子所属分区名
            $this->assign('bbs_part_name',$bbs_part_name);
            // 输出帖子所属版块名
            $this->assign('bbs_cate_name',$bbs_cate_name);
            // 输出帖子信息
            $this->assign('bbs_post_array',$bbs_post_array);
            // 输出用户信息
            $this->assign('bbs_users_array',$bbs_users_array);
            // 输出帖子回复信息
            $this->assign('bbs_replys_array',$bbs_replys_array);
            // 输出帖子详情页面模板
            $this->display();
        } else {
            $this->error('非法浏览帖子');
        }
    }

    // 接收帖子回复信息，保存
    public function save()
    {
        // 接收回复内容
        $reply_data_array['reply_content'] = I('post.reply_content/s','','/^[\S]+$/');
        if (empty($reply_data_array['reply_content'])) {
            $this->error('回复内容不能为空');
        }
        
        // 接收帖子ID
        $reply_data_array['post_id'] = I('get.post_id/d',0);
        if (empty($reply_data_array['post_id'])) {
            $this->error('请选择帖子回复');
        }

        // 接收用户ID
        $reply_data_array['user_info'] = I('session.user_info',[]);
        if (empty($reply_data_array['user_info']['user_id'])) {
            $this->error('请登录');
        } else {
            $reply_data_array['user_id'] = $reply_data_array['user_info']['user_id'];
            unset($reply_data_array['user_info']);
        }

        // 回复时间
        $reply_data_array['reply_create_time'] = time();

        // 将回复信息保存入数据库
        $bbs_add_reply_result = M('bbs_reply')->add($reply_data_array);

        // 判断回复信息是否保存成功
        if ($bbs_add_reply_result) {
            // 实例化帖子表
            $bbs_post_object = M('bbs_post');
            // 如果成功，执行修改帖子更新时间操作
            $bbs_post_object->where('post_id='.$reply_data_array['post_id'])->save(['post_update_time' => $reply_data_array['reply_create_time']]);
            // 帖子回复数 + 1
            $bbs_post_object->where('post_id='.$reply_data_array['post_id'])->setInc('post_reply_count',1);
            
            $this->success('回复成功');
        } else {
            $this->error('回复失败');
        }
    }
    
}