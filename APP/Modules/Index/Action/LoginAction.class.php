<?php

/**
 * 会员前台登录控制器
 */
Class LoginAction extends Action{

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
    public function index(){
        $this->display();
    }


    /**
     * 会员登录视图
     * @return [type] [description]
     */
    public function logincl(){
			 header("Content-type:text/html;charset=utf-8");

        //验证系统是否为开放状态
        if (C('MEMBER_LOGIN') == 'off') {

            alert('系统暂未开放！',-1);
        }

        if (I('username')=="" || I('password')=="") {
            alert('用户名和密码不能为空！',-1);
        }

        $verify=I('post.verCode','','trim');
        if(empty($verify)){
            alert('请输入图形验证码！',-1);
        }

        if($_SESSION['verify'] != md5($verify)) {
            alert('图形验证码错误！',-1);
        }

        $model_m = M('member');
        //验证用户名和密码
        $member = $model_m->where(array('username'=>I('username')))->find();
        if(!$member){

            alert('用户名或密码错误！',-1);
        }


        //禁止锁定会员登录
        if($member['lock'] == 1){

            alert('账号已经被锁定!联系客服！',-1);
        }

        //更新上一次IP和登录时间
        $prologin['preloginip']      = $member['loginip'];
        $prologin['preloginaddress'] = '';
        $prologin['prelogintime']    = $member['logintime'];

        $model_m->where(array('id'   =>$member['id']))->save($prologin);
        //更新最后一次登录的IP和登录时间
        //$area = $Ip->getlocation(get_client_ip());
        //$area = get_ip_address(get_client_ip());

        $data = array(
            'id'           => $member['id'],
            'logintime'    => time(),
            'loginip'      => '',
            'loginaddress' => ''
        );
        $model_m->save($data);

        //添加登录总次数
        $model_m->where(array('username'=>I('username')))->setInc('logincount');
        //保存session
        session('mid',$member['id']);
        session('username',$member['username']);
        session('member','memberlogin');

        $remember=I("post.remember",0,'intval');
        $mypassword=I('post.password');
        if(!empty($remember)){
            setcookie('rememberusername', $member['username'], time() + 3600 * 24 * 30);
            setcookie('rememberpassword', $mypassword, time() + 3600 * 24 * 30);

        }else{
            setcookie('rememberusername', null, time() - 3600 * 24 * 30);
            setcookie('rememberpassword', mull, time() - 3600 * 24 * 30);
        }

        if($member['status']==0){

            alert('登陆成功,完善资料认证通过即送1台矿机！',U('Index/Account/shoukuanma'));
        }else{

            alert('登陆成功！',U('Index/Account/gonggao'));
        }

    }

    /**
     * 生成验证码
     */
    public function verify(){
        import('ORG.Util.Image');
        Image::buildImageVerify(4,1,'png',55,25);
    }

    public function showcode(){
        $this->display();
    }

    //验证码验证
    public function checkVerify($code){
        if (session('verify') != $code) {
            alert('验证码错误',-1);
        }
    }

    public function checkUsername($username){
        if (!$id = M('member')->where(array('username'=>$username))->getField('id')) {
            alert('您输入的会员账号不存在！',-1);
        }else{
            return $id;
        }
    }

    //找回密码
    public function findpwd(){
        if (IS_POST) {
            header("Content-type:text/html;charset=utf-8");
            $username = I('post.username','','strval');
            $code = I('post.code','','md5');
            if ($username == '' || $code == '') {
                alert('请输入您的会员编号或验证码!',-1);
            }else{
                $this->checkVerify($code);
                $this->checkUsername($username);
                alert('验证通过!',U(GROUP_NAME.'/Login/checkQuestion',array('u'=>$username)));
            }
        }
        $this->display();
    }


    //修改密码
    public function editPwd(){
        header("Content-type:text/html;charset=utf-8");

        $this->display();
    }
    public function xgpost(){
		header("Content-type:text/html;charset=utf-8");

        if (IS_POST) {
            $mobile = I('post.mobile','','strval');

            if(!preg_match("/^(1)[0-9]{10}$/",$mobile)){

                alert('手机号码格式不正确！',-1);
            }
            if (!M('member')->where(array('mobile'=>trim($mobile)))->getField('id')) {

                alert('手机号不存在，请确认！',-1);
            }
            $code = I('post.code','');
            if(!$code){

                alert('请输入短信验证码！',-1);
            }
            $check_code = sms_code_verify($mobile,$code,session_id());
            if($check_code['status'] != 1){
                alert('手机验证码不匹配或者超时!',-1);
            }
            $password = I('post.password','','md5');
            $password1 = I('post.password1','','md5');

            if ($password != $password1) {

                alert('密码和确认密码不一致！',-1);
            }
            //开始修改密码
            $data = array();
            $data['password'] = $password;
            M('member')->where(array('username'=>$mobile))->save($data);
            alert('密码重置成功！',U('Index/Login'));
        }
    }














}
?>