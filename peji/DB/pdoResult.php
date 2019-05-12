<?php
namespace Peji\DB;
use Peji\ResultSet;

class pdoResult  {
	private $statment, $wrapper, $sql;

	public function __construct( $statment, $wrapper  ) {
		$this->statment = $statment ;
		$this->wrapper = $wrapper;
		$this->sql = $wrapper->getSql();

	}
	
	public function next() {
		return $this->statment->fetch( \PDO::FETCH_ASSOC  );
	}

	public function fetch() {
		return $this->next();
	}

	public function findAll() {
		return $this->statment->fetchAll( \PDO::FETCH_ASSOC );		
	}

	public function find( $callback ) {
		$std = new Resultset();
		while( $fetch = $this->next() ) {
			$std->item = $fetch;
			foreach( $this->wrapper->belongs as $k => $v ) {

				$e = explode("\\", $v[1]);
				$name = $e[count( $e ) - 1 ];

				$std->$name(@$v[1]::sql("WHERE $v[0] = ? ", [ $fetch[ $v[2] ] ])->findOne());
			}

			foreach( $this->wrapper->hasMany as $k => $v ) {

				$e = explode("\\", $v[1]);
				$name = $e[count( $e ) - 1 ];

				$std->$name(@$v[1]::sql("WHERE $v[0] = ? ", [ $fetch[ $v[2] ] ])->row());
			}

			$callback( $std, $this->wrapper );
		}
	}

	public function numRows() {
		return $this->statment->rowCount();
	}

	public function count() {
		return $this->numRows();
	}

}
