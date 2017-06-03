<?php
namespace Kekehome\Model;
use Think\Model;

class SpiderModel extends Model {

	//请求一条可用的url
	public function getURL($type){
		//$type =viewed / processed
		$aWhere = array();
		$aWhere[$type] = 0;
		//值为0表示没有被抓取，可以传给爬虫
		return $this->where($aWhere)->getField('url');
	}

	//爬虫抓取完毕后，将url置为不可用
	public function URLexpire($url,$type){
		$aWhere = array();
		$aWhere['url'] = $url;
		return $this->where($aWhere)->setField($type,1);
	}

	//生产者爬虫将获取的网址存入数据库
	public function writeURL($url){
		$aWhere = [];
		$aWhere['url'] = $url;
		$aIf = $this->where($aWhere)->find();
		if (!$aIf) {
			$aData = array();
			$aData['url'] = $url;
			$aData['viewed'] = 0;
			$aData['processed'] = 0;
			return $this->add($aData);			
		}
		return 0;
		/*$aData = array();
		$aData['url'] = $url;
		$aData['viewed'] = 0;
		$aData['processed'] = 0;
		$this->add($aData);
		return $url;*/	
	}
}
