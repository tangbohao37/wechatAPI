<?php
header("content-type:text/html;charset=utf-8");

define('APP_DEBUG',true);  //调试模式
define('CSS_URL','/Home/View/Common/css/');
define('ADMIN_CSS_URL','/Admin/View/Common/css/');
define('IMG_URL','/Home/View/Common/img/');
define('ADMIN_IMG_URL','/Admin/View/Common/img/');
define('JS_URL','/Home/View/Common/js/');
define('ADMIN_JS_URL','/Admin/View/Common/js/');
define("TOKEN", 'weixin');
define("APPID",'wxb15b4d1904bc58e8');
define("APPSECRET","cd18265f9529b9ee472f10ee2dcb3627");
//define('TEST_CSS_URL','/home/view/test/css');
//define('TEST_JS_URL','/home/view/test/js');
//define('TEST_IMG_URL','/home/view/test/img');
include ('../ThinkPHP/ThinkPHP.php');
