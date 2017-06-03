<?php
namespace Kekehome\Controller;
use Think\Controller;

class GoodsController extends Controller {
	public function index(){
		#var_dump(getUserIP());die;
		#$aRes = M()->table("goods")->select();
		//var_dump(C());die;
		$this->display("goods");
	}
	public function goods(){
		$aArr = I("post.arr");
		#$aArr=[1,2];
		$sPrice=0;
		foreach ($aArr as $val) {
			$aWhere['id']=$val;
			$aRes = M()->table("goods")->where($aWhere)->field('goods_price')->find();
			$sPrice=$sPrice+floatval($aRes['goods_price']);			
			/*foreach ($aRes as $key => $value) {
				$key = $key.$aRes['id'];
				$$key = $value;
				var_dump($key);echo "<br>";
				var_dump($$key);echo "<br>";
			}*/
		}
		$this->ajaxReturn($sPrice);
	}
}