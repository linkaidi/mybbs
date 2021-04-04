<?php
namespace Admin\Controller;

use Think\Controller;

class PartController extends CommonController {
    
    // 添加分区
    public function create()
    {
        $this->display();
    }

    // 保存分区
    public function save()
    {
        $part = $_POST;
        // 分区名不能为空
        if (empty($part['pname'])) {
            $this->error('分区不能为空');
        } else {
            // 规定用户名不能包含空格字符
            $ptn = '/^[\S]*$/';
            $res = preg_match_all($ptn,$part['pname']);
            if (!$res) {
                $this->error('分区名不能包含空格');
            }
        }

        $m = M('bbs_part');
        
        // 查询分区数据
        $parts = $m->order('pid')->select();
        
        // 将pname循环赋值给新索引数组
        $arr = [];
        foreach ($parts as $k=>$v) {
            $arr[$k] = $v['pname'];
        }

        // 判断分区是否存在
        if (in_array($part['pname'],$arr)) {
            $this->error('该分区名已存在');
        }

        // 添加分区操作
        $row = $m->add($part);

        if ($row) {
            $this->success('添加分区成功');
        } else {
            $this->error('添加分区失败');
        }
    }

    // 显示分区数据
    public function index()
    {
        // 定义一个空数组
        $condient = [];

        if (!(empty($_GET['pname']))) {
            $condient['pname'] = ['like',"%{$_GET['pname']}%"];
        }

        $m = M('bbs_part');

        // 分页
        
        // 查询满足要求的总记录数
        $count  = $m->where($condient)->count();
        
        // 实例化分页类 传入总记录数和每页显示的记录数(3)
        $Page   = new \Think\Page($count,10);
        
        // 分页显示输出
        $show  = $Page->show();

        // 查询数据遍历显示
        $parts  = $m->where($condient)
                    ->order('pid')
                    ->limit($Page->firstRow.','.$Page->listRows)
                    ->select();
        
        $cond = $_GET;

        $this->assign('parts',$parts);
        $this->assign('show',$show);
        $this->assign('cond',$cond);
        
        $this->display();
    }

    // 删除分区数据
    public function del()
    {
        $pid = $_GET['pid'];

        $row = M('bbs_part')->delete($pid);
        
        if ($row) {
            $this->success('删除分区成功');
        } else {
            $this->error('删除分区失败');
        }
    }

    // 显示修改分区数据表单
    public function edit()
    {
        $part = M('bbs_part')->find($_GET['pid']);
        $this->assign('part',$part);
        $this->display();    
    }

    // 接收修改分区数据，完成修改
    public function update()
    {

        $part = $_POST;
        // 分区名不能为空
        if (empty($part['pname'])) {
            $this->error('分区不能为空');
        } else {
            // 规定用户名不能包含空格字符
            $ptn = '/^[\S]*$/';
            $res = preg_match_all($ptn,$part['pname']);
            if (!$res) {
                $this->error('分区名不能包含空格');
            }
        }

        $m = M('bbs_part');
        
        // 查询分区数据
        $parts = $m->order('pid')->select();
        
        // 将pname循环赋值给新索引数组
        $arr = [];
        foreach ($parts as $k=>$v) {
            $arr[$k] = $v['pname'];
        }

        // 判断分区是否存在
        if (in_array($part['pname'],$arr)) {
            $this->error('该分区名已存在');
        }

        $row = $m->where('pid='.$part['pid'])->save($part);
        
        if ($row) {
            $this->success('修改分区名成功');
        } else {
            $this->error('修改分区名失败');
        }
    }
}