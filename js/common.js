//判断是cookie否有值，若有则替换HTML并返回ture 并执行GetDetail（）获取用户详细信息 ，若没有则返回fals
function isLogin() {
    if ($.cookie('userID') == null) {
        return false;
    }
    else {
        var userName = $.cookie('userID');
        if (userName.charAt(0)=='a') {
            $('#txtLogin').html("<a href='Admin.aspx'><span class='glyphicon glyphicon-cog'></span>" + "管理员：" + $.cookie('userID') + "</a>");
            $('#txtReg').html("<a href='#'><span class='glyphicon glyphicon-off' id='exitLogin'>退出登录</span></a>");
            GetDetail();
            return true;
        }
        else if(userName.charAt(0)=='s') {
            $('#txtLogin').html("<a href='sMyCourse.html'><span class='glyphicon glyphicon-cog'></span>" + "欢迎：" + $.cookie('userID') + "</a>");
            $('#txtReg').html("<a href='#'><span class='glyphicon glyphicon-off' id='exitLogin'>退出登录</span></a>");
            GetDetail();
            return true;
        }
        else {
            $('#txtLogin').html("<a href='tMyCourse.html'><span class='glyphicon glyphicon-cog'></span>" + "欢迎：" + $.cookie('userID') + "</a>");
            $('#txtReg').html("<a href='#'><span class='glyphicon glyphicon-off'>退出登录</span></a>");
            GetDetail();
            return true;
        }
    }
}

//ajax传递用户名和密码到服务端判断，若密码正确则替换HTML，若不正确这返回错误信息
function Login(ID, PWD, AutoLogin) {
    $.post("Login.ashx", { 'id': ID, 'pwd': PWD, 'autologin': AutoLogin }, function (data) {
        var serverData = data.split(':');
        if (serverData[0] == "yes") {
            $('#Login').modal('hide');
            if (ID.charAt(0) == 'a') {
                $('#txtLogin').html("<a href='Admin.aspx'><span class='glyphicon glyphicon-cog'></span>" + "管理员：" + ID + "</a>");
                $('#txtReg').html("<a href='#'><span class='glyphicon glyphicon-off' id='exitLogin'>退出登录</span></a>");            }
            else if(ID.charAt(0)=='s') {
                $('#txtLogin').html('<a href="sMyCourse.html"><span class="glyphicon glyphicon-cog"></span>欢迎：' + ID + '</a>');//点击进入个人信息设置页
                $('#txtReg').html('<a href="#"><span class="glyphicon glyphicon-off" id="exitLogin">退出登录</span> </a>'); //推出登陆，删除session
            }
            else {
                $('#txtLogin').html('<a href="tMyCourse.html"><span class="glyphicon glyphicon-cog"></span>欢迎：' + ID + '</a>');//点击进入个人信息设置页
                $('#txtReg').html('<a href="#"><span class="glyphicon glyphicon-off " id="exitLogin">退出登录</span></a>'); //推出登陆，删除session
            }
            if (AutoLogin > 0) {
                $.cookie('userID', ID);
                $.cookie('userPwd', PWD);
            }
            window.location.href = "../index.html";
            return true;
        }
        else {
            $('#msg').text(serverData[1]);
            return false;
        }
    });
}

//exit 删除cookie
function delCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if (cval != null)
        document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}

//根据cookie查看用户基本信息
function GetDetail() {
    var ID = $.cookie('userID');
    var UserType = null;
    var UserName = null;
    var UserClass = null;
    if (ID.charAt(0) == 'a') {
        UserType = "管理员";
        $('#UserName').html(UserType);
        $('#info').hide();
    }
    else if (ID.charAt(0)=='t') {
        UserType = "教师";
        $('#UserType').html(UserType);
        $.post("GetDetail.ashx", { 'id': ID }, function (data) {
            var serverdata = $.parseJSON(data);
            UserName = serverdata.tName;
            UserClass = serverdata.tIntro;
            $('#UserName').html(UserName);
            $('#UserClass').html(UserClass);
        });
    }
    else if (ID.charAt(0) == 's') {
        UserType = "学生";
        $('#UserType').html(UserType);
        $.post("GetDetail.ashx", { 'id': ID }, function (data) {
            var serverdata = $.parseJSON(data);
            UserName = serverdata.sName;
            UserClass = serverdata.sCollege+"学院"+serverdata.sMajor+"专业"+serverdata.sClass+"班级";
            $('#UserName').html(UserName);
            $('#UserClass').html(UserClass);
        });
    }
}

