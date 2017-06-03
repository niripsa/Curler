<?php
namespace Kekehome\Controller;
use Think\Controller;

class PlantController extends Controller {
	public function choose() {
		$memberlogged_username = I('cookie.m_username');
		$memberlogged_password = I('cookie.m_password');
		$memberlogged_fullname = I('cookie.m_fullname');
		$memberlogged_level = I('cookie.m_level');
		$memberlogged_ispass = I('cookie.m_isPass');

		$farmid = "";
		$land_money = "";
		$land_money_now = 0;
		$pid = "";
		$harvest = "";
		$h_harvest;$land_str = "";

		$harvest_time = "";
		$rstr = "ok";
		#intval floatval | js:parseInt parseFloat
		$farmid = intval(I("post.kid"));
		$admun = abs(floatval(I("post.addou")));
		$land = "";
		$num = 0;
		$num_now = 0;
		$time;
		$time_str;
		$rs2;
		global $memberlogged_username;

		$adtype = I("post.adtype");
		if ($adtype == "add") {
			$this->addkk();
			//这里要不要加$this->   //要
		}
		if ($adtype == "new") {
			$this->newkk();
		}
	}

	public function addkk(){

		if($admun < 0 || $admun == null)
		{
		  echo("请输入正确的数量！");exit;
		}

		$result = M("Kekehome\Model\MemberModel:h_member")->getMemberInfo($memberlogged_username);
		#h_point2 余额
		$num = $result['h_point2'];
		if($admun > $result['h_point2'])
		{
		    echo("您没有这么多KK了！快去充值吧~~！");exit;
		}else{
			$money_now = $result['h_point2'];
		}
		$rs2 = M("Kekehome\Model\MemberfarmModel:h_member_farm")->getMemberInfo($memberlogged_username);		
		
		if(count($rs2) > 0)
		{
			foreach ($rs2 as $val)
			{
			  if($val['h_pid'] == "112")
			  {
				if(intval($farmid) < 11)
				{
				  $h_harvest = explode(",",$val['h_harvest']);
				  $land_money = $h_harvest[intval($farmid)-1];
				  $pid = "112";
				  $landtype="普通地"; 
				}
			  }
			  else
			  {
				if(intval($farmid) == 11 || intval($farmid) > 11)
				{
				  $h_harvest = explode(",",$val['h_harvest']);
				  $land_money = $h_harvest[intval($farmid)-11];
				  $pid = "113";
				  $landtype="高基地";				  
				}
			  }
			}
		}
		else
		{
		  $rstr = "wrong";
		}
		
		$land_money_now = $land_money + $admun;
		
		if(intval($farmid) < 11)
		{
		  if($land_money_now > 3000)
		  { 
		    echo("您种植的数量超出了最大限度！");exit;
		  }
		  $h_harvest[intval($farmid)-1] = $land_money_now;
		}
		else
			
		{
		  if($land_money_now > 30000)
		  { 
		    echo("您种植的数量超出了最大限度！");exit;
		  }
		  $h_harvest[intval($farmid)-11] = $land_money_now;
		}
		
		$sHarvest = implode(',', $h_harvest);
		
		//这里的session有用吗
		#session_start();
		if(!cookie('shouhuo')){
				cookie('shouhuo','shouhuo', time()+5);


				$h_point2 = $num - $admun;
				if($h_point2 >= 0){
					$iAffectedRows = M("Kekehome\Model\MemberModel:h_member")->updatepoint2($memberlogged_username,$admun);

					//Mark??? writelog
					if(empty($iAffectedRows)){
						#writeLog("member attack:" . $query);
						\Think\Log::record("member attack:" . $query,"INFO");
						exit;
					}

					M("Kekehome\Model\MemberfarmModel:h_member_farm")->updateharvest($memberlogged_username,$sHarvest,$pid);

					$about=$landtype.$farmid.",增加播种".$admun.'KK';
					$account=M("Kekehome\Model\MemberModel:h_member")->getaccount($memberlogged_username);
					M("Kekehome\Model\LogPoint2Model:h_log_point2")->setLog($memberlogged_username,$admun,$about,getUserIP(),"增加播种",3,$account);
				  
				    echo("result:".$rstr."-". $land_money_now);
				}else{
					echo("您没有这么多KK了！快去充值吧~~！");exit;
				}
		}else{
			echo("正在处理,请稍后重试...");exit;
		}
	}


