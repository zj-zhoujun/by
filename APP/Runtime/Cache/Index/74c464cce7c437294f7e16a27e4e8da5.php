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
    <title>实名认证</title>
</head>
<body style="">

<!-- <div class="page">-->

<!-- 标题栏 -->
<header class="bar bar-nav">

    <a style="position: absolute;z-index: 19;width: 94%;text-align: center;display: inline-block;line-height: 50px;font-size: 1.1rem; color:#FFF;">实名认证</a>    <div class="logo">
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
<form method="post" action="<?php echo U('Account/skmpost');?>" id="formid" enctype="multipart/form-data" data-ajax="false">
    <div class="exchange">
        <ul class="mui-table-view">
            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>认证状态</span>
                    </div>
                    <div>
                        <?php if($status == 0): ?>未审核<?php else: ?><font color="red">已审核</font><?php endif; ?>
                    </div>
                </div></li>
            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>身份证号</span>
                    </div>
                    <div>
                        <?php if($status == 0): ?><input type="text" name="shenfen" id="shenfen" value="" placeholder="请输入身份证号码" maxlength="18"/>
                        <?php else: ?>
                            <font color="red"> <?php echo ($list["shenfen"]); ?></font><?php endif; ?>
                    </div>
                </div></li>
            <li class="mui-table-view-cell">
                <div class="assets">
                    <div>
                        <span>姓名</span>
                    </div>
                    <div>
                        <?php if($status == 0): ?><input type="text" name="truename" id="truename" value="" placeholder="请输入身份证上的姓名" />
                            <?php else: ?>
                            <font color="red">  <?php echo ($list["truename"]); ?></font><?php endif; ?>
                    </div>
                </div></li>
        </ul>
    </div>

    <div class="code">
        <?php if($status == 0): ?><div>
                <span>收款码</span>
            </div>


        <div>
            <div>
                <span>请上传收款码，示例如下</span>
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
            <?php else: ?>
            <div>
                <span>收款码</span>
            </div>
            <div>
                <div>
                    <font color="red"><span>恭喜你，已经完成实名认证！</span></font>
                </div>

                <div>
                    <div>
                        <li>  <img src="<?php echo ($list["image"]); ?>" style="width:100px;height:150px" alt="" /></li>
                    </div>
                </div>
            </div><?php endif; ?>


    </div>
    <?php if($status == 0): ?><div class="subMessage">
        <button id="sub" onclick="if(confirm('实名信息一经提交，不可修改，确认提交吗？')==false)return false;">提交</button>
    </div><?php endif; ?>
</form>
</div>

<script src="/Public/ybt/js/jquery-1.11.3.min.js"></script>
<script src="/Public/ybt/js/jquery.form.js"></script>
<script src="/Public/ybt/js/layer.js"></script>

<script type="text/javascript">
    $(function(){
        $("#upfile").wrap("<form action='<?php echo U('Account/uploads');?>' method='post' enctype='multipart/form-data'></form>");
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