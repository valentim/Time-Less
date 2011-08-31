<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class database_pdo {
	private $dsn;
	private $user;
	private $pass;
	private $pdo;
	
	public function __construct($dsn, $user, $pass) {
		$this->dsn = $dsn;
		$this->user = $user;
		$this->pass = $user;
	}
	
	public function conn() {
		try {
			$this->pdo = new PDO($this->dsn, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
        	die();
		}
		return $this->pdo;
	}
	
	public function close() {
		$this->pdo = null;
	}
}

?>