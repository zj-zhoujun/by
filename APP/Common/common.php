<?php

    /**
      * 出去多维数组重复值
      * @param array  array     多维数组
      * @return newarr array    去除重复值后 新的数组
      * @return author            
     */
    function arr_unique($array){
        $newarr = array();
        foreach($array as $key=>$v){
            if(!in_array($v, $newarr)){
              $newarr[$key]=$v;
            }
        }
        return $newarr;
    }

//array_column
if(!function_exists('array_column')){
	   
	function array_column($array,$column_key,$index_key=NULL){
		
 		$result = array();
        foreach($array as $arr){
            if(!is_array($arr)) continue;

            if(is_null($column_key)){
                $value = $arr;
            }else{
                $value = $arr[$column_key];
            }

            if(!is_null($index_key)){
                $key = $arr[$index_key];
                $result[$key] = $value;
            }else{
                $result[] = $value;
            }

        }

        return $result;		
		
	}
	   
}













//传入一个 父name 获取 所有的子0 是返回 数组  1 是返回 数量

function two_number($number){
			
		return number_format($number,2);
	
}


function four_number($number){
			
		return number_format($number,4);
	
}  

function set_number($number,$num){
			
		return number_format($number,$num);
	
}  


function getChildsId($cate,$id,$type=0){
	
	    $arr=array();
		foreach($cate as $v){
			if($v['parent_id']==$id){
				$arr[]=$v['id'];
				$arr=array_merge($arr,getChildsId($cate,$v['id']));
			}
				
			
		 }
		 
		if($type==0){
			 return $arr;	
		}else{
			 return count($arr);	
			
		}
		 
			
	
}


function is_mobile() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $mobile_agents = array("240x320", "acer", "acoon", "acs-", "abacho", "ahong", "airness", "alcatel", "amoi",
        "android", "anywhereyougo.com", "applewebkit/525", "applewebkit/532", "asus", "audio",
        "au-mic", "avantogo", "becker", "benq", "bilbo", "bird", "blackberry", "blazer", "bleu",
        "cdm-", "compal", "coolpad", "danger", "dbtel", "dopod", "elaine", "eric", "etouch", "fly ",
        "fly_", "fly-", "go.web", "goodaccess", "gradiente", "grundig", "haier", "hedy", "hitachi",
        "htc", "huawei", "hutchison", "inno", "ipad", "ipaq", "iphone", "ipod", "jbrowser", "kddi",
        "kgt", "kwc", "lenovo", "lg ", "lg2", "lg3", "lg4", "lg5", "lg7", "lg8", "lg9", "lg-", "lge-", "lge9", "longcos", "maemo",
        "mercator", "meridian", "micromax", "midp", "mini", "mitsu", "mmm", "mmp", "mobi", "mot-",
        "moto", "nec-", "netfront", "newgen", "nexian", "nf-browser", "nintendo", "nitro", "nokia",
        "nook", "novarra", "obigo", "palm", "panasonic", "pantech", "philips", "phone", "pg-",
        "playstation", "pocket", "pt-", "qc-", "qtek", "rover", "sagem", "sama", "samu", "sanyo",
        "samsung", "sch-", "scooter", "sec-", "sendo", "sgh-", "sharp", "siemens", "sie-", "softbank",
        "sony", "spice", "sprint", "spv", "symbian", "tablet", "talkabout", "tcl-", "teleca", "telit",
        "tianyu", "tim-", "toshiba", "tsm", "up.browser", "utec", "utstar", "verykool", "virgin",
        "vk-", "voda", "voxtel", "vx", "wap", "wellco", "wig browser", "wii", "windows ce",
        "wireless", "xda", "xde", "zte");
    $is_mobile = false;
    foreach ($mobile_agents as $device) {
        if (stristr($user_agent, $device)) {
            $is_mobile = true;
            break;
        }
    }
    return $is_mobile;
}

function reg_jl($user_id,$order){
	
	$userinfo = M("member")->where(array("id"=>$user_id))->find();
	$product = M("product");
	$id =  $order;
	//查询矿机信息
	$data = $product -> find($id);
	if(empty($data)){
		return array('result'=>0,'msg'=>'矿机不存在');
		exit;
	}

	 $num=C('num');

    for($i=1;$i<=$num;$i++){

        $map = array();
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'Q', 'Q', 'I', 'J');
        $map['kjbh'] = $yCode[intval(date('Y')) - 2011] . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
        $map['user'] = session('username');
        $map['user_id'] = $user_id;
        $map['project']= $data['title'];
        $map['sid'] = $data['id'];
        $map['yxzq'] = $data['yszq'];
        $map['sumprice'] = $data['price'];
        $map['addtime'] = date('Y-m-d H:i:s');
        $map['imagepath'] = $data['thumb'];
        $map['lixi']	= $data['gonglv'];
        $map['kjsl'] =  $data['shouyi'];
        $map['zt'] =  1;
        $map['UG_getTime'] =  time();
        M('order')->add($map);
        jinbi(session('username'),0,'活动赠'.$data['title'],1,4);

        $product->where(array("id"=>$id))->setDec("stock");
    }
	
		
	
	
   	return array('result'=>1,'msg'=>'成功');
	
	
}








