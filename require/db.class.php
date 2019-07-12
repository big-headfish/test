<?php 
/**
*---------------------------------
* 作者：duhan
* 创建时间：2019/06/27
* 版本：v1
* 版权：浙江万事通科技有限公司
* 描述：江西上饶市政务服务中心——依赖——连接mysql类
*----------------------------------
*/

class Db {
	static private $_instance;
	static private $_connectSource;
	private $_dbConfig = array(
		'host' => 'localhost',
		'user' => 'root',
		'password' => '',
		'database' => 'sr_queuedb'
	);
	static public function getInstance() {
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function connect() {
		if(!self::$_connectSource) {
			self::$_connectSource = @mysql_connect($this->_dbConfig['host'], $this->_dbConfig['user'], $this->_dbConfig['password']);
			if(!self::$_connectSource) {
				throw new Exception('mysql connect error ' . mysql_error());
				die('mysql connect error' . mysql_error());
			}
			mysql_select_db($this->_dbConfig['database'], self::$_connectSource);
			mysql_query("set names UTF8", self::$_connectSource);
		}
		return self::$_connectSource;
	}
}
?>