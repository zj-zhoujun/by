<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0041)http://www.xxx.com/Home/Index/tgbz/ -->
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

</head>
<body style="">
<script type="text/javascript">

    var sid = '554076';

</script>
<script language="javascript">
    function get_mobile_code(){

        document.getElementById('zphone').value = '正在发送';
        //document.getElementById('zphone').disabled = true;
        //mobile:jQuery.trim($('#mobile').val()),
        $.post('/Home/Index/fssjyzm', {send_code:sid}, function(msg) {
            alert(jQuery.trim(unescape(msg)));
            if(msg=='验证码发送成功'){
                RemainTime();
            }else{
                document.getElementById('zphone').value = '重新发送';
                document.getElementById('zphone').disabled = false;
            }
        });
    };
    var iTime = 59;
    var Account;
    function RemainTime(){
        document.getElementById('zphone').disabled = true;
        var iSecond,sSecond="",sTime="";
        if (iTime >= 0){
            iSecond = parseInt(iTime%60);
            iMinute = parseInt(iTime/60)
            if (iSecond >= 0){
                if(iMinute>0){
                    sSecond = iMinute + "分" + iSecond + "秒";
                }else{
                    sSecond = iSecond + "秒";
                }
            }
            sTime=sSecond;
            if(iTime==0){
                clearTimeout(Account);
                sTime='获取手机验证码';
                iTime = 59;
                document.getElementById('zphone').disabled = false;
            }else{
                Account = setTimeout("RemainTime()",1000);
                iTime=iTime-1;
            }
        }else{
            sTime='没有倒计时';
        }
        document.getElementById('zphone').value = sTime;
    }
</script>
<!-- <div class="page">-->

<!-- 标题栏 -->
<header class="bar bar-nav">

    <a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem; color:#FFF;">交易平台</a>    <div class="logo">
    <a id="cancle" href="javascript:history.go(-1)"><i class="icon icon-left"></i></a>    </div>
    <a class="icon pull-right open-panel"></a>
</header>
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

    <div class="list-block">
        <form class="cmxform form-horizontal tasi-form" action="<?php echo U('Emoney/tspost');?>" name="tousu" id="tousu" method="post">
            <ul>


                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-name"></i></div>
                        <div class="item-inner">
                            <div class="item-title label">投诉内容</div>
                            <div class="item-input">
                                <textarea rows="10" name="content" id="form-field-8" class="span6" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                </li>
                <input type="hidden"  name="id" value="<?php echo ($id); ?>">
            </ul>
        </form>
    </div>
    <div class="content-block">
        <div class="row">
            <div class="col-50">
                <button type="button" class="button button-big button-fill button-success js-submit" style="width: 100%;" onclick="document.getElementById('tousu').submit();">提交</button>
            </div>
            <div class="col-50"><a href="javascript:history.go(-1)" class="button button-big button-fill button-dark">取消</a></div>
        </div>
    </div>






</div>



</body></html>