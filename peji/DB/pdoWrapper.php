<?php
namespace Peji\DB;

class pdoWrapper {

	private $statment, $db;
	public $belongs = [];
	public $hasMany = [];

	public function setAttr( $array ) {
		foreach( $array as $k => $v ) {
			$this->db->setAttribute( $k, $v );
		}
	}

	public function connect( $host, $username, $password, $dbName ) {
		try {
			
			$this->db = new \PDO( "mysql:host=".$host.";dbname=".$dbName.";charset=utf8", $username, $password );
			$this->setAttr([\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);

		} catch(\PDOException $e) {
			echo ( "Error Connect !<br/>" );
			exit();
		}
	}

	public function __construct() {
		
	}

	public function error( $e, $method ) {
		$err = "In method '".$method."'\n";
		$err .= "SQl : '".$this->getSql()."'\n";
		$err .= "".$e->getMessage()."\n";
		echo $err;
		exit();	
	}

	public function prepare( $sql ) {
		try {

			$this->statment = $this->db->prepare( $this->sql = $sql );
		} catch ( \PDOException $e ) {
			$this->error( $e, __METHOD__ );
		}
		return $this;
	}

	public function lastInsertId() {
		return $this->db->lastInsertId();
	}

	public function getSql() {
		return $this->sql;
	}

	public function execute( $bind = [] ) {
		return $this->bind( $bind )->exec();
	}

	public function exec() {
		try {
			$this->statment->execute();
		} catch (\PDOException $e) {
			$this->error( $e, __METHOD__ );
		}
		$res = new pdoResult( $this->statment, $this );
		return $res;
	}

	public function bind( &$bind = [] ) {
		try {
			if( is_array( $bind ) && @count( $bind ) > 0 ) foreach( $bind as $k => $v ) {
				$this->statment->bindValue( $k + 1, $v,  is_int( $v ) ? \PDO::PARAM_INT : \PDO::PARAM_STR );
			}
		} catch (\PDOException $e) {
			$this->error( $e, __METHOD__ );
		}
		return $this;
	}

	public function __destruct() {
		$this->db = null;
		unset( $this->db );
	}

}