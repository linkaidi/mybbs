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
                <form action="/Admin/User/index" method="GET">
                    <table class="search-tab">
                        <tr>
                            <th width="120">用户性别:</th>
                            <td>
                                <select name="user_sex" id="">
                                    <option value="">全部</option>
                                    <option value="1" <?php if($keep_search_condient['user_sex'] === '1'){ echo 'selected';}?>>保密</option>
                                    <option value="2" <?php if($keep_search_condient['user_sex'] === '2'){ echo 'selected';}?>>男</option>
                                    <option value="3" <?php if($keep_search_condient['user_sex'] === '3'){ echo 'selected';}?>>女</option>
                                </select>
                            </td>
                            <th width="120">用户等级:</th>
                            <td>
                                <select name="user_level" id="">
                                    <option value="">全部</option>
                                    <option value="1" <?php if($keep_search_condient['user_level'] === '1'){ echo 'selected';}?>>普通用户</option>
                                    <option value="2" <?php if($keep_search_condient['user_level'] === '2'){ echo 'selected';}?>>会员</option>
                                    <option value="3" <?php if($keep_search_condient['user_level'] === '3'){ echo 'selected';}?>>版主</option>
                                    <option value="4" <?php if($keep_search_condient['user_level'] === '4'){ echo 'selected';}?>>区主</option>
                                    <option value="5" <?php if($keep_search_condient['user_level'] === '5'){ echo 'selected';}?>>管理员</option>
                                    <option value="6" <?php if($keep_search_condient['user_level'] === '6'){ echo 'selected';}?>>站长</option>
                                </select>
                            </td>
                            <th width="120">用户状态:</th>
                            <td>
                                <select name="user_status" id="">
                                    <option value="">全部</option>
                                    <option value="1" <?php if($keep_search_condient['user_status'] === '1'){ echo 'selected';}?>>正常</option>
                                    <option value="2" <?php if($keep_search_condient['user_status'] === '2'){ echo 'selected';}?>>禁用</option>
                                </select>
                            </td>
                            <th width="70">用户名:</th>
                            <td>
                                <input class="common-text" autocomplete="off" placeholder="#模糊查询" name="user_name" value="<?php if(!(empty($keep_search_condient['user_name']))){echo $keep_search_condient['user_name'];} ?>" id="" type="text">
                            </td>
                            <td>
                                <input class="btn btn-primary btn2" value="查询" type="submit">
                                <a href="/Admin/User" class="btn btn-primary btn2">返回</a>
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
                            <th>用户编号</th>
                            <th>用户名</th>
                            <th>用户头像</th>
                            <th>用户性别</th>
                            <th>用户状态</th>
                            <th>用户权限</th>
                            <th>用户创建时间</th>
                            <th>操作</th>
                        </tr>
                        <?php if(is_array($users_data_array)): foreach($users_data_array as $key=>$v): ?><tr>
                            <td><?php echo ($v["user_id"]); ?></td>
                            <td><?php echo ($v["user_name"]); ?></td>
                            <td>
                                <img src="/<?php echo ($v["user_face"]); ?>" alt="">
                            </td>
                            <td>
                                <?php switch($v["user_sex"]): case "1": ?>保密<?php break;?>
                                    <?php case "2": ?>男<?php break;?>
                                    <?php case "3": ?>女<?php break; endswitch;?>
                            </td>
                            <td>
                                <?php switch($v["user_status"]): case "1": ?>正常<?php break;?>
                                    <?php case "2": ?>禁用<?php break; endswitch;?>
                            </td>
                            <td>
                                <?php switch($v["user_level"]): case "1": ?>普通用户<?php break;?>
                                    <?php case "2": ?>会员<?php break;?>
                                    <?php case "3": ?>版主<?php break;?>
                                    <?php case "4": ?>区主<?php break;?>
                                    <?php case "5": ?>管理员<?php break;?>
                                    <?php case "6": ?>站长<?php break; endswitch;?>
                            </td>
                            <td><?php echo (date("Y-m-d H:i:s",$v["user_register_time"])); ?></td>
                            <td>
                                <a class="link-update" href="/Admin/user/edit?user_id=<?php echo ($v["user_id"]); ?>">修改</a>
                                <a class="link-del" href="/Admin/user/del?user_id=<?php echo ($v["user_id"]); ?>">删除</a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                        <!-- <tr>
                            <td class="tc"><input name="id[]" value="58" type="checkbox"></td>
                            <td>
                                <input name="ids[]" value="58" type="hidden">
                                <input class="common-input sort-input" name="ord[]" value="0" type="text">
                            </td>
                            <td>58</td>
                            <td title="黑色经典"><a target="_blank" href="#" title="黑色经典">黑色经典</a> …
                            </td>
                            <td>0</td>
                            <td>35</td>
                            <td>admin</td>
                            <td>2013-12-30 22:34:00</td>
                            <td></td>
                            <td>
                                <a class="link-update" href="#">修改</a>
                                <a class="link-del" href="#">删除</a>
                            </td>
                        </tr> -->
                    </table>
                    <div class="list-page"><?php echo ($page_html_show); ?></div>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>