<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0035)http://www.xxx.com/Home/Info/ -->
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
    <!--<script type='text/javascript' src='/App/Tpl/Wap/Default/Public/js/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='/App/Tpl/Wap/Default/Public/js/sm.js' charset='utf-8'></script>-->
    <!--如果你用到了拓展包中的组件，还需要引用下面两个-->
    <link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">
    <!--    <script type='text/javascript' src='/App/Tpl/Wap/Default/Public/js/sm-extend.js' charset='utf-8'></script>-->

    <!--图标-->
    <link rel="stylesheet" href="/Public/ybt/css/iconfont.css">
    <!--自定义-->

    <link rel="stylesheet" href="/Public/ybt/css/main.css">
    <link rel="stylesheet" href="/Public/ybt/css/order.css">
    <!-- 变量声明  -->
    <!--<script type="text/javascript">
    var URL = '/Member';
    var APP = '';
    var PUBLIC = '/Public';
    var TMPL = "/App/Tpl/Wap/Default/"; //主题路径
    var GROUP = '';
    var ROOT = '';
    </script>-->
</head>
<body style="">

<!--  <div class="page">-->

<!-- 标题栏 -->
<header class="bar bar-nav">

    <a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem; color:#FFF;">个人资料</a>    <div class="logo">
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
    <div class="buttons-tab">
         <a href="<?php echo U('Index/Account/grzl');?>" class="active button">个人资料</a>
        <a href="<?php echo U('Index/Account/dlmm');?>" class="button">修改收款码</a>
		<a href="<?php echo U('Index/Account/xgmm');?>" class="button">修改密码</a>
        <a href="<?php echo U('Index/Account/ejmm');?>" class="button">修改二级密码</a>

    </div>
    <style type="text/css">
        body{ background: #FFF;}
        .li_touxiang img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }
    </style>
    <div class="list-block">


            <ul>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-name"></i></div>
                        <div class="item-inner">
                            <div class="item-title label">用户名</div>
                            <div class="item-input"><?php echo ($list["username"]); ?></div>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-name"></i></div>
                        <div class="item-inner">
                            <div class="item-title label">注册时间</div>
                            <div class="item-input"><?php echo (date('Y-m-d H:i:s',$list["regdate"])); ?></div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-name"></i></div>
                        <div class="item-inner">
                            <div class="item-title label">推荐人</div>
                            <div class="item-input"><?php echo ($list["parent"]); ?></div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-name"></i></div>
                        <div class="item-inner">
                            <div class="item-title label">真实姓名</div>
                            <div class="item-input"><?php echo ($list["truename"]); ?></div>
                        </div>
                    </div>
                </li>

            </ul>

    </div>


</div>






</body></html>