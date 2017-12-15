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
                <h1>

                    <?php if($type == 1): ?>热销活动
                        <?php else: ?>
                        招商信息<?php endif; ?>
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="events-list">
                    <?php if(is_array($activityList)): $i = 0; $__LIST__ = $activityList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
                        <td>
                            <div class="event-date">
                                <div class="event-day"><?php echo (date('d',strtotime($res["create_time"]))); ?>日</div>
                                <div class="event-month"><?php echo (date('m',strtotime($item["create_time"]))); ?>月</div>
                            </div>
                        </td>
                        <td>
                            <a target="_blank" href="/Home/Index/activity?type=1&id=<?php echo ($item["id"]); ?>" class="event-grey"><?php echo ($item["title"]); ?></td>
                        </td>
                        <td><a target="_blank" href="/Home/Index/activity?type=1&id=<?php echo ($item["id"]); ?>" class="btn btn-grey btn-sm event-more">查看更多</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
            </div>
        </div>
    </div>
    <div style="position: relative;left:50%;display: inline-block">
    <div id="pageBreaker" style="margin-left:-50%;"></div>
    </div>
</ul>
</div>


<script src="/Public/js/Common/bootstrap-paginator.js"></script>
<script type="text/javascript">
    $(function(){
         var options = {
                currentPage: <?php echo ($currentPage); ?>||1,//当前页
                totalPages: <?php echo ($totalpage); ?>,//总页数
                numberofPages: 5,//显示的页数
                
                itemTexts: function(type, page, current) { //修改显示文字
                    switch (type) {
                    case "first":
                        return "第一页";
                    case "prev":
                        return "上一页";
                    case "next":
                        return "下一页";
                    case "last":
                        return "最后一页";
                    case "page":
                        return page;
                    }
                }, onPageClicked: function (event, originalEvent, type, page) { //异步换页
                    window.location.href = "/Home/Index/activityList?type=<?php echo ($type); ?>&start="+page;
                },
                        
        };

            $("#pageBreaker").bootstrapPaginator(options);
    });
</script>

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