<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Tables - Ace Admin</title>

		<meta name="description" content="Static &amp; Dynamic Tables" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="__PUBLIC__/css/bootstrap.min.css" rel="stylesheet" />
		<link href="__PUBLIC__/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link href="__PUBLIC__/css/animate.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />

		<style type="text/css" title="currentStyle">
			@import "__PUBLIC__/css/TableTools.css";
		</style>

		<!--[if IE 7]>
		  <link rel="stylesheet" href="__PUBLIC__/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<!--bbc styles-->

		<link rel="stylesheet" href="__PUBLIC__/css/bbc.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/css/bbc-responsive.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/css/bbc-skins.min.css" />
		<script src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="__PUBLIC__/css/bbc-ie.min.css" />
		<![endif]-->

		<!--inline styles if any-->
	</head>

	<body>
		<!--导航-->
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<i class="icon-leaf"></i>
							会员管理系统
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">




						<li class="light-blue user-profile">
							<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
								<img class="nav-user-photo" src="__PUBLIC__/avatars/avatar2.png"/>
								<span id="user_info">
									<small>管理员</small>
									<?php echo (session('adminusername')); ?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">
								<li>
									<a href="<?php echo U(GROUP_NAME.'/Index/Logout');?>">
										<i class="icon-off"></i>
										安全退出
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>
        
        
<style>
#page_search input{ border:0px; background:#ccc;color:#ffffff; margin-left:5px;}
#page_search .current{ background:#005580; color:#ffffff;}
.page a{font-size:16px;}
a.active{ color:#C30 !important; font-size:18px;}

</style>        
        

		<div class="container-fluid" id="main-container">
			<a id="menu-toggler" href="#">
				<span></span>
			</a>

			<!--边栏-->
			<div id="sidebar">
<?php $acc = session("_ACCESS_LIST");?>
				<div id="sidebar-shortcuts">
				
					<div id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!--#sidebar-shortcuts-->

				<ul class="nav nav-list">
					<li>
						<a href="<?php echo U(GROUP_NAME.'/Index/index');?>">
							<i class="icon-dashboard"></i>
							<span>首页</span>
						</a>
					</li>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="Memberuncheck_Membercheck" <?php if(MODULE_NAME == 'Member'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-edit"></i>
							<span>会员管理</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'Member'): ?>style="display: block;"<?php endif; ?>>				
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('member_group')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/member_group');?>">
									<i class="icon-double-angle-right"></i>
									会员等级
								</a>
							</li><?php endif; ?>		


<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('check')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Membercheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/check');?>">
									<i class="icon-double-angle-right"></i>
									会员列表
								</a>
							</li><?php endif; ?>

	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('shequn')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Membercheck">
			<a href="<?php echo U(GROUP_NAME.'/Member/shequn');?>">
				<i class="icon-double-angle-right"></i>
				社群资料审核
			</a>
		</li><?php endif; ?>

<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('shu_list')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Membercheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/shu_list');?>">
									<i class="icon-double-angle-right"></i>
									团队树形图
								</a>
							</li><?php endif; ?>

	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('award')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/award');?>">
									<i class="icon-double-angle-right"></i>
									赠送矿机
								</a>
							</li><?php endif; ?>

	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('awardlist')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Member/awardlist');?>">
									<i class="icon-double-angle-right"></i>
									赠送矿机记录
								</a>
							</li><?php endif; ?>
	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('qianbaolist')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
			<a href="<?php echo U(GROUP_NAME.'/Member/qianbaolist');?>">
				<i class="icon-double-angle-right"></i>
				赠送矿池钱包记录
			</a>
		</li><?php endif; ?>
	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('zichanlist')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
			<a href="<?php echo U(GROUP_NAME.'/Member/zichanlist');?>">
				<i class="icon-double-angle-right"></i>
				赠送矿池资产记录
			</a>
		</li><?php endif; ?>
	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Member')][strtoupper('yuelist')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
			<a href="<?php echo U(GROUP_NAME.'/Member/yuelist');?>">
				<i class="icon-double-angle-right"></i>
				赠送可售余额记录
			</a>
		</li><?php endif; ?>

						</ul>
					</li><?php endif; ?>

<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="top"  <?php if(MODULE_NAME == 'Shop'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-random"></i>
							<span>矿机管理</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'Shop'): ?>style="display: block;"<?php endif; ?>>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('banner')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Shop/banner');?>">
									<i class="icon-double-angle-right"></i>
									首页滚动横幅
								</a>
							</li><?php endif; ?>
	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('hdgl')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
			<a href="<?php echo U(GROUP_NAME.'/Shop/hdgl');?>">
				<i class="icon-double-angle-right"></i>
				活动管理
			</a>
		</li><?php endif; ?>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('type_list')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Shop/type_list');?>">
									<i class="icon-double-angle-right"></i>
									分类列表
								</a>
							</li><?php endif; ?>	
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('lists')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Shop/lists');?>">
									<i class="icon-double-angle-right"></i>
									矿机列表
								</a>
							</li><?php endif; ?>					
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Shop')][strtoupper('orderlist')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Memberuncheck">
								<a href="<?php echo U(GROUP_NAME.'/Shop/orderlist');?>">
									<i class="icon-double-angle-right"></i>
									已购矿机
								</a>
							</li><?php endif; ?>							
						</ul>
					</li><?php endif; ?>						
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="Bonusindex_Jinbidetailindex_JinbidetailjinbiAddList_Jinzhongzidetailindex" <?php if(MODULE_NAME == 'Jinbidetail'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-calendar"></i>
							<span>资金管理</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'Jinbidetail'): ?>style="display: block;"<?php endif; ?>>
						
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('csdd')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/csdd');?>">
									<i class="icon-double-angle-right"></i>
									出售订单
								</a>
							</li><?php endif; ?>						
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('qiugou')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/qiugou');?>">
									<i class="icon-double-angle-right"></i>
									求购订单
								</a>
							</li><?php endif; ?>	
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('jiaoyi')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/jiaoyi');?>">
									<i class="icon-double-angle-right"></i>
									交易中的订单
								</a>
							</li><?php endif; ?>			
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('jywc')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/jywc');?>">
									<i class="icon-double-angle-right"></i>
									交易完成订单
								</a>
							</li><?php endif; ?>	


	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('report_order')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
                    <a href="<?php echo U(GROUP_NAME.'/Jinbidetail/report_order');?>">
                        <i class="icon-double-angle-right"></i>
                        投诉中的订单
                    </a>
                </li><?php endif; ?>
  
  
    
    
    
				
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('zichandetail')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/zichandetail');?>">
									<i class="icon-double-angle-right"></i>
									矿池资产明细
								</a>
							</li><?php endif; ?>

	
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('qianbaodetail')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/qianbaodetail');?>">
									<i class="icon-double-angle-right"></i>
									矿池钱包明细
								</a>
	
						</li><?php endif; ?>	
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('dongjiedetail')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
								<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/dongjiedetail');?>">
									<i class="icon-double-angle-right"></i>
									交易冻结明细
								</a>
							</li><?php endif; ?>
	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Jinbidetail')][strtoupper('ksyedetail')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Jinbidetailindex">
			<a href="<?php echo U(GROUP_NAME.'/Jinbidetail/ksyedetail');?>">
				<i class="icon-double-angle-right"></i>
				可售余额明细
			</a>

		</li><?php endif; ?>

				
						</ul>
					</li><?php endif; ?>					
					
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="Infoannounce_InfoannType_InfomsgReceive_InfomsgSend" <?php if(MODULE_NAME == 'Info'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-list-alt"></i>
							<span>信息交流</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'Info'): ?>style="display: block;"<?php endif; ?>>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')][strtoupper('announce')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Infoannounce">
								<a href="<?php echo U(GROUP_NAME.'/Info/announce');?>">
									<i class="icon-double-angle-right"></i>
									公告管理
								</a>
							</li><?php endif; ?>							
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')][strtoupper('annType')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="InfoannType">
								<a href="<?php echo U(GROUP_NAME.'/Info/annType');?>">
									<i class="icon-double-angle-right"></i>
									公告类别
								</a>
							</li><?php endif; ?>
	<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')][strtoupper('updatenew')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="InfoannType">
			<a href="<?php echo U(GROUP_NAME.'/Info/updatenew');?>">
				<i class="icon-double-angle-right"></i>
				更新公告
			</a>
		</li><?php endif; ?>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')][strtoupper('msgReceive')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="InfomsgReceive">
								<a href="<?php echo U(GROUP_NAME.'/Info/msgReceive');?>">
									<i class="icon-double-angle-right"></i>
									收件箱
								</a>
							</li><?php endif; ?>							
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Info')][strtoupper('msgSend')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="InfomsgSend">
								<a href="<?php echo U(GROUP_NAME.'/Info/msgSend');?>">
									<i class="icon-double-angle-right"></i>
									发件箱
								</a>
							</li><?php endif; ?>						
						</ul>
					</li><?php endif; ?>			
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Rbac')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="Rbacindex_Rbacrole_Rbacnode" <?php if(MODULE_NAME == 'Rbac'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-file"></i>
							<span>权限管理</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'Rbac'): ?>style="display: block;"<?php endif; ?>>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Rbac')][strtoupper('index')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Rbacindex">
								<a href="<?php echo U(GROUP_NAME.'/Rbac/index');?>">
									<i class="icon-double-angle-right"></i>
									管理员列表
								</a>
							</li><?php endif; ?>	
						
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Rbac')][strtoupper('role')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Rbacrole">
								<a href="<?php echo U(GROUP_NAME.'/Rbac/role');?>">
									<i class="icon-double-angle-right"></i>
									角色列表
								</a>
							</li><?php endif; ?>	




