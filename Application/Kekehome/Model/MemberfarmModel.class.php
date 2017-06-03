<?php
namespace Kekehome\Model;
use Think\Model;

class MemberfarmModel extends Model {
	public function getMemberInfo($username){
		$aWhere=[];
		$aWhere['h_userName']=$username;
		$aWhere['h_isEnd']=0;
		return $this->table("h_member_farm")->where($aWhere)->select();
	}

	public function updateharvest($username,$sHarvest,$pid){
		$aWhere = [];
		$aWhere['h_userName'] = $username;
		$aWhere['h_pid'] = $pid;
		return $this->table("h_member_farm")->where($aWhere)->setField(array("h_harvest" => $sHarvest));
	}

	public function updateMemberInfo($username,$pid,$land,$sHarvest,$time_str){
		$aWhere = [];
		$aWhere['h_userName'] = $username;
		$aWhere['h_pid'] = $pid;
		$aSave = [];
		$aSave['h_land'] = $land;
		$aSave['h_harvest'] = $sHarvest;
		$aSave['h_h_time'] = $time_str;
		return $this->table("h_member_farm")->where($aWhere)->save($aSave);
	}
}