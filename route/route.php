<?php
use Pejman\Router as Router;
use Peji\View as View;

function getPath() {
	$appDir = str_replace( "public_html/index.php", "", $_SERVER['PHP_SELF'] );
	define( 'baseUrl', $appDir );

	$reqUri = explode("?", $_SERVER['REQUEST_URI'])[0] ;
	return preg_replace( '#^'.$appDir.'#', "", $reqUri );
}

function pageNotFount() {

	$get = [];
	$get['baseUrl'] = baseUrl;

	View::set( $get );
	return View::render('404');
}

Router::setPath( getPath() );

Router::route('admin/{controller?}/{action?}/{id?}', function( $controller = 'index', $action = 'index', $id = 0 ) {


	if( ! Peji\Bootstrap::start( 'admin', $controller, $action, $id ) ) {
		pageNotFount();
	}

})->where( ['controller' => '[a-zA-Z]+', 'action' => '[a-zA-Z_]+', 'id' => '[a-zA-Z_0-9]+'] )->setExtension( [ 'html' ] )


->elseRoute('{controller?}/{action?}/{id?}', function( $controller = 'index', $action = 'index', $id = 0 ) {

	if( ! Peji\Bootstrap::start( 'user', $controller, $action, $id ) ) {
		pageNotFount();
	}


})->where( ['controller' => '[a-zA-Z]+', 'action' => '[a-zA-Z_]+', 'id' => '[a-zA-Z_0-9]+'] )->setExtension( [ 'html' ] )



->elseRoute( '{:all}', function( $p ) {
	echo "Another request";
});


Router::dispatch(function( $status ) {

	if( $status == 404 ) {
		pageNotFount();
	}
});