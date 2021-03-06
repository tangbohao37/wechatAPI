<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>bootstrap.min.css">
<!--    <link rel="stylesheet" href="../Common/css/bootstrap.min.css" />-->
<!--    <link rel="stylesheet" href="../Common/css/pickout.css" />-->
<!--    <link rel="stylesheet" href="../Common/css/jquery.mobile.min.css" />-->
<!--    <link rel="stylesheet" href="../Common/css/theme.min.css" />-->
<!--    <script src="../Common/js/jquery.min.js"></script>-->
<!--    <script src="../Common/js/jquery.mobile.min.js"></script>-->
<!--    <script src="<?php echo (JS_URL); ?>jquery-1.11.1.min.js"></script>-->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <style>
        .textbox {
            background-color: transparent;
            color: #FFF;
            border: none;
            border-bottom: 3px solid #cccccc;
            letter-spacing: 1px;
        }
        
/*
         ::-webkit-input-placeholder {
            color: #8e8e8e !important;
            font-size: 20px;
            font-family: FangSong;
        }
*/
        
        body {
            background-color: #efefef;
            font-size: 10px;
            font-family: '宋体';
        }
        
        label {
            font-size: 20px;
        }
        
        .green {
            color: #515151;
        }
        
        .big {
            padding: 0 40px;
            padding-top: 10px;
            height: 45px;
            text-transform: uppercase;
            font: bold 20px/22px Arial, sans-serif;
        }
        
        .divtop {
            margin-top: 20px;
        }
        
        .divheight {
            width: 94%;
            margin: 0px auto 0px;
        }

    </style>
</head>

<body>
    <div data-role="header" data-id="myHeader" data-position="fixed" data-tap-toggle="false">
        <h2>基本信息</h2>
    </div>
    <div class="container text-center divheight">
        <form action="/index.php/Home/User/userRegister" class="form-horizontal" method="post" role="form">
            <div class="divtop">
                <input type="text" name="uname" class="form-control" placeholder="name">
                <input type="text" name="uschool" class="form-control" placeholder="school">
            </div>
            <div>
                <label class="text-muted" for="state">年龄:</label>
                <select name="uage" id="state" class="state pickout">
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
				</select>
            </div>
            <p></p>
            <div>
                <label class="text-muted radio-inline">
  <input type="radio" name="usex" id="inlineRadio2" value="男"><b>男</b></label>
                <label class="text-muted radio-inline">
  <input type="radio" name="usex" id="inlineRadio3" value="女"><b>女</b></label>
            </div>
            <hr>
            <h2 class="text-muted"><b>意向工作地点</b></h2>
            <label class="checkbox-inline">
                  <input type="checkbox" name="uaddress[]" value="渝中区"><b class="text-muted">渝中区</b></label>
            <label class="checkbox-inline">
                  <input type="checkbox" name="uaddress[]" value="大渡口区"><b class="text-muted">大渡口区</b></label>
            <label class="checkbox-inline">
                  <input type="checkbox" name="uaddress[]" value="江北区"><b class="text-muted">江北区</b></label>
            <label class="checkbox-inline">
                  <input type="checkbox" name="uaddress[]" value="沙坪坝区"><b class="text-muted">沙坪坝区</b></label>
            <label class="checkbox-inline">
                  <input type="checkbox"  name="uaddress[]" value="九龙坡区"><b class="text-muted">九龙坡区</b></label>
            <label class="checkbox-inline">
                  <input type="checkbox"  name="uaddress[]" value="南岸区"><b class="text-muted">南岸区</b></label>
            <label class="checkbox-inline">
                  <input type="checkbox" name="uaddress[]" value="渝北区"><b class="text-muted">渝北区</b></label>
            <label class="checkbox-inline">
                  <input type="checkbox" name="uaddress[]" value="巴南区"><b class="text-muted">巴南区</b></label>
            <label class="checkbox-inline">
                  <input type="checkbox" name="uaddress[]"  value="北碚区"><b class="text-muted">北碚区</b></label>
            <hr>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info btn-lg green"><b>SIGN IN</b></button>
                </div>
            </div>
        </form>
    </div>
    <!-- /container -->

</body>

<!--
<script src="../Common/js/bootstrap.min.js"></script>
<script src="../Common/js/pickout.js"></script>
-->
<script>
    // Preparar o select
    //pickout.to('.pickout');
    pickout.to({
        el: '.city',
        theme: 'dark',
        search: true
    });

    pickout.to({
        el: '.state',
        theme: 'clean',
    });
    // Caso o valor já venha do servidor, já atribui a seleção automaticamente
    pickout.updated('.city');
</script>

</html>