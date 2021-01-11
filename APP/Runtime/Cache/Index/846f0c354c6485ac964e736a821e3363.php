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
    <title>社群奖励</title>
</head>
<body style="">

<!-- <div class="page">-->

<!-- 标题栏 -->
<header class="bar bar-nav">

    <a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem; color:#FFF;">社群奖励</a>    <div class="logo">
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
<form method="post" action="<?php echo U('Account/sqjlpost');?>" id="formid" enctype="multipart/form-data" data-ajax="false">
    <div class="exchange">
        <ul class="mui-table-view">

            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>群名称</span>
                    </div>
                    <div>

                        <input type="text" name="name" id="name" value="" placeholder="请输入群名称" />

                    </div>
                </div></li>
            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>群号码</span>
                    </div>
                    <div>

                            <input type="text" name="number" id="number" value="" placeholder="微信群可不填写" />

                    </div>
                </div></li>
            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>申请人微信</span>
                    </div>
                    <div>

                            <input type="text" name="weixin" id="weixin" value="" placeholder="请输入申请人微信" />

                    </div>
                </div></li>

            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>申请人QQ</span>
                    </div>
                    <div>
                        <input type="text" name="QQ" id="QQ" value="" placeholder="请输入申请人QQ" />

                    </div>
                </div></li>
        </ul>
    </div>

    <div class="code">

            <div>
                <span>社群截图</span>
            </div>


        <div>
            <div>
                <span>请上传社群截图页面，示例如下</span>
            </div>

            <div>
                <div>
                    <div>
                        <span  class="sima"> <img id="clickimg" src="/Public/ybt/image/icon_add.png" onclick="document.getElementById('upfile').click()" id="clickimg" width="120" height="120" /></span>
                    </div>
                    <input type="file" name="photoimg" multiple="multiple"  id="upfile"  class="upload_pic" style="display: none;" />
                    <input type="hidden" id="image" name="image" value="">
                </div>
                <div>
                    <li>  <img src="/Public/ybt/image/code.png" style="width:100px;height:150px" alt="" /></li>
                </div>
            </div>
        </div>



    </div>
    <p><font color="red">备注：</font> <?php echo ($sqbz); ?></p>

    <?php if($status == 0): ?><div class="subMessage">
        <button id="sub" onclick="if(confirm('建立社群库是为了更好的发展，每个账号仅可以领取一次奖励，恶意提交会被封号，确认提交吗？')==false)return false;">提交</button>
    </div><?php endif; ?>
</form>

</div>

<script src="/Public/ybt/js/jquery-1.11.3.min.js"></script>
<script src="/Public/ybt/js/jquery.form.js"></script>
<script src="/Public/ybt/js/layer.js"></script>

<script type="text/javascript">
    $(function(){
        $("#upfile").wrap("<form action='<?php echo U('Account/uploads1');?>' method='post' enctype='multipart/form-data'></form>");
        $("#upfile").off().on('change',function(){
            var objform = $(this).parents();
            objform.ajaxSubmit({
                dataType:  'json',
                target: '#preview',
                success:function(data){
                    if(data.result==1){
                        $("#clickimg").attr('src','/Public/'+data.url)
                        $("#image").val('/Public/'+data.url)
                    }else{
                        $('.sima').html('<font style="color:red;">'+data.msg+'</font>')
                    }
                },
                error:function(){
                }
            });
        });
    });
</script>
</body>
</html>