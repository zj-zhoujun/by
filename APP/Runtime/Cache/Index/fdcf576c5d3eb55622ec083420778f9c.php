<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0041)http://www.xxx.com/Home/Login/reg2/ -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta name="robots" content="noindex,nofollow">
	<meta name="robots" content="noarchive">
	<!-- 屏蔽-->
	<title>XRCoin</title>
	<meta name="keywords" content="">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta content="IE=9; IE=EDGE" http-equiv="X-UA-Compatible">
	<link rel="stylesheet" href="/Public/ybt/css/sm.css">
	<link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">
	<link rel="stylesheet" href="/Public/ybt/css/iconfont.css">
	<link rel="stylesheet" href="/Public/ybt/css/main.css">
	<style type="text/css">

	</style>
</head>
<body style="">
<div class="page">
	<!-- 标题栏 -->
	<header class="bar bar-nav"><a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem;">新用户注册</a>
		<div class="logo"><a href=""><i class="icon icon-left"></i></a></div>
	</header>
	<!-- 这里是页面内容区 -->
	<div class="content" style="margin-bottom:10px;">
		<form class="form-signin" action="<?php echo U('Index/Sem/regsempost');?>" name="loginForm" id="loginForm" method="post">
			<div class="list-block">

				<ul>
					<input type="hidden" name="parent" value="<?php echo ($username); ?>">
					<li>
						<div class="item-content">
							<div class="item-media"><i class="icon icon-form-name"></i></div>
							<div class="item-inner">
								<div class="item-title label">用户名手机号</div>
								<div class="item-input">
									<input class="col-20" name="mobile" id="mobile" placeholder="必须本人银行卡绑定的手机号" type="text" value="">
								</div>
							</div>
						</div>
					</li>
					
					 <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon icon-form-name"></i></div>
                            <div class="item-inner">
                                <div class="item-title label">验证码</div>
                                <div class="item-input">
                                    <div style="float:left; width:50%;margin:0px;padding: 0px;">
                                        <input type="text" class="form-control tooltips" data-trigger="hover" data-toggle="tooltip" placeholder="请输入验证码" name="verCode" id="verCode">
                                    </div>
                                    <div style=" float:left;width:50%;margin:0px;padding: 0px;">
                                        <img width="110" height="38" src="<?php echo U('Sem/verify');?>" onclick="this.src='<?php echo U('Sem/verify','','');?>?'+Math.random();" alt="点击刷新验证码" style="cursor:pointer;margin-top: 5px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

					<li>
						<div class="item-content">
							<div class="item-media"><i class="icon icon-form-name"></i></div>
							<div class="item-inner">
								<div class="item-title label">短信验证码</div>
								<input type="text" placeholder="短信验证码" name="code" required id="code" class="fl">

								<span  id="count_down" onClick="send_sms_reg_code()" class="button button-fill button-warning  col-20 fr reg-mobile-js" style="width:200px;">获取验证码</span>

							</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-media"><i class="icon icon-form-name"></i></div>
							<div class="item-inner">
								<div class="item-title label">姓名</div>
								<div class="item-input">
									<input class="col-20" name="truename" id="truename" placeholder="必须真实姓名，注册后不可修改" type="text" value="">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-media"><i class="icon icon-form-name"></i></div>
							<div class="item-inner">
								<div class="item-title label">登录密码</div>
								<div class="item-input">
									<input class="col-20" name="password" id="password" type="password" placeholder="请输入登录密码" value="">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-media"><i class="icon icon-form-name"></i></div>
							<div class="item-inner">
								<div class="item-title label">确认密码</div>
								<div class="item-input">
									<input class="col-20" name="password1" id="password1" type="password" placeholder="请输入确认登录密码" value="">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-media"><i class="icon icon-form-name"></i></div>
							<div class="item-inner">
								<div class="item-title label">二级密码</div>
								<div class="item-input">
									<input class="col-20" name="password2" id="password2" type="password" placeholder="请输入二级密码" value="">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-media"><i class="icon icon-form-name"></i></div>
							<div class="item-inner">
								<div class="item-title label">确认密码</div>
								<div class="item-input">
									<input class="col-20" name="password21" id="password21" type="password" placeholder="请输入确认二级密码" value="">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-media"><i class="icon icon-form-name"></i></div>
							<div class="item-inner">
								<div class="item-title label">推荐人手机号</div>
								<div class="item-input">
									<?php echo ($username); ?>
								</div>
							</div>
						</div>
					</li>

				</ul>

			</div>
			<div style="font-size:9pt; margin:10px;line-height: 20px;"><strong>尊敬的XRC原始矿工请认真阅读以下规则：</strong><br>

				【1】年龄范围18至70周岁，不用上传手持照片，注册帐号必须是本人银行卡绑定手机号码，系统自动审核并秒发放矿机。<br>

				【2】平台为保证每位矿工资金安全，收款资料注册成功任何人不得篡改，真实姓名与支付宝不一致永久封号处理。<br>

				【3】如果支付宝帐号设置隐私导致买方查找不到无法完成打款，收款方永久封号处理。<br>

				【4】交易规则请严格遵照平台制度执行，2小时内完成打款，2小时内确认收款，任何一方违规将被系统临时冻结帐号处理，求助解冻请查看平台公告。<br>

				【5】区块链被誉为财富第九波，XRC平台完全去中心化，矿工点对点交易，所有资金不经过平台，无众筹无充值提现。零门槛，零投资，零风险，安全免费随时可卖币退出。投资自由，风险自控，请用闲散资金参与。<br>


				<input name="xy" type="checkbox" id="xy" value="1">
				<strong style="color:#990000;"> 我已认真阅读以上规则，同意加入XRC矿工联盟</strong>
			</div>
		</form>
		<div class="content-block">
			<div class="row">
				<div class="col-100">
					<button id="send" type="submit" class="button button-big button-fill button-success js-submit" style="width: 100%;" onclick="document.getElementById('loginForm').submit();">注册新会员</button>
				</div>
			</div>
		</div>
