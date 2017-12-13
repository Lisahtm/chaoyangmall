<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="朝阳商场">
    <link rel="shortcut icon" href="/chaoyangmall/Public/images/nahuolun_emblem-bg.png" type="image/x-icon" />
    <title><?php echo (C("TITLE")); ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/chaoyangmall/Public/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- MetisMenu CSS -->
    <link href="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/datatables-responsive/css/responsive.dataTables.css" rel="stylesheet">
    <!-- toastr CSS -->
    <link href="/chaoyangmall/Public/toastr/toastr.min.css" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link href="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- My CSS -->
    <link href="/chaoyangmall/Public/css/common.css" rel="stylesheet" type="text/css">
    <link href="/chaoyangmall/Public/css/admin.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/chaoyangmall/Public/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>
    <!-- Bootstrap Confirmation Plugin -->
    <script src="/chaoyangmall/Public/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
    <!-- toastr CSS -->
    <script src="/chaoyangmall/Public/toastr/toastr.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/dist/js/sb-admin-2.js"></script>
    <script src="/chaoyangmall/Public/startbootstrap-sb-admin-2-1.0.8/bower_components/jquery/dist/jquery.autocomplete.js"></script>


    <!-- Baidu Tongji JavaScript -->
    <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "//hm.baidu.com/hm.js?9bd11faac48d75dcd3c7b6dda89d127f";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
    </script>


    <!-- My JavaScript -->
    <script src="/chaoyangmall/Public/js/Common/pagination.js"></script>
</head>


<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">管理员登录</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="login" method="post">
                            <fieldset>
                                <?php if($error > 0): ?><div id="notification" class="alert alert-danger alter-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        登录失败！原因:<?php echo ($msg); ?>。
                                    </div><?php endif; ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="用户名" name="account" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="密码" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="remember">记住登录状态
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="form-group">

                                    <button class="btn btn-success btn-block" type="submit">登录</button>
                                </div>
       
                                
                            </fieldset>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>