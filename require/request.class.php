<?php
/**
*---------------------------------
* 作者：duhan
* 创建时间：2019/06/27
* 版本：v1
* 版权：浙江万事通科技有限公司
* 描述：江西上饶市政务服务中心——依赖——post请求
*----------------------------------
*/

class Request {
	/**
	* post请求接口 输出通信数据
	* @param string $url 接口地址
	* @param array $post_data 参数
	* return string
	*/
	public static function ddPost($url,$post_data) {
		$ch = curl_init();  
	    curl_setopt($ch, CURLOPT_POST, 1);  
	    curl_setopt($ch, CURLOPT_URL, $url);  
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
	        'Content-Type: application/json; charset=utf-8',  
	        'Content-Length: ' . strlen($post_data))  
	    );  
	    ob_start();
	    curl_exec($ch);
	    $data = ob_get_contents();
	    ob_end_clean();
	    $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    return $data;
	}
	/**
	* post请求接口 输出通信数据
	* @param string $url 接口地址
	* @param array $post_data 参数
	* return string
	*/
	public static function post($url='', $post_data = array()) {
		if (empty($url) || empty($post_data)) {
	        return false;
	    }
	    $o = "";
	    foreach ( $post_data as $k => $v ) { 
	        $o.= "$k=" . urlencode( $v ). "&" ;
	    }
	    $post_data = substr($o,0,-1);

	    $postUrl = $url;
	    $curlPost = $post_data;
	    $ch = curl_init(); // 初始化curl
	    curl_setopt($ch, CURLOPT_URL,$postUrl); // 抓取指定网页
	    curl_setopt($ch, CURLOPT_HEADER, 0); // 设置header
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 要求结果为字符串且输出到屏幕上
	    curl_setopt($ch, CURLOPT_POST, 1); // post提交方式
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
	    $data = curl_exec($ch); // 运行curl
	    curl_close($ch);
	    return $data;
	}
	/**
	* get请求方式 输出通信数据
	* @param string $url 地址
	* return string
	*/
	public static function get($url='') {
		$curl = curl_init(); // 启动一个CURL会话
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);  // 从证书中检查SSL加密算法是否存在
		$data = curl_exec($curl); // 返回api的json对象
		curl_close($curl);
	    return $data;
	}
}