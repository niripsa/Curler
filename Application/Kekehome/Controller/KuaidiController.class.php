<?php
namespace Kekehome\Controller;
use Think\Controller;

class KuaidiController extends Controller {
	public function kuaidi(){
		$com = I("post.com");
		$nu = I("post.nu");
		#http://api.kuaidi100.com/api?id=[]&com=[]&nu=[]&valicode=[]&show=[0|1|2|3]&muti=[0|1]&order=[desc|asc]
		$aGet = array();
		$aGet['id']="267f1735b1e8febd";
		$aGet['com']=$com;
		$aGet['nu']=$nu;
		$build = http_build_query($aGet);
		#id=267f1735b1e8febd&com=zhaijisong&nu=A006076150603
		$url = "http://api.kuaidi100.com/api?".$build;


		$c = curl_init();
		curl_setopt($c,CURLOPT_URL,$url);
		curl_setopt($c,CURLOPT_SSL_VERIFYPEER,false); //不验证证书
		curl_setopt($c,CURLOPT_RETURNTRANSFER,1); //将网页内容储存在变量里
		curl_setopt($c,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2628.0 Safari/537.36");
		curl_setopt($c,CURLOPT_TIMEOUT,8);
		$res = curl_exec($c);
		$this->ajaxReturn($res);
	}
}