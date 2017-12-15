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
                    <li class="logo-wrapper"><a href="index.html"><img src="img/mPurpose-logo.png" alt="LOGO PIC"></a></li>
                    <li class="<?php echo ($list[0]); ?>">
                        <a href="index.html">首页</a>
                    </li>
                    <li class="<?php echo ($list[1]); ?>">
                        <a href="/Home/Index/introduction">广场介绍</a>
                    </li>
                    <li class="<?php echo ($list[2]); ?>">
                        <a href="/Home/Index/introduction">商户分布</a>
                    </li>
                    <li class="<?php echo ($list[3]); ?>">
                        <a href="/Home/Index/activitylist?type=1">热销活动</a>
                    </li>
                    <li class="<?php echo ($list[4]); ?>">
                        <a href="热销活动.html">位置交通</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>    
    <div id="wrapper">
      
         
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>商场介绍</h1>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-sm-2 blog-sidebar">
                <h4>商场概况</h4>
                <ul class="recent-posts">
                    <li><a href="#">第一层·奢侈品</a></li>
                    <li><a href="#">第二层</a></li>
                    <li><a href="#">第三层</a></li>
                    <li><a href="#">第四层</a></li>
                </ul>

            </div>
            <!-- End Sidebar -->
            <div class="col-sm-10">
                <div class="blog-post blog-single-post">
                    <div class="single-post-title">
                        <h3>商场概况</h3>
                    </div>
                    <div class="single-post-image">
                        <img src="img/blog-large.jpg" alt="Post Title">
                    </div>
                    <div class="single-post-content">
                        <h3>Lorem ipsum dolor sit amet</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis, nulla id pretium malesuada, dui est laoreet risus, ac rhoncus eros diam id odio. Duis elementum ligula eu ipsum condimentum accumsan.
                        </p>
                        <p>
                            Vivamus euismod elit ac libero facilisis tristique. Duis mollis non ligula vel tincidunt. Nulla consectetur libero id nunc ornare, vel vulputate tellus mollis. Sed quis nulla magna. Integer rhoncus sem quis ultrices lobortis. Maecenas tempus nulla quis dolor vulputate egestas. Phasellus cursus tortor quis massa faucibus fermentum vel sit amet tortor. Phasellus vehicula lorem et tortor luctus, a dignissim lacus tempor. Aliquam volutpat molestie metus sit amet aliquam. Duis vestibulum quam tortor, sed ultrices orci sagittis nec.
                        </p>
                        <h3>Sed sit amet metus sit</h3>
                        <p>
                            Proin fermentum, purus id eleifend molestie, nisl arcu rutrum tellus, a luctus erat tortor ut augue. Vivamus feugiat nisi sit amet dignissim fermentum. Duis elementum mattis lacinia. Sed sit amet metus sit amet leo semper feugiat. Nulla vel orci nec neque interdum facilisis egestas vitae lorem. Phasellus elit ante, posuere at augue quis, porta vestibulum magna. Nullam non mattis odio. Donec eget velit leo. Nunc et diam volutpat tellus ultrices fringilla eu a neque. Integer lectus nunc, vestibulum a turpis vitae, malesuada lacinia nibh. In sit amet leo ut turpis convallis bibendum. Nullam nec purus sapien. Quisque sollicitudin cursus felis sit amet aliquam.
                        </p>
                    </div>
                </div>
            </div>
            <!-- End Blog Post -->
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