<?php

/**
 * 电子货币控制器
 */
Class EmoneyAction extends CommonAction{
    //交易中心页面
    public function index(){
    
        //判断是否开启
        $jy_open=C('jy_open');
        $jy_time=C('jy_time');
        if(empty($jy_open)){
            alert('交易中心未开放！',U('Index/index/index'));
            exit;
        }
        if(!empty($jy_time)){
            $jy_time_arr=explode('-',$jy_time);
            // var_dump($jy_time_arr);die;
            $s_time=strtotime(date("Y-m-d ".$jy_time_arr[0]));

            $o_time=strtotime(date("Y-m-d ".$jy_time_arr[1]));
            if(time() < $s_time || time() > $o_time){
                alert('交易开放时间为'.$jy_time,U('Index/index/index'));
                exit;
            }
        }
		
		$minfo = M('member')->where(array('username'=>session('username')))->find();		
		//锁定?
        if($minfo['lock'] == 1){
			alert('账号已经被锁定!联系客服！',U('Index/index/logout'));
          }
        $status = M('member')->where(array('username'=>session('username')))->getField('status');
        if($status == 0){
            alert('请先实名认证',U('Account/shoukuanma'));
            exit;
        }
        import('ORG.Util.Page');
        $count = M('jyzx')->where(array('zt'=>0))->count();
        $Page  = new Page($count,10);
        $show  = $Page->show();
        $list=	M('jyzx')->where(array('zt'=>0))->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $level = M('member')->where(array('username'=>session('username')))->getField('level');

        $shouxu = M('member_group')->where(array('level'=>$level))->getField('shouxu');
        $baifen = $shouxu * 100;
		$this->assign('baifen',$baifen);
		$this->assign('shouxu',$shouxu);
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    //买入页面
    public function mairu(){
        $status = M('member')->where(array('username'=>session('username')))->getField('status');
        if($status == 0){
            alert('请先实名认证',U('account/shoukuanma'));
            exit;
        }
        import('ORG.Util.Page');
        $count = M('jyzx')->where(array('mr_id'=>session('mid'),'mr_user'=>session('username'),'datatype'=>qgcbt))->count();
        $Page  = new Page($count,10);
        $show  = $Page->show();
        $list = M('jyzx')->where(array('mr_id'=>session('mid'),'mr_user'=>session('username'),'datatype'=>qgcbt))->select();
        // 之前的交易价
         $jiage = M('date')->order('id desc')->limit(1)->getField("price");

        // $jiage = M('date_today')->order('id desc')->limit(1)->getField("price");

        $map['mr_id'] = session('mid');
        $map['mr_user'] = session('username');
        $map['datatype'] = qgcbt;
        $map['zt'] = array( 'neq', 0);



        $lists = M('jyzx')->where($map)->select();
        foreach($lists as $kk=>$vv){
            // var_dump($vv);
            $lists[$kk]['total']=$vv['danjia']*$vv['cbt'];;

        }
        $this->assign('jiage',$jiage);
        $this->assign('list',$list);
        $this->assign('lists',$lists);
        $this->assign('page',$show);
        $this->display();
    }
    //买入申请
    public function mrpost(){
        if (IS_POST) {
            //判断是否开启
            $jy_open=C('jy_open');
            if(empty($jy_open)){
                alert('交易中心未开放！',U('Index/index/index'));
                exit;
            }
            // $jy_time=C('jy_time');   之前的买入交易时间
            if (!session('mid')) 
            {
                alert('非法操作！',U('Index/index/index'));
                exit;
            }
            $level = M('member')->where(array('id'=>session('mid')))->getField('level');
            // $jy_time = M('member')->join('left join member_group on member_group.level = member.level')->where(array('member.id'=>session('mid')))->getField('member_group.item1');
            $jy_time = M('member_group')->where(array('level'=>$level))->getField('item1');
            if (!$jy_time) 
            {
                $group1 = M("member_group")->getField('level,name');
                $levelName = $group1[$level];
                alert('未设置当前 ( '.$levelName.' ) 矿工等级的交易时间!',U('Index/index/index'));
                exit;
            }

            if(!empty($jy_time)){
                $jy_time_arr=explode('-',$jy_time);
                $s_time=strtotime(date("Y-m-d ".$jy_time_arr[0]));
                $o_time=strtotime(date("Y-m-d ".$jy_time_arr[1]));
                if(time() < $s_time || time() > $o_time){
                    alert('交易开放时间为'.$jy_time,U('Index/index/index'));
                    exit;
                }
            }
            $user = M('member')->where(array('username'=>session('username')))->find();
            if($user['status'] == 0){
                alert('请先实名认证',U('account/shoukuanma'));
                exit;
            }
            $cbt = $_POST['amount'];
            if(!preg_match("/^\d*$/",$cbt)){
            	alert('非法操作',-1);
            	die;
            }
            if ($cbt <= 0) 
            {
                alert('买入数量不能小于0',U('emoney/mairu'));
                exit;
            }
            if($cbt < C("bsbei") || $cbt%C("bsbei")!=0){
                alert('交易数量必须为'.C("bsbei").'的倍数！',-1);
            }
            // 之前
            $jiage = M('date')->order('id desc')->limit(1)->getField("price");
            
            // $jiage = M('date',$today)->order('id desc')->limit(1)->getField("price");
            $gname = session("username");
            /*        $a=1;
                    $b=0;
                    $maps['zt']=array(array('eq',$a),array('eq',$b),'or');
                    $maps['_string']="(mr_user = '$gname' or mr_user = '$gname')";
                    $pd = M('jyzx')->where($maps)->find();
                    if($pd){
                        alert('您还有未完成交易的订单,请先完成交易！',-1);
                    }*/
            $a=1;
            $b=0;
            $maps['zt']=array(array('eq',$a),array('eq',$b),'or');
            $maps['mr_user'] = $gname;
            $num = M('jyzx')->where($maps)->count();
            if($num >= 5){
                alert('单个账号最多同时能挂5个买入订单！',-1);
            }

            $danjia = $jiage;
            $map['mr_id'] =  $user['id'];
            $map['mr_user'] = $user['username'];
            $map['qian'] = $danjia*$cbt;
            $map['cbt'] = $cbt;
            $map['date']= time();
            $map['mr_level'] = $user['level'];
            $map['danjia']  = $danjia;
            $map['datatype'] = 'qgcbt';

            $oob=M('jyzx')->add($map);
            if($oob){
                alert('订单已成功发送至交易大厅!',U('Emoney/mairu'));
            }
        }
    }
    //卖出页面
    public function maichu(){

        import('ORG.Util.Page');
        $count = M('jyzx')->where(array('mc_id'=>session('mid'),'mc_user'=>session('username'),'datatype'=>qgcbt))->count();
        $Page  = new Page($count,10);
        $show  = $Page->show();
        $list = M('jyzx')->where(array('mc_id'=>session('mid'),'mc_user'=>session('username'),'datatype'=>qgcbt))->select();


        $map['mc_id'] = session('mid');
        $map['mc_user'] = session('username');
        $map['datatype'] = qgcbt;
        $map['zt'] = array( 'neq', 0);



        $lists = M('jyzx')->where($map)->select();

        $this->assign('list',$list);
        $this->assign('lists',$lists);
        $this->assign('page',$show);
        $this->display();
    }

    //卖出执行
    public function mcpost(){
        if (IS_GET) {
            if(empty($_GET['id']) && empty($_GET['ejmm']) && empty($_GET['shenfen'])){
                $this->ajaxReturn(array("msg"=>'请输入交易密码及身份证号验证交易！'));
            }

            $time=date('Y-m-d 00:00:00');
            $time1=date('Y-m-d 23:59:59');
            $c=1;
            $d=2;
            $map = array();
            $map['zt']=array('in',[1,2]);
            $map['mc_user']=session("username");
            $map['mc_id']=session("mid");
            $map['datatype']=array('eq', 'qgcbt');
            $map['jydate']=array('BETWEEN',array($time,$time1));
            // $map['jydate']=array('elt',$time1);
            $mcnum = M('jyzx')->where($map)->count();

            // 每个级别的等级矿工

            $level58 = M('member')->where(array('id'=>session('mid')))->getField('level');
            $item2 = M('member_group')->where(array('level'=>$level58))->getField('item2');
            // if($mcnum >= C('mcnum') ){
            //     $this->ajaxReturn(array("msg"=>'对不起，每个账号每天仅允许出售'.C("mcnum").'单！'));
            // }
            if($mcnum >= $item2 ){
                $this->ajaxReturn(array("msg"=>'对不起，您这个等级的矿工每天仅允许出售'.$item2.'单！'));
            }
			
			
			// if(!preg_match("/^\d{17}(\d|x)$/",$_GET['shenfen'])){
			// 	$this->ajaxReturn(array('msg'=>'身份证号码格式不正确!'));
			// }	


            $user = M('member')->where(array('username'=>session("username")))->find();

            if ($user['password2'] !=MD5($_GET['ejmm'])  ) {
                $this->ajaxReturn(array("msg"=>'二级密码错误,请重新输入！'));
            }

            if ($user['shenfen']!=$_GET['shenfen'] ) {
                $this->ajaxReturn(array("msg"=>'身份证号错误,请重新输入！'));
            }

            $shouxu = M('member_group')->where(array('level'=>$user['level']))->getField('shouxu');

            $result = M('jyzx')->where(array('id'=>$_GET['id']))->find();

            $maichu = $result['cbt'] * $shouxu +  $result['cbt'];

            if($result['zt']==1 ){
                $this->ajaxReturn(array("msg"=>'对不起，该订单已匹配成功，正在交易中！'));
            } elseif($result['cbt'] > $user['ksed']){
                $this->ajaxReturn(array("msg"=>'对不起，您的可售额度不足！'));
            }elseif( $maichu > $user['ksye']){
                $this->ajaxReturn(array("msg"=>'对不起，您的可售余额不足！'));
            }elseif($result['mr_user']==session("username")){
                $this->ajaxReturn(array("msg"=>'您不能出售到自己的账户！'));
            }elseif($result['zt']==2){
                $this->ajaxReturn(array("msg"=>'对方交易已完成！'));
            }else{

                $time=date('Y-m-d H:i:s');

                M('jyzx')->where(array('id'=>$_GET['id']))->data(array('zt'=>1,'jydate'=>$time,'mc_user'=>$user['username'],'mc_level'=>$user['level'],'mc_id'=>$user['id']))->save();

                // 可售余额 + 手续费
                $results = M('member')->where(array('username'=>session("username")))->setDec('ksye',$maichu);

                // 可售额度 不加手续费
                $results11 = M('member')->where(array('username'=>session("username")))->setDec('ksed',$result['cbt']);

                // 记录可售余额
                keshou(session("username"),$maichu,'交易中心下单',0);
                // 可售额度
                dongjie(session("username"),$result['cbt'],'交易中心下单',0);

                // 卖家
                // $obs = M('member')->where(array('username'=>session("username")))->setInc('qjinbi',$maichu);
                // 10个矿石钱包  17个可售额度

                if($results && $results11){
					$qycode=rand(111111,999999);
					$mobile = $result['mr_user'];
					$appkey = C('CODE_APIKEY'); //请用自己的appkey代替
					$content="买家已经上传付款截图，请尽快确认完成交易。【XRC】";
					$url="http://api.jisuapi.com/sms/send?appkey=$appkey&mobile=$mobile&content=$content";
					$return = ccurlOpen($url);
                    $this->ajaxReturn(array("msg"=>'匹配成功！','url'=>U('Emoney/maichu')));
                }
            }




        }
    }
    //上传图片
    public function sctp(){

        $id = $_GET['id'];
        $this->assign('id',$id);
        $this->display();
    }
    //上传图片执行
    public function scpost(){
        if (IS_POST) {
        	// dump($_POST);die;
            // $data['image'] = I('post.image');
            $data['image'] = I('post.image');
            $is_zr = explode('/',$data['image']);
            // dump($is_zr);die;
            if($is_zr['1'] != 'Public' && $is_zr['2'] != 'Uploads'){
            	alert('非法操作',-1);
            	die;
            }
            if(empty($data['image'])){
                alert('请上传付款截图页面',-1);
            }

            $list = M('jyzx')->where(array('mr_id' => session('mid'),'mr_user'=>session('username'),'id'=>$_POST['id'],'zt'=>1))->find();

            if(empty($list)){
                alert('非法操作，没有查到该订单！',-1);
                die;
            }
            if(!empty($list['image'])){
                alert('上传失败，该订单已经上传过付款页截图！',-1);
                die;
            }

            $result = M('jyzx')->where(array('id' => $_POST['id']))->save($data);

            if (!empty($result)) {
					$qycode=rand(111111,999999);
					$mobile = $list['mc_user'];
					$appkey = C('CODE_APIKEY'); //请用自己的appkey代替
					$content="买家已经上传付款截图，请尽快确认完成交易。【XRC】";
					$url="http://api.jisuapi.com/sms/send?appkey=$appkey&mobile=$mobile&content=$content";
					$return = ccurlOpen($url);
					alert('付款页截图上传成功',U('Emoney/mairu'));
            } else {

                alert('付款页截图上传失败',-1);
            }
        }


    }

    //上传图片
    public function cktp(){

        $id = $_GET['id'];
        $image = M('jyzx')->where(array('mc_id' => session('mid'),'mc_user'=>session('username'),'id'=>$_GET['id'],'zt'=>1))->getField('image');

        if(empty($image)){
            alert('买家还未上传付款截图，请致电沟通！',-1);
        }


        $this->assign('image',$image);
        $this->assign('id',$id);
        $this->display();
    }

    //上传图片
    //ajax 图片上传

    public function uploads(){



        if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){


            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];

            $file_time=date('Ymd',time());
            $file_name = './Public/Uploads/';
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

    public function mrchexiao(){
        if (IS_GET) {
            $id= I("get.id",0,"intval");
            $jyzx = M('jyzx')->where(array('id'=>$id,'mr_user'=>$_SESSION['username']))->find();
            if(empty($jyzx)){
                alert('订单不存在！',U('Emoney/mairu'));
                exit;
            }
            if($jyzx['zt'] >0){
                alert('已经匹配的订单不能撤销！',U('Emoney/mairu'));
                exit;
            }
            $a_time = time()-$jyzx['date'];
            if ($a_time <= 1800) 
            {
            	alert('订单未超过半个小时不能撤销！',U('Emoney/mairu'));
                exit;
            }
            $result = M('jyzx')->where(array('id'=>$id,'mr_user'=>$_SESSION['username']))->delete();
            if($result){
                alert('取消成功！',U('Emoney/mairu'));
            }else{
                alert('取消失败！',U('Emoney/mairu'));
            }

        }
    }
    public function tousu(){

        $id = $_GET['id'];
        $result=M('jyzx')->where(array('id'=>$id))->find();
        $time = strtotime($result['jydate']);
        $time1=C('tousu_time')*60*60+$time;
        if(time() < $time1 ){
            alert('匹配成功'.C("tousu_time").'小时后才可以投诉！',-1);
        }
        $tousu = M('tousu')->where(array('pid' => $id))->find();//说明已经有一方投诉过了
        if ($tousu) {
            if ($tousu['user'] = $_SESSION['username']) {
                alert('已经有一方投诉过了,请勿重复投诉！', -1);
            }
        }
        $this->assign('id', $id);

        $this->display();
    }


    public function tspost(){
        if (IS_POST) {
            $data_P = 	$_POST['id'];
            $text = 	$_POST['content'];

            $result=M('jyzx')->where(array('id'=>$data_P))->find();
            $time = strtotime($result['jydate']);
            $time1=C('tousu_time')*60*60+$time;
            if(time() < $time1 ){
                alert('匹配成功'.C("tousu_time").'小时后才可以投诉！',-1);
            }

            $tousu=M('tousu')->where(array('pid'=>$data_P))->find();//说明已经有一方投诉过了
            if($tousu){
                if($tousu['user']=$_SESSION['username']){
                    alert('已经有一方投诉过了,请勿重复投诉！',-1);
                }
            }

            if($text==""){
                alert('投诉内容不能为空！',-1);
            }
            if($result['mr_user']==$_SESSION['username']){

                $map['text']=$text;//投诉内容
                $map['user']=$_SESSION['username'];//投诉人；
                $map['buser'] =$result['mc_user']; //被投诉人
                $map['date'] = date('Y-m-d H:i:s');
                $map['pid'] = $data_P;
                $oob=M('tousu')->add($map);
                if($oob){
                    alert('投诉成功，等待管理员处理！',U('Emoney/mairu'));
                }
            }

            if($result['mc_user']==$_SESSION['username']){

                $map1['text']=$text;//投诉内容
                $map1['user']=$_SESSION['username'];//投诉人；
                $map1['buser'] =$result['mr_user']; //被投诉人
                $map1['date'] = date('Y-m-d H:i:s');
                $map1['pid'] = $data_P;
                $oobs=M('tousu')->add($map1);
                if($oobs){
                    alert('投诉成功，等待管理员处理！',U('Emoney/maichu'));
                }

            }
        }

    }

    //买入完成

    public function mrwc(){
        $id=$_GET['id'];
        $jyzx = M('jyzx')->where(array('id'=>$id,'mr_user'=>$_SESSION['username'],'zt'=>1))->find();
        if(empty($jyzx)){
            alert('订单不存在！',-1);
            exit;
        }
        if(empty($jyzx['image'])){
            alert('请尽快上传付款截图，等待卖家确认并完成交易！',-1);
            exit;
        }

        alert('卖家正在赶来确认完成交易的路上，请耐心等候！',-1);
    }

    //买家看卖家详情

    public function mcxq(){
        if (IS_GET) {
            $id = $_GET['id'];
            $jyzx = M('jyzx')->where(array('id' => $id, 'mr_user' => $_SESSION['username'], 'zt' => 1))->find();
            if (empty($jyzx)) {
                alert('订单不存在！', -1);
                exit;
            }
            $mclist = M('member')->where(array('id' => $jyzx['mc_id'], 'username' => $jyzx['mc_user']))->field('truename,username,image')->find();
            if (empty($mclist)) {
                alert('卖出用户不存在！', -1);
                exit;
            }
            $huilv = C('rmb_hl');
            $jyzx['qian']=$jyzx['danjia']*$jyzx['cbt'];
            $rmb = $jyzx['qian'] * $huilv;
            $this->assign('rmb', $rmb);
            $this->assign('jyzx', $jyzx);
            $this->assign('mclist', $mclist);
        }
        $this->display();
    }


    //卖家看买家详情

    public function mrxq(){
        if (IS_GET) {
            $id = $_GET['id'];
            $jyzx = M('jyzx')->where(array('id' => $id, 'mc_user' => $_SESSION['username'], 'zt' => 1))->find();
            if (empty($jyzx)) {
                alert('订单不存在！', -1);
                exit;
            }
            $mclist = M('member')->where(array('id' => $jyzx['mr_id'], 'username' => $jyzx['mr_user']))->find();
            if (empty($mclist)) {
                alert('买入用户不存在！', -1);
                exit;
            }
            $huilv = C('rmb_hl');
            $jyzx['qian']=$jyzx['danjia']*$jyzx['cbt'];
            $rmb = $jyzx['qian'] * $huilv;
            $this->assign('rmb', $rmb);
            $this->assign('jyzx', $jyzx);
            $this->assign('mclist', $mclist);
        }
        $this->display();
    }

    //卖出完成

    public function mcwc(){
        if (IS_GET) {
            $id=$_GET['id'];
            $jyzx = M('jyzx')->where(array('id'=>$id,'mc_user'=>$_SESSION['username'],'zt'=>1))->find();
            if(empty($jyzx)){
                alert('订单不存在！',-1);
                exit;
            }
            if(empty($jyzx['image'])){
                alert('买家还未上传付款截图，暂时不能完成交易！',-1);
                exit;
            }

            // 买家加钱
			$bili = M("member_group")->where(array("level"=>$jyzx['mr_level']))->getField("yjbl");
            $mr_member = M('member')->where(array('id'=>$jyzx['mr_id']))->find();
            $obsArr = array(
                'jinbi' => ($jyzx['cbt'] + $mr_member['jinbi']),
                'ksed'  => round($jyzx['cbt'] * $bili + $mr_member['ksed'],2),
            );
            $obs = M('member')->where(array('id'=>$jyzx['mr_id']))->save($obsArr);
            // 加可售额度
            dongjie($jyzx['mr_user'],$jyzx['cbt'] * $bili,'交易中心买入',1);
            $shouxu = M("member_group")->where(array("level"=>$jyzx['mc_level']))->getField("shouxu");
            $cbt = $jyzx['cbt'] +  $jyzx['cbt'] * $shouxu;

            // M('member')->where(array('username'=>$_SESSION['username'],'id'=>$jyzx['mc_id']))->setDec('qjinbi',$cbt);
            // dongjie($jyzx['mc_user'],$cbt,'卖出成功',0);

            // M('member')->where(array('username'=>$jyzx['mr_user'],'id'=>$jyzx['mr_id']))->setInc('ksye',$jyzx['cbt']);
            // 加矿产钱包
            jinbi($jyzx['mr_user'],$jyzx['cbt'],'交易中心买入',1);

            // $bili = M("member_group")->where(array("level"=>$jyzx['mr_level']))->getField("yjbl");
            // $edu = $bili * $jyzx['cbt'];
            // M('member')->where(array('username'=>$jyzx['mr_user'],'id'=>$jyzx['mr_id']))->setInc('ksed',$edu);
            // M('member')->where(array('username'=>$jyzx['mc_user'],'id'=>$jyzx['mc_id']))->setDec('ksed',$edu);
            $data['zt'] = 2;
            M('jyzx')->where(array('id'=>$id,'mc_user'=>$_SESSION['username']))->save($data);

            alert('交易成功！',U('Emoney/mairu'));

        }
    }






/*    public function del(){
        $id= I("get.id",0,"intval");

        $oob = M('ppdd')->where(array('id'=>$id))->find();
        if($oob['p_user']!=$_SESSION['username']){
            die("<script>alert('操作失败！');history.back(-1);</script>");
        }
        $oobs = M('member')->where(array('username'=>$oob['p_user']))->find();

        $inc = M('member') -> where(array('username'=>$oob['p_user']))->setInc('jinbi',$oobs['qjinbi']);
        account_log($_SESSION['username'],$oobs['qjinbi'],'订单撤销返还',1);

        $dec = M('member') -> where(array('username'=>$oob['p_user']))->setDec('qjinbi',$oobs['qjinbi']);
        account_log4($_SESSION['username'],$oobs['qjinbi'],'订单撤销扣除',0);

        $result=M('jyzx')->where(array('id'=>$id))->delete();
        if($result && $inc && $dec){
            alert('取消成功！',U('Emoney/mairu'));
        }else{
            alert('取消失败！',U('Emoney/mairu'));
        }
    }*/







    //首页
    public function shouye(){

        $typeData = M("product") -> where("is_on = 0") ->order("id asc")  -> select();
        $banner_list =M("banner") ->order("id asc")  -> select();

        $this->assign("typeData",$typeData);
        $this->assign("banner_list",$banner_list);
        $this->display();
    }


}
?>