<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>这是一个神奇的网站</title>
	<meta name="keywords" content="论坛,PHP">
	<meta name="description" content="最大的社区网站">
	<meta http-equiv="X-UA-Compatible" content="IE=8">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/style_1_common.css?gQK" /> 
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/style_1_forum_viewthread.css?gQK" /> 
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/layout.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/css.css">
	<style>
		.list-page{padding:20px 0;text-align:center;}
		.list-page a{margin:0 5px;padding:2px 7px;border:1px solid #ccc;background:#f3f3f3;}
		.list-page a:hover{background:#e4e4e4;border:1px solid #908f8f;}
		.list-page .current{margin:0 5px;padding:2px 7px;background:#f60;border:1px solid #fe8101;color:#fff;}
		.list-page  li{display:inline-block;}
	</style>
</head>
<body>
<!--网页顶部start-->
  <div id="top">
    <div id="top_main">
      <span class="top_content_left">设为主页</span>
      <span class="top_content_left">收藏本站</span>
      <span class="top_content_right">切换到宽版</span>
    </div>
  </div>
<!--网页顶部end-->
 
	<!--网页主体部分start-->
	<div id="main">
  
		<!--网页顶部广告部分start-->
		<div id="banner"></div>
		<!--网页顶部广告部分end-->
		
		<!--网页头部start-->
		<div id="header">
		
		  <!--logo、登陆部分start-->
		  <div id="logo_login">
		  
			<!--logo部分start-->
			<div id="logo"></div>
			<!--logo部分end-->
			<!--登陆部分start-->
			<div id="login" style="width:351px">
					<?php if($_SESSION['user_info']['flag'] == true): if($_SESSION['user_info']['user_level'] == 'admin'): ?><a href="<?php echo U('Admin/Login/login','','');?>" target="_blank">后台登录</a>
							管理员：
							<?php else: ?>
							用户：<?php endif; ?>
							<?php echo ($_SESSION['user_info']['user_name']); ?>
							<a href="<?php echo U('Home/Login/logout','','');?>">退出登录</a>
					<?php else: ?>
						<form action="<?php echo U('Home/Login/doLogin');?>" method="POST">
							<table>
							<tr>
								<td>
								<label>帐号</label>
								</td>
								<td>
								<input type="text" autocomplete="off" name="user_name" />
								</td>
								<td width="80px">
								<label><input type="checkbox" name="remember" />自动登录</label>
								</td>
								<td>
								找回密码
								</td>
							</tr>
							<tr>
								<td>
								<label>密码</label>
								</td>
								<td>
								<input type="password" name="user_password" />
								</td>
								<td>
								<input type="submit" value="立即登录" />
								</td>
								<td>
								<a href="<?php echo U('Home/Login/signUp','','');?>">立即注册</a>
								</td>
							</tr>
							</table>
						</form><?php endif; ?>
				
				
			</div>
			<!--登陆部分start-->
			
		  </div>
		  <!--logo、登陆部分end-->
		  
		  <!--菜单部分start-->
		  <div id="menu">
			<ul>
			  <li><a href="<?php echo U('Home/Index/index','','');?>">首页</a></li>
			  <li class="line"></li>
			  <li><a href="">论坛</a></li>
			  <li class="line"></li>
			  <li><a href="">论坛</a></li>
			  <li class="line"></li>
			  <li><a href="">论坛</a></li>
			  <li class="line"></li>
			</ul>
		  </div>
		  <!--菜单部分end-->
		  
			<!--搜索部分start-->
			<div id="search">
				<table cellpadding="0" cellspacing="0">
				  <tr>
					<td class="search_ico"></td>
					<td class="search_input">
					  <input type="text" name="search" x-webkit-speech speech placeholder="请输入搜索内容" />
					</td>
					<td class="search_select">
					  <a href="">帖子</a>
					  <span class="select"></span>
					</td>
					<td class="search_btn">
					  <button>搜索</button>
					</td>
					

					</td>
				  </tr>
				</table>
			</div>
			<!--搜索部分end-->
					
			<!--小提示部分start-->
			<div id="tip">
				
	<!--路径部分start-->
	<div id="path">
		<a href="<?php echo U('Home/Index/index','','');?>" class="index"></a>
		<em></em>
		<span class="path_menu" style="width:75px"><?php echo ($bbs_part_name["part_name"]); ?>  <?php echo ($bbs_cate_name["cate_name"]); ?></span>
	</div>
	<!--路径部分end-->

			

			</div>
			<!--小提示部分end-->
			
		</div>
		<!--网页头部end-->
		
    <!--内容部分start-->
		<div class="content">			
			<!--发帖按钮start-->
			<div class="send_btn">
				<div class="send">
					<a href="<?php echo U('Home/Post/create',['part_id'=>$_GET['part_id'],'cate_id'=>$_GET['cate_id']],'');?>">
                        <img src="/Public/Home/images/pn_post.png" />
                    </a>
				</div>
				<div style="clear:both"></div>
			</div>
			<!--发帖按钮end-->
			
			<!--帖子列表部分start-->
			<div class="post_list" >
				
				<!--帖子列表标题部分start-->
				<div class="post_title">
					<table cellspacing=0 cellpadding=0 width='100%'>
						<tr>
							<th class="list_title">帖子标题</th>
							<th class="list_author">作者</th>
							<th class="list_count">回复/查看</th>
							<th class="list_ptime">最后发表</th>
						</tr>
					</table>
				</div>
				<!--帖子列表标题部分end-->
				<!--帖子列表内容部分start-->
				<div class="post_content">
					<table cellspacing=0 cellpadding=0 width='100%'>
						<?php if(is_array($bbs_posts_array)): foreach($bbs_posts_array as $key=>$bbs_post_array): ?><tr>
								<td class="list_title">
									<?php if(($bbs_post_array["post_is_jing"]) == "1"): ?><a href="<?php echo U('Home/Reply/create',['post_id'=>$bbs_post_array[post_id]],'');?>">
											<span style="color:red;font-size:2em"><?php echo ($bbs_post_array["post_title"]); ?></span>
										</a><?php endif; ?>	
									<?php if(($bbs_post_array["post_is_jing"]) == "2"): ?><a href="<?php echo U('Home/Reply/create',['post_id'=>$bbs_post_array[post_id]],'');?>">
											<span><?php echo ($bbs_post_array["post_title"]); ?></span>
										</a><?php endif; ?>	
								</td>
								<td class="list_author"><?php echo ($bbs_users_array[$bbs_post_array[user_id]]); ?></td>
								<td class="list_count"><?php echo ($bbs_post_array["post_reply_count"]); ?>/<?php echo ($bbs_post_array["post_visit_count"]); ?></td>
								<td class="list_ptime"><?php echo (date('Y-m-d H:i:s',$bbs_post_array["post_update_time"])); ?></td>
							</tr><?php endforeach; endif; ?>
					</table>
					<div class="list-page"><?php echo ($html_posts_page); ?></div>
				</div>
				<!--帖子列表内容部分end-->
			</div>
			<!--帖子列表部分end-->       
        </div>
        <!--内容部分end-->

        <!--友情链接部分start-->
        <div id="friend_link">
            
            <!--友情链接标题部分start-->
            <div id="fri_title">
              <span>友情链接</span>
            </div>
            <!--友情链接标题部分end-->
            
            <!--友情链接内容部分start-->
            <div class="fri_content">
                <div class="fri_left"><img src="/Public/Home/images/20080926_9b2baec56b95a9ae46ab8ir8uBrEJQjx.gif" /></div>
                <div class="fri_right">
                  <p><strong>Discuz! 产品</strong></p>
                  <p>Discuz! 官方网站 用户会员区</p>
                </div>
            </div>
            <!--友情链接内容部分end-->
            
        </div>
        <!--友情链接部分end-->
	
	</div>
	<!--网页主体部分end-->
	
	<!--尾部部分start-->
	<div id="footer">
	
		<!--尾部左侧部分start-->
		<div id="footer_left">
		  <p>Powered by <strong><a href="http://www.discuz.net" target="_blank">Discuz!</a></strong> <em>X2.5</em></p>
		  <p class="xs0">© 2001-2012 <a href="http://www.comsenz.com" target="_blank">Comsenz Inc.</a></p>
		</div>
		<!--尾部左侧部分start-->
		
		<!--尾部右侧部分start-->
		<div id="footer_right">
		  <p>
			<a href="http://www.discuz.net/archiver/">Archiver</a>
			<span class="pipe">|</span>
			<a href="">手机版</a>
			<span class="pipe">|</span>
			<strong>
			  <a href="http://www.comsenz.com/" target="_blank">北京康盛新创科技有限责任公司</a>
			</strong>
		  ( <a href="http://www.miitbeian.gov.cn/" target="_blank">京ICP证110024号|京网文[2011]0019-007号|北京公安备案:1101082242</a> )&nbsp;
			<a href="http://discuz.qq.com/service/security" target="_blank" title="防水墙保卫网站远离侵害">
		  </p>
		  <p class="xs0">
		  GMT+8, 2012-11-13 20:33
		  <span id="debuginfo">
		  , Processed in 0.030692 second(s), 2 queries
		  , Gzip On, Memcached On.
		  </span>
		  </p>
		</div>
		<!--尾部右侧部分end-->
		
	</div>
	<!--尾部部分end-->
</body>
</html>