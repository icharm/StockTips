<?php
/**
 * @abstract 统一配置
 */

// url
define('GURL_ROOT', 'http://localhost/gupiao/');

// path
define('GPATH_ROOT', dirname(__FILE__));

// var
$gvarconf = array(
	'platform' => array(
		0 => 'wap',
		1 => 'ios',
		2 => 'android',
		3 => 'winphone',
		4 => 'pc',
	),
);

// db
$gdbconf = array(
	'stock' => array(
		'host' => '121.42.48.161',
		'port' => 3306,
		'username' => 'stocktips',
		'password' => '2s6K1zh9KyalyBzS',
		'dbname' => 'stocktips',
	),
);

// mail
$mailconf = array(
	'foxmail' => array(
		'host' => 'smtp.qq.com',
		'port' => 465,
		'secure' => 'ssl',	//加密方式
		'username' => 'icharm.me@foxmail.com',
		'password' => 'cjdvdeetatsydcic', //qq授权码
		'formName' => '股票预警(ICHARM)', //显示在源邮件地址旁边的head
	),
);

