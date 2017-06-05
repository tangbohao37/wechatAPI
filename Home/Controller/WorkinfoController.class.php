<?php

namespace Home\Controller;
use Think\Controller;

class WorkinfoController extends Controller{
    function workinfo(){
        if(!empty($_GET)){
            $wid= $_GET["wid"];
            $issue=M(issue);
            $work=$issue->where("id=$wid")->find();
            $companyinfo=M(companyinfo)->where("cid=$work[cid]")->find();
//            dump($companyinfo);
//            dump($work);
            $this->assign("work",$work);
            $this->assign("company",$companyinfo);
        }
        $this->display("workinfo"); //http://www.wechat.com/index.php/home/workinfo/test
    }

    function worklist(){
        if(empty($_SESSION['userOpenId'])){ //如果没有用户oupenid则重新获取
            $code=$_GET['code'];
            $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSECRET."&code=".$code."&grant_type=authorization_code";
            $res=$this->http_curl($url,'get');
//            var_dump($res);
            $_SESSION['userOpenId']=$res['openid'];
            $openid=$_SESSION['userOpenId'];
            $student=M("studentinfo")->where("openid=$openid")->find();
            $_SESSION['uid']=$student['uid'];
//            var_dump($res['openid']);
        }
//        var_dump($_SESSION['userOpenId']);
        $issue=M(issue);
        $a=$issue->select(); // 获取公司id 对应的 工作id
//        dump($a);
        $this->assign("worklist",$a);
        $this->display("worklist");
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

    function workSubmit(){
        if(!empty($_POST)){
            $wid=$_POST["wid"];
            $resume=M(resume);
            $studentinfo=M(studentinfo);
            if(empty($_SESSION['userOpenId'])){
                $this->error("没有获取到个人信息,请稍后再试");
                return 0;
            }else{
                $student=$studentinfo->where("openid='".$_SESSION['userOpenId']."'")->find();
                $uid=$student['uid'];
                if($student==null){
                    $this->error("请先补充个人信息","https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APPID."&redirect_uri=".urlencode("http://tangbohao.xicp.net/index.php/home/user/register")."&response_type=code&scope=snsapi_base&state=123#wechat_redirect",2);
                }
                $res=$resume->where("wid=$wid and uid=$uid")->find();
                if(!empty($res)){
                    $this->error("您已经报名该兼职","/index.php/home/workinfo/worklist",2);
                }else{
                    $data=array(
                        "umsg"=>$_POST["umsg"],
                        "uname"=>$student['uname'],
                        "uid"=>$student['uid'],
                        "wid"=>$wid,
                    );
                    $res=$resume->add($data);
                    if($res){
                        $this->success("报名成功,两秒后自动跳转","/index.php/home/workinfo/worklist",2);
                    }else{
                        $this->error("数据库写入失败，稍后再试","/index.php/home/workinfo/worklist",2);
                    }
                }
            }
        }
    } //兼职报名
}