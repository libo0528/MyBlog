<?php
namespace Core;
	class MyPDO{
		private $type;
		private $host;
		private $user;
		private $psw;
		private $dbname;
		private $charset;
		private $port;
		private $pdo;
		private static $instance;
		private function __construct($param){
			$this->initparam($param);
			$this->initPDO();
			$this->initExecption();
		}
		private function __clone(){
		}
		public static function getinstance($param=array()){
			if(!self::$instance instanceof self)
				self::$instance=new self($param);
			return self::$instance;
		}
		//1、初始化参数
		private function initparam($param){
			$this->type=$param['type']??'mysql';
			$this->host=$param['host']??'127.0.0.1';
			$this->user=$param['user']??'root';
			$this->psw=$param['psw']??'root';
			$this->dbname=$param['dbname']??'mvc';
			$this->charset=$param['charset']??'utf8';
			$this->port=$param['port']??3306;
		}
		//2、初始化PDO
		private function initPDO(){
			try {
				$dsn="{$this->type}:host={$this->host};dbname={$this->dbname};charset={$this->charset};port={$this->port}";
				$this->pdo=new \PDO($dsn,$this->user,$this->psw);
			} catch (\Exception $e) {
				$this->showExecption($e);
			}
		}
		//3、封装显示异常
		private function showExecption($e,$sql=''){
			if($sql!='')
				echo 'SQL语句执行失败！','<br>','错误的SQL语句是：',$sql;
			echo '错误代码是：',$e->getCode(),'<br>';
			echo '错误信息是：',$e->getMessage(),'<br>';
			echo '错误文件是：',$e->getFile(),'<br>';
			echo '错误行是：',$e->getLine(),'<br>';
			exit;
		}
		//4、初始化PDO异常自动抛出模式
		private function initExecption(){
			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
		}
		//5、执行操作语句
		//5.1 执行方法exec()
		public function exec($sql){
			try {
				return $this->pdo->exec($sql);
			} catch (\Exception $e) {
				$this->showExecption($e,$sql);
			}				
		}
		//5.2 获取自动增长的编号
		public function getInsertId(){
			return $this->pdo->lastInsertId();
		}
		//5.3 获取查询语句的PDOStatement对象
		private function getPDOStatement($sql){
			try {
				return $this->pdo->query($sql);
			} catch (\Exception $e) {
				$this->showExecption($e,$sql);
			}
		}
		//5.4 封装获取的匹配类型
		private function getFetchtype($type){
			switch($type){
				case 'num':
					return \PDO::FETCH_NUM;
				case 'both':
					return \PDO::FETCH_BOTH;
				default:
					return \PDO::FETCH_ASSOC;
			}
		}
		//5.5 匹配多行数据
		public function fetchAll($sql,$type='assoc'){
			$stmt=$this->getPDOStatement($sql);
			$type=$this->getFetchtype($type);
			return $stmt->fetchAll($type);
		}
		//5.6 匹配一行数据
		public function fetchRow($sql,$type='assoc'){
			$stmt=$this->getPDOStatement($sql);
			$type=$this->getFetchtype($type);
			return $stmt->fetch($type);
		}
		//5.7 匹配一行一列数据   $n  默认是从第0个开始
		public function fetchColumn($sql,$n=0){
			$stmt=$this->getPDOStatement($sql);
			return $stmt->fetchColumn($n);
		}

	}
	
/*	if($pdo->exec("insert into tt values (null,'aa')")){
		echo $pdo->getInsertId();
	}*/
	// $list=$pdo->fetchAll("select * from tt",'num');
	// $list=$pdo->fetchRow("select * from tt where id=6",'num');
	/*$list=$pdo->fetchColumn('select count(*) from tt');
	echo '<pre>';
	print_r($list)*/