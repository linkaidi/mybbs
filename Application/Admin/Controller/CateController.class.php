<?php
namespace Admin\Controller;

use Think\Controller;

class CateController extends CommonController {
    
    // 添加版块
    public function create()
    {
        // 获取以分区编号为下标，分区名为值的数组
        $parts = M('bbs_part')->order('pid')
                              ->getField('pid,pname');
                              
        // 输出分区数组            
        $this->assign('parts',$parts);
        $this->display();
    }

    // 保存版块
    public function save()
    {
        $cate = $_POST;

        // 实例化数据表
        $m = M('bbs_cate');

        // 所属分区不能为空
        if (empty($cate['pid'])) {
            $this->error('请选择所属分区');
        }

        // 版块名不能为空
        if (empty($cate['cname'])) {
            $this->error('版块名不能为空');
        }
            
        // 定义正则匹配，规定不可传入带空白符的版块名
        $ptn = '/^[\S]*$/';
        $row = preg_match_all($ptn,$cate['cname']);
        
        // 如果返回值为false，则版块名含有空白符
        if (!$row) {
            $this->error('版块名不能包含空白符');
        }
        
        // 判断版块名是否已存在
        // 获取所有版块名
        $cates = $m->where("pid={$cate['pid']}")->getField('cid,cname');

        // 判断版块名是否已存在
        if (in_array($cate['cname'],$cates)) {
            $this->error('版块名已存在');
        }
        
        // 保存版块数据
        $row = $m->add($cate);

        if ($row) {
            $this->success('添加版块成功');
        } else {
            $this->error('添加版块失败');
        }
        
    }

    // 显示版块数据
    public function index()
    {
        $get_cate = $_GET;

        // 定义一个条件数组
        $condient = [];
        
        // 如果分区不为空
        if (!empty($get_cate['pid'])) {
            $condient['pid'] = ['eq',$get_cate['pid']];
        }
        
        // 如果版块不为空
        if (!empty($get_cate['cid'])) {
            $condient['cid'] = ['eq',$get_cate['cid']];
        }
        
        // 如果版主不为空
        if (!empty($get_cate['uid'])) {
            $condient['uid'] = ['eq',$get_cate['uid']];
        }

        // 实例化版块数据表
        $m = M('bbs_cate');
        
        // 查询满足要求的总记录数
        $count = $m->where($condient)->count();
        // 实例化分页类 传入总记录数和每页显示的记录数(5)
        $Page  = new \Think\Page($count,5);
        // 分页显示输出
        $show  = $Page->show();
        // 进行分区分页数据查询 注意limit方法的参数要使用Page类的属性
        $cates =  $m->order('pid')
                    ->where($condient)
                    ->limit($Page->firstRow.','.$Page->listRows)
                    ->select();
        
        // 获取分区数据
        $cates_list = $m->order('cid')->getField('cid,cname');

        // 获取分区数据
        $parts_list = M('bbs_part')->order('pid')->getField('pid,pname');

        // 获取用户数据
        $users_list = M('bbs_user')->where("author='a'")->getField('uid,uname');
    
        // 输出版块数据
        $this->assign('cates',$cates);
        // 输出分页按钮
        $this->assign('show',$show);
        // 输出分区数据
        $this->assign('parts',$parts_list);
        // 输出版块数据
        $this->assign('cates_list',$cates_list);
        // 输出用户数据
        $this->assign('users',$users_list);

        $this->assign('cond',$get_cate);
        
        $this->display();
    }

    // 删除版块数据
    public function del()
    {
        $cid = $_GET['cid'];
        $row = M('bbs_cate')->delete($cid);
        if ($row) {
            $this->success('删除版块成功');
        } else {
            $this->error('删除版块失败');
        }
    }

    // 显示修改版块数据表单
    public function edit()
    {
        $cid = $_GET['cid'];
        // 查询修改的数据
        $cate = M('bbs_cate')->find($cid);

        // 查询分区数据
        $parts = M('bbs_part')->order('pid')->getField('pid,pname');
        
        $this->assign('cate',$cate);
        $this->assign('parts',$parts);
        $this->display();
    }

    // 接收修改版块数据，完成修改
    public function update()
    {
        $cate = $_POST;
        
        // 所属分区不可为空
        if (empty($cate['pid'])) {
            $this->error('请选择所属分区');
        }

        // 版块名不可为空
        if (empty($cate['cname'])) {
            $this->error('版块名不可为空');
        }
        
        // 版块名不可包含空白
        $ptn = '/^[\S]*$/';
        $res = preg_match_all($ptn,$cate['cname']);
        if (!$res) {
            $this->error('版块名不可包含空白符');
        }

        // 实例化版块数据表
        $m = M('bbs_cate');
        
        // 同一个分区的版块名是唯一的
        $part_list = $m->where("pid={$cate['pid']}")->getField('cid,cname');
        if (in_array($cate['cname'],$part_list)) {
            $this->error('版块名已存在');
        }

        // 执行修改操作
        $row = $m->where("cid={$cate['cid']}")->save($cate);

        if ($row) {
            $this->success('修改版块成功');
        } else {
            $this->error('修改版块失败');
        }
    }
}