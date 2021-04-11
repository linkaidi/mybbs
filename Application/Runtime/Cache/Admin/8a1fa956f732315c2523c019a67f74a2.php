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
                <li><a href="#"><?=$_SESSION['userInfo']['user_name']?></a></li>
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
                    <a href="<?php echo U('Admin/User/index');?>"><i class="icon-font">&#xe003;</i>用户管理</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo U('Admin/User/index');?>"><i class="icon-font">&#xe008;</i>查看用户</a></li>
                        <li><a href="<?php echo U('Admin/User/create');?>"><i class="icon-font">&#xe005;</i>添加用户</a></li>

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
                    <a href="<?php echo U('Admin/Post/index','','');?>"><i class="icon-font">&#xe003;</i>帖子管理</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo U('Admin/Post/index','','');?>"><i class="icon-font">&#xe008;</i>查看帖子</a></li>
                        <li><a href="<?php echo U('Admin/Post/create','','');?>"><i class="icon-font">&#xe005;</i>添加帖子</a></li>

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
    
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.html">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">作品管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="/Admin/Part/index" method="GET">
                    <table class="search-tab">
                        <tr>
                            <th width="70">分区:</th>
                            <td><input class="common-text" autocomplete="off" placeholder="#模糊查询" name="part_name" value="<?php if(!(empty($keep_search_condient['part_name']))){echo $keep_search_condient['part_name'];} ?>" id="" type="text"></td>
                            <th width="70">区主:</th>
                            <td><input class="common-text" autocomplete="off" placeholder="#模糊查询" name="user_name" value="<?php if(!(empty($keep_search_condient['user_name']))){echo $keep_search_condient['user_name'];} ?>" id="" type="text"></td>
                            <td>
                                <input class="btn btn-primary btn2" value="查询" type="submit">
                                <a href="/Admin/Part" class="btn btn-primary btn2">返回</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th>分区ID</th>
                            <th>分区名</th>
                            <th>区主</th>
                            <th>操作</th>
                        </tr>
                        <foreach name="bbs_parts_array" item="v">
                        <?php foreach ($bbs_parts_array as $bbs_part_array) :?>
                        <tr>
                            <td><?php echo ($bbs_part_array['part_id']); ?></td>
                            <td><?php echo ($bbs_part_array['part_name']); ?></td>
                            <td><?php echo ($bbs_user_array[$bbs_part_array['user_id']]); ?></td>
                            <td>
                                <a class="link-update" href="/Admin/Part/edit?part_id=<?php echo ($bbs_part_array['part_id']); ?>">修改</a>
                                <a class="link-del" href="/Admin/Part/del?part_id=<?php echo ($bbs_part_array['part_id']); ?>">删除</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <div class="list-page"><?php echo ($parts_page_show); ?></div>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>