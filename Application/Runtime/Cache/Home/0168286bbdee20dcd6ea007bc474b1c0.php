<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="朝阳商场">
    <link rel="shortcut icon" href="/Public/images/nahuolun_emblem-bg.png" type="image/x-icon" />
    <title><?php echo (C("TITLE")); ?></title>

    <link rel="stylesheet" href="/Public/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/Public/css/Home/main.css"/>
    <script src="/Public/js/Home/jquery-1.9.1.min.js"></script>
</head>


<body>
<!-- Navigation & Logo-->
    <div class="mainmenu-wrapper">
        <div class="container">
            <nav id="mainmenu" class="mainmenu">
                <ul>
                    <div style="display: none;"> <?php echo ($list=array()); ?>
                    <?php echo ($list[$tab_type]="active"); ?>
                    </div>
                    <li class="logo-wrapper"><a href="index.html"><img style="width: 40px;" src="/Public/image/logo.png" alt="LOGO PIC"></a></li>
                    <li class="<?php echo ($list[0]); ?>">
                        <a href="index.html">首页</a>
                    </li>
                    <li class="<?php echo ($list[1]); ?>">
                        <a href="/Home/Index/introduction">广场介绍</a>
                    </li>
                    <li class="<?php echo ($list[2]); ?>">
                        <a href="/Home/Index/company">商户分布</a>
                    </li>
                    <li class="<?php echo ($list[3]); ?>">
                        <a href="/Home/Index/activitylist?type=1">热销活动</a>
                    </li>
                    <li class="<?php echo ($list[4]); ?>">
                        <a href="/Home/Index/traffic">位置交通</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>    
    <div id="wrapper" style="overflow: hidden">
      
         
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5b04ca7b890930543fdd80615ad71268"></script>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <!-- Map -->
                <div id="contact-us-map">

                </div>
                <!-- End Map -->
                <!-- Contact Info -->
                <p class="contact-us-details text-center">
                    <b>Address:</b> 北京市朝阳区西坝河中里34号<br/>
                    <b>Phone:</b> (010)64661561<br/>
                    <b>Email:</b> <a href="mailto:getintoutch@yourcompanydomain.com">getintoutch@yourcompanydomain.com</a>
                </p>
                <!-- End Contact Info -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        // 百度地图API功能
        var map = new BMap.Map("contact-us-map");    // 创建Map实例
        map.centerAndZoom(new BMap.Point(116.446344,39.967705), 13);  // 初始化地图,设置中心点坐标和地图级别


        var point = new BMap.Point(116.446344,39.967705);
        var marker = new BMap.Marker(point);  
        map.addOverlay(marker);              
        map.centerAndZoom(point, 15);
        var opts = {
          width : 200,     // 信息窗口宽度
          height: 100,     // 信息窗口高度
          title : "北京朝阳商业大楼" , // 信息窗口标题
          enableMessage:true,//设置允许信息窗发送短息
          message:"北京市朝阳区西坝河中里34号"
        }
        var infoWindow = new BMap.InfoWindow("地址：北京市朝阳区西坝河中里34号", opts);  // 创建信息窗口对象 
        marker.addEventListener("click", function(){          
            map.openInfoWindow(infoWindow,point); //开启信息窗口
        });
    })

</script>
    </div>
    <!-- Footer -->
<div class="footer">
    <div class="container">
        <div class="row">       
            <div class="col-footer col-xs-12 " style="text-align: center">
                <h3>联系我们</h3>
                <p class="contact-us-details">
                    <b>Address:</b> 123 Fake Street, LN1 2ST, London, United Kingdom<br/>
                    <b>Phone:</b> +44 123 654321<br/>
                    <b>Fax:</b> +44 123 654321<br/>
                    <b>Email:</b> <a href="mailto:getintoutch@yourcompanydomain.com">getintoutch@yourcompanydomain.com</a>
                </p>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="footer-copyright">Copyright &copy; 2015.Company name All rights reserved.</div>
            </div>
        </div>
    </div>
</div>

    <!-- /#wrapper -->  
    <?php if(($tab_type) == "0"): ?><script src="/Public/js/Home/jquery-1.9.1.min.js"></script>
    <script src="/Public/js/Home/bootstrap.min.js"></script>
    <script src="/Public/js/Home/jquery.fitvids.js"></script>
    <script src="/Public/js/Home/jquery.sequence-min.js"></script>
    <script src="/Public/js/Home/jquery.bxslider.js"></script>
    <script src="/Public/js/Home/main-menu.js"></script>
    <script src="/Public/js/Home/template.js"></script><?php endif; ?>

</body>
</html>