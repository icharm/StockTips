<?php
/**
 * @abstract 处理有关stock的ajax请求
 */

require_once("../inc/global.php");

$ac = trim($_GET['ac']);

if($ac == 'nameandprice'){
	$code = trim($_GET['code']);
	if(!$code){
		exit();
	}

	$stock = new Stock($code);

	$name = urlencode($stock->getStockName());
	$price = $stock->getPrice();
	if(strlen($name) < 7){
		echo returnMsg(0,"未获取到数据，请检查股票代码是否正确");
		exit();
	}

	$data  = array(
		'name' => $name,
		'price' => $price,
		);

	echo returnMsg(1,"OK",$data);
	exit();
}