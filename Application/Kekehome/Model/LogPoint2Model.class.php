<?php
namespace Kekehome\Model;
use Think\Model;

class LogPoint2 extends Model {
	public function setLog($username,$price,$about,$actIP,$type,$typeID,$account){
		$aData=array();
		$aData['h_userName']=$username;
		$aData['h_price']=-$price;
		$aData['h_about']=$about;
		$aData['h_addTime']=array("exp",'now()');
		$aData['h_actIP']=$actIP;
		$aData['h_type']=$type;
		$aData['h_type_id']=$typeID;
		$aData['h_account']=$account;
		$this->table("h_log_point2")->add($aData);
	}
}