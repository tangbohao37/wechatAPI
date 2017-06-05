<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
	<script>
	function clearnamelabel(){
		var flag = document.getElementById("errname");
    	flag.innerHTML="";
	}
	function checkname(){
    var value = document.getElementById("cname").value.trim().length;
    var flag = document.getElementById("errname");
    if(value == ""){
        flag.innerHTML="<a style='color: red'>*</a><a>公司名称不能为空</a>";
    }
	}
	
	
	function clearaddresslabel(){
		var flag = document.getElementById("erraddress");
    	flag.innerHTML="";
	}
	function checkaddress(){
    var value = document.getElementById("caddress").value.trim().length;
    var flag = document.getElementById("erraddress");
    if(value == ""){
        flag.innerHTML="<a style='color: red'>*</a><a>公司地址不能为空</a>";
    }
	}
	
	
	function clearinfolabel(){
		var flag = document.getElementById("errinfo");
    	flag.innerHTML="";
	}
	function checkinfo(){
    var value = document.getElementById("cinfo").value.trim().length;
    var flag = document.getElementById("errinfo");
    if(value == ""){
        flag.innerHTML="<a style='color: red'>*</a><a>公司简介不能为空</a>";
    }
	}
	
	</script>
</head>

<body>
    <h3>公司信息</h3>
    <hr>
    <form  action="/index.php/Admin/Right/alterCompany" class="form-horizontal" role="form" method="post">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">公司名称</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="cname" id="cname" placeholder="公司名称" onfocus="clearnamelabel()" onblur="checkname()"><span><label id="errname"></label></span>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">公司地址</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="caddress" id="caddress" placeholder="公司地址" onfocus="clearaddresslabel()" onblur="checkaddress()"><span><label id="erraddress"></label></span>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">公司简介</label>
            <div class="col-sm-7">
                <textarea class="form-control" placeholder="公司简介" name="cinfo" id="cinfo" style="resize: none;" rows="3" onfocus="clearinfolabel()" onblur="checkinfo()"></textarea><span><label id="errinfo"></label>
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