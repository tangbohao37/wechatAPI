<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="../Common/css/bootstrap.css">-->
    <!--
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Common/css/font-awesome.css">
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
-->
	<script>
	function cleartitlelabel(){
		var flag = document.getElementById("errtitle");
    	flag.innerHTML="";
	}
	function checktitle(){
    var value = document.getElementById("title").value.trim().length;
    var flag = document.getElementById("errtitle");
    if(value == ""){
        flag.innerHTML="<a style='color: red'>*</a><a>标题不能为空</a>";
    }
	}
	
	
	function clearworkinfolabel(){
	var flag = document.getElementById("errworkinfo");
    flag.innerHTML="";
	}
	function checkworkinfo(){
   	var value = document.getElementById("workinfo").value.trim().length;
    var flag = document.getElementById("errworkinfo");
    if(value == ""){
    flag.innerHTML="<a style='color: red'>*</a><a>工作内容不能为空</a>";
    }
	}
	
	function clearworkplacelabel(){
	var flag = document.getElementById("errworkplace");
    flag.innerHTML="";
	}
	function checkworkplace(){
   	var value = document.getElementById("workplace").value.trim().length;
    var flag = document.getElementById("errworkplace");
    if(value == ""){
    flag.innerHTML="<a style='color: red'>*</a><a>工作地点不能为空</a>";
    }
	}
	
	
	function clearrequestlabel(){
	var flag = document.getElementById("errrequest");
    flag.innerHTML="";
	}
	function checkrequest(){
   	var value = document.getElementById("request").value.trim().length;
    var flag = document.getElementById("errrequest");
    if(value == ""){
    flag.innerHTML="<a style='color: red'>*</a><a>工作要求不能为空</a>";
    }
	}
	
	
	function clearsalarylabel(){
	var flag = document.getElementById("errsalary");
    flag.innerHTML="";
	}
	
	function checksalary(){
    var flag = document.getElementById("errsalary");
    var obj = document.getElementById("salary");
    if(!/^\+?[1-9][0-9]*$/.test(obj.value)){  
        flag.innerHTML="<a style='color: red'>*</a><a>请输入正确的工资信息</a>";
    }  
	}
	
	
	function clearcontactlabel(){
	var flag = document.getElementById("errcontact");
    flag.innerHTML="";
	}
	function checkcontact(){
   	var value = document.getElementById("contact").value.trim().length;
    var flag = document.getElementById("errcontact");
    if(value == ""){
    flag.innerHTML="<a style='color: red'>*</a><a>联系人不能为空</a>";
    }
	}
	
	
	function clearnumberlabel(){
	var flag = document.getElementById("errnumber");
    flag.innerHTML="";
	}
	
	function checknumber(){
    var flag = document.getElementById("errnumber");
    var obj = document.getElementById("phone");  
	var patt1 =/^(\(\d{3,4}\)|\d{3,4})?\d{7,8}$/;
	//var patt1 = new RegExp("/^1\d{10}$/");
	var val=obj.value
	var result = val.match(patt1);
	if(result==null){
    	flag.innerHTML="<a style='color: red'>*</a><a>请输入正确的联系方式</a>";
    }
	}
	
	function clearcountlabel(){
	var flag = document.getElementById("errcount");
	flag.innerHTML="";
	}
	function checkcount(){
	var flag = document.getElementById("errcount");
    var obj = document.getElementById("count");
    if(!/^[0-9]*$/.test(obj.value)){  
    flag.innerHTML="<a style='color: red'>*</a><a>请输入正确的人数</a>";
    }  
	}
	
	
	</script>
</head>

<body>
    
    <h1><b>兼职发布</b></h1>
    <hr>
    <form action="/index.php/Admin/Right/fabu" class="form-horizontal" method="post" role="form">
        <div class="form-group">
            <label  class="col-sm-2 control-label">标题</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="title" id="title" placeholder="标题" onfocus="cleartitlelabel()" onblur="checktitle()"><span><label id="errtitle"></label></span>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">工作内容</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="workInfo" id="workinfo" placeholder="工作内容" onfocus="clearworkinfolabel()" onblur="checkworkinfo()"><span><label id="errworkinfo"></label></span>
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
                <input type="text" name="address" id="workplace" class="form-control"  placeholder="工作地点" onfocus="clearworkplacelabel()" onblur="checkworkplace()"><span><label id="errworkplace"></label></span>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">工作要求</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="request" name="request" placeholder="工作要求" onfocus="clearrequestlabel()" onblur="checkrequest()"><span><label id="errrequest"></label></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">工资</label>
            <div class="col-lg-2">
                <div class="input-group">
                    <input type="text" class="form-control" name="salary" id="salary" placeholder="工资" onfocus="clearsalarylabel()" onblur="checksalary()"><span><label id="errsalary"></label></span>
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
                    <input type="text" name="num" class="form-control" id="count" placeholder="人数" onfocus="clearcountlabel()" onblur="checkcount()">
                    <span class="input-group-addon">人</span>
                </div>
				<div>
					<label id="errcount"></label>
				</div>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">联系人</label>
            <div class="col-sm-7">
                <input type="text" name="person" id="contact" class="form-control"  placeholder="联系人" onfocus="clearcontactlabel()" onblur="checkcontact()"><span><label id="errcontact"></label></span>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">联系电话</label>
            <div class="col-sm-7">
                <input type="text" name="phone" id="phone" class="form-control"  placeholder="联系电话" onfocus="clearnumberlabel()" onblur="checknumber()"><span><label id="errnumber"></label></span>
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