/**
 * 友好时间显示
 * @param $time
 * @return bool|string
 */
function friend_date($time)
{
    if (!$time)
        return false;
    $fdate = '';
    $d = time() - intval($time);
    $ld = $time - mktime(0, 0, 0, 0, 0, date('Y')); //得出年
    $md = $time - mktime(0, 0, 0, date('m'), 0, date('Y')); //得出月
    $byd = $time - mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')); //前天
    $yd = $time - mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')); //昨天
    $dd = $time - mktime(0, 0, 0, date('m'), date('d'), date('Y')); //今天
    $td = $time - mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')); //明天
    $atd = $time - mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')); //后天
    if ($d == 0) {
        $fdate = '刚刚';
    } else {
        switch ($d) {
            case $d < $atd:
                $fdate = date('Y年m月d日', $time);
                break;
            case $d < $td:
                $fdate = '后天';
                break;
            case $d < 0:
                $fdate = '明天';
                break;
            case $d < 60:
                $fdate = $d . '秒前';
                break;
            case $d < 3600:
                $fdate = floor($d / 60) . '分钟前';
                break;
            case $d < $dd:
                $fdate = floor($d / 3600) . '小时前';
                break;
            case $d < $yd:
                $fdate = '昨天';
                break;
            case $d < $byd:
                $fdate = '前天';
                break;
            case $d < $md:
                $fdate = date('m月d日', $time);
                break;
            case $d < $ld:
                $fdate = date('m月d日', $time);
                break;
            default:
                $fdate = date('Y年m月d日', $time);
                break;
        }
    }
    return $fdate;
}





function mmtjrennumadd($parent_id)
{
	// dump($parent_id);die;
    
    // 是否升级送矿机
   	$a111 = M('member')->where(array('id' => $parent_id))->find();
		if ($a111['parent_id']) {
	M('member')->where(array('id' => $a111['parent_id']))->setInc('tdnum',1);//  gamecount  parentcount
		 }
   	// 当前矿机升级条件
   	$memberGroup = M('member_group')->where(array('level'=>$a111['level']))->find();
   	// 满足条件送矿机
   	if ($a111['tdnum'] >= $memberGroup['teamnum'] && $a111['ztnum'] >= $memberGroup['tjjnum']) 
   	{
   		M('member')->where(array('id' => $parent_id))->setInc('jinbi',$memberGroup['item4']);
   		M('member')->where(array('id' => $parent_id))->setInc('kczc',$memberGroup['item5']);
   		$maxLevel = M('member_group')->field('max(level) a')->find();
   		$nowLevel = $a111['level'] +1;
   		if ($nowLevel>=$maxLevel['a']) 
   		{
   			$nowLevel = $maxLevel['a'];
   		}
   		M('member')->where(array('id' => $parent_id))->save(array('level'=>$nowLevel));
   		if ($memberGroup['item7'] > 0) 
   		{
   			//查询矿机信息
   			$data = M('product')->where(array('id'=>$memberGroup['item6']))->find();
   			if(!empty($data)){
   			    for($i=1;$i<=$memberGroup['item7'];$i++){
   			        $map = array();
   			        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'Q', 'Q', 'I', 'J');
   			        $map['kjbh'] = $yCode[intval(date('Y')) - 2011] . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
   			        $map['user'] = $a111['username'];
   			        $map['user_id'] = $a111['id'];
   			        $map['project']= $data['title'];
   			        $map['sid'] = $data['id'];
   			        $map['yxzq'] = $data['yszq'];
   			        $map['sumprice'] = $data['price'];
   			        $map['addtime'] = date('Y-m-d H:i:s');
   			        $map['imagepath'] = $data['thumb'];
   			        $map['lixi']	= $data['gonglv'];
   			        $map['kjsl'] =  $data['shouyi'];
   			        $map['zt'] =  1;
   			        $map['UG_getTime'] =  time();
   			        M('order')->add($map);
   			        jinbi($a111['username'],0,'升级'.'赠'.$data['title'],1,3);
   			        M('product')->where(array("id"=>$memberGroup['item7']))->setDec("stock");
   			    }
   			}
   		}
   	}
   	if ($a111['parent_id']) 
   	{
   	  mmtjrennumadd($a111['parent_id']);
   	} else{
   	   return true;
   	}
}


//升级
function updateLevel(){
	  $list = M("member")->where("`level`>0")->order("id desc")->select();
	  foreach($list as $k=>$v){
		  $level = $v['level'] + 1;
		  $groupinfo = M("member_group")->where(array("level"=>$level))->find();
		  if($groupinfo){
			  if($v['parentcount']>=$groupinfo['tjjnum'] && $v['gamecount']>=$groupinfo['teamnum'] && $v['teamgonglv']>=$groupinfo['teamsuanli']){
				  M("member")->where(array("id"=>$v['id']))->setField("level",$level);
			  }
		  }
	  }
	
}



