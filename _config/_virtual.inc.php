<?php


//BASIC CONFIGURATION FOR WEB SERVER
$afconfig([
	'root'			=> '_web',

	'debug'=>true,

	//PHP Universal Database Library (PUDL)
	'pudl'				=>	[
		'type'			=>	'sqlite',
		'database'		=>	'altaform.db',
		//'prefix'		=>	'prefix_',
		//'redis'		=>	'local.redis.server',
		//'hash'		=>	'REPLACE WITH A RANDOM STING',
	],


	// ENCRYPTION DATA
	'encrypt'			=>	[
		'key'			=>	'FVpXEjT9t^cupUHlZbnqmuWHjZiU0m*4GZ0iAfUycRT*F#y*MN',
		'cipher'		=>	'AES-256-CBC',
	],

]);



//DEFAULT OPEN GRAPH DATA
$og = [
	'title'			=> 'Web Site Title',
	'image' 		=> '',
	'description'	=> '',
	'keywords'		=> '',
	'viewport'		=> 'width=650,user-scalable=no',
];
