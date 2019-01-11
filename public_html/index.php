<?php
session_start();
require_once __DIR__.'/../vendor/autoload.php';

use Peji\DB as DB;
use Peji\Config as Config;
use Peji\View as View;

Config::setDir('../config');
$dbConf = Config::file('db');


DB::connect( $dbConf['host'], $dbConf['username'], $dbConf['password'], $dbConf['db'] );

DB::setAttr([
	\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'" ,
	\PDO::ATTR_PERSISTENT => false ,
	\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true ,
]);

/*$find = DB::sql("select * from posts order by id desc ")->paginate(5, 2)->find();
print_r( $find );

print_r( DB::getPagination() );


exit();



$id = DB::table("posts")->insert(['title' => 'test']);
print_r( $id );

DB::table("posts")->where(['id' => 2 ])->update(['title' => 'aaaaa']);

exit();
*/

View::setDir( '../app/View' );

require_once '../route/route.php';

?>