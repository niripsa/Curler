<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<!-- layer.js -->
    <!--margin padding border-->
    <!--display:inline inline-block block none flex-->
    <!--div/span? -->
    <!--
		inline:不能设置长和宽 不能换行 <span>
		inline-block:能设置长和宽 不能换行 <img>
		block:即可以设置长和宽 又可以换行 <div>
    -->
    <!--position: absolute/relative/fixed/static-->
    <!-- float--clear -->
    <!--1em=父元素字体的大小（16px） vs px-->

	<title>可可家园</title>
	<style type="text/css">
		div{
			margin:0 auto;
		}

		#user{
			margin-bottom: 20px;
			cursor:pointer;
		}

		body{
			width: 100%;
			text-align: center;
		}

		#reg-span,#login-span{
			font-size: 0.8em;
		}

		.blue-font{
			color:#0f88eb;
		}

		.left-move{
			transform: translateX(30px);
		}
	</style>
</head>
<body>
    <!-- division -->
  
    <div id="user" style="position: relative;">
    	<span id="reg-span" class="blue-font">注册</span> <span id="login-span">登陆</span>
    	<span id="blue-stick" style="background: #0f88eb;height: 1.5px;width: 25px;display: inline-block;position: absolute;margin-top: 20px;margin-left: -55px;transition: all .15s linear;"></span>
    </div>
    
    <div id="register" style="clear:both;">
		<div>
			<label for="username">用户名:</label><input id="username" type="text" name="username" placeholder="用户名"><span id="remind"></span>
		</div>
		<div>
			<label for="password"><span style="color:blue;">密</span> <span style="color:red;">码</span>:</label><input id="password" type="password" name="password" placeholder="密码">
		</div>
		<div>
			<label for="passwordii"><span style="color:blue;">密</span> <span style="color:red;">码</span>:</label><input id="passwordii" type="password" name="passwordii" placeholder="确认密码">
		</div>
		<div>
			<input id="reg-button" type="submit" value="注册">
		</div>
	</div>
    <div id="login" style="display:none;">
		<div> 
			<label for="username">用户名:</label><input id="username" type="text" name="username" placeholder="用户名">
		</div>
		<div>
			<label for="password"><span style="color:blue;">密</span> <span style="color:red;">码</span>:</label><input id="password" type="password" name="password" placeholder="密码">
		</div>
		<div>
			<label for="verify">验证码</label><input type="text" name="verify" id="verify">
			<img src="/thinkphp/index.php/Kekehome/Login/verify_code" onclick="this.src='/thinkphp/index.php/Kekehome/Login/verify_code?t=' + Math.random();">
		</div>
		<div>
			<input id="login-button" type="submit" value="登陆">
		</div>
	</div>
	

	<!-- ajax是直接在本页面进行操作 所以ajax-->
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.1.js"></script>
	<!-- <script type="text/javascript" src="/Public/layer/layer.js"></script> -->
	<script type="text/javascript">

	//$符号=jQuery
	$("#reg-span").click(function(){
		//hide show
		$("#register").show();
		$("#login").hide();
		$("#reg-span").addClass("blue-font");
		$("#login-span").removeClass("blue-font");
		$("#blue-stick").removeClass("left-move");
	});

	$("#login-span").click(function(){
		//hide show
		$("#register").hide();
		$("#login").show();
		$("#login-span").addClass("blue-font");
		$("#reg-span").removeClass("blue-font");
		$("#blue-stick").addClass("left-move");
	});

	//1.console.log 2.下断点的方式去调试ajax
	$("#login-button").click(function(){
		var username = $("#username").val();
		var password = $("#password").val();
		var passwordii = $("#passwordii").val();
		var verify = $("#verify").val();

		//alert(username + "|" + password + "|" + passwordii);
		//pc端页面 微信页面 一般大量$.ajax(jquery的方式调用ajax)
		console.log(1);
		$.ajax({
			type: "post",
			url:"/thinkphp/index.php/Kekehome/Login/login1",
			data:{username:username, password:password, passwordii:passwordii,verify:verify},
			dataType:"json",
			success:function(res){
				if(res.errno == 1){
					var msg = res.errmsg;
					//layer.tips(msg, $("#username"), {tips:1});
				}else{
					alert("登陆成功啦！赶快登陆我们的网站吧！");
				}
			},
			error:function(res){
				alert("登陆失败！");
			}
		});
		console.log(2);

		return false;//不走form提交了

	});
	</script>
</body>
</html>