<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>文件上传</title>
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
	<script type="text/javascript" src="/jquery.js"></script>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
</head>
<body>


	<form id="file">
	  <div class="form-group">
	    <label for="InputFile">File input</label>
	    <input type="file" id="InputFile" name="file" onchange="UploadImg(this)" accept="image/*"/>
	  </div>
	  <!-- <button type="submit" class="btn btn-default">Submit</button> -->
	  <input type="button" class="btn btn-default" value="Submit" onclick="fileinput();">
	</form>

	<br>
	<label>预览：</label><br>
	<img id="fileimg" style="display: none">
	<canvas id="canvas" width= "400" height="400" style="border: 1px solid red"></canvas>

	<script type="text/javascript">
		function fileinput(){
			var form = new FormData(document.getElementById('file'));
			$.ajax("/thinkphp/index.php/Kekehome/Test/getfile",{
				method:"post",
				data:form,
				dataType:"json",
				processData:false,
				contentType:false
			}).done(function(evt){
				alert(evt)
			}).fail(function(){
				alert("网络错误，请重新提交")
			});
		}


        function UploadImg(obj) {
            var file = obj.files[0];

            console.log(obj);console.log(file);
            console.log("file.size = " + file.size);  //file.size 单位为byte

            var reader = new FileReader();

            //读取文件过程方法
            reader.onloadstart = function (e) {
                console.log("开始读取....");
            }
            reader.onprogress = function (e) {
                console.log("正在读取中....");
            }
            reader.onabort = function (e) {
                console.log("中断读取....");
            }
            reader.onerror = function (e) {
                console.log("读取异常....");
            }
            reader.onload = function (e) {
                console.log("成功读取....");
            //console.log(this.result);
            
            var img = document.getElementById("fileimg");
            img.src = e.target.result;
			var c=document.getElementById("canvas");
			var ctx=c.getContext("2d");
			ctx.drawImage(img,10,10);
					

                //或者 img.src = this.result;  //e.target == this
            }

            reader.readAsDataURL(file)
        }




	</script>
</body>
</html>