<?php
	/**
	 * 后台首页控制器
	 */
	Class IndexAction extends CommonAction{
		/**
		 * 后台首页视图
		 */
		public function index(){
			$member = M('member');
			$Order=M('order');
			
			//总会员数量
			$this->membercount = $member->count();
			$this->membercount2 = $member->where('`status`=1')->count();
			//总金币
			//$this->jinbisun = $member->sum('jinbi');
			//总金种子
			//$this->jinzhonzisum = $member->sum('jinzhongzi');
			//昨日新增人数
			$s_time=strtotime(date("Y-m-d 00:00:01",strtotime('-1 day')));
			$o_time=strtotime(date("Y-m-d 23:59:59",strtotime('-1 day')));
			$this->Yesterday_menber_number= $member->where("regdate > {$s_time} and regdate < {$o_time}")->count();
			
			
			//今日新增人数
			$s_time=strtotime(date("Y-m-d 00:00:01"));
			$o_time=strtotime(date("Y-m-d 23:59:59"));
			$this->Today_menber_number= $member->where("regdate > {$s_time} and regdate < {$o_time}")->count();
			
			
			//在线会员
			$oo_time=time()-(5*60);
			
			$this->Online_menber_number= $member->where("online_time > {$oo_time}")->count();
			
			
			
			
			
			//正在运行的矿机算力
			$data_a=$Order->where("zt = 1")->sum('lixi');
			

            //算出总共产了多少币 根据日字
            $b['desc']="矿机收益";
            $data_b=M("jinbidetail")->where( $b)->sum('adds');



			
			//当前可售额度总和

			$data_c=M('member')->sum('ksed');



            //当前可售余额总和

            $data_d=M('member')->sum('ksye');

            //当前冻结交易总和

            $data_g=M('member')->sum('qjinbi');
			
			
			
			//今天有多少矿机
			$data_e=$Order->where("zt = 1")->count();



            //当前矿池资产总和

            $data_f=M('member')->sum('kczc');
			
			
			
			
			
			 $this->assign('data_a',$data_a);
			 $this->assign('data_b',$data_b);
			 $this->assign('data_c',$data_c);
			 $this->assign('data_d',$data_d);
			 $this->assign('data_e',$data_e);
			 $this->assign('data_f',$data_f);
			 $this->assign('data_g',$data_g);

			
			
			
		/*	//昨天产了多少币 根据日志
			$s_time=strtotime(date("Y-m-d 00:00:01",strtotime('-1 day')));
			$o_time=strtotime(date("Y-m-d 23:59:59",strtotime('-1 day')));
			$data_c=M("jinbidetail")->where("type = 1 and addtime > {$s_time} and addtime < {$o_time}")->sum('adds');
			
			
			*/
			
			
			
		/*	
			//今天产了多少币 根据日志
			$s_time=strtotime(date("Y-m-d 00:00:01"));
			$o_time=strtotime(date("Y-m-d 23:59:59"));
			$data_d=M("jinbidetail")->where("type = 1 and addtime > {$s_time} and addtime < {$o_time}")->sum('adds');
			
			*/
			
			//当日收入
			
			/*$model = new Model();
			$nowmember = $model->query("SELECT * FROM ds_member WHERE status = 1 and acc_type = '主账号' and  DATE_FORMAT(FROM_UNIXTIME(checkdate),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')");
			$todaymoney = 0;
			foreach($nowmember as $k=>$v){
				$group = M("member_group")->where(array('level'=>$v['level']))->find();
				$todaymoney += pv($group['money']);
			}
			
			$this->todaymoney = $todaymoney;*/
			//当日支出
			/*$tbonus = $model->query("SELECT SUM(adds) as zsum FROM ds_jinbidetail WHERE DATE_FORMAT(FROM_UNIXTIME(addtime),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') and type>0");
			$this->drzc = $tbonus[0]['zsum'];
			//当日拔比
			$this->drbb = number_format($this->drzc / $this->todaymoney,3) * 100;
			//总收入
			$mlsit = M('member')->where(array('status'=>1,'acc_type'=>'主账号'))->select();
			foreach($mlsit as $k=>$v){
				$group = M("member_group")->where(array('level'=>$v['level']))->find();
				$sumsr += pv($group['money']);
			}			
			$this->allsr = $sumsr;
			//总奖金
			$pp = $model->query("SELECT SUM(adds) as zsum FROM ds_jinbidetail WHERE type>0");
			$this->sumzc = $pp[0]['zsum'];
			//总拔比
			$this->sumbb = number_format($this->sumzc / $this->allsr,3) * 100;*/
			$this->display();
		}

		/**
		 * 后台退出登录
		 */
		public function logout(){
			//添加日志
			$desc = '管理员'. session('adminusername') .'登出';
			write_log(session('adminusername'),'admin',$desc);
			//销毁session
			//session('[destroy]');
			session('adminusername',null);
			session('logtime',null);
			session('loginip',null);
			unset($_SESSION['superadmin']);
			$this->redirect(GROUP_NAME.'/Login/index');
		}



	}
?>