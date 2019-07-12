<?php 
/**
*---------------------------------
* 作者：duhan
* 创建时间：2019/07/02
* 版本：v1
* 版权：浙江万事通科技有限公司
* 描述：江西上饶市政务服务中心——依赖——发送短信
*----------------------------------
*/
class Sms{
	public function sendTicketSMS($tel,$QNO,$FLOOR_TIP,$WAIT,$WINDOW_NAME){
		require_once('request.class.php');
		$msg = "【上饶市政务服务中心】尊敬的客户,您的排队号为".$QNO.",前面还有".$WAIT."人等待，请前往".$FLOOR_TIP."等候，办理窗口为".$WINDOW_NAME.",请您留意手机短信、现场屏幕提醒以免过号!";
		$url = "http://39.108.85.117:6068/sms.aspx?action=send&userid=48&account=上饶行政服务中心&password=123456&mobile=$tel&content=".$msg."&sendTime=&taskName=本次任务描述&checkcontent=1&mobilenumber=10&countnumber=12&telephonenumber=2";
		$xml = Request::get($url); // 发起get请求
		$objectxml = simplexml_load_string($xml); // 将文件转换成 对象
		$xmljson = json_encode($objectxml ); // 将对象转换个JSON
		$xmlarray = json_decode($xmljson,true); // 将json转换成数组
		$apiCode = $xmlarray["message"];
		return $apiCode;
	}
}
 ?>