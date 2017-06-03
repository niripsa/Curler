<?php
namespace Kekehome\Controller;
use Think\Controller;
set_time_limit(0);

class SpiderController extends Controller {
	//类中的变量前要加var
	//代理数据来源于http://www.xicidaili.com/api,可以使用接口调用,这里为了简便,直接写在这里
	var $file = "115.220.3.95:808 180.118.240.135:808 36.66.213.25:8080 118.181.167.23:8998 183.153.27.104:808 183.151.12.247:8998 222.134.164.149:808 112.194.217.99:808 58.252.6.165:9000 58.208.228.225:8998 40.68.224.47:8080 122.241.75.227:808 123.169.39.191:808 182.87.185.126:8998 114.239.147.149:808 121.62.189.240:808 36.66.76.177:3128 123.55.191.115:808 212.67.220.137:80 114.239.149.62:808 141.196.144.176:8080 112.194.171.147:808 212.237.22.165:1189 59.39.128.69:808 46.32.2.98:8080 180.115.5.102:23237 117.95.83.105:44407 114.239.146.66:808 222.94.150.6:808 223.150.30.227:8998 113.121.46.37:21071 195.190.124.202:8080 122.241.75.220:808 115.220.150.9:808 113.14.168.210:8998 59.62.109.90:808 202.77.101.97:8080 59.78.13.190:8998 113.121.247.122:808 123.169.89.112:808 115.220.148.142:808 121.235.234.189:37640 114.239.2.79:808 183.153.63.31:808 122.245.66.151:808 36.249.29.255:808 175.155.224.210:808 60.214.118.170:63000 113.69.215.60:808 115.220.7.190:808 180.250.156.35:8088 106.0.6.165:8081 180.183.56.175:8080 49.86.62.199:808 60.178.5.91:8081 200.145.14.144:21320 111.72.244.89:808 222.76.87.13:36366 121.61.100.215:808 119.57.105.241:8080 180.117.58.211:8998 47.48.167.78:8080 183.153.12.8:808 43.243.142.130:8080 122.245.65.183:808 123.169.87.198:808 171.39.29.223:8123 60.178.2.204:8081 24.37.151.46:8080 120.83.122.19:808 59.63.32.98:8998 110.73.3.30:8123 114.231.71.230:25235 115.193.233.204:8998 115.220.150.239:808 125.122.56.19:808 64.234.251.84:8080 180.110.132.29:808 176.237.81.235:8080 103.230.62.82:8080 219.128.149.103:8998 36.68.158.133:3128 123.169.38.0:808 123.169.85.105:808 115.220.1.110:808 114.239.145.101:808 122.235.36.113:8998 222.34.223.91:8998 54.186.43.94:80 175.155.25.60:808 141.196.211.157:8080 46.181.247.30:8080 125.220.159.161:8080 111.155.124.79:8123 213.79.121.190:8080 220.179.211.238:808 54.169.154.52:80 176.237.183.77:8080 125.112.94.214:8998 115.220.1.173:808";

	//$aURL:网址   $useProxy:是否使用代理  $proxy:代理ip及端口
	public function curlconnect($aURL,$useProxy=false ,$proxy=""){
			$c = curl_init();
			curl_setopt($c,CURLOPT_URL,$aURL);
			curl_setopt($c,CURLOPT_SSL_VERIFYPEER,false);
			//下面值为1时,会将网页内容储存在变量里;若为0,则直接返回网页
			curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($c,CURLOPT_USERAGENT,"User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; .NET4.0C; .NET4.0E; .NET CLR 2.0.50727; .NET CLR 3.0.30729; .NET CLR 3.5.30729; InfoPath.3; rv:11.0) like Gecko");
			curl_setopt($c,CURLOPT_TIMEOUT,7);
			curl_setopt($c,CURLOPT_FOLLOWLOCATION, true);
			//可以使用curl获取cookie并自动使用cookie，这里为了简便，使用浏览器拷贝的cookie
			curl_setopt($c,CURLOPT_COOKIE,"ll=\"118221\"; bid=nXfsJonc7L4; viewed=\"3288908\"; ap=1; _vwo_uuid_v2=704D6B4C39F7A9517E627B000206F749|4cfca36ec9bb8fb5b4ddb5f2efade949; _pk_ref.100001.8cb4=%5B%22%22%2C%22%22%2C1495722172%2C%22https%3A%2F%2Fwww.baidu.com%2Flink%3Furl%3DP-O1MhnNP3KyK-g78oVdGBRyea3Vl57QvScVl8bprx6v5C-3s52M3Y_kaEwTSdN3%26wd%3D%26eqid%3D93940f950000b01b000000045926ad3e%22%5D; __utmt=1; __ads_session=KV9yaH1K6ghTM90H8AA=; _pk_id.100001.8cb4=2ee4bc662df199c8.1495011966.8.1495722204.1495711513.; _pk_ses.100001.8cb4=*; __utma=30149280.570279273.1483066586.1495711514.1495722173.33; __utmb=30149280.2.10.1495722173; __utmc=30149280; __utmz=30149280.1495706943.31.19.utmcsr=baidu|utmccn=(organic)|utmcmd=organic");
			if ($useProxy) {
				curl_setopt($c,CURLOPT_PROXY, $proxy);
			}			
			$ret = curl_exec($c);
			curl_close($c);	
			return $ret;	
	}

