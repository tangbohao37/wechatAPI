<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>登录</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>PClogin_style.css" tppabs="css/style.css" />
<!--<link rel="stylesheet" type="text/css" href="../Common/css/PClogin_style.css" tppabs="css/style.css" />-->
<style>
body{height:100%;background:#16a085;overflow:hidden;}
canvas{z-index:-1;position:absolute;}
</style>
<script src="<?php echo (ADMIN_JS_URL); ?>jquery.min.js"></script>
<!--<script src="../Common/js/jquery.min.js"></script>-->
<!--<script src="../Common/js/verificationNumbers.js" tppabs="../Common/js/verificationNumbers.js"></script>-->
<script src="<?php echo (ADMIN_JS_URL); ?>verificationNumbers.js" tppabs="<?php echo (ADMIN_JS_URL); ?>verificationNumbers.js"></script>
<!--<script src="../Common/js/verificationNumbers.js" tppabs="../Common/js/verificationNumbers.js"></script>-->
<script src="<?php echo (ADMIN_JS_URL); ?>Particleground.js"></script>
<!--<script src="../Common/js/Particleground.js"></script>-->
<script>
$(document).ready(function(){
  //粒子背景特效
  $('body').particleground({
    dotColor: '#5cbdaa',
    lineColor: '#5cbdaa'
  });
  //验证码
  	createCode();
  //测试提交，对接程序删除即可
  $(".submit_btn").click(function(){
      if(!validate()){
          alert("验证码错误");
          return;
      }
      var name=$('[name="name"]').val();
      var pwd=$('[name="pwd"]').val();
	  if(name.length==0 && pwd.length==0){
	  	alert("用户名与密码不能为空");
          return ;
	  }else if(name.length==0){
	  	alert("用户名不能为空");
          return;
	  }else if(pwd.length==0){
	  	alert("密码不能为空");
          return;
	  }
      $.post('/index.php/Admin/Login/login',{"name":name,"pwd":pwd}, function(data){
            if(data==='1'){
                window.location.href="/index.php/Admin";
            }else {
                alert("用户名或密码错误");
            }
      });
  });
});
</script>
</head>
<body>
<div id="aa"></div>
<dl class="admin_login">
 <dt>
  <strong>卓越招聘管理系统</strong>
  <em>Recruitment System</em>
 </dt>
 <dd class="user_icon">
  <input type="text" name="name" placeholder="账号" class="login_txtbx"/>
 </dd>
 <dd class="pwd_icon">
  <input type="password" name="pwd" placeholder="密码" class="login_txtbx"/>
 </dd>
 <dd class="val_icon">
  <div class="checkcode">
    <input type="text" id="J_codetext" placeholder="输入验证码" maxlength="4" class="login_txtbx">
    <canvas class="J_codeimg" id="myCanvas" onclick="createCode()">对不起，您的浏览器不支持canvas，请下载最新版浏览器!</canvas>
  </div>
  <input type="button" value="验证码核验" class="ver_btn" onClick="validate();">
 </dd>
 <dd>
  <input type="button" value="立即登录" class="submit_btn"/>
 </dd>
 <dd>
<p id="msg" style="color: red"></p>
 </dd>
</dl>
</body>
</html>