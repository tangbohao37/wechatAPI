<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Common/css/bootstrap.css">
    <!--
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Common/css/font-awesome.css">
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
-->
</head>

<body>
    <?php echo ($a); ?>
    <h1><b>兼职发布</b></h1>
    <hr>
    <form action="/index.php/Admin/Right/fabu" class="form-horizontal" method="post" role="form">
        <div class="form-group">
            <label  class="col-sm-2 control-label">标题</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="title"  placeholder="标题">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">工作内容</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="workInfo" placeholder="工作内容">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">工作开始时间</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" name="workStartDate" placeholder="工作开始时间">
            </div>
            <label  class="col-sm-2 control-label">工作结束时间</label>
            <div class="col-sm-2">
                <input type="date" class="form-control"  name="workStopDate" placeholder="工作结束时间">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">工作地点</label>
            <div class="col-sm-7">
                <input type="text" name="address" class="form-control"  placeholder="工作地点">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">工作要求</label>
            <div class="col-sm-7">
                <input type="text" class="form-control"  name="request" placeholder="工作要求">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">工资</label>
            <div class="col-lg-2">
                <div class="input-group">
                    <input type="text" class="form-control" name="salary" placeholder="工资">
                </div>
            </div>
            <div class="col-lg-2 radio">
                <label>
                    <input type="radio" name="isdalysalary"  value="1" checked>
    /天
  </label>
                <label>
                    <input type="radio" name="isdalysalary"  value="0">
    /小时
  </label>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">人数</label>
            <div class="col-sm-2">
                <div class="input-group">
                    <input type="text" name="num" class="form-control" placeholder="人数">
                    <span class="input-group-addon">人</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">联系人</label>
            <div class="col-sm-7">
                <input type="text" name="person" class="form-control"  placeholder="联系人">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">联系电话</label>
            <div class="col-sm-7">
                <input type="text" name="phone" class="form-control"  placeholder="联系电话">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>
</body>

</html>