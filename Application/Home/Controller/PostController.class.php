<?php
namespace Home\Controller;
use Think\Controller;
class PostController extends CommonController {
    // 显示发帖页面
    public function create()
    {
        $this->display();
    }

    // 接收发帖数据，保存
    public function save()
    {
        // 是否是session获取的用户信息
        // if (IS_SESSION) {
        //     var_dump(I("session.user_info/a",'',''));
        // }
        echo '<pre>';
        var_dump($_POST);
    }
}