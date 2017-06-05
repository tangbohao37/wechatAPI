<?php

namespace Home\Controller;
use Think\Controller;
//控制器
class UserController extends controller
{
    function register()
    {
        if (empty($_SESSION['userOpenId'])) { //如果没有用户oupenid则重新获取
            $code = $_GET['code'];
            $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . APPID . "&secret=" . APPSECRET . "&code=" . $code . "&grant_type=authorization_code";
            $res = $this->http_curl($url, 'get');
            $_SESSION['userOpenId'] = $res['openid'];
        }
        $student = M("studentinfo");
        $openid = $_SESSION['userOpenId'];
        $res = $student->where("openid='".$openid."'")->find();
        if($_GET["ischack"]!=1){
            if($res){
                $this->error("您已经完善过资料,继续填写将修改个人资料","/index.php/home/user/register/ischack/1",3);
            }
        }
        $this->display("register");  //http://www.wechat.com/index.php/home/user/login

//        $this->display('WorkInfo/showlist'); // 同级目录下访问
    }

    function http_curl($url,$type='get',$res='json',$arr=''){
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//跳过证书验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        if($type=='post'){
            curl_setopt($ch,CURLOPT_PORT,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
        }
        $output=curl_exec($ch);
        curl_close($ch);
        if($res=='json'){
            if(curl_errno($ch)){
                return curl_exec($ch); //请求失败返回错误信息
            }else{
                return json_decode($output,true);
            }
        }
    }

    function userRegister(){
        if(!empty($_POST)){
            $students=M(studentinfo);
            $data=($_POST);
            $data['uaddress']=implode(",",$data['uaddress']);
            $data['openid']=$_SESSION['userOpenId'];
//            dump($data);
            $res=$students->data($data)->add();
            if($res){
                $_SESSION['uid']=$res;
                redirect('/index.php/home/workinfo/worklist', 2, '注册成功，2秒后页面跳转，页面跳转中...');
            }else{
                redirect('/index.php/home/index/register', 2, '数据库写入失败，稍后再试...');
            }
        }
    }

    function getMyResume(){
        $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
        $postObj = simplexml_load_string( $postArr );
        $toUser   = $postObj->FromUserName;
        $fromUser = $postObj->ToUserName;
    }
    
    function history(){
        $this->display("history");
//        $this->display('WorkInfo/showlist'); // 同级目录下访问er/login
//        $this->display("register"); //访问其他控制器的模板
    }
}