//会员等级
function group($level){
	        if($level==0){
				return "普通会员";
			}
			$infos = M('member_group')->field('level,name')->select();
			foreach($infos as $k=>$v){
				$group[$v['level']] = $v['name'];
			}	
	        return $group[$level];
}



	 //获取左侧末端成员ID 双轨
	function find_left_user($username){
		      $r =  M('member')->where(array('username'=>$username))->find();
			  $p = $username;
			  if($r['left']!=NULL){


						$p = find_left_user($r['left']);

			  }
			  return $p;
	}
  //返回上级所有安置成员 三轨
	function find_top_fid($fparents,$n=0){
			$r =  M('member_two')->where(array('id'=>$fparents))->find();
			$p = $fparents;

			 $fparents = $r['fparents'];
			$n++;

			if($fparents!= NULL){
				if($n<11150){

						 $p .=','.find_top_fid($fparents,$n);


				}
			}
		   return rtrim($p, ",");
    }
	 //获取所有下层成员ID 三轨
	function find_member_down($cid){
              $ids = array();
			  if($cid['0']!=NULL || $cid['1']!=NULL || $cid['2']!=NULL){
		          $id = $cid;
				  foreach($id as $k=>$v){
					   if($v!=NULL){
						$ids[]= $v;
						$r =  M('member')->where(array('username'=>$v,'status'=>1))->find();
						$ids= array_merge($ids,find_member_down(array($r['left'],$r['center'],$r['right'])));
					  }
				  }
			  }
			  return $ids;
	}

    //返回当前层数
	function get_ceng($fparent,$n=0){
		$n++;
		if($fparent!=NULL){
		    $rs =  M('member')->field('fparent')->where(array('username'=>$fparent))->find(); //获取父级属性
			if($rs['fparent']!=NULL){
				$n = get_ceng($rs['fparent'],$n);
			}
		}
		return $n;

	}
  //返回上级所有安置成员
	function fl_top_fid($fparent,$type=0,$n=0){
			$r =  M('member')->where(array('username'=>$fparent))->find();
			if($r['status']!=0){
				$p = $fparent;
			}
			$fparent = $r['fparent'];
			$n++;

			if($fparent!= NULL){
				if($type==1 && $n<11150){
					if($r['status']!=0){
						 $p .=','.fl_top_fid($fparent,1,$n);
				  }else{
						 $p .=fl_top_fid($fparent,1,$n);
				  }


				}elseif($type==0){
				   $p =fl_top_fid($fparent);
				}
			}
		   return rtrim($p, ",");
    }
	 //获取所有下层成员ID
	  function all_member_down($cid){
              $ids = array();
			  if($cid['0']!=NULL || $cid['1']!=NULL){
		          $username = $cid;
				  foreach($username as $k=>$v){
					   if($v!=NULL){
						$ids[]= $v;
						$r =  M('member')->where(array('username'=>$v,'status'=>1))->find();
						$ids= array_merge($ids,all_member_down(array($r['left'],$r['right'])));
					  }
				  }
			  }
			  return $ids;
		}
			 //获取所有下层成员ID
	  function all_member_down2($cid){
              $ids = array();
			  if($cid['0']!=NULL || $cid['1']!=NULL){
		          $username = $cid;
				  foreach($username as $k=>$v){
					   if($v!=NULL){
						  $r =  M('member')->where(array('username'=>$v,'status'=>1))->find();
						  if($r){
							  $ids[]= $v;
						  }
						  $ids= array_merge($ids,all_member_down2(array($r['left'],$r['right'])));
					  }
				  }
			  }
			  return $ids;
		}
	  //返回对应层数会员的数量
	   function get_c_num($username){
			   $mu =  M('member')->where(array('username'=>$username,'status'=>1))->find();

			   $muceng = all_member_down_c(array($mu['left'],$mu['right']));
			   $f_arr = array();
               foreach($muceng as $k=>$v){
				   $m =  M('member')->where(array('username'=>$v[0],'status'=>1))->find();
				   if($m){
				      $f_arr[$v[1]][] = $v[0];
				   }

			   }
		       return $f_arr;
	  }
	 //获取所有下层成员ID
	  function all_member_down_c($cid,$n=0){
              $ids = array();
			  if($cid['0']!=NULL || $cid['1']!=NULL){
		          $username = $cid;
				  ++$n;
				  foreach($username as $k=>$v){
					   if($v!=NULL){
						$ids[]= array($v,$n);
						$r =  M('member')->where(array('username'=>$v,'status'=>1))->find();
						$ids= array_merge($ids,all_member_down_c(array($r['left'],$r['right']),$n));
					  }
				  }
			  }
			  return $ids;
		}
	   //获取所有下层成员包含自身的业绩数量
		 function get_product($username){
			 //塔顶成员信息
			$memberinfo =  M('member')->where(array('username'=>$username))->find();
			$xiaceng = array();

			//获取下层成员
			$xiaceng = all_member_down(array($memberinfo['left'],$memberinfo['right']));
			$xiaceng[] = $username;
			$number = 0;
             foreach($xiaceng as $k=>$v){
				//当前会员详细信息
				 $r =  M('member')->field('my_jd,left,right')->where(array('username'=>$v))->find();
				 $sum =   M('order')->where(array('member'=>$v,'status'=>2))->sum('num');
				 if(empty($sum)){
					 $number +=0;
				 }else{
					 $number +=$sum;
				 }

			 }
			 return $number;

		}
 //返回标准model样式代码
 function htmlModel($title,$content){
	$html = "<div class='panel'><div class='panel-heading'><span class='panel-icon'><i class='fa fa-pencil'></i></span><span class='panel-title title'>{$title}</span></div><div class='panel-body content'>{$content}</div><div class='panel-footer text-right'></div></div>";
	return $html;
  }
  

    /**
     * 资金日志
     * @param $member 会员名称
     * @param $money  产生的金额
     * @param $desc   描述
	 * @param $jj     资金增减 1增加 0减少
	 * @param $type   日志类型
     * @return bool
     */

