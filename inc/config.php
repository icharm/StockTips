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
		'host' => '172.0.0.1',		//数据库地址
		'port' => 3306,				//数据库端口
		'username' => 'username',	//数据库登录用户名
		'password' => 'password',	//登录密码
		'dbname' => 'dbname',		//本条配置项对应的数据库名
	),
);

// mail
$mailconf = array(
	'foxmail' => array(
		'host' => 'smtp.qq.com',			//stmp发件地址
		'port' => 465,						//端口
		'secure' => 'ssl',					//加密方式
		'username' => 'icharm.me@foxmail.com',
		'password' => 'qq shou quan ma', //qq授权码(现在是使用授权码来代替qq密码)
		'formName' => '股票预警(ICHARM)', //显示在源邮件地址旁边的head
	),
);

