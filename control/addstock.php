<?php
/**
 * @abstract 添加股票Ajax后台处理
 */

require_once("../inc/global.php");

$code = trim($_POST['code']);
$name = trim($_POST['name']);
$buy = trim($_POST['buy']);
$rising_price = trim($_POST['rising_price'])?trim($_POST['rising_price']):0;
$rising_range = trim($_POST['rising_range'])?trim($_POST['rising_range']):0;
$drop_range = trim($_POST['drop_range'])?trim($_POST['drop_range']):0;
$drop_price = trim($_POST['drop_price'])?trim($_POST['drop_price']):0;

if(!$code){
	echo returnMsg(0,"请填写股票代码");
	exit();
}
if(!$buy){
	echo returnMsg(0,"请填写买入价");
	exit();
}
//判断一下登录情况$g_user['id']
if(!$g_user['id']){
	echo returnMsg(0,"登录超时，请重新登录!");
	exit();
}

//计算价格:

$stock = new Stock($code);

if(!$name){
	$name = $stock->getStockName();
}
$type = $stock->getStockType();

$conn = icharm_db::factory("stock");
$date = date("Y-m-d H:i:s");

$data = array(
	'user_id' => $g_user['id'],
	'code' => $code,
	'name' => $name,
	'buy_price' => $buy,
	'rising_range' => $rising_range,
	'drop_range' => $drop_range,
	'rising_price' => $rising_price,
	'drop_price' => $drop_price,
	'created' => $date,
	'modify_datetime' => $date,
	'notice_times'=> 0,
	'type' => $type,
	);
$result = $conn->insert("stock_list", $data);

if($result){
	echo returnMsg(1,"添加成功");
	exit();
}else{
	echo returnMsg(0,"添加失败，出现未知错误，请稍后再试");
	exit();
}


