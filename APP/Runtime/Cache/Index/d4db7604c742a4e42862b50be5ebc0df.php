<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" class="translated-ltr"><head id="Head1"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <title>XRCoin</title>

</head>
<body>
<section class="panel">
<script type="text/javascript" src="/Public/ybt/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/ybt/js/highcharts.js"></script>
<script type="text/javascript" src="/Public/ybt/js/exporting.js"></script>
<script type="text/javascript">
    Highcharts.setOptions({
        global: {
            useUTC: false
        }
    });

    var chart;
    $(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'chart_line', //图表放置的容器，DIV
                defaultSeriesType: 'line', //图表类型line(折线图),
                zoomType: 'x'   //x轴方向可以缩放
            },
            credits: {
                enabled: false   //右下角不显示LOGO
            },
            title: {
                text: 'XRC币历史价格' //图表标题
            },
            subtitle: {
                text: '2020年'  //副标题
            },
            xAxis: {  //x轴
                categories: [ <?php echo ($categories); ?>], //x轴标签名称
                gridLineWidth: 1, //设置网格宽度为1
                lineWidth: 2,  //基线宽度
                labels:{y:26}  //x轴标签位置：距X轴下方26像素
            },
            yAxis: {  //y轴
                title: {text: '每日XRC币价格'}, //标题
                lineWidth: 2 //基线宽度
            },
            plotOptions:{ //设置数据点
                line:{
                    dataLabels:{
                        enabled:true  //在数据点上显示对应的数据值
                    },
                    enableMouseTracking: false //取消鼠标滑向触发提示框
                }
            },
            legend: {  //图例
                layout: 'horizontal',  //图例显示的样式：水平（horizontal）/垂直（vertical）
                backgroundColor: '#ffc', //图例背景色
                align: 'left',  //图例水平对齐方式
                verticalAlign: 'top',  //图例垂直对齐方式
                x: 100,  //相对X位移
                y: 70,   //相对Y位移
                floating: true, //设置可浮动
                shadow: true  //设置阴影 -->
            },
            exporting: {
                enabled: false  //设置导出按钮不可用
            },
            series: [{  //数据列
                name: '最新价格',
                data: [ <?php echo ($series); ?>]        }]
        });


    });
</script>
    <div id="chart_line" style="width:100%; height:320px; margin:10px auto;"></div>
</section>

</body></html>