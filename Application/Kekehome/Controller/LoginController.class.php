<?php
namespace Kekehome\Controller;
use Think\Controller;


class LoginController extends Controller {
	public function login(){
		$username = I("get.username");
		$password = I("get.pwd");
		$verify = I("get.verify");
		$remember = I("get.remember");

		$aMemberInfo = M("Kekehome\Model\LoginModel:member")->findMemberInfo($username);
		var_dump($aMemberInfo);exit;
	}

	public function testModel(){
		$aUserInfo=M("Kekehome\Model\UsersModel:user")->getUserInfo("zhl");
		$this->ajaxReturn($aUserInfo);
	}
	//一个表对应一个Model,然后Model的名字就取表名
	//h_user DB_PREFIX=>"h_"
	
	//1.xss攻击(插入html标签)	2.sql注入	3.csrf攻击
	public function testI(){
		$username = $_GET['username'];
		$sql = "insert into user set user_name='$username';";
		$aResult = M()->query();
		var_dump($aResult);
	}

	public function testD(){
		//D方法要求Model名和表名一致
		/*$aWhere = array();
		$aWhere['user_name']="zhl";*/
		$a = D('user')->getUserInfo("zhl");
		var_dump($a);
		#$this->ajaxReturn($a);
	}
	public function testDisplay(){
		$this->assign("a","1111");
		$this->display("Index:index");
		//display()的用法:
		//display("模板文件","字符编码","输出类型")
		//1.不加参数,默认去找View/当前控制器/当前方法名.html
		//2.加"name",去找View/当前控制器/name.html
		//3.加"Controller:Name",去找View/Controller/Name.html
		//	↑":"也可以换成/或&
		//4.加"Home@Controller:Name",找Home/View/Controller/Name.html
		//5.加完整路径,如$this->display('./Template/Public/menu.html');这里的Template是相对于当前项目入口文件下面
		//$this->theme("luxury")->display() 
		//↑View/luxury/Login/testdisplay.html
	}

	public function testT(){
		//T方法用于生成模板文件地址
		$sRes = T("Admin@Controller/name","ViewFile");
		#./Application/Admin/ViewFile/Controller/name.html
		echo $sRes;
	}

	public function testFetch(){
		$content = $this->fetch("Index:index");
		#var_dump($content);
		//fetch()方法类似display(),但是并不是直接输出,而是将模板文件的内容作为返回值
		$this->show($content,"ut-8","text/html");
	}

	public function testAssign(){
		$this->assign("name","gaoxugang");
		//assign("key","value")可以直接输出变量
		$aOutput = [];
		$aOutput['name']="gaoxugang";
		$aOutput['work']="IT worker";
		$aOutput['age']=27;
		$this->assign($aOutput);
		//assign($array);可以直接将数组中的key,value作为变量输出
	}

	public function verify_code(){
		$config =    array(
		    'fontSize'    =>    30,    // 验证码字体大小
		    'length'      =>    5,     // 验证码位数
		    'useNoise'    =>    true,  // 关闭验证码杂点
		    'useCurve'	  =>	true,	    
		);
		$Verify = new \Think\Verify($config);
		//var_dump($Verify->length);die;
		$Verify->entry();

		/*#中文验证码
		$Verify =     new \Think\Verify();
		// 验证码字体使用 ThinkPHP/Library/Think/Verify/ttfs/5.ttf
		$Verify->useZh = true; 
		$Verify->entry();*/
	}

	public function login1(){
		$sPost = I("post.verify");
		#var_dump($aPost);
		$verify = new \Think\Verify();
    	$Ret = $verify->check($sPost);
    	$this->ajaxReturn($Ret);
	}

	//单文件上传
	public function get_file(){
	    $upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小,字节
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =     './Public/'; // 设置附件上传根目录
	    //./指的是thinkphp文件夹下
	    $upload->savePath  =     ''; // 设置附件上传（子）目录
	    // 上传文件 
	    $info   =   $upload->upload();
	    if(!$info) {// 上传错误提示错误信息
	        $this->error($upload->getError());
	    }else{// 上传成功
	        $this->success('上传成功！');
	    }		
	}

	//多文件上传(服务器代码和单文件上传一样)
	public function multiple_file(){
		//$_FILES;
	    $upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小,字节
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
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

	public function testpost(){
		$this->ajaxReturn(I("post."));
	}

	public function testRPC(){    
        vendor('phpRPC.phprpc_client');
        $client = new \PHPRPC_Client('http://www.local.com/thinkphp/index.php/Kekehome/Server');
        // 或者采用
        //$client = new \PHPRPC_Client();
        //$client->useService('http://serverName/index.php/Home/Server');
        $result = $client->test_server(); 
        var_dump($result);   		
	}

	public function testlog(){
		$aUserInfo = array(
			'name'=>"中文日志测试",
		); 
		
		//把数组变成字符串有哪几种方式？
		//1.json_encode(信息,[JSON_UNESCAPED_UNICODE]),加上第二个参数可以不把汉字解析成unicode,用于显示中文

		//\Think\Log::record("日志信息","警告级别");
		\Think\Log::record(json_encode($aUserInfo,JSON_UNESCAPED_UNICODE),"INFO");
		//record()要求输出一定要是字符串,不能是数组
	}

	//file redis※ memcache
	public function testcache(){
		//写入的格式是S("key",value);
		//第一次写入时需要传入设置数组作为第三个参数
		//type:缓存类型 expire:缓存过期时间(秒) 
		//prefix:缓存标识前缀
		S('name','gaoxugang', array('type'=>"file","expire"=>300));
		S("age",27);
		S("work","IT worker");
		//如果S("key")或S("key","")则是读取缓存
		echo S("work");
		//删除缓存是S("key",NULL);
		S("age",null);

		//F()方法,没有过期时间,除非主动删除缓存,类似S方法
		//设置：F("key",$value,PATH);
		F("name","gaoxugang");
		F("name",NULL);
	}

	public function testcache2(){
		$username = I("get.username");
		$aCacheInfo = S($username);
		if (empty($aCacheInfo)) {
			$aWhere = array();
			$aWhere['user_name']=$username;
			$aCacheInfo = M()->table('user')->where($aWhere)->find();
			S("username",$aCacheInfo,100);
			$aCacheInfo = $aCacheInfo;
		}
		var_dump($aCacheInfo);
	}

	public function testBit(){
		$save['business_license_is_permanent'] = true;
		//$res = M()->table('testbit')->select();
		$res = M()->table('testbit')->save($save);
		var_dump($res);
	}
}