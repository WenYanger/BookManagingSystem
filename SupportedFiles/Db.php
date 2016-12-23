<?php
class Db{
	static private $_instance;
	static private $_connectSource;
	private $_dbConfig = array(
		'host' => '127.0.0.1',
		'user' => 'root',
		'password' => '',
		'database' => 'bookmanagingsystem'
	);
	private function __construct() {
	}
	static public function getInstance(){
		if(!self::$_instance instanceof self){
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function connect(){
		if(!self::$_connectSource){
			self::$_connectSource = new mysqli(
							$this->_dbConfig['host'],
							$this->_dbConfig['user'],
							$this->_dbConfig['password'],
							$this->_dbConfig['database']);
			if(!self::$_connectSource){
				die('mysql connect error'.mysqli_error(self::$_connectSource));
			}
		}
		//给数据库添加默认编码
		self::$_connectSource->query("SET NAMES 'UTF8'");
		return self::$_connectSource;
	}
}
?>

