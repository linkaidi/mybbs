<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link href="/Public/Admin/css/admin_login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="admin_login_wrap">
    <h1>后台管理</h1>
    <div class="adming_login_border">
        <div class="admin_input">
            <form action="/Admin/Login/doLogin" method="post">
                <ul class="admin_items">
                    <li>
                        <label for="user">用户名：</label>
                        <input type="text" name="user_name" autocomplete="off" value="" id="user" size="35" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">密码：</label>
                        <input type="password" name="user_password"  value="" id="pwd" size="35" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">验证码：</label>
                        <input type="text" name="user_code" value="" autocomplete="off" id="code" size="15" class="admin_input_style" />
                        <img src="/Admin/Login/code" style="vertical-align: top;" alt="验证码" onclick="this.src='/Admin/Login/code?&x='+Math.random()">
                    </li>
                    <li>
                        <input type="submit" tabindex="3" value="提交" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <p class="admin_copyright">
        <a tabindex="5" href="http://www.mybbs.com/" target="_blank">返回首页</a> 
    </p>
</div>
</body>
</html>