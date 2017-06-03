<?php
namespace Kekehome\Model;
use Think\Model;

class UserModel extends Model {
	public function getUserInfo($username){
		$aWhere = array();
		$aWhere['user_name']=$username;
		return $this->table("user")->where($aWhere)->find();
	}
}

