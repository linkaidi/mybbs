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
    
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.html">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">作品管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="/Admin/Cate/index" method="GET">
                    <table class="search-tab">
                        <tr>
                            <th width="70">分区:</th>
                            <td>
                                <select name="pid" id="">
                                    <option value="">全部</option>
                                    <?php foreach($parts as $k=>$v) : ?>
                                    <option value="<?php echo ($k); ?>" <?php if($cond['pid'] === "$k"){echo 'selected';}?>><?php echo ($v); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <th width="70">版块:</th>
                            <td>
                                <select name="cid" id="">
                                    <option value="">全部</option>
                                    <?php foreach($cates_list as $k=>$v) : ?>
                                    <option value="<?php echo ($k); ?>" <?php if($cond['cid'] === "$k"){echo 'selected';}?>><?php echo ($v); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <th width="70">版主:</th>
                            <td>
                                <select name="uid" id="">
                                    <option value="">全部</option>
                                    <?php foreach($users as $k=>$v) : ?>
                                    <option value="<?php echo ($k); ?>" <?php if($cond['pid'] === "$k"){echo 'selected';}?>><?php echo ($v); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <input class="btn btn-primary btn2" value="查询" type="submit">
                                <a href="/Admin/Cate" class="btn btn-primary btn2">返回</a>
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
                            <!-- <th>分区编号</th> -->
                            <th>分区名</th>
                            <!-- <th>版块编号</th> -->
                            <th>版块名</th>
                            <th>版主</th>
                            <th>操作</th>
                        </tr>
                        <?php foreach($cates as $k=>$v) :?>
                        <tr>
                            <!-- <td></td> -->
                            <td><?php echo ($v['pid']); ?>--<?php echo ($parts[$v['pid']]); ?></td>
                            <!-- <td></td> -->
                            <td><?php echo ($v["cid"]); ?>--<?php echo ($v['cname']); ?></td>    
                            <td><?php echo ($users[$v['uid']]); ?></td>
                            <td>
                                <a class="link-update" href="/Admin/Cate/edit?cid=<?php echo ($v['cid']); ?>">修改</a>
                                <a class="link-del" href="/Admin/Cate/del?cid=<?php echo ($v['cid']); ?>">删除</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <div class="list-page"><?php echo ($show); ?></div>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>