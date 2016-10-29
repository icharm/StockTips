<?php
/**
 * @abstract 定时任务脚本，检测是否有超过预警规则的股票
 */

require_once("global.php");
require_once("phpmail/function.php");

$conn = icharm_db::factory("stock");

$sql = "SELECT * FROM `stock_list`";

$data = $conn->fetchRows($sql, null, null);

$date = date("Y-m-d H:i:s");

varDump($data);

foreach ($data as $key => $value) {
	$code = $data[$key]['code'];
	$stock = new Stock($code);
	$price = $stock->getPrice();
	//涨幅超过
	if($price >= $data[$key]['rising_price']){
		$mail = getMailByUserId($data[$key]['user_id']);
		$username = getNameFromMail($mail);
		$param = array(
			'0' => $mail,
			'1' => $data[$key]['name']." 涨幅预警通知|ICHARM",
			'2' => $username,
			'3' => $data[$key]['name']."(".$data[$key]['code'].")",
			'4' => $data[$key]['name'],
			'5' => $data[$key]['code'],
			'6' => $price,
			'7' => $data[$key]['rising_price'],
			'8' => $data[$key]['rising_range'],
			'9' => $stock->getRangeNow(),
			'10' => $stock->getOpenPrice(),
			'11' => $stock->getHighestPrice(),
			'12' => $date,
			);
		$result = sendRisingNotice($param);
		$param_json = json_encode($param);
		$logData = array(
			'user_id' => $data[$key]['user_id'],
			'stock_id' => $data[$key]['id'],
			'content' => $param_json,
			'type' => 111, //涨幅通知
			'status' => $result,
			'created' => $date,
			);
		$insertFlag = $conn->insert("stock_notices_log", $logData);
		if(!$insertFlag){
			error_log(json_encode($logData),3,"../log/sendNoticeMail.log");
		}
	}

	//跌幅超过
	if($price <= $data[$key]['drop_price']){
		$mail = getMailByUserId($data[$key]['user_id']);
		$username = getNameFromMail($mail);
		$param = array(
			'0' => $mail,
			'1' => $data[$key]['name']." 跌幅预警通知|ICHARM",
			'2' => $username,
			'3' => $data[$key]['name']."(".$data[$key]['code'].")",
			'4' => $data[$key]['name'],
			'5' => $data[$key]['code'],
			'6' => $price,
			'7' => $data[$key]['rising_price'],
			'8' => $data[$key]['rising_range'],
			'9' => $stock->getRangeNow(),
			'10' => $stock->getOpenPrice(),
			'11' => $stock->getHighestPrice(),
			'12' => $date,
			);
		$result = sendDropNotice($param);
		$param_json = json_encode($param);
		$logData = array(
			'user_id' => $data[$key]['user_id'],
			'stock_id' => $data[$key]['id'],
			'content' => $param_json,
			'type' => 110, //跌幅通知
			'status' => $result,
			'created' => $date,
			);
		$insertFlag = $conn->insert("stock_notices_log", $logData);
		if(!$insertFlag){
			error_log(json_encode($logData),3,"../log/sendNoticeMail.log");
		}
	}
}