///传输用户ID到后台获取 此ID已经选择的课程并替换HTML 显示在网页上
function LoadMyCourse(ID) {
    if (ID.charAt(0) == 's') {
        $.post("LoadMyCourse.ashx", { 'id': ID }, function (data) {
            var serverdata = $.parseJSON(data);
            var serverdatalength = serverdata.length;
            for (var i = 0; i < serverdatalength; i++) {
                $("<tr><td>" + i + "</td><td><a href='javascript:void(0)'class='CourseDetail' cID='" + serverdata[i].CourseID + "' >" + serverdata[i].CourseName + "</a></td><td>" + serverdata[i].TeacherName + "</td><td>" + serverdata[i].Year + "</td><td><a href='javascript:void(0)' class='ExitCourse' cID='" + serverdata[i].CourseID + "' userID='" + ID + "' >退选此课程</a></td></tr>").appendTo("#myCarouse");
            }
            GotoCourseDetail();
            ExitCourse();
        });
    }
    else {
        $.post("LoadMyCourse.ashx", { 'id': ID }, function (data) {
            var serverdata = $.parseJSON(data);
            var serverdatalength = serverdata.length;
            for (var i = 0; i < serverdatalength; i++) {
                $("<tr><td>" + i + "</td><td><a href='javascript:void(0)'class='CourseDetail' cID='" + serverdata[i].CourseID + "' >" + serverdata[i].CourseName + "</a></td><td>" + serverdata[i].TeacherName + "</td><td>" + serverdata[i].Year + "</td><td><a href='javascript:void(0)' class='CourseSelecterDetail' tID='"+serverdata[i].tID+"' cID='" + serverdata[i].CourseID + "' tID='"+serverdata[i].tID+" Year='"+serverdata[i].Year+"' ' cID='" + ID + "' >选课情况</a></td></tr>").appendTo("#myCarouse");
            }
            GotoCourseDetail();
            GoToCourseSelecterDetail();
        });
    }
}

//根据课程ID  进入tb_CourseSelecter和CoursePlan 查看选课情况，
function GoToCourseSelecterDetail() {
    $('.CourseSelecterDetail').click(function () {
        var cID = $(this).attr('cID');
        var tID = $(this).attr('tID');
        window.open("CourseSelecterDetail.html?&cID=" + cID + "&tID=" + tID);
    });
}

/// 获取URL的 tID cID值 获取该课程选择情况
function GetCourseSelecterDetail()
{
    GetUrlParams();
    var cID= GetParamValue("cID");
    var tID=GetParamValue("tID");
    $.post("GetCourseSelecterDetail.ashx", { 'cID': cID, 'tID': tID },function(data){
        var serverdata = $.parseJSON(data);
        var serverdatalength = serverdata.length;
        for(var i=0;i<serverdatalength;i++){
            $("<tr><td>" + i + "</td><td>" + serverdata[i].CourseName + "</td><td>" + serverdata[i].StudentName + "</td><td>" + serverdata[i].StudentCollege + "</td><td>" + serverdata[i].StudentMajor + "</td><td>" + serverdata[i].StudentClass + "</td><td><input type='text' name='Score' sID='"+serverdata[i].sID+"' /></td></tr>").appendTo("#StudentDetail");
            $('#CourseSelecterCount').html(i);
        }
    });
}

// 根据 URL的 cID 获取该课程 人数上限
function GetCourseSelecterCount() {
    GetUrlParams();
    var cID = GetParamValue("cID");
    $.post("GetCourseSelecterCount.ashx", { 'cID': cID }, function (data) {
        var serverdata = data;
        $('#CourseCount').html(serverdata);
    });
}

//退选课程 根据课程ID 用户ID 删除
function ExitCourse() {
    $('.ExitCourse').click(function () {
        var UserID = $(this).attr('userID');
        var cID = $(this).attr('cID');
        if(confirm("确定退选么")){
            $.post("ExitCourse.ashx", { 'cid': cID, 'UserID': UserID }, function (data) {
                if (serverData[0] == "yes") {
                    alert(serverData[1]);
                    UserType();
                }
                else {
                    alert(serverData[0]);
                }
            });
        }
        else{
            
        }
    });
}

