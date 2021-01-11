<?php
//账号管理控制器
Class AccountAction extends CommonAction{

    //账号管理
    public function index(){

        $this->display();
    }
    //账号解封
    public function jiefeng(){

        $this->display();
    }
    //账号解封执行
    public function jfpost(){
        if(empty($_POST['mobile']) || empty($_POST['password2']) || empty($_POST['shenfen'])){
            alert('请正确填写解封信息！',-1);
            die;
        }

        $jiefeng = M('member')->where(array('username'=>$_POST['mobile'],'lock'=>1))->find();

        if(!$jiefeng){
            alert('该账号未被封禁或者账号不存在！',-1);
            die;
        }

        if($jiefeng['level'] == 0){
            alert('该账号所在级别不能被解封！',-1);
            die;
        }

        $list = M('member')->where(array('username'=>session('username'),'password'=>md5($_POST['password2']),'shenfen'=>$_POST['shenfen']))->find();
        if(empty($list)){
            alert('您输入的二级密码或者身份证号不正确！',-1);
            die;
        }

        $membergroup =M('member_group')->where(array('level'=>$jiefeng['level']))->find();

        if($jiefeng['jfcs'] >= $membergroup['jfnum']){
            alert('您要解封的账号已达到该账号所在级别的最高解封次数！',-1);
            die;
        }else{
            if($list['ksye'] < $membergroup['jfmoney']){
                alert('您的可售余额不足，无法解封！',-1);
                die;
            }else{
                M('member')->where(array('username'=>$_POST['mobile']))->save(array('lock'=>0));
                M('member')->where(array('username'=>session('username')))->setDec('ksye',$membergroup['jfmoney']);
                M('member')->where(array('username'=>$_POST['mobile']))->setInc('jfcs');
                keshou(session('username'),$membergroup['jfmoney'],'解封会员'.$_POST['mobile'],0);
                alert('账号解封成功！',U('Index/Index/index'));
            }

        }

    }

    //个人资料
    public function grzl(){
        $list = M('member')->where(array('username'=>session('username')))->field('username,regdate,parent,truename')->find();
        $status = M('member')->where(array('username'=>session('username')))->getField('status');
        $this->assign('list',$list);
        $this->assign('status',$status);
        $this->display();
    }
    // 修改密码
    public function dlmm(){
        $list = M('member')->where(array('username'=>session('username')))->field('username,regdate,parent,truename,shenfen,image')->find();
        $status = M('member')->where(array('username'=>session('username')))->getField('status');
        if ($status == 0)
        {
        	alert('请先去实名认证！',-1);
        	die;
        }
        $this->assign('list',$list);
        $this->assign('status',$status);
        $this->display();
    }
    public function kefu(){

        $this->display();
    }
    //修改登录密码
    public function dlmmpost(){
        $old_password = I('post.old_password','','strval');
        if(empty($old_password)){
            alert('原密码不能为空！',-1);
            die;
        }
        $newpwd = I('post.newpwd','','strval');
        $newpwd1 = I('newpwd1','','strval');
        if (empty($newpwd)  || empty($newpwd1)) {
            alert('新登陆密码或确认密码不能为空！',-1);
            die;
        }
        if(!preg_match("/^[a-zA-Z\d_]{6,}$/",I('post.newpwd'))){
            alert('新密码长度不能小于6位！',-1);
            die;
        }
        if ($newpwd !=$newpwd1) {
            alert('两次密码输入不一样！',-1);
            die;
        }
        $old = M('member')->where(array('id'=>session('mid')))->getField('password');
        if ($old != MD5($old_password)) {
            alert('原登陆密码错误！',-1);
            die;
        }
        if (M('member')->where(array('id'=>session('mid')))->save(array('password'=>MD5($newpwd)))) {
            alert('登陆密码修改成功！',U('Index/login/index'));
        }else{
            alert('登陆密码修改失败！',U('Index/Account/xgmm'));
        }
    }
        public function dlmmpost1(){
            if (IS_POST) {
                $data['shenfen']    = $_POST['shenfen'];
                $data['truename']   = $_POST['truename'];
                $data['image']  =  $_POST['image'];
                $status = M('member')->where(array('username'=>session('username')))->getField('status');
                if($status == 2){
                    alert('当前账号已修改过！',-1);
                    die;
                }
       //          if(empty($data['shenfen'])){
       //              alert('身份证号不能为空',-1);
       //              die;
       //          }
    			// if(!preg_match("/(^\d{15}$)|(^\d{17}([0-9]|X)$)/",$data['shenfen'])){
       //              alert('身份证号码格式不正确',-1);
       //              die;
       //          }
       //          if(empty($data['truename'])){
       //              alert('真实姓名不能为空',-1);
       //              die;
       //          }
    			// if(!preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$data['truename'])){
    			// 	alert('真实姓名格式不正确',-1);
       //              die;
    			// }	
                if(empty($data['image'])){
                    alert('请上传收款码截图',-1);
                    die;
                }
                $data['status']  = 2;
                if (M('member')->where(array('username'=>session('username')))->save($data)) 
                {
                    alert('实名认证修改成功!',U('Account/shoukuanma'));
                }else{
                    alert('实名认证修改失败，请重新提交!',-1);
                }
        }
    }
    //修改二级密码
    public function ejmmpost(){
        $old_password = I('post.ymm','','strval');
        if(empty($old_password)){
            alert('原密码不能为空！',-1);
            die;
        }
        $newpwd = I('post.xmm','','strval');
        $newpwd1 = I('xmmqr','','strval');
        if (empty($newpwd)  || empty($newpwd1)) {
            alert('新二级密码或确认密码不能为空！',-1);
            die;
        }
		
        if(!preg_match("/^[a-zA-Z\d_]{6,}$/",I('post.xmm'))){
            alert('新密码长度不能小于6位！',-1);
            die;
        }
        if ($newpwd !=$newpwd1) {
            alert('两次密码输入不一样！',-1);
            die;
        }
        $old = M('member')->where(array('id'=>session('mid')))->getField('password2');
        if ($old != MD5($old_password)) {
            alert('原二级密码错误！',-1);
            die;
        }
        if (M('member')->where(array('id'=>session('mid')))->save(array('password2'=>MD5($newpwd)))) {
            alert('二级密码修改成功！',U('Index/Account/ejmm'));
        }else{
            alert('二级密码修改失败！',U('Index/Account/ejmm'));
        }
    }

    //矿池资产
    public function kczc(){
        $jinbi = M('member')->where(array('id'=>session('mid'),))->field('jinbi,level')->find();
        $kcdh = M('member_group')->where(array('level'=>$jinbi['level']))->getField('dhkc');
        
        $this->assign('kcdh',$kcdh);
        $this->assign('jinbi',$jinbi);
        $this->display();
    }
    //矿池资产兑换
    public function kcpost(){
        if (IS_POST) {
            $kczc  = intval($_POST['amount']);
            $ejmm = md5($_POST['ejmm']);

            if(empty($kczc) && empty($ejmm)){
                alert('请正确填写信息！',-1);
                die;
            }
            if (intval($_POST['amount']) <= 0) 
            {
                alert('存入金额必须大于0',-1);
                die;
            }
            $member = M('member')->where(array('username'=>session('username')))->field('jinbi,level')->find();
            if (!M('member')->where(array('username'=>session('username'),'password2'=>$ejmm))->getField('id')) {
                alert('对不起,二级密码错误!',-1);
                die;
            }else{
                if ($member['jinbi'] < $kczc) {
                    alert('对不起,您的可存入矿池钱包不足!',-1);
                    die;
                }else{
                    $dhzc = M('member_group')->where(array('level'=>$member['level']))->getField('dhkc');
                    $zjkc = $kczc * $dhzc;
                    M('member')->where(array('username'=>session('username')))->setInc('kczc',$zjkc);
                    zichan(session('username'),$zjkc,'矿池钱包兑换',1);
                    M('member')->where(array('username'=>session('username')))->setDec('jinbi',$kczc);
                    jinbi(session('username'),$kczc,'兑换矿池资产',0);

                    alert('兑换矿池资产成功!',U('Index/Account/kczc'));
                }
            }

        }
    }
    //可售余额兑换管理
    public function dhgl(){
        $ksye = M('member')->where(array('id'=>session('mid'),))->field('ksye,level')->find();
        $dhzcbs = C('dhzcbs');
        $this->assign('dhzcbs',$dhzcbs);
        $this->assign('ksye',$ksye);
        $this->display();
    }
    //可售余额兑换执行
    public function dhpost(){
        if (IS_POST) {
            $zchb  = intval($_POST['zchb']);
			$ejmm = md5($_POST['ejmm']);
            if(empty($zchb) || empty($ejmm)){
                alert('请正确填写信息！',-1);
                die;
            }
            if (intval($_POST['zchb']) <= 0) 
            {
                alert('兑换金额必须大于0',-1);
                die;
            }
            //设置提现整数倍
            if (C('dhzcbs') > 0) {
                if ($zchb % C('dhzcbs') != 0) {
                    alert('您输入的兑换金额必须为'. C('dhzcbs').'的整数倍！',-1);
                    die;
                }
            }
            $member = M('member')->where(array('username'=>session('username')))->field('ksye,level')->find();
            if (!M('member')->where(array('username'=>session('username'),'password2'=>$ejmm))->getField('id')) {
                alert('对不起,二级密码错误!',-1);
                die;
            }else{
                if ($member['ksye'] < $zchb) {
                    alert('对不起,您的可售余额不足!',-1);
                    die;
                }else{
                    M('member')->where(array('username'=>session('username')))->setInc('jinbi',$zchb);
                    jinbi(session('username'),$zchb,'可售余额兑换',1);
                    M('member')->where(array('username'=>session('username')))->setDec('ksye',$zchb);
                    keshou(session('username'),$zchb,'兑换矿池钱包',0);
                    alert('兑换矿池钱包成功!',U('Index/Account/dhgl'));
                }
            }

        }
    }
    //收款码
    public function shoukuanma(){
        $list = M('member')->where(array('username'=>session('username')))->find();
        $status = M('member')->where(array('username'=>session('username')))->getField('status');

        $this->assign('status',$status);
        $this->assign('list',$list);
        $this->display();
    }

    public function skmpost(){
        if (IS_POST) {

            $data['shenfen']    = $_POST['shenfen'];
            $data['truename']   = $_POST['truename'];
            $data['image']  =  $_POST['image'];
            $is_zr = explode('/',$data['image']);
            if($is_zr['1'] != 'Public' && $is_zr['2'] != 'Uploads'){
            	alert('非法操作',-1);
            	die;
            }
            $status = M('member')->where(array('username'=>session('username')))->getField('status');
            if($status == 1){
                alert('当前账号已经认证过，不可重复认证！',-1);
                die;
            }
            if(empty($data['shenfen'])){
                alert('身份证号不能为空',-1);
                die;
            }
            if(!preg_match("/(^\d{15}$)|(^\d{17}([0-9]|X)$)/",$data['shenfen'])){
                alert('身份证号码格式不正确',-1);
                die;
            }			
            // if(!preg_match("/^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{2}$/",$data['shenfen'])){
            //     alert('身份证号码格式不正确',-1);
            //     die;
            // }
            if(empty($data['truename'])){
                alert('真实姓名不能为空',-1);
                die;
            }
			if(!preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$data['truename'])){
				alert('真实姓名格式不正确',-1);
                die;
			}	
            if(empty($data['image'])){
                alert('请上传收款码截图',-1);
                die;
            }
            $data['status']  = 1;
            if (M('member')->where(array('username'=>session('username')))->save($data)) {

                $user_id = M('member')->where(array('username'=>session('username')))->getField('id');
                $product = M("product");
                $num = C('num');
                $id =  C('z_num');
                //查询矿机信息
                $data = $product -> find($id);
                if(empty($data)){

                    alert('矿机不存在!',-1);
                }
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
                    jinbi(session('username'),0,'注册赠'.$data['title'],1,3);

                    $product->where(array("id"=>$id))->setDec("stock");
                }
                alert('实名认证成功!',U('Account/shoukuanma'));

            }else{

                alert('实名认证失败，请重新提交!',-1);
            }


        }
    }

    //活动奖励
    public function hdjl(){
        $list = M('hdjl')->select();
        $username = session('username');
        foreach($list as $k => $v){
            
            // $leiji = M('jyzx')->where("date > ". $v['addtime']." AND date < ". $v['endtime']." AND mr_user = $username AND zt = 2")->sum('cbt');
            $leiji = M('jyzx')->where(" mr_user = $username AND zt = 2")->sum('cbt');
            // $zichan = M('zichandetail') ->where(array('member'=>$username,'type'=>2))->sum('adds');
            $zichan = M('zichandetail')->join('ds_hdjl on ds_hdjl.id = ds_zichandetail.hdjl_id') ->where(array('ds_zichandetail.member'=>$username,'ds_zichandetail.type'=>2))->sum('ds_hdjl.num');
            $list[$k]['leiji'] = $leiji - $zichan;
            $list[$k]['kjname'] = M('product') ->where(array('id'=>$v['kj_id']))->getField('title');

        }
        $this->assign('list',$list);
        $this->display();
    }
    //查看奖励详情
    public function ckhd(){

        $list = M('hdjl')->where(array('id'=>$_GET['id']))->find();

        $kjname = M('product') ->where(array('id'=>$list['kj_id']))->getField('title');
        $this->assign('kjname',$kjname);
        $this->assign('list',$list);
        $this->display();
    }
    //领取奖励
    public function lqjl(){
        $id = $_GET['id'];
        $username = session('username');
        $user_id = session('mid');
        $list = M('hdjl')->where(array('id'=>$id))->find();
        if(time() < $list['addtime'] && time() > $list['endtime']){
            alert('活动结束，该活动已经过了活动时间！',-1);
        }
        $leiji= M('jyzx')->where("mr_user = $username AND zt = 2")->sum('cbt');

        // $zichan = M('zichandetail') ->where(" member = $username AND type = 2")->sum('adds');
        $zichan = M('zichandetail')->join('ds_hdjl on ds_hdjl.id = ds_zichandetail.hdjl_id') ->where(array('ds_zichandetail.member'=>$username,'ds_zichandetail.type'=>2))->sum('ds_hdjl.num');

        $yingfa = $leiji - $zichan;

        if($yingfa < $list['num']){
            alert('您未达到本期'.$list['name'].'的要求！',-1);
            exit;
        }

        // 限制每次活动只能领取一次
        $hdjlCount = M('zichandetail')->where(array('hdjl_id'=>$id,'member'=>$username))->count();

        if ($hdjlCount > 0) 
        {
            alert('您已经领取过了本期活动,不能再次领取！',-1);
            exit;
        }

        if(M('member')->where(array('username'=>$username))->setInc('kczc',$list['zszc']))  {

            zichan($username,$list['zszc'],$list['name'].'赠送',1,2,$id);
        }

        if($list['kj_num'] > 0){
            //查询矿机信息
            $data = M('product')->where(array('id'=>$list['kj_id']))->find();
            if(!empty($data)){
                for($i=1;$i<=$list['kj_num'];$i++){
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
                    jinbi(session('username'),0,$list['name'].'赠'.$data['title'],1,3);
                    M('product')->where(array("id"=>$list['kj_id']))->setDec("stock");
                }
            }
        }
        alert('领取'.$list['name'].'奖励成功！',-1);

    }

    //上传图片
    //ajax 图片上传

    public function uploads(){

        if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){

            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];
            $file_time=date('Ymd',time());
            $file_name = './Public/Uploads/shoukuanma/'.date('Ymd');
            if(!file_exists($file_name)){
                mkdir($file_name);
            }
            $path = $file_name.'/';
            $extArr = array("jpg", "png", "gif", "jpeg");
            if(empty($name)){
                echo json_encode(array('result' => 0,'msg'=>'请选择要上传的图片'));
                return;
            }
            $ext = $this->extend($name);
            if(!in_array($ext,$extArr)){
                echo json_encode(array('result' => 0,'msg'=>'图片格式错误'));
                return;

            }
            if($size>(300*1024*1024)){
                echo json_encode(array('result' => 0,'msg'=>'图片大小不能超过3M'));
                return;
            }
            $image_name = time().rand(100,999).".".$ext;
            $tmp = $_FILES['photoimg']['tmp_name'];

            $uploadip = substr($path,9);
            if(move_uploaded_file($tmp, $path.$image_name)){
                echo json_encode(array('result' => 1,'url'=>$uploadip.$image_name));
                return;
            }else{
                echo json_encode(array('result' => 0,'msg'=>'上传出错了'));
                return;
            }
            exit;
        }
        exit;

    }
    public function uploads1(){

        if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){

            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];
            $file_time=date('Ymd',time());
            $file_name = './Public/Uploads/shequn/';
            if(!file_exists($file_name)){
                mkdir($file_name);
            }
            $path = $file_name.'/';
            $extArr = array("jpg", "png", "gif", "jpeg");
            if(empty($name)){
                echo json_encode(array('result' => 0,'msg'=>'请选择要上传的图片'));
                return;
            }
            $ext = $this->extend($name);
            if(!in_array($ext,$extArr)){
                echo json_encode(array('result' => 0,'msg'=>'图片格式错误'));
                return;

            }
            if($size>(300*1024*1024)){
                echo json_encode(array('result' => 0,'msg'=>'图片大小不能超过3M'));
                return;
            }
            $image_name = time().rand(100,999).".".$ext;
            $tmp = $_FILES['photoimg']['tmp_name'];

            $uploadip = substr($path,9);
            if(move_uploaded_file($tmp, $path.$image_name)){
                echo json_encode(array('result' => 1,'url'=>$uploadip.$image_name));
                return;
            }else{
                echo json_encode(array('result' => 0,'msg'=>'上传出错了'));
                return;
            }
            exit;
        }
        exit;

    }
    public function extend($file_name){
        $extend = pathinfo($file_name);
        $extend = strtolower($extend["extension"]);
        return $extend;
    }


    public function sqjl(){

        $huiyuan = M('member') ->where(array('parent'=>session('username')))->count();
        $sqbz = C('sqbz');

        if($huiyuan < C('zhitui')){
            alert('对不起，必须直推'.C('zhitui').'人才可以申请该项奖励！',-1);
        }


        $count = M('shequn') ->where(array('member'=>session('username')))->count();
        if($count >= 1){
            alert('对不起，每个账号只能申请一次社群奖励！',-1);
        }
        $this -> assign('sqbz',$sqbz);
        $this->display();
    }
    public function sqjlpost(){
        $huiyuan = M('member') ->where(array('parent'=>session('username')))->count();

        if($huiyuan < C('zhitui')){
            alert('对不起，必须直推'.C('zhitui').'人才可以申请该项奖励！',-1);
        }
        $count = M('shequn') ->where(array('member'=>session('username')))->count();
        if($count >= 1){
            alert('对不起，每个账号只能申请一次社群奖励！',-1);
        }
        if(empty($_POST['name'])){
            alert('请输入群名称！',-1);
        }
        if(empty($_POST['weixin'])){
            alert('请输入您的微信号！',-1);
        }
        if(empty($_POST['QQ'])){
            alert('请输入您的支付宝号！',-1);

        }
        if(empty($_POST['image'])){
            alert('请上传群二维码截图！',-1);
        }
        $_POST['member'] = session('username');
        if(M('shequn')->add($_POST)){
            alert('社群信息提交成功，请等待审核！',-1);

        }else{
            alert('提交失败，请重新提交！',-1);

        }

    }

    //曲线图
    public function resource(){
        $date = M('date')->field('date')->order('id desc')->limit(0, 5)->select();
        $price = M('date')->field('price')->order('id desc')->limit(0, 5)->select();
        $date = array_reverse($date);
        $price = array_reverse($price);
        foreach($date as $k => $d){
            $categories[$k] = date("m-d",$d['date']);
        }
        foreach($price as $k => $d){
            $series[$k] = $d['price'];
        }
        $categories = "'".implode("','",$categories)."'";
        $series = implode(",",$series);
        $this->assign('categories', $categories);
        $this->assign('series', $series);
        $this->display();
    }

    //更新公告
    public function gonggao(){
        $new = M('updatenew')->where(array('id'=>1))->find();
        $this->assign('new',$new);
        $this->display();
    }
    /**
     * 发送手机注册验证码
     */
    public function send_sms_reg_code(){
        $mobile = I('mobile');
        if(!check_mobile($mobile))
            exit(json_encode(array('status'=>-1,'msg'=>'手机号码格式有误!')));
        if (M('member')->where(array('mobile'=>$mobile))->getField('id')) {
            exit(json_encode(array('status'=>-1,'msg'=>'手机号码已存在!')));
        }
        $code =  rand(1000,9999);
        $send = sms_log($mobile,$code,session_id());
        if($send['status'] != 1)
            exit(json_encode(array('status'=>-1,'msg'=>$send['msg'])));
        exit(json_encode(array('status'=>1,'msg'=>'验证码已发送，请注意查收')));
    }


    //我的玩家账号
    public function myAccount(){

        $user_id = session('mid');
        import('ORG.Util.Page');

        // $count = M('member')->where(array('parent_id'=>$user_id))->count();
        $count = M('member')->where(array('parent'=>session('username')))->count();
        $page = new Page($count,15);

        $page->setConfig('theme', '%first% %upPage% %linkPage% %downPage% %end%');
        $show = $page->show();// 分页显示输出
        // $list = M('member')->where(array('parent_id'=>$user_id))->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
        $list = M('member')->where(array('parent'=>session('username')))->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();



        $this->assign('list',$list);
        $this->assign('page',$show);

        $this->display();
    }






    public function tuiguangma(){

        header ( "Content-type: text/html; charset=utf-8");

        $e_keyid=encrypt(session('mid'),'E','xyb8888');

        $e_keyid=str_replace('/','AAABBB',$e_keyid);

        $tuiguangma = "http://".$_SERVER['SERVER_NAME'].U('Index/Sem/regSem',array('u'=>$e_keyid));
        $erwei = M("member")->where(array('username'=>session('username')))->getField("erwei");

        if(!$erwei){
            Vendor('phpqrcode.phpqrcode');
            //生成二维码图片
            $object = new QRcode;
            $level=3;
            $size=6;
            $errorCorrectionLevel =intval($level) ;//容错级别
            $matrixPointSize = intval($size);//生成图片大小
            $path = "Public/erwei/";
            // 生成的文件名
            $fileName = $path.session('username').'.png';
            $object->png($tuiguangma,$fileName, $errorCorrectionLevel, $matrixPointSize, 2);
            import('ORG.Util.Image');
            $Image = new Image();

            define('THINKIMAGE_WATER_CENTER', 5);
            $Image->water(PUBLIC_PATH.'/encard.jpg',$fileName,$fileName,100,array(240,350));
            $erwei = '/'.$fileName;
            M("member")->where(array('username'=>session('username')))->setField("erwei",$erwei);
        }
        $this->assign('erwei',$erwei);
        $adurl=C('adurl');
        $adurl2=str_replace('[adurl]',$tuiguangma,$adurl);

        $this->assign('tuiguangma',$tuiguangma);
        $this->assign('adurl2',$adurl2);
        $this->display();
    }

    public function tgm(){

        header ( "Content-type: text/html; charset=utf-8");

        $e_keyid=encrypt(session('mid'),'E','xyb8888');

        $e_keyid=str_replace('/','AAABBB',$e_keyid);

        $tuiguangma = "http://".$_SERVER['SERVER_NAME'].U('Index/Sem/regSem',array('u'=>$e_keyid));
        $erwei = M("member")->where(array('username'=>session('username')))->getField("erwei");

        if(!$erwei){
            Vendor('phpqrcode.phpqrcode');
            //生成二维码图片
            $object = new QRcode;
            $level=3;
            $size=3;
            $errorCorrectionLevel =intval($level) ;//容错级别
            $matrixPointSize = intval($size);//生成图片大小
            $path = "Public/erwei/";
            // 生成的文件名
            $fileName = $path.session('username').'.png';
            $object->png($tuiguangma,$fileName, $errorCorrectionLevel, $matrixPointSize, 2);
            import('ORG.Util.Image');
            $Image = new Image();

            define('THINKIMAGE_WATER_CENTER', 5);
            $Image->water(PUBLIC_PATH.'/card.jpg',$fileName,$fileName,100,array(180,570));
            $erwei = '/'.$fileName;
            M("member")->where(array('username'=>session('username')))->setField("erwei",$erwei);
        }
        $this->assign('erwei',$erwei);
        $adurl=C('adurl');
        $adurl2=str_replace('[adurl]',$tuiguangma,$adurl);

        $this->assign('tuiguangma',$tuiguangma);
        $this->assign('adurl2',$adurl2);
        $this->display();
    }




    public function mrsf(){

        $s_time=strtotime(date("Y-m-d 00:00:01"));
        $o_time=strtotime(date("Y-m-d 23:59:59"));
        $user_id = session('mid');
        $username = session('username');

        $member = M('member')->where(array('username'=>$username))->find();
        if($member['kczc'] <= 0){
            alert('您当前没有足够的矿池资产可供释放，快去用矿池钱包兑换吧!',-1);
        }

        $sfbl = M('member_group')->where(array('level'=>$member['level']))->getField('sfbl');

        $shifang = $member['kczc'] * $sfbl;

        // $map['_string'] = "(addtime > '$s_time' or addtime < '$o_time')";
        $map = array();
        $map['member'] = $username;
        $map['desc'] =  '释放金额';
        $map['addtime'] = array('between',[$s_time,$o_time]);

        $todayData = M('keshoudetail')->where($map)->count();

        if($todayData >= 1){
            alert('您今日已经释放过金额了!',-1);
        }else{

            M('member') -> where(array('id'=>session('mid')))->setInc('ksye',$shifang);
            keshou($username,$shifang,'释放金额',1);
            M('member') -> where(array('id'=>session('mid')))->setDec('kczc',$shifang);
            zichan($username,$shifang,'释放金额',0);
            alert('释放成功,获得'. $shifang .'个可售余额!',-1);

        }


    }









}



?>