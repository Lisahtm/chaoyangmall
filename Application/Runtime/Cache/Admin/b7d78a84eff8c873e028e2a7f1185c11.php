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
    <!-- Bootstrap Core CSS -->
    <link href="/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- MetisMenu CSS -->
    <link href="/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/datatables-responsive/css/responsive.dataTables.css" rel="stylesheet">
    <!-- toastr CSS -->
    <link href="/Public/toastr/toastr.min.css" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link href="/Public/startbootstrap-sb-admin-2-1.0.8/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- My CSS -->
    <link href="/Public/css/common.css" rel="stylesheet" type="text/css">
    <link href="/Public/css/admin.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/Public/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>
    <!-- Bootstrap Confirmation Plugin -->
    <script src="/Public/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
    <!-- toastr CSS -->
    <script src="/Public/toastr/toastr.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/Public/startbootstrap-sb-admin-2-1.0.8/dist/js/sb-admin-2.js"></script>
    <script src="/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/jquery/dist/jquery.autocomplete.js"></script>


    <!-- Baidu Tongji JavaScript -->
    <script>
        var _hmt = _hmt || [];
        (function() {
          // var hm = document.createElement("script");
          // hm.src = "//hm.baidu.com/hm.js?9bd11faac48d75dcd3c7b6dda89d127f";
          // var s = document.getElementsByTagName("script")[0]; 
          // s.parentNode.insertBefore(hm, s);
        })();
    </script>


    <!-- My JavaScript -->
    <script src="/Public/js/Common/pagination.js"></script>
</head>


<body>
    <div id="wrapper">
        <!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/Admin/index" style="padding: 5px 15px;"><img class="navbar_logo" src="/Public/images/nahuolun_emblem-bg.png"  height="40"><img class="navbar_logo" src="/Public/images/nahuolun_logo_thin.png" height="40"></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li id="nav-user" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <strong>用户</strong> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo (C("prefix")); ?>/Admin/Admin/logout"><i class="fa fa-sign-out fa-fw"></i> 退出登录</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
   
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="#"><i class="fa fa-fire fa-fw"></i>热销活动管理<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/Admin/Activity/disp.html?type=1">所有活动</a>
                        </li>
                        <li>
                            <a href="/Admin/Activity/edit.html?type=1">添加热销活动</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
   
                <li>
                    <a href="#"><i class="fa fa-money fa-fw"></i> 招商管理<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/Admin/Activity/disp.html?type=2">所有招商信息</a>
                        </li>
                        <li>
                            <a href="/Admin/Activity/edit.html?type=2">添加招商信息</a>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-male fa-fw"></i> 商户管理<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/Admin/Company/disp.html">所有商户</a>
                        </li>
                        <li>
                            <a href="/Admin/Company/edit.html">添加商户信息</a>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
        
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    
                    <?php if($isEdit == 1): if($type == 1): ?>修改热销活动信息    
                        <?php else: ?>
                            修改招商信息<?php endif; ?>
                    
                        <?php else: ?>
                        <?php if($type == 1): ?>新增热销活动信息    
                        <?php else: ?>
                            新增招商信息<?php endif; endif; ?>
                    <a href="/Admin/Activity/edit?type=<?php echo ($type); ?>" class="btn btn-success pull-right">新增</a>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <?php if(isset($res)): if($res == 0): ?><div class="alert alert-success alter-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    更新成功！
                </div>

                <?php elseif($res > 0): ?>
                <div class="alert alert-danger alter-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    更新失败！
                    <?php if($res == 1): ?>标题内容不允许为空
                    <?php elseif($res == 2): ?>
                        标题过长！<?php endif; ?>
                </div><?php endif; endif; ?>
        <div class="row">
            <div class="col-lg-12">
            <form class="form-horizontal" role="form" enctype="multipart/form-data" action="/Admin/Activity/edit" method="post">
                <input type="hidden" name="type" value="<?php echo ($type); ?>">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        详细信息
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <input type="hidden" id="id" name="id" value="<?php echo ((isset($activity_info['id']) && ($activity_info['id'] !== ""))?($activity_info['id']):''); ?>">
                            <div class="form-group">
                                <label for="customer_name" class="col-sm-2 control-label">标题</label>
                                <div class="col-sm-10">
                                    <input class="form-control not_null" id="title" name="title" placeholder="标题（不能为空）" type="text" value="<?php echo ((isset($activity_info['title']) && ($activity_info['title'] !== ""))?($activity_info['title']):''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="col-sm-2 control-label">内容</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control not_null" id="content" name="content" placeholder="内容"  rows="10"><?php echo ((isset($activity_info['content']) && ($activity_info['content'] !== ""))?($activity_info['content']):''); ?></textarea> 
                                </div>
                            </div>
                            <div class="form-group" style="text-align: center">

                                <button type="submit" class="btn btn-success" onclick="return check(this.form)">
                                    &nbsp;&nbsp;保存&nbsp;&nbsp;

                                </button>
                            </div>    
                        </form>
                    </div>

                </div>
                <!-- /.panel -->
            </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<script src="/Public/js/Admin/activity.edit.js"></script>

<script type="text/javascript">
    $(function(){

    });

</script>
    </div>
    <!-- /#wrapper -->	
</body>
</html>