	public function newkk(){
		$result = M("Kekehome\Model\MemberModel:h_member")->getMemberInfo($memberlogged_username);
		$num = $result['h_point2'];

		$rs2 = M("Kekehome\Model\MemberfarmModel:h_member_farm")->getMemberInfo($memberlogged_username);

		//$rs2里面存着那两块地的信息
		if(count($rs2) > 0)
		{
			foreach ($rs2 as $key=>$val)
			{
			  if($val['h_pid'] == "112")
			  {
				if(intval($farmid) < 11)
				{
				  //js:split join 
				  //php:explode implode
				  $h_harvest = explode(",",$val['h_harvest']);
				  $land_money = $h_harvest[intval($farmid)-1];
				  $land = explode(",",$val['h_land']);
				  $time = explode("|",$val['h_h_time']);
				  $time[intval($farmid)-1] = date('Y-m-d')." 00:00:00";
				  
				  $pid = "112";
				  $landtype="普通地";
				  $i = 0;
				  for($a = 0; $a < count($land); $a++)
				  {
				    if($land[$a] == "1")
				    {
				      $i++;
				    }
				  }
				  $num_now = 300;
				}
			  }
			  else
			  {
				if(intval($farmid) >= 11)
				{
				  $h_harvest = explode(",",$val['h_harvest']);
				  $land_money = $h_harvest[intval($farmid)-11];
				  $land =  explode(",",$val['h_land']);
				  $time = explode("|",$val['h_h_time']);
				  $time[intval($farmid)-11] = date('Y-m-d')." 00:00:00";
				  
				  $pid = "113";
				  $landtype="高基地";
				  $i = 0;
				  for($a = 0; $a < count($land); $a++)
				  {
				    if($land[$a] == "1")
				    {
				      $i++;
				    }
				  }
				  $num_now = 3000;
				}
			  }
			}
		}
		else
		{
		  $rstr = "wrong";
		}
		
		if(intval($farmid) < 11)
		{
			
		  $land_money_now = 300;

		  if($num < 300){  echo("您没有这么多KK了！快去充值吧~~！");exit; }

		  if($land[intval($farmid)-1] == '1'){
		  		exit('不可重复种地！');
		  }

		  $h_harvest[intval($farmid)-1] = $land_money_now;
		  $land[intval($farmid)-1] = "1";
		}
		else
		{
		  $land_money_now = 3000;

		  if($num < 3000){  echo("您没有这么多KK了！快去充值吧~~！");exit; }

		  if($land[intval($farmid)-11] == '1'){
		  		exit('不可重复种地！');
		  }

		  $h_harvest[intval($farmid)-11] = $land_money_now;
		  $land[intval($farmid)-11] = "1";
		}
		
		$land_str = implode(",", $land);
		$time_str = implode("|", $time);
	    $sHarvest = implode(',', $h_harvest);		

	    #session_start();
		if(!cookie('shouhuo')){
				cookie('shouhuo','shouhuo', time()+5);
				$h_point2 = $num - $land_money_now;
				if($h_point2 >= 0){

					$iAffectedRows = M("Kekehome\Model\MemberModel:h_member")->updatepoint2($memberlogged_username,$land_money_now);
					//MARK???
					if(empty($iAffectedRows)){
						#writeLog("member new attack:" . $query);
						\Think\Log::record("member new attack:" . $query,"INFO");
						exit;
					}
					M("Kekehome\Model\MemberfarmModel:h_member_farm")->updateMemberInfo($memberlogged_username,$pid,trim($land_str,','),$sHarvest,trim($time_str,'|'));

					$about=$landtype.$farmid.",增加播种KK";
					$account=M("Kekehome\Model\MemberModel:h_member")->getaccount($memberlogged_username);
					M("Kekehome\Model\LogPoint2Model:h_log_point2")->setLog($memberlogged_username,$land_money_now,$about,getUserIP(),"开垦",2,$account);
				  
				    echo("result:".$rstr."-". $land_money_now);

				}else{
					echo("您没有这么多KK了！快去充值吧~~！");exit;
				}
		}else{
			echo("正在处理,请稍后重试...");exit;
		}
	}
}