<!--<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('Rbac')][strtoupper('node')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="Rbacnode">
								<a href="<?php echo U(GROUP_NAME.'/Rbac/node');?>">
									<i class="icon-double-angle-right"></i>
									节点列表
								</a>
							</li><?php endif; ?>-->

				
						</ul>
						
					</li><?php endif; ?>	
		
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('System')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li sid="Logindex_BakbackUp_SystemcustomSetting"  <?php if(MODULE_NAME == 'System'): ?>class="open"<?php endif; ?>>
						<a href="#" class="dropdown-toggle">
							<i class="icon-text-width"></i>
							<span>系统设置</span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" <?php if(MODULE_NAME == 'System'): ?>style="display: block;"<?php endif; ?>>
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('System')][strtoupper('backUp')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="BakbackUp">
								<a href="<?php echo U(GROUP_NAME.'/System/backUp');?>">
									<i class="icon-double-angle-right"></i>
									数据备份
								</a>
							</li><?php endif; ?>	
<?php if((isset($acc[strtoupper(GROUP_NAME)][strtoupper('System')][strtoupper('customSetting')])) or (!empty($_SESSION[C('ADMIN_AUTH_KEY')]))): ?><li url="SystemcustomSetting">
								<a href="<?php echo U(GROUP_NAME.'/System/customSetting');?>">
									<i class="icon-double-angle-right"></i>
									自定义配置
								</a>
							</li><?php endif; ?>								
							
						</ul>
					</li><?php endif; ?>					
					
				</ul><!--/.nav-list-->

				<div id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>

<script type="text/javascript">
	window.jQuery || document.write("<script src='__PUBLIC__/js/jquery-1.9.1.min.js">"+"<"+"/script>");
</script>
<script type="text/javascript">
	$(function() {
		var method = '<?php echo ($_SERVER['PATH_INFO']); ?>';
		var middle = method.split('/')[2];
		var end = method.split('/')[3];

		$('li[sid*='+ middle + end +']').addClass("active open");
		$('li[url*='+ middle + end +']').addClass("active");
	});
</script>

			<div id="main-content" class="clearfix">
				<div id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="#">Home</a>

							<span class="divider">
								<i class="icon-angle-right"></i>
							</span>
						</li>
						<li class="active">资金管理</li>
					</ul><!--.breadcrumb-->
				</div>

				<div id="page-content" class="clearfix">
					<div class="page-header position-relative">
						<h1> 赠送可售余额记录 </h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
						<!--PAGE CONTENT BEGINS HERE-->
						<form id="table-searchbar" method="POST" action="<?php echo U(GROUP_NAME.'/member/yuelist');?>" class="form-inline well well-small">
							<div class="row-fluid">&nbsp;&nbsp;用户编号
				                <input type="text" class="input-small" name="id" value="<?php echo $_POST['id'];?>">    
		                        <button type="submit" class="btn btn-small no-border" id="btn-query" type="button"><i class="icon-search"></i>查询</button>
							</div>
						</form>

						<div class="row-fluid">
							<table id="table_report" class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th class="center">序号</th>
									<th>用户编号</th>
									<th>发放种类</th>
									<th>增加</th>
									<th>减少</th>
									<th>结余</th>
									<th>说明</th>

									<th>发放时间</th>

								</tr>
								</thead>
								<tbody>
								<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
										<td><?php echo ($v["id"]); ?></td>
										<td><a target="_blank" href="<?php echo U('Member/inMember',array('u'=>$v['member']));?>"><?php echo ($v["member"]); ?></a></td>
										<td>矿池钱包</td>

										<td><?php echo ($v["adds"]); ?></td>
										<td><?php echo ($v["reduce"]); ?></td>
										<td><?php echo ($v["balance"]); ?></td>
										<td><?php echo ($v["desc"]); ?></td>
										<td><?php echo (date('Y-m-d H:i:s',$v["add_time"])); ?></td>

									</tr><?php endforeach; endif; ?>
									<tr>
										<td colspan="12" style="text-align:center;padding:10px;"><?php echo ($page); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<!--PAGE CONTENT ENDS HERE-->
					</div><!--/row-->
				</div><!--/#page-content-->
			</div><!--/#main-content-->
		</div><!--/.fluid-container#main-container-->

		<a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->
		<script src="__PUBLIC__/js/jquery-1.9.1.min.js"></script>

		<script src="__PUBLIC__/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->
		<script src="__PUBLIC__/js/bootbox.min.js"></script>
		<script src="__PUBLIC__/js/jquery.dataTables.min.js"></script>
		<script src="__PUBLIC__/js/jquery.dataTables.bootstrap.js"></script>
		<script src="__PUBLIC__/js/TableTools.min.js"></script>
		<!--bbc scripts-->

		<script src="__PUBLIC__/js/bbc-elements.min.js"></script>
		<script src="__PUBLIC__/js/bbc.min.js"></script>

		<script src="__PUBLIC__/js/bootstrap.notification.js"></script>
		<script src="__PUBLIC__/js/jquery.easing.1.3.js"></script>
		<!--inline scripts related to this page-->
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
	</body>
</html>