<!-- 		<div align="center"><a href="">点击下载APP</a><br>
			<img src="/Public/ybt/image/1520935591.png" width="80%"></div> -->
	</div>
</div>
<script src="/Public/ybt/js/jquery-1.10.2.min.js"></script>

<script type="text/javascript">
    // 发送手机短信
    function send_sms_reg_code(){
        var mobile = $('#mobile').val();
        var verCode = $('#verCode').val();

        if(!verCode.length==4){
            alert('请输入图形验证码');
            return;
        }
        if(!checkMobile(mobile)){
            alert('请输入正确的手机号码');
            return;
        }


        var url = "/index.php/index/sem/send_sms_reg_code/mobile/"+mobile+'/verCode/'+verCode;
        $.get(url,function(data){
            obj = $.parseJSON(data);
            if(obj.status == 1)
            {
                $('#count_down').attr("disabled","disabled");
                intAs = 60; // 手机短信超时时间
                jsInnerTimeout('count_down',intAs);
            }
            alert(obj.msg);// alert(obj.msg);

        })
    }
    $('#count_down').removeAttr("disabled");
    //倒计时函数
    function jsInnerTimeout(id,intAs)
    {
        var codeObj=$("#"+id);
        //var intAs = parseInt(codeObj.attr("IntervalTime"));

        intAs--;
        if(intAs<=-1)
        {
            codeObj.removeAttr("disabled");
//            codeObj.attr("IntervalTime",60);
            codeObj.text("获取验证码");
            return true;
        }

        codeObj.text(intAs+'秒');
//        codeObj.attr("IntervalTime",intAs);

        setTimeout("jsInnerTimeout('"+id+"',"+intAs+")",1000);
    };
    function checkMobile(tel) {
        var reg = /(^1[3|4|5|7|8][0-9]{9}$)/;
        if (reg.test(tel)) {
            return true;
        }else{
            return false;
        };
    }
</script>

</body></html>