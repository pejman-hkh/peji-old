<?php
namespace Peji\DB;

class queryBuilder {
	private $params = [];
	private $prefix, $sql = '';

	public function getParams() {
		$params = $this->params;
		$this->params = [];
		return $params;
	}

	public function setParams( $array = [] ) {
		$this->params = array_merge($this->params, $array );
	}


	public function setParamsBefore( $array = [] ) {
		$this->params = array_merge( $array, $this->params );
	}

	public function getSql() {
		$sql = $this->sql;
		$this->sql = '';
		return $sql;
	}

	public function setPrefix( $prefix ) {
		$this->prefix = $prefix;
	}

	public function table( $tableName ) {
		$this->tableName = $tableName;
		return $this;
	}

	public function update( $array = [] ) {
		$setString = '`'.implode('` = ?, `', array_keys( $array ) ).'` = ? ';

		$this->setParamsBefore( array_values( $array ) );

		$this->sql = "UPDATE `".$this->tableName."` SET ".$setString."".$this->sql." ";
	}

	public function insert( $array ) {
		$keyString = '`'.implode("` , `", array_keys( $array ) ).'`';

		$this->params = array_values( $array );

		$this->sql = "INSERT INTO `".$this->tableName."`(".$keyString.") VALUES(".( str_repeat('?,', count( $array ) - 1 ).'?' ).")";
	}

	public function select( $tableName, $fields = '*' ) {
		$this->sql = "SELECT SQL_CALC_FOUND_ROWS ".$fields." FROM ".$this->prefix.$tableName;
		return $this;
	}

	public function leftJoin( $table, $on ) {
		return $this->sql .= " LEFT JOIN ".$table." ON ".$on;
	}

	public function sql( $sql ) {
		$sql = trim($sql);
		if( substr( $sql, 0, 6 ) == 'select' ) {
			$sql = substr( $sql, 6);
			$sql = 'SELECT SQL_CALC_FOUND_ROWS '.$sql;
		}

		$this->sql = $sql;
		return $this;
	}

	public function where( $key, $q = '=', $value = [] ) {

		if( is_array( $key ) ) {
			$sql = '';
			$pre = '';
			$setBind = true;
			foreach( $key as $k => $v ) {
				if( is_numeric( $k ) ) {
					$setBind = false;
					$sql .= $pre.$v;
				} else {
					$sql .= $pre." `$k` = ? ";
				}
				
				$pre = " AND ";
			}

			$this->sql .= " WHERE ".$sql;
			if( $setBind )
				$this->params = array_values( $key );

		}

		return $this;
	}

	public function limit( $to, $from = 0 ) {
		if( $to !== 0)
			$this->sql .= " LIMIT ".$from.", ".$to;

		return $this;
	}

}
?>