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

</head>
<body style="">

<!-- <div class="page">-->

<!-- 标题栏 -->
<header class="bar bar-nav">

    <a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem; color:#FFF;">矿池资产</a>    <div class="logo">
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


<div class="content" id="main_content">

    <br>
    <span id="tjbd_text"><a class="button button-big button-fill button-success js-tixian-submit" href="<?php echo U('Account/mrsf');?>">每日释放</a></span><br><br>



    <h4 style="color: #333333; font-size:18px;">购买矿池资产</h4>
    <hr color="#333333" size="1">
    <div class="list-block">
        <form class="cmxform form-horizontal tasi-form" name="form1" id="form1" method="post" action="<?php echo U('Account/kcpost');?>">
            <ul>

                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-name"></i></div>
                        <div class="item-inner">
                            <div class="item-title label">矿池钱包余额</div>
                            <div class="item-input">
                                <?php echo (four_number($jinbi["jinbi"])); ?>枚
                            </div>
                        </div>
                    </div>
                </li>



                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-name"></i></div>
                        <div class="item-inner">
                            <div class="item-title label">存入数量</div>
                            <div class="item-input">
                                <input type="text" name="amount" id="amount" style="font-size:12px;" placeholder="1矿池钱包=<?php echo ($kcdh["kcdh"]); ?>矿池资产" value="">

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
                                <input class="col-20" type="password" placeholder="请输入二级密码" name="ejmm" value="">
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </form>
    </div>
    <div class="content-block">
        <div class="row">

            <div class="col-50"><a onclick="document.getElementById('form1').submit();" id="submit" class="button button-big button-fill button-success js-tixian-submit">确认存入</a></div>
            <div class="col-50"><a href="<?php echo U('Account/kczc');?>" class="button button-big button-fill button-dark">取消</a></div>
        </div>
    </div>

    <!--表单结束-->




</div>



</body></html>