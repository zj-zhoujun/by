<?php  
	header("Content-type:text/html;charset=utf-8");
	/**
	 * 会员推广控制器
	 */
	Class SemAction extends Action{
			
			public function _initialize(){
				//判断是否关闭了网站
				$open_web=C('open_web');
				if(empty($open_web)){
					$this->open_web_notice=C('open_web_notice');
					$this->display('Index:404');
					exit;
				}	
				//是否pc禁止访问		
				if(C('PC_LOGIN') == 'off'){
			
					if(!is_mobile()){ 
					header("Content-type:text/html;charset=utf-8");
					alert('请用手机访问！',U('Index/Login'));
					exit;
				} 
			
				}
				
			}

		
		//注册推广
		 public function regSem(){
			 header("Content-type:text/html;charset=utf-8");
			 
			 $d_key=I('get.u','','trim');//$d_keyid=encrypt("t24GWvVczWju",'D','xyb8888');
			 
			 if(!is_int($d_key)){
				  $d_key=str_replace('AAABBB','/',$d_key);
			      $uid =encrypt($d_key,'D','xyb8888');
			 }else{
				 $uid =$d_key; 		 
			}
			 
			 
			
			 $uid =intval($uid);
			 $userinfo = M('member')->where(array('id'=>$uid))->find();
			 if(!$userinfo){
				 //halt("错误的访问请求!");
				 $this->error('错误的访问请求!');
			 }
			 $username = M('member')->where(array('id'=>$uid))->getField('username');

			
			$this->assign('username',$username);			
			$this->assign('uid',$uid);			
			$this->display();			 
		 }
		 
		
	//注册推广
		 public function regSempost(){
            // alert('注册功能暂时关闭',-1);
            // exit;
             if (IS_POST) {
                 $password    = $_POST['password'];
                 $password1   = $_POST['password1'];
                 $password2  =  $_POST['password2'];
                 $password21  =  $_POST['password21'];
                 $data['username']      = $data['mobile']    = $_POST['mobile'];
                 $code = $_POST['code'];
                 $xy = $_POST['xy'];
                 $data['parent_id'] = M('member')->where(array('username'=>$_POST['parent']))->getField('id');
                 $data['parent'] = $_POST['parent'];
                 $a_ip = $_SERVER['REMOTE_ADDR'];
                 $ipcount = M("member")->where(array('ip'=>$a_ip))->count();
                 if ($ipcount >= C('ipren')) 
                 {
                    alert('禁止注册多个账户。',-1);
                    exit;
                    
                 }
                 if(empty($xy)){
                     alert('请认真阅读注册规则!',-1);
                 }
                 if(empty($_POST['parent'])){
                     alert('请输入推荐人编号!',-1);
                 }
                 //验证推荐人信息是否已存在及审核
                 if (!M('member')->where(array('username'=>$data['parent']))->getField('id')) {
                     alert('推荐人不存在!',-1);
                 }

                 if(empty($_POST['mobile'])){
                     alert('手机号码不能为空!',-1);
                 }

                 if(!preg_match("/^1[34578]{1}\d{9}$/",$data['mobile'])){

                     alert('手机号码格式不正确!',-1);
                 }
                 if (M('member')->where(array('mobile'=>trim($data['mobile'])))->getField('id')) {

                     alert('手机号已存在，请更换!',-1);
                 }


                 if(!$code){
                     alert('短信验证码不能为空!',-1);
                 }

                 $check_code = sms_code_verify($data['mobile'],$code,session_id());
                 if($check_code['status'] != 1){
                     
                     alert('手机验证码不匹配或者超时!',-1);
                 }



                 if (empty($password)  || empty($password1)) {
                     alert('登陆密码不能为空!',-1);
                 }
                 if(!preg_match("/^[a-zA-Z\d_]{6,}$/",$password)){
                     alert('登陆密码不能小于6位!',-1);
                 }
                 if ($password != $password1) {
                     alert('两次输入的登陆密码不相同!',-1);
                 }
                 if (empty($password2)  || empty($password21)) {
                     alert('交易密码不能为空!',-1);
                 }
                 if(!preg_match("/^[a-zA-Z\d_]{6,}$/",$password2)){
                     alert('交易密码不能小于6位!',-1);
                 }
                 if ($password2 != $password21) {
                     alert('两次输入的交易密码不相同!',-1);
                 }

                 $data['password']  = md5($password);
                 $data['password2'] = md5($password2);
                 $parentinfo = M('member')->where(array('username'=>$data['parent']))->find();
                 $data['parentpath']  = trim($parentinfo['parentpath'] . $parentinfo['id'] . '|');;
                 $data['regdate']     = time();
                 $data['kczc']     = C('zs_num');
                 $data['ip']       = $a_ip;

				$data['tdnum']      = 1;
                 $data['level']      = 0;
                 M('member')->add($data);
                 //我的上级直推加一
                 M('member')->where(array('username' => $data['parent']))->setInc('ztnum',1);
				 M('member')->where(array('username' => $data['parent']))->setInc('tdnum',1);
                 mmtjrennumadd($data['parent_id']);//  所有上级加一人

                 alert('注册成功！请登录后完善个人资料,即可获得免费矿机!',U('Index/Login/index'));

             }

		}



        //注册
        public function reg(){
            // alert('注册功能暂时关闭!',U('Index/Login/index'));
            //     exit;
			    $this->display();
        }
        public function regpost(){
            // alert('注册功能暂时关闭',-1);
            // exit;
            if (IS_POST) {
                $password    = $_POST['password'];
                $password1   = $_POST['password1'];
                $password2  =  $_POST['password2'];
                $password21  =  $_POST['password21'];
                $data['username']      = $data['mobile']    = $_POST['mobile'];
                $code = $_POST['code'];
                $xy = $_POST['xy'];
                $data['parent_id'] = M('member')->where(array('username'=>$_POST['parent']))->getField('id');
                $data['parent'] = $_POST['parent'];
                $a_ip = $_SERVER['REMOTE_ADDR'];
                $ipcount = M("member")->where(array('ip'=>$a_ip))->count();
                if ($ipcount >= C('ipren')) 
                {
                   alert('禁止注册多个账户。',-1);
                   exit;
                   
                }
                if(empty($xy)){
                    alert('请认真阅读注册规则!',-1);
                }
                if(empty($_POST['parent'])){
                    alert('推荐人不能为空!',-1);
                }
                //验证推荐人信息是否已存在及审核
                if (!M('member')->where(array('username'=>$data['parent']))->getField('id')) {
                    alert('推荐人不存在!',-1);
                }

                if(empty($_POST['mobile'])){
                    alert('手机号码不能为空!',-1);
                }

                if(!preg_match("/^1[34578]{1}\d{9}$/",$data['mobile'])){

                    alert('手机号码格式不正确!',-1);
                }
                if (M('member')->where(array('mobile'=>trim($data['mobile'])))->getField('id')) {

                    alert('手机号已存在，请更换!',-1);
                }


                if(!$code){
                    alert('短信验证码不能为空!',-1);
                }

                $check_code = sms_code_verify($data['mobile'],$code,session_id());
                if($check_code['status'] != 1){
                   
                    alert('手机验证码不匹配或者超时!',-1);
                }



                if (empty($password)  || empty($password1)) {
                    alert('登陆密码不能为空!',-1);
                }
                if(!preg_match("/^[a-zA-Z\d_]{6,}$/",$password)){
                    alert('登陆密码不能小于6位!',-1);
                }
                if ($password != $password1) {
                    alert('两次输入的登陆密码不相同!',-1);
                }
                if (empty($password2)  || empty($password21)) {
                    alert('交易密码不能为空!',-1);
                }
                if(!preg_match("/^[a-zA-Z\d_]{6,}$/",$password2)){
                    alert('交易密码不能小于6位!',-1);
                }
                if ($password2 != $password21) {
                    alert('两次输入的交易密码不相同!',-1);
                }

                $data['password']  = md5($password);
                $data['password2'] = md5($password2);
                $parentinfo = M('member')->where(array('username'=>$data['parent']))->find();
                $data['parentpath']  = trim($parentinfo['parentpath'] . $parentinfo['id'] . '|');;
                $data['regdate']     = time();
                $data['level']      = 0;
                $data['kczc']     = C('zs_num');
                $data['ip']       = $a_ip;
				$data['tdnum']      = 1;
                M('member')->add($data);
                //我的上级直推加一
                M('member')->where(array('username' => $data['parent']))->setInc('ztnum',1);
				M('member')->where(array('username' => $data['parent']))->setInc('tdnum',1);
                mmtjrennumadd($data['parent_id']);//  所有上级加一人

                alert('注册成功！请登录后完善个人资料,即可获得免费矿机!',U('Index/Login/index'));
            }
        }

    /**
     * 发送手机注册验证码
     */
    public function send_sms_reg_code(){
		
		
        $mobile = I('mobile');
		
          $verify=I('verCode','','trim');
         // exit(json_encode(array('status'=>-1,'msg'=> $verify)));
        if(empty($verify)){
            exit(json_encode(array('status'=>-1,'msg'=>'请输入图形验证码!')));
        }
        if($_SESSION['verify'] != md5($verify)) {
            exit(json_encode(array('status'=>-1,'msg'=>'图形验证码错误！!')));
        }
        if(!check_mobile($mobile))
            exit(json_encode(array('status'=>-1,'msg'=>'手机号码格式有误!')));
        

		if (M('member')->where(array('mobile'=>$mobile))->getField('id')) {
          exit(json_encode(array('status'=>-1,'msg'=>'手机号码已存在!')));
        }		
        $code =  rand(1000,9999);
        $send = sms_log($mobile,$code,session_id());
        if($send['status'] != 1){
			 exit(json_encode(array('status'=>-1,'msg'=>$send['msg'])));
		}
        session('verify',null);   
		exit(json_encode(array('status'=>1,'msg'=>'验证码已发送，请注意查收')));
    }

/**
     * 发送改密手机验证码
     */
    public function send_sms_gm_code(){
		
		
        $mobile = I('mobile');
		if(!$mobile && session('username')){
            $mobile = M('member')->where(array('username'=>session('username')))->getField('mobile');
        }
          $verify=I('verCode','','trim');
         // exit(json_encode(array('status'=>-1,'msg'=> $verify)));
        if(empty($verify)){
            exit(json_encode(array('status'=>-1,'msg'=>'请输入图形验证码!')));
        }
        if($_SESSION['verify'] != md5($verify)) {
            exit(json_encode(array('status'=>-1,'msg'=>'图形验证码错误！!')));
        }
        if(!check_mobile($mobile))
            exit(json_encode(array('status'=>-1,'msg'=>'手机号码格式有误!')));
		
        if (!M('member')->where(array('mobile'=>$mobile))->getField('id')) {
          exit(json_encode(array('status'=>-1,'msg'=>'手机号码不存在!')));
        }
			
        $code =  rand(1000,9999);
        $send = sms_log($mobile,$code,session_id());
        if($send['status'] != 1){
			 exit(json_encode(array('status'=>-1,'msg'=>$send['msg'])));
		}
        session('verify',null);   
		exit(json_encode(array('status'=>1,'msg'=>'验证码已发送，请注意查收')));
    }
        public function verify(){
		ob_clean();
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }



}
?>