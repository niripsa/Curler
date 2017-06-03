<?php
namespace Kekehome\Model;
use Think\Model;

class LoginModel extends Model {	
	public function findMemberInfo($username){
		$aWhere = array();
		$aWhere['h_userName'] = $username;
		$aMemberInfo = $this->where($aWhere)->find();
		return $aMemberInfo;
	}
}