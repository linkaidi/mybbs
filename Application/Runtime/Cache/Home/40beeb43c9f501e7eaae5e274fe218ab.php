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
					<td class="search_hot">
					  <div>
						<strong>热搜:</strong>
						<?php if(is_array($bbs_parts_array)): foreach($bbs_parts_array as $key=>$bbs_part_array): ?><a href=""><?php echo ($bbs_part_array["part_name"]); ?></a><?php endforeach; endif; ?>
					</div>
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
					  <a href="<?php echo U('Home/Post/index',['part_id'=>$bbs_part_name['part_id'],'cate_id'=>$bbs_cate_name['cate_id']],'');?>" class="path_menu" style="width:75px"><?php echo ($bbs_part_name["part_name"]); ?>  <?php echo ($bbs_cate_name["cate_name"]); ?></a>
					</div>
					<!--路径部分end-->

			

			</div>
			<!--小提示部分end-->
			
		</div>
		<!--网页头部end-->
		
	<!--内容部分start-->
		<div class="content">			
			<form action="<?php echo U('Home/Post/save',['cate_id'=>$_GET['cate_id'],'part_id'=>$_GET['part_id']],'');?>" method="post">
				<table height="60">
					<tr>
						<td>
                            <label>当前分区:</label>
                        </td>
						<td>
                            <label><?php echo ($bbs_parts_name_array[$_GET['part_id']]); ?></label>
                        </td>
					</tr>
                    <tr>
                        <td>
                            <label>版块:</label>
                        </td>
                        <td>
                            <select name="cate_id" id="">
								<option value="">请选择</option>
								<?php if(is_array($bbs_cates_name_array)): foreach($bbs_cates_name_array as $cate_id=>$cate_name): ?><option value="<?php echo ($cate_id); ?>" <?php if($cate_id == $_GET['cate_id']){echo 'selected';}?>><?php echo ($cate_name); ?></option><?php endforeach; endif; ?>
                            </select>
                        </td>
                    </tr>
					<tr>
						<td><label>标题:</label></td>
						<td><input type="text" autocomplete="off" name="post_title" size="50"></td>
					</tr>
					<tr>
						<td><label>内容：</label></td>
						<td><textarea name="post_content" rows="12" cols="80"></textarea></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="发贴" style="width:100px;height:30px;"></td>
					</tr>
					
				</table>
			</form>
				
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