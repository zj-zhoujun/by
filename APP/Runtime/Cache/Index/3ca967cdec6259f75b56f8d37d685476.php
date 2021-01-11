<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="robots" content="noindex,nofollow">
    <meta name="robots" content="noarchive">
    <!-- 屏蔽-->
    <title>登录</title>
    <meta name="keywords" content=" ">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="IE=9; IE=EDGE" http-equiv="X-UA-Compatible">
    <link rel="stylesheet" href="/Public/ybt/css/sm.css">

    <link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">
    <link rel="stylesheet" href="/Public/ybt/css/iconfont.css">
    <link rel="stylesheet" href="/Public/ybt/css/main.css">
    <style type="text/css">
        <!--
        .dsafdfasdf {
            margin-top: 10px;
            margin-left: 10px;
        }
        -->
    </style>
    <style type="text/css">
        .page{background: url('/Public/ybt/image/login.jpg') no-repeat top center; background-size:100% 110%;}
        .list-block{margin: 1.75rem 1rem; }
        .list-block ul {background: none; color: #777575;}
        .list-block input[type="text"], .list-block input[type="password"]{ color: #777575;}
        .list-block .item-content{padding-left:0px;}
        .list-block .item-media + .item-inner{margin-left:0.5rem;}
        .button-success.button-fill {
            color: #FFF; font-size: 1.2rem;
            /* background-color: #7fcfff;*/ border-radius: 20px;
        }
        .button-success.button-fill:active {
            background-color: #2672ac;
        }
        .list-block .item-title.label { width: 25%;}
    </style></head>

<body>
<div class="page">

    <!-- 这里是页面内容区 -->
    <form name="form" method="post" action="<?php echo U('Index/Login/logincl');?>" class="form-signin">
        <div class="content" style="margin-bottom:0px;">
            <div style="height:40%; text-align:center;"></div>
            <div class="list-block">
                <ul>
                    <!-- Text inputs -->
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon iconfont icon-wxbzhanghu"></i></div>
                            <div class="item-inner">
                                <div class="item-title label">手机号</div>
                                <div class="item-input">
                                    <input name="username" type="text" id="username" placeholder="请输入手机号" maxlength="11">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon iconfont icon-lock"></i></div>
                            <div class="item-inner">
                                <div class="item-title label">密&nbsp;码</div>
                                <div class="item-input">
                                    <input type="password" name="password" id="password" placeholder="请输入密码" class="">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon iconfont icon-yanjing"></i></div>
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
                </ul>

                <div class="content-block" style="padding:0;">
                    <div class="row">
                        <div class="col-100">

                            <input type="submit" class="button button-big button-fill button-success"  value="登&nbsp; &nbsp;陆"/>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-50 login-link">
                            <a href="<?php echo U('Index/Sem/reg');?>" style=" color:#333333;">注册新用户</a>
                        </div>
                        <div class="col-50 login-link" style="text-align: right;">
                            <a href="<?php echo U('Index/Login/editpwd');?>" style="color:#333333;">找回密码</a>
                        </div>
                    </div>
                </div>
          </div><div align="center"><a href="http://43.226.54.6/app.html">点击下载APP</a><br>
            <!--img src="/Public/ybt/image/1221.png" width="80%"--></div></div> 
    </form>
    <!--content end-->
</div>
<!-- popup, panel 等放在这里 -->
<div class="panel-overlay"></div>
<!-- 默认必须要执行$.init(),实际业务里一般不会在HTML文档里执行，通常是在业务页面代码的最后执行 -->


</body></html>