<?php
namespace Kekehome\Controller;
use Think\Controller;

class CurlController extends Controller {
	public function curl(){
		$url = "https://movie.douban.com/subject/26260853/";
		$c = curl_init();

		curl_setopt($c,CURLOPT_URL,$url);
		curl_setopt($c,CURLOPT_SSL_VERIFYPEER,false); //不验证证书
		curl_setopt($c,CURLOPT_RETURNTRANSFER,1); //将网页内容储存在变量里
		curl_setopt($c,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2628.0 Safari/537.36");
		curl_setopt($c,CURLOPT_TIMEOUT,8);

		$sRet = curl_exec($c);
		curl_close($c);
		$aRes = [];
		//标题和小标题
		preg_match("/<span\sproperty=\"v:itemreviewed\">(.*?)<\/span>/i",$sRet,$aMatcha);
		$aRes['title'] = $aMatcha[1];

		//图片地址
		preg_match("/<img\ssrc=\"(.*?)\"\stitle/i",$sRet,$aMatchb);
		$aRes['img'] = $aMatchb[1];

		//导演
		preg_match("/rel=\"v:directedBy\">(.*?)<\/a><\/span>/i",$sRet,$aMatchc);

		$aRes['directed'] = $aMatchc[1];
		
		//这里是简介  (?)空格
		preg_match("/<span\sproperty=\"v:summary\"\sclass=\"\">\s*(.*?)\s*<\/span>/i",$sRet,$aMatchd);
		/*<span property="v:summary" class=""> 　　多米尼克（范·迪塞尔 Vin Diesel 饰）与莱蒂（米歇尔·罗德里格兹 Michelle Rodriguez 饰）共度蜜月，布莱恩与米娅退出了赛车界，这支曾环游世界的顶级飞车家族队伍的生活正渐趋平淡。然而，一位神秘女子Cipher（查理兹·塞隆 Charlize T heron 饰）的出现，令整个队伍卷入信任与背叛的危机，面临前所未有的考验。 </span>*/
		$aRes['summary'] = trim($aMatchd[1]);

		//评分
		preg_match("/property=\"v:average\">(.*?)<\/strong>/i",$sRet,$aMatche);
		/*<strong class="ll rating_num" property="v:average">7.2</strong> */
		$aRes['average'] = $aMatche[1];

		$res = M()->table("curl")->add($aRes);
	}
}