function account_log4($member,$money,$desc,$jj,$type=0,$status=1){
	
	  $qjinbidetail = M('qjinbidetail');  
	  $oldjinbi = M('member')->where(array('username'=>$member))->getField('qjinbi');

	  
	  $data = array();
	  $data['member']  = $member;
	  if($jj==1){
		    $oldjinbi = $oldjinbi - $money;
		    $data['adds']    = $money;
	        $data['balance'] = $money + $oldjinbi;	  
	  }else{
		    $oldjinbi = $oldjinbi + $money;
            $data['reduce']  = $money;
            $data['balance'] = $oldjinbi - $money;		  
	  }

	  $data['addtime'] = time();
	  $data['type']    = $type;
	  $data['desc']    = $desc;
	  $data['status']    = $status;
	  $qjinbidetail->add($data);
}


// 可售
function keshou($member,$money,$desc,$jj,$type){

    $keshoudetail = M('keshoudetail');
    $ksye = M('member')->where(array('username'=>$member))->getField('ksye');
    $data = array();
    $data['member']  = $member;
    $data['type']  = $type;
    if($jj==1){
        $ksye = $ksye - $money;
        $data['adds']    = $money;
        $data['balance'] = $money + $ksye;
    }else{
        $ksye = $ksye + $money;
        $data['reduce']  = $money;
        $data['balance'] = $ksye - $money;
    }

    $data['addtime'] = time();
    $data['desc']    = $desc;
    $keshoudetail->add($data);
}

// 矿池资产明细
function zichan($member,$money,$desc,$jj,$type,$hdjlID=0){

    $zichandetail = M('zichandetail');
    $kczc = M('member')->where(array('username'=>$member))->getField('kczc');
    $data = array();
    $data['member']  = $member;
    $data['type']  = $type;
    if($jj==1){
        $kczc = $kczc - $money;
        $data['adds']    = $money;
        $data['balance'] = $money + $kczc;
    }else{
        $kczc = $kczc + $money;
        $data['reduce']  = $money;
        $data['balance'] = $kczc - $money;
    }

    $data['addtime'] = time();
    $data['desc']    = $desc;
    if ($hdjlID) 
    {
    	$data['hdjl_id'] = $hdjlID;
    }
    $zichandetail->add($data);
}

// /矿池钱包明细
function jinbi($member,$money,$desc,$jj,$type){

    $jinbidetail = M('jinbidetail');
    $jinbi = M('member')->where(array('username'=>$member))->getField('jinbi');
    $data = array();
    $data['member']  = $member;
    $data['type']  = $type;
    if($jj==1){
        $jinbi = $jinbi - $money;
        $data['adds']    = $money;
        $data['balance'] = $money + $jinbi;
    }else{
        $jinbi = $jinbi + $money;
        $data['reduce']  = $money;
        $data['balance'] = $jinbi - $money;
    }

    $data['addtime'] = time();
    $data['desc']    = $desc;
    $jinbidetail->add($data);
}
// 冻结明细
function dongjie($member,$money,$desc,$jj,$type){

    $dongjiedetail = M('dongjiedetail');
    $qjinbi = M('member')->where(array('username'=>$member))->getField('ksed');
    $data = array();
    $data['member']  = $member;
    $data['type']  = $type;
    if($jj==1){
        $qjinbi = $qjinbi - $money;
        $data['adds']    = $money;
        $data['balance'] = $money + $qjinbi;
    }else{
        $qjinbi = $qjinbi + $money;
        $data['reduce']  = $money;
        $data['balance'] = $qjinbi - $money;
    }

    $data['addtime'] = time();
    $data['desc']    = $desc;
    $dongjiedetail->add($data);
}
    /**
     * 短信验证码验证
     * @param $mobile   手机
     * @param $code  验证码
     * @param $session_id   唯一标示
     * @return bool
     */
     function sms_code_verify($mobile,$code,$session_id){
        //判断是否存在验证码
        $data = M('sms_log')->where(array('mobile'=>$mobile,'session_id'=>$session_id,'code'=>$code))->order('id DESC')->find();
        if(empty($data))
            return array('status'=>-1,'msg'=>'手机验证码不匹配');

        //获取时间配置
        $sms_time_out = C('CODE_GQ');
        //验证是否过时
        if((time() - $data['add_time']) > $sms_time_out){
			return array('status'=>-1,'msg'=>'手机验证码超时'); //超时处理
		}
            
        //M('sms_log')->where(array('mobile'=>$mobile,'session_id'=>$session_id,'code'=>$code))->delete();
        return array('status'=>1,'msg'=>'验证成功');
    }
