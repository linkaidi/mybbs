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
    <a href="<?php echo U('Home/Post/index',['part_id'=>$bbs_part_name['part_id'],'cate_id'=>$bbs_cate_name['cate_id']],'');?>" class="path_menu" style="width:75px"><?php echo ($bbs_part_name["part_name"]); ?>  <?php echo ($bbs_cate_name["cate_name"]); ?></a>
  </div>
  <!--路径部分end-->

			

			</div>
			<!--小提示部分end-->
			
		</div>
		<!--网页头部end-->
		
    <!--内容部分start--> 
    <div id="wp" class="wp content"> 
        <!--留白--> 
        <div id="pt" class="bm cl"></div> 
        <!--包含发贴和回贴--> 
        <div id="ct" class="wp cl"> 
        
         <!--发贴列表start--> 
         <div id="postlist" class="pl bm"> 
          <table cellspacing="0" cellpadding="0"> 
           <tbody>
            <tr> 
             <td class="pls ptm pbm"> 
              <div class="hm"> 
               <span class="xg1">查看:</span> 
               <span class="xi1"><?php echo ($bbs_post_array["post_visit_count"]); ?></span>
               <span class="pipe">|</span>
               <span class="xg1">回复:</span> 
               <span class="xi1"><?php echo ($bbs_post_array["post_reply_count"]); ?></span> 
              </div> </td> 
            <td class="plc ptm pbn vwthd"> 
                <h1 class="ts"> 
                    <a href="" id="thread_subject">
                        <?php echo ($bbs_post_array["post_title"]); ?>
                    </a> 
                </h1> 
            </td> 
            </tr> 
           </tbody>
          </table> 
          <table cellspacing="0" cellpadding="0" class="ad">
           <tbody>
            <tr>
             <td class="pls"></td>
             <td class="plc"></td>
            </tr>
           </tbody>
          </table> 
          <div id="post_16"> 
           <table id="pid16" summary="pid16" cellspacing="0" cellpadding="0"> 
            <tbody>
             <tr> 
              <td class="pls" rowspan="2"> <a name="lastpost"></a> 
               <div class="pi"> 
                <div class="authi"> 
                 <a href="" target="_blank" class="xw1"><?php echo ($bbs_users_array[$bbs_post_array[user_id]][user_name]); ?></a> 
                </div> 
               </div> 
               <div> 
                <div class="avatar" onmouseover="showauthor(this, 'userinfo16')">
                  <?php $post_user_face = $bbs_users_array[$bbs_post_array['user_id']]['user_face'] ?>
                  <?php if(empty($post_user_face)): ?><a href="" target="_blank"><img src="/Public/Home/images/common/tavatar.gif" /></a>
                    <?php else: ?>
                    <a href="" target="_blank"><img src="/<?php echo (getSm($post_user_face)); ?>" /></a><?php endif; ?>
                </div> 
                <div class="tns xg2"> 
                 <table cellspacing="0" cellpadding="0"> 
                  <tbody>
                   <tr>
                    <th><p><a href="home.php?mod=space&amp;uid=1&amp;do=thread&amp;view=me&amp;from=space" class="xi2">4</a></p>主题</th> 
                    <th> <p><a href="home.php?mod=space&amp;uid=1&amp;do=friend&amp;view=me" class="xi2">0</a></p>好友 </th> 
                    <td><p><a href="home.php?mod=space&amp;uid=1&amp;do=profile" class="xi2">35</a></p>积分</td> 
                   </tr>
                  </tbody>
                 </table> 
                </div> 
                <p><em><a href="" target="_blank">管理员</a></em></p> 
               </div> </td> 
              <td class="plc"> 
               <div class="pi"> 
                <strong> <a href="">楼主</a> </strong> 
                <div class="pti"> 
                 <div class="pdbt"> 
                 </div> 
                 <div class="authi"> 
                  <img class="authicn vm" id="authicon16" src="/Public/Home/images/common/online_admin.gif" /> 
                  <em id="authorposton16">发表于 <span title="<?php echo (date("Y-m-d H:i:s",$bbs_post_array["post_create_time"])); ?>"><?php echo (date("Y-m-d H:i:s",$bbs_post_array["post_create_time"])); ?></span></em> 
                  <span class="pipe">|</span>
                  <a href="">倒序浏览</a> 
                  <span class="pipe">|</span> 
                 </div> 
                </div> 
               </div>
               <div class="pct">
                <style type="text/css">.pcb{margin-right:0}</style>
                <div class="pcb"> 
                 <div class="t_fsz"> 
                  <table cellspacing="0" cellpadding="0">
                   <tbody>
                    <tr>
                     <td class="t_f" id="postmessage_16"><?php echo ($bbs_post_array["post_content"]); ?></td>
                    </tr>
                   </tbody>
                  </table> 
                 </div> 
                 <div id="comment_16" class="cm"> 
                 </div> 
                 <div id="post_rate_div_16"></div> 
                </div> 
               </div> </td> 
             </tr> 
             <tr> 
              <td class="plc plm"></td> 
             </tr> 
             <tr> 
              <td class="pls"></td> 
              <td class="plc" style="overflow:visible;"></td> 
             </tr> 
             <tr class="ad"> 
              <td class="pls"></td> 
              <td class="plc"></td> 
             </tr> 
            </tbody>
           </table> 
          </div> 
         </div> 
         <!--发贴列表end--> 
         
         <!--回复列表start--> 
         <!-- 楼层计数 -->
         <?php $n=1 ?>
         <?php if(is_array($bbs_replys_array)): foreach($bbs_replys_array as $key=>$bbs_reply_array): ?><div class="pl bm"> 
          <table cellspacing="0" cellpadding="0" class="ad"> 
           <tbody>
            <tr> 
             <td class="pls"></td>
             <td class="plc"></td> 
            </tr> 
           </tbody>
          </table> 
          <div id="post_16"> 
           <table id="pid16" summary="pid16" cellspacing="0" cellpadding="0"> 
            <tbody>
             <tr> 
              <td class="pls" rowspan="2"> <a name="lastpost"></a> 
               <div class="pi"> 
                <div class="authi"> 
                 <a href="" target="_blank" class="xw1"><?php echo ($bbs_users_array[$bbs_reply_array[user_id]][user_name]); ?></a> 
                </div> 
               </div> 
               <div> 
                <div class="avatar" onmouseover="showauthor(this, 'userinfo16')"> 
                  <?php $history_reply_user_face = $bbs_users_array[$bbs_reply_array['user_id']]['user_face']; ?>
                  <?php if(empty($history_reply_user_face)): ?><a href="" target="_blank"> <img src="/Public/Home/images/common/tavatar.gif" /> </a> 
                  <?php else: ?>
                    <a href="" target="_blank"> <img src="/<?php echo (getSm($history_reply_user_face)); ?>" /> </a><?php endif; ?>
                </div> 
                <div class="tns xg2"> 
                 <table cellspacing="0" cellpadding="0"> 
                  <tbody>
                   <tr>
                    <th><p><a href="home.php?mod=space&amp;uid=1&amp;do=thread&amp;view=me&amp;from=space" class="xi2">4</a></p>主题</th> 
                    <th> <p><a href="home.php?mod=space&amp;uid=1&amp;do=friend&amp;view=me" class="xi2">0</a></p>好友 </th> 
                    <td><p><a href="home.php?mod=space&amp;uid=1&amp;do=profile" class="xi2">35</a></p>积分</td> 
                   </tr>
                  </tbody>
                 </table> 
                </div> 
                <p> <em> <a href="" target="_blank">管理员</a> </em> </p> 
               </div> </td> 
              <td class="plc"> 
               <div class="pi"> 
                <strong> <a href="">第<?php echo ($n++); ?>楼</a> </strong> 
                <div class="pti"> 
                 <div class="pdbt"> 
                 </div> 
                 <div class="authi"> 
                  <img class="authicn vm" id="authicon16" src="/Public/Home/images/common/online_admin.gif" /> 
                  <em id="authorposton16">发表于 <span title=""><?php echo (date('Y-m-d H:i:s',$bbs_reply_array["reply_create_time"])); ?></span></em> 
                  <span class="pipe">|</span>
                  <a href="forum.php?mod=viewthread&amp;tid=6&amp;extra=&amp;ordertype=1">倒序浏览</a> 
                  <span class="pipe">|</span> 
                 </div> 
                </div> 
               </div>
               <div class="pct">
                <style type="text/css">.pcb{margin-right:0}</style>
                <div class="pcb"> 
                 <div class="t_fsz"> 
                  <table cellspacing="0" cellpadding="0">
                   <tbody>
                    <tr>
                     <td class="t_f" id="postmessage_16"><?php echo ($bbs_reply_array["reply_content"]); ?></td>
                    </tr>
                   </tbody>
                  </table> 
                 </div> 
                 <div id="comment_16" class="cm"> 
                 </div> 
                 <div id="post_rate_div_16"></div> 
                </div>
               </div> </td>
             </tr> 
             <tr>
              <td class="plc plm"> </td> 
             </tr> 
             <tr> 
              <td class="pls"></td> 
              <td class="plc" style="overflow:visible;"> </td> 
             </tr> 
             <tr class="ad"> 
              <td class="pls"></td> 
              <td class="plc"> </td> 
             </tr> 
            </tbody>
           </table> 
          </div> 
         </div><?php endforeach; endif; ?>
         <!--回复列表end--> 
        <div class="list-page"><?php echo ($html_replys_page); ?></div>
         <div class="xi2 mbm pbm bbs"></div> 
         <!--[diy=diyfastposttop]-->
         <div id="diyfastposttop" class="area"></div>
         <!--[/diy]--> 
         <div id="f_pst" class="pl bm bmw"> 
          <form method="post" id="fastpostform" action="<?php echo U('Home/Reply/save',['post_id'=>$_GET['post_id']],'');?>"> 
           <table cellspacing="0" cellpadding="0"> 
            <tbody>
             <tr> 
              <td class="pls"> 
               <div class="avatar">
                 <?php $reply_user_face = $bbs_users_array[$_SESSION[user_info][user_id]][user_face]; ?>
                <?php if(empty($reply_user_face)): ?><a href="" target="_blank"><img src="/Public/Home/images/common/tavatar.gif" /></a>
                <?php else: ?>
                  <a href="" target="_blank"><img src="/<?php echo (getSm($reply_user_face)); ?>" /></a><?php endif; ?>
               </div></td> 
              <td class="plc"> <span id="fastpostreturn"></span> 
               <div class="cl"> 
                <div id="fastsmiliesdiv" class="y">
                 <div id="fastsmiliesdiv_data">
                  <div id="fastsmilies"></div>
                 </div>
                </div>
                <div class="hasfsl" id="fastposteditor"> 
                 <div class="tedt mtn"> 
                  <div class="bar"> 
                   <span class="y"> </span> 
                  </div> 
                  <div class="area"> 
                   <textarea rows="6" cols="80" name="reply_content" id="fastpostmessage" tabindex="4" class="pt"></textarea> 
                  </div> 
                 </div> 
                </div> 
               </div> 
               <div class="upfl hasfsl"> 
                <table cellpadding="0" cellspacing="0" border="0" id="attach_tblheader" style="display: none;"> 
                 <tbody>
                  <tr> 
                   <td>点击附件文件名添加到帖子内容中</td> 
                   <td class="atds">描述</td> 
                   <td class="attv"> 阅读权限 <img src="/Public/Home/images/common/faq.gif" alt="Tip" class="vm" onmouseover="showTip(this)" tip="阅读权限按由高到低排列，高于或等于选中组的用户才可以阅读" /> </td> 
                   <td class="attpr">金钱</td>
                   <td class="attc"></td> 
                  </tr> 
                 </tbody>
                </table> 
                <div class="fieldset flash" id="attachlist"></div> 
               </div> <p class="ptm pnpost"> <button type="submit" name="" id="fastpostsubmit" class="pn pnc vm" value="replysubmit" tabindex="5"><strong>发表回复</strong></button> </p> </td> 
             </tr> 
            </tbody>
           </table> 
          </form> 
         </div> 
        </div> 

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