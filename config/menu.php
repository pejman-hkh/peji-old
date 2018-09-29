<?php

$menu = [];

$menu['cms'] = [ 'title' => 'Cms' ];

$menu['cms']['sub'][] = [
	'title' => 'Posts',
	'link' => 'post',
	'sub' => [

	]
];

$menu['cms']['sub'][] = [
	'title' => 'Menu',
	'link' => 'menu',
	'sub' => [

	]
];


return $menu;

?>