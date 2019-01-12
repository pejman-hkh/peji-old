<?
namespace Peji;
use Peji\DB\pdoWrapper;
use Peji\DB\queryBuilder;

class DB extends Singleton {

	public function __construct() {
		$this->db = new pdoWrapper();
		$this->QB = new queryBuilder();
	}

	protected function connect( $host, $username, $password, $dbName ) {
		$this->db->connect( $host, $username, $password, $dbName );
	}
	
	protected function setAttr( $attr ) {
		$this->db->setAttr( $attr );
	}

	protected function select( $tname ) {
		$this->QB->select( $tname );
		return $this;
	}

	protected function sql( $sql ) {
		$this->QB->sql( $sql );
		return $this;
	}

	protected function table( $tname ) {
		$this->QB->table( $tname );
		return $this;
	}

	public function where( $key, $q = '=', $value = [] ) {
		$this->QB->where( $key, $q, $value );
		return $this;
	}

	public function leftJoin( $table, $on ) {
		$this->QB->leftJoin( $table, $on );
		return $this;
	}

	public function searchKey() {

		return $this;
	}

	public function search() {

		return $this;
	}

	public function insert( $array ) {
		$this->QB->insert( $array );
		$this->run();
		return $this->db->lastInsertId();
	}

	public function update( $array ) {

		$this->QB->update( $array );
		return $this->run();
	}

	public function find( $array = [] ) {
		$this->QB->setParams( $array );

		return $this->run()->findAll();
	}


	public function findOne( $array = [] ) {
		$this->QB->limit(1)->setParams( $array );

		return @$this->run()->findAll()[0];
	}

	public function execute( $array = [] ) {
		return $this->run();
	}

	private function run() {

		return $this->db->prepare( $this->QB->getSql() )->execute( $this->QB->getParams() );
	}

	protected function getPaginate() {
		$number = $this->paginateData[0];
		$page = $this->paginateData[1];

		$fetch = $this->db->prepare("SELECT FOUND_ROWS()")->execute()->fetch();
		$count = @$fetch["FOUND_ROWS()"];

		$limit = 4;
		$nP = ceil( $count / $number );

		$data["start"] = ( $page - $limit ) <= 0 ? 1 : $page - $limit;
		$data["end"] = ( $page + $limit >= $nP ) ? $nP : $page + $limit;
		$data["count"] = $count;
		$data["next"] = $page >= ceil( $count / $number ) ? $page : $page + 1;
		$data["prev"] = $page <= 1 ? 1 : $page - 1;

		return $data;	
	}

	public function row() {
		return $this->run();
	}

	public function paginate( $limit, $page = 1 ) {
		$this->paginateData = [ $limit, $page ];
		$this->QB->limit( $limit, ( $page * $limit - $limit ) );
		return $this;
	}

}

?>