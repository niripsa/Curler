<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>表单令牌</title>
</head>
<body>
<form action="formToken" method="post">
<label for="username">用户名：</label>
<input type="text" name="username" id="username"><br>
<label for="username">密&nbsp;码：</label>
<input type="text" name="password" id="password"><br>
<input type="submit" value="提交">
</form>
</body>
</html>