//通过课程ID 在后台获取该课程 详细信息 并显示在网页中
function GetCourseDetail(id){
    $.post("GetCourseDetail.ashx", { 'cID': id }, function (data) {
        var serverdata=$.parseJSON(data);
        var tName=serverdata.TeacherName;
        var stuGrade=serverdata.Grade;
        var College=serverdata.College;
        var stuMajor=serverdata.Major;
        var cTime=serverdata.CourseTime;
        var cPlace=serverdata.Place;
        var cIntro=serverdata.Intro;
        var CourseName=serverdata.CourseName;
        $("#CourseName").html(CourseName);
        $("#stuCollege").html(College);
        $("#stuMajor").html (stuMajor);
        $("#stuGrade").html(stuGrade);
        $("#TeacherName").html(tName);
        $("#cTime").html(cTime);
        $("#CourseIntro").html(cIntro);
    });
}

//跳转到课程详细页
function GotoCourseDetail() {
    $('.CourseDetail').click(function(){
        var cID = $(this).attr("cID");
        window.location.href = "courseDetail.html?cID="+cID;
        });
    }

///传输ID到后台获取 此ID 即将开设课程并替换HTML 显示在网页上
function LoadMyPlanCourse(ID, plan) {
    $.post("LoadMyCourse.ashx", { 'id': ID, 'type': plan }, function (data) {
        var serverdata = $.parseJSON(data);
        var serverdatalength = serverdata.length;
        for (var i = 0; i < serverdatalength; i++) {
            $("<tr><td><a href='javascript:void(0)'class='CourseDetail' cID='" + serverdata[i].CourseID + "' >" + serverdata[i].CourseName + "</a></td><td>" + serverdata[i].TeacherName + "</td><td>" + serverdata[i].Years + "</td><td>" + serverdata[i].cTime + "</td></tr>").appendTo("#myPlan");
        }
        GotoCourseDetail();
    });
}

//根据学生ID 查询此学生的课程成绩 并替换HTML显示在网页上
function LoadMyScore(ID) {
    $.post("LoadMyScore.ashx", { 'id': ID }, function (data) {
        var serverdata = $.parseJSON(data);
        var serverdatalength = serverdata.length;
        for (var i = 0; i < serverdatalength; i++) {
            $("<tr><td>" + serverdata[i].Years + "</td><td>" + serverdata[i].CourseName + "</td><td>" + serverdata[i].TeacherName + "</td><td>" + serverdata[i].sScore + "</td></tr>").appendTo("#myScore");
        }
    });
}

//根据ID判断 用户类型   跳转到 MyCourse页面
function UserType() {
    var ID = $.cookie('userID');
    if (ID==null) {
        alert("请先登录");
    }
    if (ID.charAt(0) == 't') {
        window.location.href = "tMyCourse.html"
    }
    else if (ID.charAt(0) == 's') {
        window.location.href = "sMyCourse.html"
    }
}

//获取地址栏的参数数组
function GetUrlParams(){
    var url=window.location.search;
    var temparray=url.substr(1,url.length).split("&");
    var paramsArry=new Array;
    if(temparray!=null){
        for(var i=0;i<temparray.length;i++){
            var reg=/[=|==]/; //正则表达式 用=拆分，
            var set=temparray[i].replace(reg,'&');
            var tmpstr=set.split('&');
            var array=new Array;
            array[tmpstr[0]]=tmpstr[1];
            paramsArry.push(array);
        }
    }
    return paramsArry;
}

//根据参数名称 获取参数值
function GetParamValue(name){
    var paramsArray=GetUrlParams();
    if(paramsArray!=null){
        for(var i=0;i<paramsArray.length;i++){
            for(var j in paramsArray[i]){
                if(j==name){
                    return paramsArray[i][j];
                }
            }
        }
    }
    return null;
}

//点击按钮 学习此课程  传课程ID
function LearnThisCourse(id) {
    var UserID = $.cookie('userID');
    $.post("LearnThisCourse.ashx", { 'cID': id ,'UserID':UserID}, function (data) {
        var serverData = data.split(':');
        if (serverData[0] == "yes") {
            alert(serverData[1]);
        }
        else {
            alert(serverData[0]);
        }
    });
}
