<?php 
/**
*---------------------------------
* 作者：duhan
* 创建时间：2019/06/27
* 版本：v1
* 版权：浙江万事通科技有限公司
* 描述：江西上饶市政务服务中心——依赖——api访问记录
*----------------------------------
*/
class Api {
	public function apiRecord($userID,$apiName){
		require_once('db.class.php');
		date_default_timezone_set('PRC');  // 设置时区
		$curTime = date('Y-m-d H:i:s'); // 获取当前日期
		$sql = "insert into sr_platformconfig.api_record_info (`userID`,`apiName`,`creTime`) VALUES ('".$userID."','".$apiName."','".$curTime."') ";
		try {
		    $connect = Db::getInstance()->connect();
		}catch(Exception $e) {
		    return Response::show(403, "数据库链接失败");
		}
		mysql_query($sql, $connect);
	}
}
?>