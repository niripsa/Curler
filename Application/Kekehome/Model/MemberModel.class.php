<?php
namespace Kekehome\Model;
use Think\Model;

class MemberModel extends Model {
	public function getMemberInfo($username){
		$aWhere=[];
		$aWhere['h_userName']=$username;
		return $this->table("h_member")->where($aWhere)->find();
	}

	public function getaccount($username){
		$aRes=$this->getMemberInfo($username);
		if ($aRes) {
			return $aRes['h_point2'];
		}else{
			return false;
		}
	}

	public function updatepoint2($username,$money){
		$aWhere=[];
		$aWhere['h_userName']=$username;
		$aMap=[];
		$aMap['h_point2']=array("EGT",$money);
		return $this->table("h_member")->where($aWhere)->where($aMap)->setDec("h_point2",$money);
	}

	public function loggeddata($memberlogged_username,$memberlogged_password,$memberlogged_fullname){
		$result = M("Kekehome\Model\MemberModel:h_member")->getMemberInfo($memberlogged_username);

		$memberlogged = false;
		if(isset($result['h_password'])&&$memberlogged_password==$result['h_password']){
			$memberlogged = true;
			
			if(!$memberlogged_fullname)
			$memberlogged_fullname = $memberlogged_username;
		}		
	}
}