<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta name="robots" content="noindex,nofollow">
	<meta name="robots" content="noarchive">
	<!-- 屏蔽-->
	<title>XRCoin</title>
	<meta name="keywords" content=" ">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta content="IE=9; IE=EDGE" http-equiv="X-UA-Compatible">
	<link rel="stylesheet" href="/Public/ybt/css/sm.css">
	<script src="/Public/ybt/js/jquery-1.10.2.min.js"></script>

	<link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">

	<link rel="stylesheet" href="/Public/ybt/css/iconfont.css">
	<!--自定义-->
	<link rel="stylesheet" href="/Public/ybt/css/main.css">
	<link rel="stylesheet" href="/Public/ybt/css/order.css">
	<script src="/Public/ybt/js/jquery-1.11.3.min.js"></script>
	<script src="/Public/ybt/js/jquery.form.js"></script>
	<script src="/Public/ybt/js/layer.js"></script>
</head>
<body style="">


<script language="javascript">

    function cs_cl3(bl1){
        var ejmm=jQuery.trim($('#ejmm').val());
        var shenfen=jQuery.trim($('#shenfen').val());
        if(ejmm=='' || shenfen==''){
            $( '#yzmxs_tr'+bl1 ).show();//
            $( '#yzmxs_div'+bl1 ).html("请输入二级密码和身份证号，输入后重新点击(卖给TA) <br><input name='id' type='hidden'  id='id' />二级密码: <input name='ejmm' type='password'  id='ejmm' /><br>身份证号: <input name='shenfen' type='text'  id='shenfen'  maxlength='18'/>");
            //alert('请先输入短信验证码!');
        }else{
            $.ajax({
                url:"<?php echo U('Emoney/mcpost');?>",
                type:"get",
                data:{id:bl1,ejmm:ejmm,shenfen:shenfen},
                dataType:"json",
                success:function(data){
                    alert(data.msg);

                },error:function(){
                    alert("卖出提交失败，请重新提交！");
                }
            })
        }

    }
</script>


<!-- 标题栏 -->
<header class="bar bar-nav">

	<a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem; color:#FFF;">交易平台</a>    <div class="logo">
	<a id="cancle" href="javascript:history.go(-1)"><i class="icon icon-left"></i></a>    </div>
	<a class="icon pull-right open-panel"></a></header>
<nav class="foot-bar">
	<div class="foot-menu"><a href="<?php echo U('Index/Emoney/shouye');?>">
		<i class="iconfont icon-shouye"></i><span>首页</span></a></div>
	<div class="foot-menu"><a href="<?php echo U('Index/Shop/orderlist');?>">
		<i class="iconfont icon-wxbmingxingdianpu"></i><span>我的矿机</span></a></div>
	<div class="foot-menu"><a href="<?php echo U('Index/Account/myAccount');?>">
		<i class="iconfont icon-gouwuche"></i><span>我的团队</span></a></div>
	<div class="foot-menu"><a href="<?php echo U('Index/Emoney/index');?>">
		<i class="iconfont icon-wxbdingwei"></i><span>交易平台</span></a></div>
	<div class="foot-menu"><a href="/">
		<i class="iconfont icon-geren"></i><span>会员中心</span></a></div>
</nav>

<!-- Main Container start -->
<div class="content" id="main_content">

	<div class="buttons-tab">
		<a href="<?php echo U('Index/Emoney/index');?>" class="active button">交易大厅</a>
		<a href="<?php echo U('Index/Emoney/mairu');?>" class=" button">买入XRC</a>
		<a href="<?php echo U('Index/Emoney/maichu');?>" class=" button">卖出XRC</a>

	</div>






	<!--表格开始-->
	<div class="tabs"><br>

		<h4 style="color: #333333; font-size:18px;">交易大厅-等待买入列表<div style="float:right"><input type=button value=刷新 onclick="location.reload()"></div></h4>
		<hr color="#333333" size="1">
		<!-- <form id="form2" name="form2" method="get" action="/Home/Index/jy/">
             <label>
               编号:<input name="p_user" type="text" size="11" maxlength="11" />
               <input type="submit" name="Submit2"  value="搜索" />
            </label>
          </form>-->
		<!--<input  type="button"  name="Submit" onClick="javascript:location='/Home/Index/jy/px/0/';" style="font-size:16px;" value="按单价排序"> <input  type="button" name="Submit" style="font-size:16px;"  onClick="javascript:location='/Home/Index/jy/px/1/';" value="按时间排序">-->
		<div class="card">

			<table width="100%" border="0" cellpadding="0" cellspacing="0" id="table-5">
				<thead>
				<tr>
					<th width="33%" align="center"><div align="center">数量</div></th>
					<th width="33%" align="center"><div align="center">单价/美元</div></th>
					<th align="center"><div align="center">操作</div></th>
				</tr>
				</thead>
				<tbody>
				<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr style="display:none;" id="yzmxs_tr<?php echo ($v["id"]); ?>">
					<td colspan="3" align="center"><div id="yzmxs_div<?php echo ($v["id"]); ?>" style="color:#FF0000;" align="right">


					</div></td>
				</tr>
				<tr>
					<td align="center"><?php echo ($v["cbt"]); ?></td>
					<td align="center"><?php echo ($v["danjia"]); ?>$</td>
					<td align="center"><input type="button" class="button button-fill button-warning" style="width:80px;font-size:16px;" name="Submit" onclick="javascript:if(confirm('本次出售<?php echo ($v["cbt"]); ?>个可售余额,可收<?php echo ($v["qian"]); ?>美元,需要<?php echo ($baifen); ?>%手续费,出售<?php echo ($v["cbt"]); ?>币扣<?php echo ($v["cbt"]*$shouxu); ?>,确认出售吗?'))cs_cl3('<?php echo ($v["id"]); ?>');" value="卖给TA"></td>
				</tr><?php endforeach; endif; ?>

				</tbody></table>
		</div>
	</div>
	<div id="list_bottom" class="list-bottom"> <div align="right" class="pages">  </div></div>
<div style="text-align: center"><?php echo ($page); ?></div>
	<!--表格结束-->

</div>





</body></html>