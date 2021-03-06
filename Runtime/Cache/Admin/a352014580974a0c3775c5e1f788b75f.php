<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Dashboard Template for Bootstrap</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="<?php echo (ADMIN_CSS_URL); ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo (ADMIN_CSS_URL); ?>font-awesome.css">
</head>
<style>
    .main{
        position: relative;
        top: 60px;
    }
</style>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">公司名字：<?php echo ($company); ?></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/index.php/Admin/Index/logout">退出登陆</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid main">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar" id="left">
                <!--        导航条-->
            </div>
            <div class="col-sm-9 col-md-10 " id="right">
                <!--            右边类容-->
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(function(){
            $('#left').load('/index.php/Admin/Left/left');
            $('#myModal').modal('show');
        });
    </script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo (ADMIN_JS_URL); ?>js.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="<?php echo (ADMIN_JS_URL); ?>bootstrap.min.js"></script>
</body>

</html>