<?php
session_start();
require_once __DIR__.'/../vendor/autoload.php';

use Pejman\DB as DB;
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

View::setDir( '../app/View' );

require_once '../route/route.php';

?>