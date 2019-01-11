<?
namespace Peji;

class Model extends Singleton {
	protected $table;

	public function __construct() {

	}

	protected function field( $fields = '*' ) {
		return DB::select( $this->table, $fields );
	}

	protected function paginate( $count ) {
		return DB::select( $this->table )->paginate( $count, @$_GET['page']?:1 );
	}

	protected function find( $arr = [] ) {
		return DB::select( $this->table )->find( $arr );
	}

	protected function findOne( $arr = [] ) {
		return DB::select( $this->table )->findOne( $arr );
	}

	protected function create( $array ) {
		return DB::table( $this->table )->insert( $array );
	}


	protected function leftJoin( $array ) {
		return DB::table( $this->table )->insert( $array );
	}

	protected function where( $key, $op = "AND", $value = "" ) {
		return DB::select( $this->table )->where( $key, $op, $value );
	}

	protected function getPaginate() {
		return DB::getPaginate();
	}
}

?>