//检测2级密码
function checkPass2($username,$pass2){
            if ($password2 = M('member')->where(array('username'=>$username))->getField('password2')) {
                if($password2==md5($pass2)){
					return true;
				}else{
					return false;
				}
            }else{
				return false;
			}
}
/**
 * 检查手机号码格式
 * @param $mobile 手机号码
 */
function check_mobile($mobile){
    if(preg_match('/1[34578]\d{9}$/',$mobile))
        return true;
    return false;
}

function sms_log($mobile,$code,$session_id){
		
       $s_time=strtotime(date("Y-m-d 00:00:01",time()));
	   $o_time=strtotime(date("Y-m-d 23:59:59",time()));
	   
	   $sms_count = M('sms_log')->where("mobile = '{$mobile}' and add_time > {$s_time} and add_time < {$o_time}")->count();
	   
	   if($sms_count >=5){
		   return array('status'=>-1,'msg'=>'超出每日发送次数');
	   }
	   
	   
	    //判断是否存在验证码
        $data = M('sms_log')->where(array('mobile'=>$mobile,'session_id'=>$session_id))->order('id DESC')->find();
       
	    //获取时间配置
        $sms_time_out = C('CODE_CF');
        //秒以内不可重复发送
        if($data && (time() - $data['add_time']) < $sms_time_out)
            return array('status'=>-1,'msg'=>$sms_time_out.'秒内不允许重复发送');
        //$row = M('sms_log')->add(array('mobile'=>$mobile,'code'=>$code,'add_time'=>time(),'session_id'=>$session_id));
       /* if(!$row){
			return array('status'=>-1,'msg'=>'发送失败!!');
		}*/
        $sms_type=C('sms_type'); 
		
		if($sms_type==1){
			 $send = sendSMS($mobile,$code,$session_id);
				
		}elseif($sms_type==2){
			$send = sendSMS2($mobile,$code,$session_id);	
		}else{
			$send = sendSMS($mobile,$code,$session_id);
		} 
		    
       
        if(!$send){
			 return array('status'=>-1,'msg'=>'发送失败!!');
		}else{
			 return array('status'=>1,'msg'=>'发送成功!!');
		}
           
       
}

function sendSMS2($mobile, $code,$session_id){
	
	import('ORG.Util.Ucpaas');	
		//初始化必填
	$options['accountsid']=C('sid');
	$options['token']=C('token');
	//初始化 $options必填
	$ucpass = new Ucpaas($options);
	
	//开发者账号信息查询默认为json或xml
	header("Content-Type:text/html;charset=utf-8");
	
	//短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
	$appId = C('appid');
	$to = $mobile;
	$templateId = C('templateId');
	$param=$code;
	$result=$ucpass->templateSMS($appId,$to,$templateId,$param);
	$result=json_decode($result,true);
	
	if($result['resp']['respCode']=='000000'){
		
		// 从数据库中查询是否有验证码
        //$data = M('sms_log')->where("code = '$code' and add_time > ".(time() - 60*60))->find();
        // 没有就插入验证码,供验证用
       // empty($data) && M('sms_log')->add(array('mobile' => $mobile, 'code' => $code, 'add_time' => time(), 'session_id' => $session_id));
       M('sms_log')->add(array('mobile' => $mobile, 'code' => $code, 'add_time' => time(), 'session_id' => $session_id));
	    return true;   
	}else{
		return false;	
	}

}




//    /**
//     * 发送短信
//     * @param $mobile  手机号码
//     * @param $code    验证码
//     * @return bool    短信发送成功返回true失败返回false
//     */
 function sendSMS($mobile, $code,$session_id)
{
	if(is_array($mobile)){
	  $mobile = implode(",", $mobile);
	}
	$qycode=rand(111111,999999);
	$appkey = C('CODE_APIKEY'); //请用自己的appkey代替
	$content="您的验证码为：{$qycode}，在10分钟内有效。【三泽科技】";
		
	$url="http://api.jisuapi.com/sms/send?appkey=$appkey&mobile=$mobile&content=$content";
	$return = ccurlOpen($url);
	
	if ($return != 0) {
		        return false;
	} else {
		M('sms_log')->add(array('mobile' => $mobile, 'code' => $qycode, 'add_time' => time(), 'session_id' => $session_id));
        
		return true;  
	}

} 

