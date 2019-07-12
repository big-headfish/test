<?php
/**
*---------------------------------
* 作者：duhan
* 创建时间：2019/06/27
* 版本：v1
* 版权：浙江万事通科技有限公司
* 描述：江西上饶市政务服务中心——依赖——输出数据类6
*----------------------------------
*/

class Response {
	const JSON = "json";
	/**
	* 按综合方式输出通信数据
	* @param integer $code 状态码
	* @param string $message 提示信息
	* @param array $data 数据
	* @param string $type 数据类型
	* return string
	*/
	public static function show($code, $message = '', $data1 = array() ,$data2 = array(), $data3 = array() ,$data4 = array(), $data5 = array(), $data6 = array(), $type = self::JSON) {
		if(!is_numeric($code)) {
			return '';
		}

		$type = isset($_GET['format']) ? $_GET['format'] : self::JSON;

		$result = array(
			'code' => $code,
			'message' => $message,
			'data' => array(
				'type1' => $data1,
				'type2' => $data2,
				'type3' => $data3,
				'type4' => $data4,
				'type5' => $data5,
				'type6' => $data6,
			)
		);

		if($type == 'json') {
			self::json($code, $message, $data1, $data2, $data3, $data4, $data5, $data6);
			exit;
		} elseif($type == 'array') {
			var_dump($result);
		} elseif($type == 'xml') {
			self::xmlEncode($code, $message, $data);
			exit;
		} else {
			// TODO
		}
	}
	/**
	* 按json方式输出通信数据
	* @param integer $code 状态码
	* @param string $message 提示信息
	* @param array $data 数据
	* return string
	*/
	public static function json($code, $message = '',$data1 = array() ,$data2 = array(), $data3 = array() ,$data4 = array(), $data5 = array(), $data6 = array()) {
		
		if(!is_numeric($code)) {
			return '';
		}

		$result = array(
			'code' => $code,
			'message' => $message,
			'data' => array(
				'type1' => $data1,
				'type2' => $data2,
				'type3' => $data3,
				'type4' => $data4,
				'type5' => $data5,
				'type6' => $data6,
			)
		);

		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		exit;
	}

	/**
	* 按xml方式输出通信数据
	* @param integer $code 状态码
	* @param string $message 提示信息
	* @param array $data 数据
	* return string
	*/
	public static function xmlEncode($code, $message, $data = array()) {
		if(!is_numeric($code)) {
			return '';
		}

		$result = array(
			'code' => $code,
			'message' => $message,
			'data' => $data,
		);

		header("Content-Type:text/xml");
		$xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
		$xml .= "<root>\n";

		$xml .= self::xmlToEncode($result);

		$xml .= "</root>";
		echo $xml;
	}

	public static function xmlToEncode($data) {

		$xml = $attr = "";
		foreach($data as $key => $value) {
			if(is_numeric($key)) {
				$attr = " id='{$key}'";
				$key = "item";
			}
			$xml .= "<{$key}{$attr}>";
			$xml .= is_array($value) ? self::xmlToEncode($value) : $value;
			$xml .= "</{$key}>\n";
		}
		return $xml;
	}

}