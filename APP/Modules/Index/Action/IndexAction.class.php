<?php

Class IndexAction extends CommonAction{

    public function index(){
        $member = M('member');
        $username = session('username');
        $minfo = $member->where(array('username'=>$username))->find();
		
		//锁定?
        if($minfo['lock'] == 1){
			alert('账号已经被锁定!联系客服！',U('Index/index/logout'));
          }
        $yxkj = M('order')->where(array('user'=>$username,'zt'=>1))->count();
        $ljcl = M('order')->where(array('user'=>$username))->sum('already_profit');

        $jytj11 = M('jyzx')->where(array('mc_user'=>$username,'zt'=>1))->sum('cbt');

        // 直推 团队
        $ztnum = M('member')->where(array('parent'=>session('username')))->count();
        $parentpath = M('member')->where(array('username'=>session('username')))->getField('parentpath');
        $parentpath .= session('mid').'|';
        $tdnum = M('member')->where(array('parentpath'=>array('like',$parentpath.'%')))->count();
        $this->assign('ztnum',$ztnum);
        $this->assign('tdnum',$tdnum+1);
        $this->assign('yxkj',$yxkj);
        $this->assign('ljcl',$ljcl);
        $this->assign('jytj11',$jytj11);
        $this->assign('minfo',$minfo);
        $this->display();
    }

    /**
     * 生成验证码
     */
    public function verify(){
        ob_clean();
        import('ORG.Util.Image');
        Image::buildImageVerify(4,1,'png',55,25);
    }

    //退出系统
    public function logout(){
        //添加日志
        $desc = '会员'. session('account') .'登出';
        write_log(session('account'),'member',$desc);

        //销毁session
        //session('[destroy]');
        session('mid',null);
        session('username',null);
        session('member',null);
        session('usersecondlogin',null);
        $this->redirect(GROUP_NAME.'/Login/index');
        //$this->redirect(U('Index/Login/index'));
    }





}
?>