function ccurlOpen($url, $config = array()){
    $arr = array('post' => false,'referer' => $url,'cookie' => '', 'useragent' => 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; customie8)', 'timeout' => 20, 'return' => true, 'proxy' => '', 'userpwd' => '', 'nobody' => false,'header'=>array(),'gzip'=>true,'ssl'=>false,'isupfile'=>false);
    $arr = array_merge($arr, $config);
    $ch = curl_init();
     
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, $arr['return']);
    curl_setopt($ch, CURLOPT_NOBODY, $arr['nobody']); 
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $arr['useragent']);
    curl_setopt($ch, CURLOPT_REFERER, $arr['referer']);
    curl_setopt($ch, CURLOPT_TIMEOUT, $arr['timeout']);
    //curl_setopt($ch, CURLOPT_HEADER, true);//获取header
    if($arr['gzip']) curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    if($arr['ssl'])
    {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    if(!empty($arr['cookie']))
    {
        curl_setopt($ch, CURLOPT_COOKIEJAR, $arr['cookie']);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $arr['cookie']);
    }
     
    if(!empty($arr['proxy']))
    {
        //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); 
        curl_setopt ($ch, CURLOPT_PROXY, $arr['proxy']);
        if(!empty($arr['userpwd']))
        {           
            curl_setopt($ch,CURLOPT_PROXYUSERPWD,$arr['userpwd']);
        }       
    }   
     
    //ip比较特殊，用键值表示
    if(!empty($arr['header']['ip']))
    {
        array_push($arr['header'],'X-FORWARDED-FOR:'.$arr['header']['ip'],'CLIENT-IP:'.$arr['header']['ip']);
        unset($arr['header']['ip']);
    }  
    $arr['header'] = array_filter($arr['header']);
     
    if(!empty($arr['header']))
    {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arr['header']);
    }
 
    if ($arr['post'] != false)
    {
        curl_setopt($ch, CURLOPT_POST, true);
        if(is_array($arr['post']) && $arr['isupfile'] === false)
        {
            $post = http_build_query($arr['post']);           
        }
        else
        {
            $post = $arr['post'];
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }   
    $result = curl_exec($ch);
    //var_dump(curl_getinfo($ch));
    curl_close($ch);
 
    return $result;
}



	/**
	 *  post数据
	 *  @param string $url		post的url
	 *  @param int $limit		返回的数据的长度
	 *  @param string $post		post数据，字符串形式username='dalarge'&password='123456'
	 *  @param string $cookie	模拟 cookie，字符串形式username='dalarge'&password='123456'
	 *  @param string $ip		ip地址
	 *  @param int $timeout		连接超时时间
	 *  @param bool $block		是否为阻塞模式
	 *  @return string			返回字符串
	 */
	
	 function sendPost($curlPost,$url) {
        header("Content-Type: text/html; charset=utf-8");
        
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_NOBODY, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
		$return_str = curl_exec($curl);
		curl_close($curl);
		return  $return_str;
	  
	}
	/**
	 * 公用函数库
	 */
	function p($array){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
        
    /**
     * 用于显示上个月和下个月
     * @param int $sign 1:表示上个月 0：表示下个月
     * @return string
     */
    function get_month($sign="1"){
        //得到系统的年月
        $tmp_date=date("Ym");
        //切割出年份
        $tmp_year=substr($tmp_date,0,4);
        //切割出月份
        $tmp_mon =substr($tmp_date,4,2);
        $tmp_nextmonth=mktime(0,0,0,$tmp_mon+1,1,$tmp_year);
        $tmp_forwardmonth=mktime(0,0,0,$tmp_mon-1,1,$tmp_year);
        if($sign==0){
            //得到当前月的下一个月 
            return $fm_next_month=date("Y-m",$tmp_nextmonth);        
        }else{
            //得到当前月的上一个月 
            return $fm_forward_month=date("Y-m",$tmp_forwardmonth);         
        }
    }

	/**
	 * 系统操作日志
	 * @param  [string] $account [编号]
	 * @param  [string] $type    [日志描述]
	 * @param  [string] $desc    [日志类型 member:会员	admin:管理员]
	 * @return [type]          [description]
	 */
	function write_log($account , $type , $desc){
			import('ORG.Net.IpLocation');// 导入IpLocation类
		    $Ip = new IpLocation(); // 实例化类
		    $location = $Ip->getlocation(get_client_ip()); // 获取某个IP地址所在的位置
		    $data['logiplocal'] = $location['country'].$location['area']; // 所在国家或者地区
	  		$data['logtime'] = time();
	  		$data['logaccount'] = $account;
	  		$data['logip'] = get_client_ip();
	  		$data['logdesc'] = $desc;
	  		$data['logtype'] = $type;	
			M('log')->data($data)->add();
	}

	//返回今天的起点和终点时间戳
	function todaytime($mode){
		if ($mode == 'start') {
			return mktime(0,0,0,date('m'),date('d'),date('Y'));
		}elseif ($mode == 'end') {
			return mktime(0,0,0,date('m'),date('d')+1,date('Y'));
		}
	}

	function alert($info = '', $url = '', $top = 0){
		$win = $top ? 'window.top' : 'window';
		die("
			<script>
				if('$info' != ''){alert('$info');}
				'$url'==-1 ? window.history.back() : ('$url' == '' ? '' : $win.location = '$url');
			</script>
		");
	}

	//会员前台根据字段返回相应的值
	function getFieldValue($table,$where,$key){
		$value = M($table)->where($where)->getField($key);
		if ($value) {
			return $value;
		}else{
			return false;
		}	
	}

	//取当前登录会员表字段信息
	function getMemberField($field){
		return getFieldValue('member',array('id'=>session('mid')),$field);
	}

	/**
	 * 字节格式化
	 * @param  [type]  $input [description]
	 * @param  integer $dec   [description]
	 * @return [type]         [description]
	 */
	function byte_format($input, $dec=0)
	{
	  $prefix_arr = array("B", "K", "M", "G", "T");
	  $value = round($input, $dec);
	  $i=0;
	  while ($value>1024)
	  {
	     $value /= 1024;
	     $i++;
	  }
	  $return_str = round($value, $dec).$prefix_arr[$i];
	  return $return_str;
	}

	/**
	 * 格式化时间
	 * @param  [type] $time   [description]
	 * @param  string $format [description]
	 * @return [type]         [description]
	 */
	function toDate($time, $format = 'Y-m-d H:i:s') {
		if (empty ( $time )) {
			return '';
		}
		$format = str_replace ( '#', ':', $format );
		return date ($format, $time );
	}

	function dir_path($path) {
		$path = str_replace('\\', '/', $path);
		if(substr($path, -1) != '/') $path = $path.'/';
		return $path;
	}

	function fileext($filename) {
		return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
	}

	function dir_list($path, $exts = '', $list= array()) {
		$path = dir_path($path);
		$files = glob($path.'*');
		foreach($files as $v) {
			$fileext = fileext($v);
			if (!$exts || preg_match("/\.($exts)/i", $v)) {
				$list[] = $v;
				if (is_dir($v)) {
					$list = dir_list($v, $exts, $list);
				}
			}
		}
		return $list;
	}

	function filter_search_field($v1) {
		if ($v1 == "keyword")
			return true;
		$prefix = substr($v1, 0, 3);
		$arr_key = array("be_", "en_", "eq_", "li_", "lt_", "gt_");
		if (in_array($prefix, $arr_key)) {
			return true;
		} else {
			return false;
		}
	}

	function date_to_int($date) {
		$date = explode("-", $date);
		$time = explode(":", "00:00");
		$time = mktime($time[0], $time[1], 0, $date[1], $date[2], $date[0]);
		return $time;
	}
	
	
	/**
	 * 数字自动补0
	 * @param unknown $str	原字符串
	 * @param unknown $len	新字符串长度
	 * @param unknown $msg	填补字符
	 * @param string $type	类型，0为后补，1为前补
	 * @return unknown|string
	 */
	function dispRepair($str,$len,$msg,$type='1') {
		$length = $len - strlen($str);
		if($length<1)return $str;
		if ($type == 1) {
			$str = str_repeat($msg,$length).$str;
		} else {
			$str .= str_repeat($msg,$length);
		}
		return $str;
	}
	


	function check_ad_user_v($check_name){
		$result = false;
		session('userad') != '' and $result = true;

		if (strpos(C('CON_USER_NOAD_USE'), $check_name)>0) {
			$result = true;
		}
		return $result;
	}
	
	function dogif($treeobj,$pobj,$gifrow,$gifstr,$modename,$userrsobj){
		if ($gifstr == '') {
			return true;
		}
		$t_gifstr = $gifstr;
		//时间替换免
		
		//团队查询
		$regex = '/\{treewhere\,([^\}]+)\}/i';
		$matches = array();
		preg_match($regex, $t_gifstr,$matches);
		foreach ($matches as $v) {
			$dogifmode = $treeobj->getmode[$modename];
			switch ($dogifmode->mode) {
				case 0:
				case 5:
					//此处省略SQl代码
					$t_val = 0;
					if (is_null($t_val) || $t_val) {
						$t_val = 0;
					}
					$t_gifstr = str_replace($v, $t_val, $t_gifstr);
					break;
				case 2:
					//此处省略SQl代码
					$t_val = 0;
					if (is_null($t_val) || $t_val) {
						$t_val = 0;
					}
					$t_gifstr = str_replace($v, $t_val, $t_gifstr);
					break;
			}
		}
		//条件查询
		//$regex = '/\{where\,([^\}]+)\}/i';
		//单团队业绩查询
		
		//.....
		return true;
	}
	
	function substr_cn($string_input,$start,$length) { 
    /* 功能: 
     * 此算法用于截取中文字符串 
     * 函数以单个完整字符为单位进行截取,即一个英文字符和一个中文字符均表示一个单位长度 
     * 参数: 
     * 参数$string为要截取的字符串, 
     * 参数$start为欲截取的起始位置, 
     * 参数$length为要截取的字符个数(一个汉字或英文字符都算一个) 
     * 返回值: 
     * 返回截取结果字符串 
     * */ 
	    $str_input=$string_input; 
	    $len=$length; 
	    $return_str=""; 
	    //定义空字符串 
	    for ($i=0;$i<2*$len+2;$i++) 
	        $return_str=$return_str." "; 
	    $start_index=0; 
	    //计算起始字节偏移量 
	    for ($i=0;$i<$start;$i++) 
	    { 
	        if (ord($str_input{$start_index}>=161))          //是汉语      
	        { 
	            $start_index+=2; 
	        } 
	        else                                          //是英文 
	        { 
	            $start_index+=1; 
	        }         
	    }     
	    $chr_index=$start_index; 
	    //截取 
	    for ($i=0;$i<$len;$i++) 
	    { 
	        $asc=ord($str_input{$chr_index}); 
	        if ($asc>=161) 
	        { 
	            $return_str{$i}=chr($asc); 
	            $return_str{$i+1}=chr(ord($str_input{$chr_index+1})); 
	            $len+=1; //结束条件加1 
	            $i++;    //位置偏移量加1 
	            $chr_index+=2; 
	            continue;             
	        } 
	        else  
	        { 
	            $return_str{$i}=chr($asc); 
	            $chr_index+=1; 
	        } 
	    }     
	    return trim($return_str); 
	}//end of substr_cn 
	
	function cut_str($string, $sublen, $start = 0, $code = 'UTF-8') { 
		if($code == 'UTF-8') 
	    { 
	        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/"; 
	        preg_match_all($pa, $string, $t_string); 
	 
	        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)); 
	        return join('', array_slice($t_string[0], $start, $sublen)); 
	    } 
	    else 
	    { 
	        $start = $start*2; 
	        $sublen = $sublen*2; 
	        $strlen = strlen($string); 
	        $tmpstr = ''; 
	 
	        for($i=0; $i< $strlen; $i++) 
	        { 
	            if($i>=$start && $i< ($start+$sublen)) 
	            { 
	                if(ord(substr($string, $i, 1))>129) 
	                { 
	                    $tmpstr.= substr($string, $i, 2); 
	                } 
	                else 
	                { 
	                    $tmpstr.= substr($string, $i, 1); 
	                } 
	            } 
	            if(ord(substr($string, $i, 1))>129) $i++; 
	        } 
	        //if(strlen($tmpstr)< $strlen ) $tmpstr.= "..."; 
	        return $tmpstr; 
	    } 
	} 

	//根据IP查询具体的地址
	function get_ip_address($ip){
		$source=file_get_contents('http://www.ip138.com/ips138.asp?ip='.$ip.'&action=2'); 
		preg_match_all("/<li>(.*)<\/li>/isU",$source,$result);
		$ip = substr_cn($result[1][0],12,30);
        $ip = iconv('GB2312', 'UTF-8', $ip);
		return $ip;
	}
	
	function randStr($len=6,$format='ALL') { 
		switch($format) { 
		case 'ALL':
			$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz023456789-@#~'; break;
		case 'CHAR':
			$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~'; break;
		case 'NUMBER':
			$chars='0123456789'; break;
		default :
			$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~'; 
		break;
		}
		mt_srand((double)microtime()*1000000*getmypid()); 
		$password="";
		while(strlen($password)<$len)
		$password.=substr($chars,(mt_rand()%strlen($chars)),1);
		return $password;
	}


	
	
	
