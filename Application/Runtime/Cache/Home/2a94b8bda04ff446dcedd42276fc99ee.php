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
      
         

<!-- Homepage Slider -->
<div class="homepage-slider">
    <div id="sequence">
        <ul class="sequence-canvas">
            <!-- Slide 1 -->
            <li class="bg4">
                <!-- Slide Title -->
                <h2 class="title">朝阳商业大楼</h2>
                <!-- Slide Text -->
                <h3 class="subtitle">您正确的选择</h3>
                <!-- Slide Image -->
                <img class="slide-img" src="/Public/image/homepage-slider/slide1.png" alt="Slide 1" />
            </li>
            <!-- End Slide 1 -->
            <!-- Slide 2 -->
            <li class="bg3">
                <!-- Slide Title -->
                <h2 class="title">时尚女装</h2>
                <!-- Slide Text -->
                <h3 class="subtitle">开启您的时尚之路</h3>
                <!-- Slide Image -->
                <img class="slide-img" src="/Public/image/homepage-slider/slide2.png" alt="Slide 2" />
            </li>
            <!-- End Slide 2 -->
            <!-- Slide 3 -->
            <li class="bg1">
                <!-- Slide Title -->
                <h2 class="title">娱乐设施</h2>
                <!-- Slide Text -->
                <h3 class="subtitle">设施齐全</h3>
                <!-- Slide Image -->
                <img class="slide-img" src="/Public/image/homepage-slider/slide3.png" alt="Slide 3" />
            </li>
            <!-- End Slide 3 -->
        </ul>
        <div class="sequence-pagination-wrapper">
            <ul class="sequence-pagination">
                <li>1</li>
                <li>2</li>
                <li>3</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Homepage Slider -->
<!-- Introduction -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                    <div class="service-wrapper">
                        
                        <h3>官方微博</h3>
                        <p>weibo:weibo.com</p>
                    </div>
                    <div class="service-wrapper" style="text-align: left">
                        <p><a href="http://map.baidu.com/"><img src="/Public/image/map.jpg" style="width:100%;"></p>
                        <p class="contact-us-details">
                            <b>地址:</b> 辽宁省朝阳市双塔区朝<br/>
                            <b>电话:</b> +44 123 654321<br/>
                            <b>传真:</b> +44 123 654321<br/>
                            <b>邮箱:</b> <a href="mailto:getintoutch@yourcompanydomain.com">getintoutch@yourcompanydomain.com</a>
                        </p>
                    </div>
            </div>
            <div class="col-md-8 col-sm-6">
                <div >
                    <div class="service-wrapper">
                        <img src="/Public/image/firelogo.png" alt="firelogo">
                        <h3>热销活动</h3>
                        <ul style="text-align: left">
                            <?php if(is_array($activityList)): $i = 0; $__LIST__ = $activityList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="in-press press-wired"><a href="/Home/Index/activity?id=<?php echo ($item["id"]); ?>&type=1"><?php echo (mb_substr($item["title"],0,30)); ?>
<span class="pull-right"><?php echo (date('Y-m-d',strtotime($item["create_time"]))); ?></span>
                             </a>

                             </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                       <a href="/Home/Index/activitylist?type=1" class="btn">查看更多</a>
                    </div>
                </div>
                <div >
                    <div class="service-wrapper">
                        <img src="/Public/image/companylogo.png" alt="companylogo">
                        <h3>招商信息</h3>
                        <ul style="text-align: left">
                            <?php if(is_array($businessList)): $i = 0; $__LIST__ = $businessList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="in-press press-wired"><a href="/Home/Index/activity?id=<?php echo ($item["id"]); ?>&type=2"><?php echo (mb_substr($item["title"],0,32)); ?>
<span class="pull-right"><?php echo (date('Y-m-d',strtotime($item["create_time"]))); ?></span>
                             </a>

                             </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <a href="/Home/Index/activitylist?type=2" class="btn">查看更多</a>
                    </div>
                </div>                
            </div>

        </div>
    </div>
</div>
<!-- End Introduction -->

<!-- Call to Action Bar 过渡层-->
<div class="section section-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="calltoaction-wrapper">
                    <h3>It's a free multipurpose Bootstrap 3 template!</h3> <a href="http://www.dragdropsite.com" class="btn btn-orange">Download here!</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Call to Action Bar -->

<!-- Our Clients -->
<div class="section">
    <div class="container">
        <h2>入驻商户</h2>
        <div class="clients-logo-wrapper text-center row">
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="/Public/image/logos/canon.png" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="/Public/image/logos/cisco.png" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="/Public/image/logos/dell.png" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="/Public/image/logos/ea.png" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="/Public/image/logos/ebay.png" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="/Public/image/logos/facebook.png" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="/Public/image/logos/google.png" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="/Public/image/logos/hp.png" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="/Public/image/logos/microsoft.png" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="/Public/image/logos/mysql.png" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="/Public/image/logos/sony.png" alt="Client Name"></a></div>
            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="/Public/image/logos/yahoo.png" alt="Client Name"></a></div>
        </div>
    </div>
</div>
<!-- End Our Clients -->
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