<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<style>
    .nav li{
        cursor: pointer;
    }
    .navbar-fixed-left{
/*        position: fixed;*/
    }
</style>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-left navbar-collapse collapse">
        <ul class="nav nav-sidebar navbar-nav">
            <li><a onclick="link('index')" >兼职报名概况</a></li>
            <li><a onclick="link('table')">近期报名详细</a></li>
            <li><a onclick="link('employed')">确认录用人员</a></li>
            <li><a onclick="link('grade')">兼职人员评分</a></li>
            <li><a onclick="link('issue')">兼职信息发布</a></li>
            <li><a onclick="link('')">历史发布记录</a></li>
            <li><a onclick="link('')">历史录用人员</a></li>
            <li><a onclick="link('conpany')">公司信息修改</a></li>
        </ul>
    </nav>
</body>

</html>