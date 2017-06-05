<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <h3>公司信息</h3>
    <hr>
    <form  action="/index.php/Admin/Right/alterCompany" class="form-horizontal" role="form" method="post">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">公司名称</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="cname" placeholder="公司名称">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">公司地址</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="caddress" placeholder="公司地址">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">公司简介</label>
            <div class="col-sm-7">
                <textarea class="form-control" placeholder="公司简介" name="cinfo" style="resize: none;" rows="3"></textarea>
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