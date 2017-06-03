<?php
namespace Kekehome\Controller;
use Think\Controller\RpcController;

class ServerController extends RpcController {
	//echo和return的区别
	public function test_server(){
		return json_encode(array("name"=>"gaoxugang"));
	}
	
}