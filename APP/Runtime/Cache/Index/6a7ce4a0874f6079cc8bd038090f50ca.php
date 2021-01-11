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

<div class="page">

    <!-- 标题栏 -->
    <header class="bar bar-nav">

        <a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem; color:#FFF;">活动奖励</a>    <div class="logo">
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
        <div class="tabs">

            <div class="card">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" id="table-5">
                    <thead>
                    <tr>
                        <th align="center"><div align="center">活动名称</div></th>
                        <th align="center"><div align="center">累积购买数量</div></th>
                        <th align="center"><div align="center">赠送矿池</div></th>
                        <th align="center"><div align="center">赠送矿机</div></th>
                        <th align="center"><div align="center">赠送矿机数量</div></th>
                        <th align="center"><div align="center">操作</div></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
                            <td align="center"><?php echo ($v["name"]); ?></td>

                            <td align="center"><?php echo (two_number($v["leiji"])); ?>/<?php echo (two_number($v["num"])); ?></td>
                            <td align="center"><?php echo ($v["zszc"]); ?></td>
                            <td align="center"><?php echo ($v["kjname"]); ?></td>
                            <td align="center"><?php echo ($v["kj_num"]); ?></td>
                            <td align="center"><a href="<?php echo U('Account/ckhd',array('id'=>$v['id']));?>">查看活动</a></td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>


            </div>

            <div style="position: absolute;top: 75%;left: 5%;right: 5%;width: 90%;height: 60%;">
                <font color="red">活动说明：</font>
            <br/>
                本活动购买数量为累计制，领取奖励后将重新累积购买数量，比如：累计购买数量为600枚，领取了500奖励，剩余累计100枚。想要领取1000奖励，需再购买900枚。</p></div>
        </div>
        <div style=" text-align: center;"><?php echo ($page); ?></div>
    </div>
</div>
</body>
</html>