<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0, user-scalable=no" />
    <link href="/Public/ybt/css/mui.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="/Public/ybt/css/common.css" />
    <link rel="stylesheet" href="/Public/ybt/css/verified.css" />

    <link rel="stylesheet" href="/Public/ybt/css/sm.css">
    <script src="/Public/ybt/js/jquery-1.10.2.min.js"></script>

    <link rel="stylesheet" href="/Public/ybt/css/sm-extend.css">

    <link rel="stylesheet" href="/Public/ybt/css/iconfont.css">
    <!--自定义-->
    <link rel="stylesheet" href="/Public/ybt/css/main.css">
    <link rel="stylesheet" href="/Public/ybt/css/order.css">


    <title>订单详情</title>
</head>
<body style="">

<!-- <div class="page">-->

<!-- 标题栏 -->
<header class="bar bar-nav">

    <a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem; color:#FFF;">订单详情</a>    <div class="logo">
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

<div class="content" id="main_content">

    <style type="text/css">
        body{ background: #FFF;}
        .li_touxiang img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }
    </style>

    <div class="exchange">
        <ul class="mui-table-view">
            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>手机号</span>
                    </div>
                    <div>
                    <font style="font-size:20px;color:red"><?php echo ($mclist["username"]); ?></font>（交易前请先致电确认）
                    </div>
                </div></li>
            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>真实姓名</span>
                    </div>
                    <div>
                        <font style="font-size:20px;color:red"> <?php echo ($mclist["truename"]); ?></font>（请确认与收款码姓名一致）
                    </div>
                </div></li>
        </ul>
    </div>
    <div class="exchange" style="margin-top: 16px;">
        <ul class="mui-table-view">
            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>XRC数量</span>
                    </div>
                    <div>
                        <font style="font-size:20px;color:red">   <?php echo ($jyzx["cbt"]); ?></font>个XRC
                    </div>
                </div>
            </li>
            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>单价</span>
                    </div>
                    <div>
                        <font style="font-size:20px;color:red">     <?php echo ($jyzx["danjia"]); ?></font>$
                    </div>
                </div>
            </li>
            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>合计美元</span>
                    </div>
                    <div>
                        <font style="font-size:20px;color:red">    <?php echo ($jyzx["qian"]); ?></font>$
                    </div>
                </div></li>

            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>合计人民币</span>
                    </div>
                    <div>
                        <font style="font-size:20px;color:red"><?php echo ($rmb); ?></font>￥
                    </div>
                </div></li>
        </ul>
    </div>
    <div class="code">
        <div>
            <span>卖家收款码</span>
        </div>
        <div>
            <div>
                <span>支付时请确认收款码与真实姓名一致</span>
            </div>

            <img id="img1" src="<?php echo ($mclist["image"]); ?>" style="width:100px;height:150px" alt="" />

    </div>
        <script type="text/javascript">
            $(function(){
                $("#img1").click(function(){
                    var width = $(this).width();
                    if(width==100)
                    {
                        $(this).width(400);
                        $(this).height(600);
                    }
                    else
                    {
                        $(this).width(100);
                        $(this).height(150);
                    }
                });
            });
        </script>

</body>
</html>