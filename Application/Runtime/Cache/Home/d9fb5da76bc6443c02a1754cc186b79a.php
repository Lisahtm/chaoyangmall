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
      
         

<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>详细内容</h1>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Job Description -->

                <div class="job-details-wrapper">
                    <h3><?php echo ($res["title"]); ?></h3>
                    <p class="job-time">发布时间：<?php echo (date('Y-m-d',strtotime($res["create_time"]))); ?></p>
                    <p>
                        <pre><?php echo ($res["content"]); ?></pre>
                    </p>
                        
                </div>
                <!-- End Job Description -->
            </div>
            <!-- Sidebar -->
            <div class="col-md-3 col-md-offset-1">
                <h4>你可能感兴趣</h4>
                <table class="jobs-list">
                    <tr>
                        <td class="job-position">
                            <?php if(!empty($previousRecord)): ?><a href="/Home/Index/activity?type=<?php echo ($type); ?>&id=<?php echo ($previousRecord["id"]); ?>">上一篇:&nbsp;<?php echo ((isset($previousRecord["title"]) && ($previousRecord["title"] !== ""))?($previousRecord["title"]):'无'); ?></a><?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="job-position">
                            <?php if(!empty($afterRecord)): ?><a href="/Home/Index/activity?type=<?php echo ($type); ?>&id=<?php echo ($afterRecord["id"]); ?>">下一篇:&nbsp;<?php echo ((isset($afterRecord["title"]) && ($afterRecord["title"] !== ""))?($afterRecord["title"]):'无'); ?> </a><?php endif; ?>
                        </td>
                    </tr>

                </table>
            </div>
            <!-- End Sidebar -->
        </div>
    </div>
</div>
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