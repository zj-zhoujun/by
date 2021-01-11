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
	<header class="bar bar-nav"><a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem;">找回密码</a>
		<div class="logo"><a href="javascript:history.back(-1)"><i class="icon icon-left"></i></a></div>
	</header>
	<!-- 这里是页面内容区 -->
	<div class="content" style="margin-bottom:10px;">
		<form class="form-signin" action="<?php echo U('Index/Login/xgpost');?>" name="loginForm" id="loginForm" method="post">
			<div class="list-block">

				<ul>

					<li>
						<div class="item-content">
							<div class="item-media"><i class="icon icon-form-name"></i></div>
							<div class="item-inner">
								<div class="item-title label">手机号</div>
								<div class="item-input">
									<input class="col-20" name="mobile" id="mobile" placeholder="请输入手机号" type="text" value="">
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
								<div class="item-title label">登录密码</div>
								<div class="item-input">
									<input class="col-20" name="password" id="password" type="password" placeholder="请输入新登录密码" value="">
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
									<input class="col-20" name="password1" id="password1" type="password" placeholder="请确认新登录密码" value="">
								</div>
							</div>
						</div>
					</li>


				</ul>

			</div>

		</form>
		<div class="content-block">
			<div class="row">
				<div class="col-100">
					<button id="send" type="submit" class="button button-big button-fill button-success js-submit" style="width: 100%;" onclick="document.getElementById('loginForm').submit();">提交</button>
				</div>
			</div>
		</div>

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


        var url = "/index.php/index/sem/send_sms_gm_code/mobile/"+mobile+'/verCode/'+verCode;
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