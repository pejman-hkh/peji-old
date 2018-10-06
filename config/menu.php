<?php

$menu = [];

$menu['user'] = [ 'title' => 'User' ];
$menu['user']['sub'][] = [
	'title' => 'Users',
	'link' => 'user',
	'icon' => 'nav-icon icon-user',
	'sub' => [
		[ 'title' => 'Add User', 'link' => 'user/add' ],
		[ 'title' => 'Users List', 'link' => 'user/index' ],
		[ 'title' => 'Users Search', 'link' => 'user/search' ],
	]
];


$menu['cms'] = [ 'title' => 'Cms' ];

$menu['cms']['sub'][] = [
	'title' => 'Posts',
	'link' => 'post',
	'icon' => 'nav-icon icon-pencil',
	'sub' => [
		[ 'title' => 'Add Post', 'link' => 'post/add' ],
		[ 'title' => 'Posts List', 'link' => 'post/index' ],
		[ 'title' => 'Posts Search', 'link' => 'post/search' ],
	]
];

$menu['cms']['sub'][] = [
	'title' => 'Menu',
	'link' => 'menu',
	'icon' => 'nav-icon icon-menu',
	'sub' => [
		[ 'title' => 'Add Menu', 'link' => 'menu/add' ],
		[ 'title' => 'Menus List', 'link' => 'menu/index' ],
		[ 'title' => 'Menus Search', 'link' => 'menu/search' ],
	]
];


$menu['another'] = [ 'title' => 'Another' ];

$menu['another']['sub'][] = [
	'title' => 'Comments',
	'link' => 'comment',
	'icon' => 'nav-icon icon-speech',
	'sub' => [
		[ 'title' => 'Comments List', 'link' => 'comment/index' ],
		[ 'title' => 'Comments Search', 'link' => 'comment/search' ],
	]
];

$menu['another']['sub'][] = [
	'title' => 'Messages',
	'link' => 'message',
	'icon' => 'nav-icon icon-bell',
	'sub' => [
		[ 'title' => 'Messages List', 'link' => 'message/index' ],
		[ 'title' => 'Messages Search', 'link' => 'message/search' ],
	]
];


$menu['another']['sub'][] = [
	'title' => 'Settings',
	'link' => 'setting',
	'icon' => 'nav-icon icon-settings',
	'sub' => [
		[ 'title' => 'Settings List', 'link' => 'setting/index' ],
		[ 'title' => 'Settings Search', 'link' => 'setting/search' ],
	]
];

$menu['another']['sub'][] = [
	'title' => 'Logs',
	'link' => 'log',
	'icon' => 'nav-icon icon-eye',
	'sub' => [
		[ 'title' => 'Logs List', 'link' => 'log/index' ],
		[ 'title' => 'Logs Search', 'link' => 'log/search' ],
	]
];


return $menu;

?>