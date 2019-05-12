<?
namespace Peji;

class Model extends Singleton {
	protected $table;

	public function __construct() {
		$this->db = DB::getInstance();
		
	}

	protected function belongTo( $field, $model, $id ) {
		DB::belongTo( [ $field, $model, $id ] );
	}

	protected function hasMany( $field, $model, $id ) {
		DB::hasMany( [ $field, $model, $id ] );
	}

	protected function field( $fields = '*' ) {
		return DB::select( $this->table, $fields );
	}

	protected function paginate( $count, $page = 1 ) {
		return DB::select( $this->table )->paginate( $count, $page?:(@$_GET['page']?:1) );
	}

	protected function find( $arr = [] ) {
		if( is_numeric($arr) ) {
			return DB::select( $this->table )->where(['id' => $arr ])->findOne( $arr );
		}
		return DB::select( $this->table )->find( $arr );
	}

	protected function findOne( $arr = [] ) {
		return DB::select( $this->table )->findOne( $arr );
	}

	protected function sql( $sql, $bind = [] ) {
		return DB::select( $this->table )->addSql( $sql )->bind( $bind );
	}

	protected function create( $array ) {
		return DB::table( $this->table )->insert( $array );
	}

	protected function update( $array, $where = [] ) {
		return DB::table( $this->table )->where( $where )->update( $array );
	}

	protected function leftJoin( $array ) {
		return DB::table( $this->table )->insert( $array );
	}

	protected function where( $key, $op = "AND", $value = "" ) {
		return DB::select( $this->table )->where( $key, $op, $value );
	}

	protected function row() {
		return DB::select( $this->table )->row();
	}

	protected function getPaginate() {
		return DB::getPaginate();
	}
}

?>