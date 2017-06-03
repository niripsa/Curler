<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
<script type="text/javascript"  src="http://code.jquery.com/jquery-3.2.0.min.js"></script>
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<style type="text/css">
  
 /* #zjh{
    height: 200px;
    width:600px;
   } 
 */
    #first{
    	height:250px;
      width: 250px;
         /*  background-color: #DEB887;  */
      float: left;  
      margin-left: 5px;  
     
    }
    #second{
      height:250px;
      width: 250px;
        /*  background-color: #B8860B; */
      float: left;  
      margin-left: 5px;  
     
    }

    #third{
    	height:250px;
      width: 250px;
       /* background-color: #556B2F; */
      float: left;  
      margin-left: 5px;
    }  
</style>
</head>
<body>
  <div id="zjh">
  
    <div id="first"> 
      <div><img  class="zzz"  src="/thinkphp/Public/image/1tu.png" ></div>
      <div ><h3>商品名</h3>
      <br>
      53
      <br>
      <del>64.5</del>
      <input name="shangpin" type="checkbox" id="1">
      </div>
    </div>

    <div id="second">
      <div><img class="zzz" src="/thinkphp/Public/image/2tu.png"></div>
      <div><h3>商品名</h3>
      <br>
      40.5
      <br>
      <del>45.6</del>
      <input name="shangpin" type="checkbox" id="2">
      </div>
    </div>

    <div id="third">
      <div><img class="zzz" src="/thinkphp/Public/image/3tu.png"></div>
      <div ><h3>商品名</h3>
      <br>
      67.9
      <br>
      <del>70.89</del>
      <input name="shangpin" type="checkbox" id="3">
      </div>
    </div>
  </div>
  <input type="text" id="text">

<script type="text/javascript">
$("[type = checkbox]").click(function(){
  var arr = [];
  $("input[name='shangpin']:checked").each(function(){
    arr.push(this.id);
  });
  $.ajax("http://127.0.0.1/thinkphp/index.php/Kekehome/Goods/goods",{
    method:"post",
    dataType:"json",
    data:{arr:arr}
  }).done(function(ret){
    $("#text").val("总价："+ret+"元");
    //alert("总价："+ret+"元");
  }).fail(function(){
    alert("提交失败");
  });
});
</script>
</body>
</html>