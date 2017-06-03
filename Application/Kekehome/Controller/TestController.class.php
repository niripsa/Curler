<?php
namespace Kekehome\Controller;
use Think\Controller;

class TestController extends Controller {
	public function display1(){
		$this->display('test');
	}
	public function display2(){
		$this->display('login');
	}

	public function displaytoken(){
		$this->display('formtoken');
	}

	public function getverify(){
		$config =    array(
		    'fontSize'    =>    20,    // 验证码字体大小
		    'length'      =>    3,     // 验证码位数
		    'useNoise'    =>    false, // 关闭验证码杂点
		    'useCurve'	  =>	false, // 关闭混淆曲线
		    'codeSet' 	  =>	"0123456789",
		);
		$Verify =     new \Think\Verify($config);
		$Verify->entry();		
	}

	public function login(){
		$user = I("post.username");
		$pwd = md5(I("post.password"));
		$code = I("post.verify");
		if (strlen($user)<6 || strlen($user)>32) {
			$this->ajaxReturn("用户名长度应在6位到32位之间");
		}
		if (!$user || !$pwd) {
			$this->ajaxReturn("请输入用户名和密码");
		}
		$aWhere=[];
		$aWhere['h_userName']=$user;
		$aRes = M()->table("h_member")->where($aWhere)->find();
		#var_dump($aRes);
		if ($aRes['h_password'] == $pwd) {
		    $verify = new \Think\Verify();
		    $checkver = $verify->check($code);
		    if ($checkver) {
		    	cookie("username",$user);
		    	cookie("password",$pwd);
				$aRet=[];
				$aRet['status']=true;
				$aRet['words']="登陆成功";
				$this->ajaxReturn($aRet);
		    }else{
		    	$this->ajaxReturn("验证码错误");
		    }
		}else{
			$this->ajaxReturn("用户名或密码错误");
		}
	}

	public function getfile(){
		//$_FILES;
	    $upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小,字节
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','txt');// 设置附件上传类型
	    $upload->rootPath  =     './Public/'; // 设置附件上传根目录
	    //./指的是thinkphp文件夹下
	    $upload->savePath  =     ''; // 设置附件上传（子）目录
	    // 上传文件 
	    $info   =   $upload->upload();
	    if(!$info) {// 上传错误提示错误信息
	       #$this->error($upload->getError());
	       $this->ajaxReturn($upload->getError());
	    }else{// 上传成功
	        #$this->success('上传成功！');
	        $this->ajaxReturn("上传成功");
	    }
	}

	public function formToken(){
		$user = I("post.username");
		$pwd  = I("post.password");
		if ($user != "123" || $pwd != "123") {
			echo "Wrong!";
		}

		// 手动进行令牌验证
		$check = M()->autoCheckToken($_POST);
		if (!$check){
			echo "TokenWrong!";
		}else{
			echo "TokenSuccess!";
			var_dump($check);
		}
	}


}