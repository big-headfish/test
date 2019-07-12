<?php 
/**
*----------------------------------
* 作者：duhan
* 创建时间：2019/07/02
* 版本：v1
* 版权：浙江万事通科技有限公司
* 描述：江西上饶市政务服务中心——依赖——创建日志文件
*----------------------------------
*/

date_default_timezone_set('PRC');  // 设置时区
/**
 * 生成日志
 * @param string $logRouto:日志路径
 * @param string $msg:内容 
 * @param string $logSort:日志分类 
 * @param string $logType:日志类型
 */
function creLog($logRouto,$msg,$logSort,$logType) {
	$curDate = date("Y-m-d"); // 获取当前日期
	$curDateTime = date("Y-m-d H:i:s"); // 获取当前时间
	$fileRoute = "D:/Xampp/htdocs/".$logRouto."/log/".$logSort."/".$logType."/";
	$fileName = $fileRoute.$curDate.".log"; // 日志文件名称
	$msgs = $msg." ".$curDateTime."\r\n"; // 日志内容
	file_put_contents($fileName,$msgs,FILE_APPEND);//记录日志
}
 ?>