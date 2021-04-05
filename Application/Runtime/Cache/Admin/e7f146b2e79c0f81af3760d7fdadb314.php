<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/main.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/> -->
    <script type="text/javascript" src="/Public/Admin/js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.html">首页</a></li>
                <li><a href="http://www.mycodes.net/" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="#"><?=$_SESSION['userInfo']['uname']?></a></li>
                <li><a href="#">修改密码</a></li>
                <li><a href="/Admin/Login/logout">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="/Admin/User/index"><i class="icon-font">&#xe003;</i>用户管理</a>
                    <ul class="sub-menu">
                        <li><a href="/Admin/User/index"><i class="icon-font">&#xe008;</i>查看用户</a></li>
                        <li><a href="/Admin/User/create"><i class="icon-font">&#xe005;</i>添加用户</a></li>

                    </ul>
                </li>
                <li>
                    <a href="/Admin/Part/index"><i class="icon-font">&#xe003;</i>分区管理</a>
                    <ul class="sub-menu">
                        <li><a href="/Admin/Part/index"><i class="icon-font">&#xe008;</i>查看分区</a></li>
                        <li><a href="/Admin/Part/create"><i class="icon-font">&#xe005;</i>添加分区</a></li>

                    </ul>
                </li>
                <li>
                    <a href="/Admin/Cate/index"><i class="icon-font">&#xe003;</i>版块管理</a>
                    <ul class="sub-menu">
                        <li><a href="/Admin/Cate/index"><i class="icon-font">&#xe008;</i>查看版块</a></li>
                        <li><a href="/Admin/Cate/create"><i class="icon-font">&#xe005;</i>添加版块</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="design.html"><i class="icon-font">&#xe008;</i>作品管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe005;</i>博文管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe006;</i>分类管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe004;</i>留言管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe012;</i>评论管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe052;</i>友情链接</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe033;</i>广告管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="system.html"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe037;</i>清理缓存</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe045;</i>数据还原</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin/design/">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/jscss/admin/design/">作品管理</a><span class="crumb-step">&gt;</span><span>新增作品</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="/Admin/Cate/save" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th><i class="require-red">*</i>所属分区：</th>
                                <td>
                                    
                                    <select id="" name="part_id" onchange="" ondblclick="" class="" ><option value="" >选择分区</option><?php  foreach($bbs_parts_info as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>版主：</th>
                                <td>
                                    
                                    <select id="" name="user_id" onchange="" ondblclick="" class="" ><option value="" >选择版主</option><?php  foreach($bbs_users_info as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>版块名：</th>
                                <td>
                                    <input class="common-text required" autocomplete="off" id="title" name="cate_name" size="50" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-primary btn6 mr10" value="新增" type="submit">
                                    <a href="/Admin/Cate" class="btn btn6">返回</a>
                                    
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->

</div>
</body>
</html>