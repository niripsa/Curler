<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>会员登陆</title>
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
	<script type="text/javascript" src="/jquery.js"></script>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
</head>
<body>
	<div style="height: 50px"></div><br>


	<form class="form-horizontal" style="width: 70%">
	  <div class="form-group">
	    <label for="inputEmail" class="col-sm-2 control-label">Username</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
	    <div class="col-sm-10">
	      <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputVerify" class="col-sm-2 control-label">Verify</label>
	    <div class="col-sm-3">
	      <input type="text" class="form-control" id="inputVerify" placeholder="Verify" name="verify">
	    </div>
	    <div class="col-sm-1"></div>
	    <div class="col-sm-3">
			<img src="http://127.0.0.1/thinkphp/index.php/Kekehome/Test/getverify" onClick="this.src=this.src+'?'+Math.random();">
	    </div>
	  </div>
	  <!-- <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <div class="checkbox">
	        <label>
	          <input type="checkbox"> Remember me
	        </label>
	      </div>
	    </div>
	  </div> -->
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button class="btn btn-default" id="submit">Sign in</button>
	    </div>
	  </div>
	</form>

	<script type="text/javascript">
	$("#submit").click(function(){
		var username = $("#inputUsername").val();
		var password = $("#inputPassword").val();
		var verify = $("#inputVerify").val();
		$.ajax("http://127.0.0.1/thinkphp/index.php/Kekehome/Test/login",{
			method:"post",
			dataType:"json",
			async:true,
			data:{username:username,password:password,verify:verify}
		}).fail(function(){
			alert("网络错误，请重新提交");
		}).done(function(ret){
			console.log(ret.words);
			if (ret.status == true) {
				alert(ret.words);
				location.href = "http://127.0.0.1/thinkphp/index.php/Kekehome/Test/display2";
			}else{
				alert(ret);
			}
		});

		return false;
	});



	</script>
</body>
</html>