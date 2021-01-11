<?php  

	/**
	* 会员管理控制器
	*/
	class MemberAction extends CommonAction{
		


		//会员列表
		public function check(){
			
			$map = $this -> _search();
			$pid=I('get.pid',0,'intval');
			$datas = I('get.');
			$id = $datas['id'];
			$status = $datas['status'];
			if($id&&$status=='2'){
				M('member')->where(array('id'=>$id))->save(array('status'=>'1'));
			
			$this->success('修改重新上传收款码成功！',U(GROUP_NAME.'/Member/check'));
			}
			if(!empty($pid)){
				$map['parent_id'] = array('eq',$pid);	
			}

			$type=$_POST['type'];
			$typename=$_POST['typename'];
			
			
			
			
	        if (!empty($type) && !empty($typename)) {
	        	//$map['type'] = array("eq",$_POST['type']); 
				if($type ==1){
					$map['id']=	$typename;
				}elseif($type ==2){
					$map['truename']=$typename;	
				}elseif($type ==3){
					$map['mobile']=	$typename;	
				}elseif($type ==4){
					$map['username']=	$typename;	
				}
				
				
	        }			
			if (method_exists($this, '_search_filter')) {
				$this -> _search_filter($map);
			}
			$name = $this -> getActionName();

			$model = D($name);
			$infos = M('member_group')->field('level,name')->select();
			foreach($infos as $k=>$v){
				$group[$v['level']] = $v['name'];
			}
			$this->assign('group',$group);	
			if (!empty($model)) {
				$this -> _list($model, $map);
			}

			$this->display();
		}
		
		

		

		
		public function award(){
			
				//会员级别

				$product=M('product')->where("is_on=0")->select();
				$this->assign('product',$product);
				$this->display();
			
	    }
		
		
		public function awardpost(){

				$username=$_POST['username'];
				$num=I('post.num',0,'intval');
				$is_include=I('post.is_include',0,'intval');
				if(empty($username)){
					$this->error('请输入会员编号');
				}
				$user_id = M('member')->where(array('username'=>$username))->getField('id');
            $product = M("product");
            $id =  $num;
            //查询矿机信息
            $data = $product -> find($id);
            if(empty($data)){
                $this->error('矿机不存在');
            }

                $map = array();
                $map['kjbh'] = 'ZS' . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
                $map['user'] = $username;
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
                jinbi($username,0,'平台赠'.$data['title'],1,2);
                $product->where(array("id"=>$id))->setDec("stock");

				$this->success("执行成功！");

	    }
		
		
		
		
		public function awardlist(){
				
				
			$Data = M('jinbidetail'); // 实例化Data数据对象
			import("@.ORG.Util.Page");// 导入分页类
			$map = array();
			if (isset($_POST['id']) && $_POST['id']!='') {
				$map['member'] = array("eq",$_POST['id']);
			}
            $map['type'] = 2;
			$count      = $Data->where($map)->count();// 查询满足要求的总记录数
	        $Page       = new Page($count,30);// 实例化分页类 传入总记录数
	        
	        
	        $list = $Data->where($map)->order('addtime desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();

	        $show       = $Page->show();// 分页显示输出
	        $this->assign('page',$show);// 赋值分页输出
	        $this->assign('list',$list);// 赋值数据集

	        $this->display(); // 输出模板
			
		}

        public function qianbaolist(){


            $Data = M('jinbidetail'); // 实例化Data数据对象
            import("@.ORG.Util.Page");// 导入分页类
            $map = array();
            if (isset($_POST['id']) && $_POST['id']!='') {
                $map['member'] = array("eq",$_POST['id']);
            }
            $map['type'] = 1;
            $count      = $Data->where($map)->count();// 查询满足要求的总记录数
            $Page       = new Page($count,30);// 实例化分页类 传入总记录数


            $list = $Data->where($map)->order('addtime desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();

            $show       = $Page->show();// 分页显示输出
            $this->assign('page',$show);// 赋值分页输出
            $this->assign('list',$list);// 赋值数据集
            $this->display(); // 输出模板

        }

        public function zichanlist(){


            $Data = M('zichandetail'); // 实例化Data数据对象
            import("@.ORG.Util.Page");// 导入分页类
            $map = array();
            if (isset($_POST['id']) && $_POST['id']!='') {
                $map['member'] = array("eq",$_POST['id']);
            }
            $map['type'] = 1;
            $count      = $Data->where($map)->count();// 查询满足要求的总记录数
            $Page       = new Page($count,30);// 实例化分页类 传入总记录数


            $list = $Data->where($map)->order('addtime desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();

            $show       = $Page->show();// 分页显示输出
            $this->assign('page',$show);// 赋值分页输出
            $this->assign('list',$list);// 赋值数据集
            $this->display(); // 输出模板

        }

        public function yuelist(){


            $Data = M('keshoudetail'); // 实例化Data数据对象
            import("@.ORG.Util.Page");// 导入分页类
            $map = array();
            if (isset($_POST['id']) && $_POST['id']!='') {
                $map['member'] = array("eq",$_POST['id']);
            }
            $map['type'] = 1;
            $count      = $Data->where($map)->count();// 查询满足要求的总记录数
            $Page       = new Page($count,30);// 实例化分页类 传入总记录数


            $list = $Data->where($map)->order('addtime desc')->limit($Page ->firstRow.','.$Page -> listRows)->select();

            $show       = $Page->show();// 分页显示输出
            $this->assign('page',$show);// 赋值分页输出
            $this->assign('list',$list);// 赋值数据集
            $this->display(); // 输出模板

        }

		//封号解封处理
		public function editFeng(){
			$lock = I('get.lock',0,'intval');
			$id = I('get.id',0,'intval');
			M('member')->where(array('id'=>$id))->save(array("lock"=>$lock));
            $this->success('设置成功！',U(GROUP_NAME.'/Member/check'));

		}

		/**
		 * 金币充值
		 * @return [type] [description]
		 */
		public function addJinbi(){
			$member = M('member')->where(array('id'=>I('get.id',0,'intval')))->find();
			
			$map['desc'] = '平台充值';
			$map['member'] = $member['username'];
			$list = M("jinbidetail")->where($map)->order("id desc")->select();
			$this->assign('list',$list);	
            $this->assign('member',$member);			
			$this->display();
		}

		/**
		 * 充值处理函数
		 * @return [type] [description]
		 */
		public function addJinbiHandle(){
			$userid = I('post.id',0,'intval');
			 $jinbi  = I('post.jinbi',0,'intval');
			 $type  = I('post.type',0,'intval');
			if($type == 0){
			    $this->error('请选择充值类型！',U(GROUP_NAME.'/Member/addJinbi'));
            }
			$member = M('member')->where(array('id'=>$userid))->find();
			if($jinbi>0){
			    if($type == 1){

                    M('member')->where(array('id'=>$userid))->setInc('jinbi',$jinbi);
                    jinbi($member['username'],$jinbi,'平台充值',1,1);
                    $this->success('充值矿池钱包成功！',U(GROUP_NAME.'/Member/addJinbi'));
                }elseif ($type == 2){

                    M('member')->where(array('id'=>$userid))->setInc('kczc',$jinbi);
                    zichan($member['username'],$jinbi,'平台充值',1,1);
                    $this->success('充值矿池资产成功！',U(GROUP_NAME.'/Member/addJinbi'));


                }elseif ($type == 3){
                    M('member')->where(array('id'=>$userid))->setInc('ksed',$jinbi);
                    $this->success('充值可售额度成功！',U(GROUP_NAME.'/Member/addJinbi'));


                }elseif ($type == 4){

                    M('member')->where(array('id'=>$userid))->setInc('ksye',$jinbi);
                    keshou($member['username'],$jinbi,'平台充值',1,1);
                    $this->success('充值可售余额成功！',U(GROUP_NAME.'/Member/addJinbi'));

                }
			}elseif($jinbi<0){
                if($type == 1){

                    M('member')->where(array('id'=>$userid))->setInc('jinbi',$jinbi);
                    jinbi($member['username'],$jinbi,'平台充值',0,1);
                    $this->success('充值矿池钱包成功！',U(GROUP_NAME.'/Member/addJinbi'));
                }elseif ($type == 2){

                    M('member')->where(array('id'=>$userid))->setInc('kczc',$jinbi);
                    zichan($member['username'],$jinbi,'平台充值',0,1);
                    $this->success('充值矿池资产成功！',U(GROUP_NAME.'/Member/addJinbi'));


                }elseif ($type == 3){
                    M('member')->where(array('id'=>$userid))->setInc('ksed',$jinbi);
                    $this->success('充值可售额度成功！',U(GROUP_NAME.'/Member/addJinbi'));


                }elseif ($type == 4){

                    M('member')->where(array('id'=>$userid))->setInc('ksye',$jinbi);
                    keshou($member['username'],$jinbi,'平台充值',0,1);
                    $this->success('充值可售余额成功！',U(GROUP_NAME.'/Member/addJinbi'));

                }
			}
			
		}

		//编辑会员
		public function editMember(){
			$member = M('member')->where(array('id'=>I('id')))->find();
			$list = M('member_group')->select();
			$this->assign('list',$list);
			$this->assign('member',$member);
			$this->display();
		}

		//编辑会员处理函数
		public function editMemberHandle(){
			$password = I('password');
			$password2 = I('password2');
			$level = I('level');
			$truename = I('truename');
			$shenfen = I('shenfen');

			$id = I('id');
			unset($_POST['id']);
			if ($password!= '') {
				$_POST['password'] = md5($password);
			}else{
				unset($_POST['password']);
			}
			if ($password2 != '') {
				$_POST['password2'] = md5($password2);
			}else{
				unset($_POST['password2']);
			}
			if ($level != '') {
				$_POST['level'] = $level;
			}else{
				unset($_POST['level']);
			}
			if ($level != '') {
				$_POST['truename'] = $truename;
			}else{
				unset($_POST['truename']);
			}
            if ($shenfen != '') {
                $_POST['shenfen'] = $shenfen;
            }else{
                unset($_POST['shenfen']);
            }
			if (M('member')->where(array('id'=>$id))->save($_POST)) {
				$this->success('编辑成功！',U(GROUP_NAME.'/Member/check'));
			}else{
				$this->error('数据没有更改！',U(GROUP_NAME.'/Member/check'));
			}
		}

		/**
		 * 后台直接跳转到会员前台
		 * @return [type] [description]
		 */
		public function inMember(){
			$username = I('get.u');
			$uid = M('member')->where(array('username'=>$username))->getField('id');
			session('mid',$uid);
			session('username',$username);
			session('usersecondlogin','1');
			session('member','adminlogin');
			$this->redirect('Index/Index/index');
		}

		//删除会员
/*		public function deleteMember(){
			$member = M('member');
			$minfo = $member->where(array('id'=>I('get.id',0,'intval')))->find();
			if ($member->where(array('id'=>$_GET['id'],'status'=>0))->delete()) {
				//更新安置人左右区信息
				if ($minfo['my_jd'] == 'left') {
					$data['left'] = array('exp','null');
					$member->where(array('username'=>$minfo['fparent']))->save($data);
				}else if($minfo['my_jd'] == 'right'){
					$data['right'] = array('exp','null');
					$member->where(array('username'=>$minfo['fparent']))->save($data);
				}
				alert('删除成功！',U(GROUP_NAME.'/Member/uncheck'));
			}else{
				alert('删除失败！',U(GROUP_NAME.'/Member/uncheck'));
			}			
		}*/
		
	    //树形图
		public function shu_list(){
			Vendor('Tree.tree');
			$menu = new tree;
				$menu->icon = array('│ ','├─ ','└─ ');
				$menu->nbsp = '&nbsp;&nbsp;&nbsp;';
				$result = M('member')->field('id,username,parentcount,parent')->select();
				foreach($result as $k=>$v){
					 
					 $arr[$v['username']] = $v;
					 $arr[$v['username']]['parentid_node'] = ($v['parent'])? ' class="child-of-node-'.$v['parent'].'"' : '';
				}
				$str  = "<tr id='node-\$username' \$parentid_node>
							<td style='padding-left:30px;'>\$spacer 会员编号：\$username (直推人数：\$parentcount)</td>
						</tr>";
			     
				$menu->init($arr);
				$categorys = $menu->get_tree(NULL, $str);		
                $this->assign('categorys',$categorys);					
			    $this->display();
		}	   
		//会员组列表
		public function member_group(){
			$list = M('member_group')->select();
			$this->assign('list',$list);			
			$this->display('member_group_list');
		}

		//添加会员组
		public function add_member_group(){
			$list = M('member_group')->select();
			$count = count($list)+1;
			$this->assign('level',$count);
			$this->display('add_member_group');
		}
		
		//添加会员组表单处理
		public function addGroupHandle(){
			for($i=0;$i<count($_POST['dai_content']);$i++){
				if(empty($_POST['dai_content'][$i])){
					$this->error('代奖参数不能为空');
				}				 
			}

			$_POST['dai_content'] = implode(",",$_POST['dai_content']);
			$_POST['addtime'] = NOW_TIME;
			if (M('member_group')->add($_POST)) {
				//添加日志操作
				$desc = '添加一个新的会员组';
				write_log(session('username'),'admin',$desc);
               $this->success('添加成功',U(GROUP_NAME.'/Member/member_group'));
			}else{
				$this->error('添加失败');
			}
		}	
        //修改会员组
      	public function	editMemberGroup(){
      		// dump($_SESSION);
			$member_group = M('member_group')->where(array('groupid'=>I('groupid')))->find();
			$member_group['dai_content'] = explode(",",$member_group['dai_content']);
			// 矿机
			$product = M('product')->getField('id,title');
// dump($product);
			$this->assign('product1358',$product);
			$this->assign('member_group',$member_group);			
			$this->display('editMemberGroup');
		}
		//修改会员组处理
		public function editGroupHandle(){
			$groupid = I('groupid',0,'intval');
			unset($_POST['groupid']);
			$_POST['dai_content'] = implode(",",$_POST['dai_content']);
			M('member_group')->where(array('groupid'=>$groupid))->save($_POST);
			//添加日志
			$desc = '修改ID为'. $groupid .'的会员组';
			write_log(session('username'),'admin',$desc);

			$this->success('会员组修改成功!',U(GROUP_NAME.'/Member/member_group'));

		}

        //社群
        public function shequn(){
            $list = M('shequn')->select();
            $this->assign('list',$list);
            $this->display();

        }


        //社群通过
        public function sqtg(){

            $id = I('get.id',0,'intval');
            $shequn = M('shequn')->where(array('id'=>$id))->find();
            $zichan = C('sq_zc');
            $kj_id = C('sq_id');
            $kj_num = C('sqkj_num');
            $qianbao = C('qianbao');
            if($qianbao > 0){
                M('member') ->where(array('username'=>$shequn['member']))->setInc('jinbi',$qianbao);
                jinbi($shequn['member'],$qianbao,'社群奖励赠',1,5);

            }
            if($zichan > 0){
                M('member') ->where(array('username'=>$shequn['member']))->setInc('kczc',$zichan);
                zichan($shequn['member'],$zichan,'社群奖励赠',1,5);

            }
            if($kj_num > 0){
                //查询矿机信息
                $data = M('product') -> find($kj_id);
                if(!empty($data)){
                    for($i=1;$i<=$kj_num;$i++){
                        $map = array();
                        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'Q', 'Q', 'I', 'J');
                        $map['kjbh'] = $yCode[intval(date('Y')) - 2011] . date('d') . substr(time(), -5) . sprintf('%02d', rand(0, 99));
                        $map['user'] = session('username');
                        $map['user_id'] = $shequn['member'];
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
                        jinbi($shequn['member'],0,'社群奖励赠'.$data['title'],1,5);
                        M('product')->where(array("id"=>$kj_id))->setDec("stock");
                    }
                }
            }


            $datas['status'] = 1;
             M('shequn')->where(array('id'=>$id))->save($datas);

            $this->success('设置成功！',U(GROUP_NAME.'/Member/shequn'));

        }

        //社群拒绝
        public function sqjj(){

            $id = I('get.id',0,'intval');
            $shequn = M('shequn')->where(array('id'=>$id))->find();
            if($shequn['status'] > 0){
                  $this->success('该申请已经审核，不可再次进行操作！',U(GROUP_NAME.'/Member/shequn'));

            }

            M('member')->where(array('id'=>$shequn['member']))->save(array("lock"=>1));

            M('shequn')->where(array('id'=>$id))->save(array("status"=>2));
            $this->success('设置成功！',U(GROUP_NAME.'/Member/shequn'));

        }
        //异步验证用户组是否存在
		public function checkGroupName(){
			//判断是否异步提交
			IS_AJAX or halt('对不起，页面不存在');

			if (M('member_group')->where(array('name'=>I('name')))->getField('groupid')) {
				echo 'false';
			}else{
				echo 'true';
			}
		}	



	
	}

?>