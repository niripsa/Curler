<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.0.min.js"></script>
	<title></title>
</head>
<body>
	<!-- <form action="/thinkphp/index.php/Kekehome/Login/multiple_file" method="post" enctype="multipart/form-data"> -->
		<input type="file" multiple="multiple" id="upload">
		<label for="submit">上传</label>
		<br>
		<input id="submit" type="submit" value="上传">
		<br>
		<progress value="0" min="0" max="100" id="prog">
		<strong>/thinkphp</strong>
	<!-- </form> -->

<script type="text/javascript">

	$("#submit").click(function(){
		var data = new FormData();

		for (var i=0; i<$("#upload")[0].files.length; i++) {

			data.append("upload"+i,$("#upload")[0].files[i]);
		}
		
		$.ajax({
			url:"/thinkphp/index.php/Kekehome/Login/multiple_file",
			type:"post",
			/*cache:false,*/
			processData:false,	//上传文件别忘了processData字段
			contentType:false,	//这个也是必选
			data:data,
			dataType:"json",
			success:function(ret){
				console.log(ret);
			},
			error:function(ret){
				console.log(ret);
			},
			xhrFields:{
				onprogress:function(res){
					console.log(res);
					/*var a=evt.loaded*100/evt.total;
					$("#prog").val(a);*/
				}
			}
		});
		return false;
	});

</script>
</body>
</html>