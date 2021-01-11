<?php  
	/**
	 * 会员前台公共控制器
	 */
	Class CommonAction extends Action{

		public function _initialize(){
			header("Content-Type:text/html; charset=utf-8");
			
				
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

			
	  		if(!isset($_SESSION['mid']) && !isset($_SESSION['username']) ){
	  			$this->redirect('Index/Login/index');
	  		}else{
				  $memberinfo = M("member")->where(array('username'=>$_SESSION['username']))->find();
				  $this->memberinfo = $memberinfo;
				  M("member")->where(array('id'=>$_SESSION['mid']))->save(array('online_time'=>time()));
				  
			}

            if ($_SESSION['username'] == 'admin') {
                $this->redirect('Index/Login/index');
            }
		
			$everyday_last_time=C('everyday_last_time');
			$everyday_rose=C('everyday_rose');
			//判断今天是否已经更新过了
			date_default_timezone_set("PRC");
			$s_time_a=strtotime(date('Y-m-d 00:00:01',time()));
			$o_time_a=strtotime(date('Y-m-d 23:59:59',time()));
            if($everyday_last_time < $s_time_a || $everyday_last_time > $o_time_a){
            // 上面判断了更新日期 只要当前的日期，小于就去更新价格
                $path = './App/Conf/system.php';
                $config = include $path;

                if(!empty($everyday_rose)){
                    $lcsj=M('date')->order('id desc')->find();
                    $jiage = $lcsj['price']+$everyday_rose;
                    $map['date']=time();
                    $map['price']=$jiage;
                    M('date')->add($map);

                    $jiage = M('date')->order('id desc')->limit(1)->getField("price"); 
					// 查询出价格小于当前价格的订单并去更新到当前价格
					// $data = M("jyzx")->where(array('danjia'=>array('lt',$jiage)))->select();
					
					//image=未上传图片的（包含正在交易中的）
				    //mc_user=只更新未匹配的订单（正在交易中的不会更新）	
			    	$data = M("jyzx")->where('danjia <= '. $jiage .' AND mc_user is NULL')->select();  // ->setField('danjia',$price);
			    	// echo(M()->getLastSql());
			    	// var_dump($data);
			    	// exit();
					foreach ($data as $key => $value){
						$value['danjia'] = $jiage;
						$value['qian'] = $jiage * $value["cbt"]; // 更新总价
						M("jyzx")->save($value);
					}


                }


                $config['everyday_last_time']      = time();
                $data = "<?php\r\nreturn " . var_export($config, true) . ";\r\n?>";
                file_put_contents($path, $data);

            }

		
		
		}


	}
?>