	//生产者
	public function spiderPush(){
		//$proxy = "115.237.10.165:8118";
		//下面的变量控制是否使用代理
		$use_proxy = true ;
		$index = 50;
		$continue = 0;
		$gzip = 0;
		do{
			//拿到一条能用的url,如果都拿过了,则退出
			$aURL = M("Kekehome\Model\SpiderModel:spider")->getURL("viewed");
			if (empty($aURL)) {
				exit("Spider Producer Finished!");
			}
			//控制是否使用代理
			if ($use_proxy == true) {
				$file = explode(" ", $this->file);			
				$proxy = $file[$index];	
				$ret = $this->curlconnect($aURL,true,$proxy);			
			}else{
				$ret = $this->curlconnect($aURL);	
			}
			//是否使用gzip进行解压	
			if ($gzip == 1) {
				$ret = substr($ret, 10);
				$ret = gzinflate($content));
			}
			//var_dump($ret);exit;
			//如果连接不上，进行重试
			if ($ret == false) {
				if ($continue == 50) {
					echo $index;exit;
				}
				$continue++;
				$index++;
				sleep(1);
				echo "continue3!".$proxy."<br>";
				$aRestart = true;
				continue;
			}
			//var_dump($ret);exit;
			$preg = "/(?:<a\sonclick=\"moreurl(?:.*?)href=\"(.*?)\">)/";
			preg_match_all($preg, $ret, $match);
			//如果匹配不到,尝试开启gzip,如果仍然无法匹配,则退出
			if ($match[1] == []) {
				if ($gzip == 0) {
					$gzip = 1;
					file_put_contents("/temp/spider.log", $ret."OPEN GZIP!\r\n\r\n", FILE_APPEND);
					$aRestart = true;
					continue;
				}else{
					file_put_contents("/temp/spider.log", $ret."\r\n\r\n", FILE_APPEND);
					file_put_contents("/temp/spider.log", $match."\r\n\r\n", FILE_APPEND);
					exit;					
				}
			}
			//$result = array_walk($match[1], array($this,"writeresult"));
			//写入数据库
			array_walk($match[1], array($this,"writeresult"));
			unset($match);
			M("Kekehome\Model\SpiderModel:spider")->URLexpire($aURL,"viewed");
			$aRestart = M("Kekehome\Model\SpiderModel:spider")->getURL("viewed");
			//判断是否还有可用的URL
			sleep(mt_rand(3,6));
			//var_dump($result);
		} while ($aRestart);
	}

	public function writeresult($value,$key){
		M("Kekehome\Model\SpiderModel:spider")->writeURL(dirname($value));
	}
	//消费者
	public function spiderPop(){
		$use_proxy = true ;
		$index = 50;
		$continue = 0;
		$gzip = 0;
		do{
			$aURL = M("Kekehome\Model\SpiderModel:spider")->getURL("processed");
			if (empty($aURL)) {
				exit("Spider Worker Finished!");
			}
			if ($use_proxy == true) {
				$file = explode(" ", $this->file);			
				$proxy = $file[$index];	
				$ret = $this->curlconnect($aURL,true,$proxy);			
			}else{
				$ret = $this->curlconnect($aURL);	
			}
			if ($gzip == 1) {
				$ret = substr($ret, 10);
				$ret = gzinflate($content));
			}
			if ($ret == false) {
				if ($continue == 50) {
					echo $index;exit;
				}
				$continue++;
				$index++;
				sleep(1);
				echo "continue3!".$proxy."<br>";
				$aRestart = true;
				continue;
			}

			//还没想好消费者爬什么_(:з」∠)_



			exit;
			$preg = "/(?:<a\sonclick=\"moreurl(?:.*?)href=\"(.*?)\">)/";
			preg_match_all($preg, $ret, $match);
			//如果匹配不到,尝试开启gzip,如果仍然无法匹配,则退出
			if ($match[1] == []) {
				if ($gzip == 0) {
					$gzip = 1;
					file_put_contents("/temp/spider.log", $ret."OPEN GZIP!\r\n\r\n", FILE_APPEND);
					$aRestart = true;
					continue;
				}else{
					file_put_contents("/temp/spider.log", $ret."\r\n\r\n", FILE_APPEND);
					file_put_contents("/temp/spider.log", $match."\r\n\r\n", FILE_APPEND);
					exit;					
				}
			}
			//$result = array_walk($match[1], array($this,"writeresult"));
			//写入数据库
			array_walk($match[1], array($this,"writeresult"));
			unset($match);
			M("Kekehome\Model\SpiderModel:spider")->URLexpire($aURL,"processed");
			$aRestart = M("Kekehome\Model\SpiderModel:spider")->getURL("processed");
			//判断是否还有可用的URL
			sleep(mt_rand(3,6));
			//var_dump($result);
		} while ($aRestart);
	}
	//爬虫用表
	//id	url		viewed(是否被生产者爬虫抓取过)		processed(是否被消费者爬虫抓取过)
}












/*create table spider(
id int(11) primary key auto_increment,
url varchar(255),
viewed tinyint(1) default 0,
processed tinyint(1) default 0,
KEY `spider-url` (`url`)
) ENGINE=innodb;*/