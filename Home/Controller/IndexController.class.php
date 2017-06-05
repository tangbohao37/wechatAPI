<?php

namespace Home\Controller;
use Think\Controller;
//控制器
class IndexController extends controller{
    
    function index()
    {
		//获得参数 signature nonce token timestamp echostr
		$nonce     = $_GET['nonce'];
		$token     = TOKEN;
		$timestamp = $_GET['timestamp'];
		$echostr   = $_GET['echostr'];
		$signature = $_GET['signature'];
		//形成数组，然后按字典序排序
		$array = array();
		$array = array($nonce, $timestamp, $token);
		sort($array);
		//拼接成字符串,sha1加密 ，然后与signature进行校验
		$str = sha1( implode( $array ));
		if( $str  == $signature && $echostr ){
			//第一次接入weixin api接口的时候    第二次接入时没有echostr
			echo  $echostr;
			exit;
		}else{
			$this->reponseMsg();
		}
	}
    
    function checkSignature() //暂时无用
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        $signature = $_GET["signature"]; // 微信加密签名
        $timestamp = $_GET["timestamp"]; // 时间戳
        $nonce = $_GET["nonce"]; // 随机数
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr ); //  数组转为字符串
		$tmpStr = sha1( $tmpStr ); // 哈希加密
		if( $tmpStr == $signature ){ //和加密签名 比对；
			return true;
		}else{
			return false;
		}
	}
    
    function reponseMsg()
    {
		//1.获取到微信推送过来post数据（xml格式）
		$postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
		//2.处理消息类型，并设置回复类型和内容
		/*<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[FromUser]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[subscribe]]></Event>
</xml>*/
		$postObj = simplexml_load_string( $postArr );
		//$postObj->ToUserName = '';
		//$postObj->FromUserName = '';
		//$postObj->CreateTime = '';
		//$postObj->MsgType = '';
		//$postObj->Event = '';
		//判断该数据包是否是订阅的事件推送
		$toUser   = $postObj->FromUserName;
        $fromUser = $postObj->ToUserName;
		if( strtolower( $postObj->MsgType) == 'event'){
			//如果是关注 subscribe 事件
			if( strtolower($postObj->Event == 'subscribe') ){
				//回复用户消息(纯文本格式)	
				$time     = time();
				$msgType  =  'text';
				$content  = '欢迎关唐博豪的微信公众账号，您openID：'.$postObj->FromUserName.'-该该公众号的openID'.$postObj->ToUserName;
				$template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
				$info     = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
				echo $info;
			}
		}
		//用户发送tuwen2关键字的时候，回复一个单图文
		if( strtolower($postObj->MsgType) == 'text' && trim($postObj->Content)=='tuwen' ){
			$arr = array(
				array(
					'title'=>'baidu',
					'description'=>"测试文字",
					'picUrl'=>'https://www.baidu.com/img/bdlogo.png',
					'url'=>'http://www.baidu.com',
				),
				array(
					'title'=>'百度',
					'description'=>"百度大法好",
					'picUrl'=>'https://www.baidu.com/img/bdlogo.png',
					'url'=>'http://www.baidu.com',
				),
				array(
					'title'=>'百度大法好',
					'description'=>"百度大法好",
					'picUrl'=>'https://www.baidu.com/img/bdlogo.png',
					'url'=>'http://www.baidu.com',
				),
			);
			$template = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<ArticleCount>".count($arr)."</ArticleCount>    
						<Articles>";
			foreach($arr as $k=>$v){ //将ARR 拼接到模板中 template
				$template .="<item>
							<Title><![CDATA[".$v['title']."]]></Title> 
							<Description><![CDATA[".$v['description']."]]></Description>
							<PicUrl><![CDATA[".$v['picUrl']."]]></PicUrl>
							<Url><![CDATA[".$v['url']."]]></Url>
							</item>";
			}
			$template .="</Articles>
						</xml> ";
			echo sprintf($template, $toUser, $fromUser, time(), 'news');
			//注意：进行多图文发送时，子图文个数不能超过10个
		}else if(strtolower($postObj->MsgType) == 'text' && trim($postObj->Content)=='兼职'){
            //回复用户消息(纯文本格式)
            $time     = time();
            $msgType  =  'text';
            $openid=$toUser;

            $uid=M("studentinfo")->where("openid='".$openid."'")->getField('uid');
            $wid=M("resume")->field("wid")->where("uid=$uid")->select();
//            dump($wid);
            $data=array();
            foreach($wid as $key=>$value){
                foreach($value as $k=>$v){
                    $data[]=$v;
                }
            }
            $data2['id']=array("IN",$data);
            $workinfo=M("issue")->where($data2)->select();
            $workinfo[0]['title'];
            $content  = "您已报名兼职：\r\n ";
            foreach($workinfo as $key=>$value){
                $content=$content.$value['title']."-->".$value['workinfo']."\r\n";
            }
            $template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
            $info     = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
            echo $info;
		}
	}//reponseMsg end

	function getWxAccessToken(){
        if($_SESSION['access_token']&&$_SESSION['expire_time']>time()){
            //如果access_token 没有过期；
            return $_SESSION['access_token'];
        }else{  //过期则重新请求；
            //1.请求url地址
            $appid = 'wxb15b4d1904bc58e8';
            $appsecret =  'cd18265f9529b9ee472f10ee2dcb3627';
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret."";
            //2初始化
            $ch = curl_init();
            //3.设置参数
            curl_setopt($ch , CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//跳过证书验证
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
            curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
            //4.调用接口
            $res = curl_exec($ch);
            //5.关闭curl
            curl_close( $ch );
            if( curl_errno($ch) ){
                var_dump( curl_error($ch) );
            }
            $arr = json_decode($res, true);
            $_SESSION['access_token']=$arr['access_token'];
            $_SESSION['expire_time']=time()+7000;
            return $arr['access_token'];
        }
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

    function definedItem(){
        $access_token=$this->getWxAccessToken();
        var_dump($access_token);
        header('content-type:text/html;charset=utf-8');
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $postArr=array(
            'button'=>array(
                array(
                    'name'=>urlencode('兼职'),
                    'sub_button'=>array(
                        array(
                            'name'=>urlencode('找兼职'),
                            'type'=>'view',
                            'url'=>"https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APPID."&redirect_uri=".urlencode("http://tangbohao.xicp.net/index.php/home/workinfo/worklist")."&response_type=code&scope=snsapi_base&state=123#wechat_redirect",
                        ),
                        array(
                            'name'=>urlencode('报名的兼职'),
                            'type'=>'view',
                            'url'=>"https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APPID."&redirect_uri=".urlencode("http://tangbohao.xicp.net/index.php/home/workinfo/worklist")."&response_type=code&scope=snsapi_base&state=123#wechat_redirect",
                        ),
                    ),
                ),
                array(
                    'name'=>urlencode('个人'),
                    'sub_button'=>array(
                        array(
                            'name'=>urlencode('个人信息'),
                            'type'=>'view',
                            'url'=>"https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APPID."&redirect_uri=".urlencode("http://tangbohao.xicp.net/index.php/home/user/register")."&response_type=code&scope=snsapi_base&state=123#wechat_redirect",
                        ),
                        array(
                            'name'=>urlencode('工作历史'),
                            'type'=>'click',
                            'key'=>'history',
                        ),
                    ),
                ),
            ),
        );
        echo "<hr/>";
        $postJson=json_encode($postArr);
        echo urldecode($postJson);
//        $res=$this->http_curl($url,'post','json',$postJson);
//        var_dump($res);
    }

	function getWxServerIp(){
		$accessToken = "6vOlKOh7r5uWk_ZPCl3DS36NEK93VIH9Q9tacreuxJ5WzcVc235w_9zONy75NoO11gC9P0o4FBVxwvDiEtsdX6ZRFR0Lfs_ymkb8Bf6kRfo";
		$url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$accessToken;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$res = curl_exec($ch);
		curl_close($ch);
		if(curl_errno($ch)){
			var_dump(curl_error($ch));
		}
		$arr = json_decode($res,true);
		echo "<pre>";
		var_dump( $arr );
		echo "</pre>";
	}

    function getUserOpenId(){
        $code=$_GET['code'];
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSECRET."&code=".$code."&grant_type=authorization_code";
        $res=$this->http_curl($url,'get');
        var_dump($res);
    }

    function test(){
        $openid="oMpc_xDBkUN7pzj48PE16YBaWhKY";
        $uid=M("studentinfo")->where("openid='".$openid."'")->getField('uid');
        $wid=M("resume")->field("wid")->where("uid=$uid")->select();
        $data=array();
        foreach($wid as $key=>$value){
            foreach($value as $k=>$v){
                $data[]=$v;
            }
        }
        $data2['id']=array("IN",$data);;
        $workinfo=M("issue")->where($data2)->select();
        dump($workinfo);
        foreach($workinfo as $key=>$value){
            dump($value["title"]);
        }

    }

    function getBaseInfo(){
        //1、获取到code
        //2、获取网页授权access_token
        //3、获得用户openid
        $redirect_uri=urlencode("http://tangbohao.xicp.net/index.php/home/user/register");
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APPID."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=123#wechat_redirect";
        header("location:".$url);
    }

}
