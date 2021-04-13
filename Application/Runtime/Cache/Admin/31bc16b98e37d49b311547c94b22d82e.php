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
                <form action="<?php echo U('Admin/Reply/index',['post_id'=>$bbs_post_data_result[post_id]],'');?>" method="GET">
                    <table class="search-tab">
                        <tr>
                            <th width="90">帖子回复作者:</th>
                            <td>
                                <input class="common-text" autocomplete="off" placeholder="#模糊查询" name="user_name" value="<?php if($keep_search_condient['user_name'] === $_GET['user_name']){echo $_GET['user_name'];}?>" id="" type="text">
                            </td>
                            <th width="90">帖子回复内容:</th>
                            <td>
                                <input class="common-text" autocomplete="off" placeholder="#模糊查询" name="reply_content" value="<?php if($keep_search_condient['reply_content'] === $_GET['reply_content']){echo $_GET['reply_content'];}?>" id="" type="text">
                            </td>
                            <td>
                                <input class="btn btn-primary btn2" value="查询" type="submit">
                                <a href="<?php echo U('Admin/Reply/index',['post_id'=>$bbs_post_data_result[post_id]],'');?>" class="btn btn-primary btn2">返回</a>
                                <a href="<?php echo U('Admin/Post/index','','');?>" class="btn btn-primary btn2">返回帖子列表</a>
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
                            <th>帖子ID</th>
                            <th>帖子标题</th>  
                            <th>所属分区</th>
                            <th>所属版块</th>
                            <th>帖子作者</th>
                            <th>帖子浏览量</th>
                            <th>帖子回复量</th>
                            <th>发帖时间</th>
                            <th>更新时间</th>
                        </tr>
                            <tr>
                                <td><?php echo ($bbs_post_data_result["post_id"]); ?></td>
                                <td>
                                    <?php if(($bbs_post_data_result["post_is_jing"]) == "1"): ?><span style="color:red"><?php echo ($bbs_post_data_result["post_title"]); ?></span><?php endif; ?>
                                    <?php if(($bbs_post_data_result["post_is_jing"]) == "2"): ?><span><?php echo ($bbs_post_data_result["post_title"]); ?></span><?php endif; ?>
                                </td>
                                
                                <td><?php echo ($bbs_part_name_array[$bbs_post_data_result[part_id]]); ?></td>
                                <td><?php echo ($bbs_cate_name_array[$bbs_post_data_result[cate_id]]); ?></td>
                                <td><?php echo ($bbs_user_name_array[$bbs_post_data_result[user_id]]); ?></td>
                                <td><?php echo ($bbs_post_data_result["post_visit_count"]); ?></td>
                                <td><?php echo ($bbs_post_data_result["post_reply_count"]); ?></td>
                                <td><?php echo (date("Y-m-d H:i:s",$bbs_post_data_result["post_create_time"])); ?></td>
                                <td><?php echo (date("Y-m-d H:i:s",$bbs_post_data_result["post_update_time"])); ?></td>
                            </tr>
                            <tr>
                                <th  colspan="9">帖子内容</th>
                            </tr>
                            <tr>
                                <td colspan="9">
                                    <?php echo ($bbs_post_data_result["post_content"]); ?>
                                </td>
                            </tr>
                    </table>
                </div>
            </form>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th>回复内容</th>
                            <th>回复作者</th>
                            <th>回复时间</th>
                            <th>操作</th>
                        </tr>
                        <?php if(is_array($bbs_reply_data_array)): foreach($bbs_reply_data_array as $key=>$bbs_reply_array): ?><tr>
                                <td><?php echo ($bbs_reply_array["reply_content"]); ?></td>
                                <td><?php echo ($bbs_user_name_array[$bbs_reply_array[user_id]]); ?></td>
                                <td><?php echo (date("Y-m-d H:i:s",$bbs_reply_array["reply_create_time"])); ?></td>
                                <td>
                                    <a href="<?php echo U('Admin/Reply/edit',['reply_id'=>$bbs_reply_array['reply_id']],'');?>">编辑</a>
                                    <a href="<?php echo U('Admin/Reply/delete',['reply_id'=>$bbs_reply_array['reply_id']],'');?>">删除</a>
                                </td>
                            </tr><?php endforeach; endif; ?>
                    </table>
                    <div class="list-page"><?php echo ($reply_list_show); ?></div>
                </div>
            </form>
        </div>
        
    </div>

</div>
</body>
</html>