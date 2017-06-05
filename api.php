<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();  //验证功能
$wechatObj->responseMsg();  //自动回复功能

class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];
        //valid signature , option
        if($this->checkSignature()){//用户数字签名 验证
        	echo $echoStr;
        	exit;
        }
		echo $echoStr;
    }

//    public function responseMsg()   /// 自动回复功能
//    {
//		//get post data, May be due to the different environments
//		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"]; // 接受用户端的 XML 数据
//      	//extract post data
//		if (!empty($postStr)){
//                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
//                   the best way is to check the validity of xml by yourself */
//                libxml_disable_entity_loader(true);
//              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
//			//解析xml
//                $fromUsername = $postObj->FromUserName; //手机端
//                $toUsername = $postObj->ToUserName; /// 微信公众平台
//                $keyword = trim($postObj->Content); // 接受用户发送的 关键词
//                $time = time(); // 时间戳
//				$msgType = $postObj->MsgType;
//			// 文本返回模板
//                $textTpl = "<xml>
//							<ToUserName><![CDATA[%s]]></ToUserName>
//							<FromUserName><![CDATA[%s]]></FromUserName>
//							<CreateTime>%s</CreateTime>
//							<MsgType><![CDATA[%s]]></MsgType>
//							<Content><![CDATA[%s]]></Content>
//							<FuncFlag>0</FuncFlag>
//							</xml>";
//				if(!empty($keyword))
//                {
//					$msgType="text";
//					// 返回类型
//                	$contentStr = "文本";
//					//格式化 字符串
//                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
//                	echo $resultStr;
//                }else{
//                	echo "Input something...";
//                }
//        }else {
//        	echo "post为空";
//        	exit;
//        }
//    }
    
    public function reponseMsg(){
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
		// gh_e79a177814ed
		//判断该数据包是否是订阅的事件推送
		if( strtolower( $postObj->MsgType) == 'event'){
			//如果是关注 subscribe 事件
			if( strtolower($postObj->Event == 'subscribe') ){
				//回复用户消息(纯文本格式)	
				$toUser   = $postObj->FromUserName;
				$fromUser = $postObj->ToUserName;
				$time     = time();
				$msgType  =  'text';
				$content  = '欢迎关注我们的微信公众账号'.$postObj->FromUserName.'-'.$postObj->ToUserName;
				$template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
				$info     = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
				echo $info;
/*<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[你好]]></Content>
</xml>*/
			

			}
		}

		//当微信用户发送imooc，公众账号回复‘imooc is very good'
		/*<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[你好]]></Content>
</xml>*/
		/*if(strtolower($postObj->MsgType) == 'text'){
			switch( trim($postObj->Content) ){
				case 1:
					$content = '您输入的数字是1';
				break;
				case 2:
					$content = '您输入的数字是2';
				break;
				case 3:
					$content = '您输入的数字是3';
				break;
				case 4:
					$content = "<a href='http://www.imooc.com'>慕课</a>";
				break;
				case '英文':
					$content = 'imooc is ok';
				break;

			}	
				$template = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
//注意模板中的中括号 不能少 也不能多
				$fromUser = $postObj->ToUserName;
				$toUser   = $postObj->FromUserName; 
				$time     = time();
				// $content  = '18723180099';
				$msgType  = 'text';
				echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
			
		}
	}
*/
		//用户发送tuwen1关键字的时候，回复一个单图文
		if( strtolower($postObj->MsgType) == 'text' && trim($postObj->Content)=='tuwen2' ){
			$toUser = $postObj->FromUserName;
			$fromUser = $postObj->ToUserName;
			$arr = array(
				array(
					'title'=>'imooc',
					'description'=>"imooc is very cool",
					'picUrl'=>'http://www.imooc.com/static/img/common/logo.png',
					'url'=>'http://www.imooc.com',
				),
				array(
					'title'=>'hao123',
					'description'=>"hao123 is very cool",
					'picUrl'=>'https://www.baidu.com/img/bdlogo.png',
					'url'=>'http://www.hao123.com',
				),
				array(
					'title'=>'qq',
					'description'=>"qq is very cool",
					'picUrl'=>'http://www.imooc.com/static/img/common/logo.png',
					'url'=>'http://www.qq.com',
				),
			);
			$template = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<ArticleCount>".count($arr)."</ArticleCount>
						<Articles>";
			foreach($arr as $k=>$v){
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
		}else{
			switch( trim($postObj->Content) ){
				case 1:
					$content = '您输入的数字是1';
				break;
				case 2:
					$content = '您输入的数字是2';
				break;
				case 3:
					$content = '您输入的数字是3';
				break;
				case 4:
					$content = "<a href='http://www.imooc.com'>慕课</a>";
				break;
				case '英文':
					$content = 'imooc is ok';
				break;
			}	
				$template = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
//注意模板中的中括号 不能少 也不能多
				$fromUser = $postObj->ToUserName;
				$toUser   = $postObj->FromUserName; 
				$time     = time();
				// $content  = '18723180099';
				$msgType  = 'text';
				echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
			
		}//if end
	}//reponseMsg end
		
	private function checkSignature()
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
}

?>