//自定义函数手机号隐藏中间四位  
function yc_phone($str){  
    $str=$str;  
    $resstr=substr_replace($str,'****',3,4);  
    return $resstr;  
} 

	

	/**
	 * 获取当前完整的URL
	 * @param  boolean $isall [是否获取完整的URL]
	 * @return [type]         [description]
	 */
	function get_url($isall = false){
		$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
	    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
	    if ($isall) {
	    	return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
	    }else{
	    	return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
	    }  
	}

	/**
	 * 将网体数据转换成whereid
	 * @param  [type] $netdata [description]
	 * @return [type]          [description]
	 */
	function netdata_to_whereid($netdata){
		$netdata2whereid = '';
		if ($netdata == '') {
			return $netdata2whereid;
		}
		$netarr = explode('|',$netdata);
		$netarr = array_filter($netarr);
		for ($i=0; $i < count($netarr); $i++) {
			$newarr = explode('-',$netarr[$i]);
			$arr[$i] = $newarr[0];
		}
		$netdata2whereid = implode(',',$arr);
		return $netdata2whereid;
	}







//加密//解密


function encrypt($string,$operation,$key=''){
    $key=md5($key);
    $key_length=strlen($key);
      $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
    $string_length=strlen($string);
    $rndkey=$box=array();
    $result='';
    for($i=0;$i<=255;$i++){
           $rndkey[$i]=ord($key[$i%$key_length]);
        $box[$i]=$i;
    }
    for($j=$i=0;$i<256;$i++){
        $j=($j+$box[$i]+$rndkey[$i])%256;
        $tmp=$box[$i];
        $box[$i]=$box[$j];
        $box[$j]=$tmp;
    }
    for($a=$j=$i=0;$i<$string_length;$i++){
        $a=($a+1)%256;
        $j=($j+$box[$a])%256;
        $tmp=$box[$a];
        $box[$a]=$box[$j];
        $box[$j]=$tmp;
        $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
    }
    if($operation=='D'){
        if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)){
            return substr($result,8);
        }else{
            return'';
        }
    }else{
        return str_replace('=','',base64_encode($result));
    }
}



//加密//解密2222


function encrypt2($string,$operation,$key=''){
    $key=md5($key);
    $key_length=strlen($key);
      $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,20).$string;
    $string_length=strlen($string);
    $rndkey=$box=array();
    $result='';
    for($i=0;$i<=255;$i++){
           $rndkey[$i]=ord($key[$i%$key_length]);
        $box[$i]=$i;
    }
    for($j=$i=0;$i<256;$i++){
        $j=($j+$box[$i]+$rndkey[$i])%256;
        $tmp=$box[$i];
        $box[$i]=$box[$j];
        $box[$j]=$tmp;
    }
    for($a=$j=$i=0;$i<$string_length;$i++){
        $a=($a+1)%256;
        $j=($j+$box[$a])%256;
        $tmp=$box[$a];
        $box[$a]=$box[$j];
        $box[$j]=$tmp;
        $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
    }
    if($operation=='D'){
        if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)){
            return substr($result,8);
        }else{
            return'';
        }
    }else{
        return str_replace('=','',base64_encode($result));
    }
}
























?>