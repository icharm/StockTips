<?php
/**
 * @abstract 删除股票Ajax后台处理
 */

require_once("../inc/global.php");

$code = trim($_POST['code']);
if(!$code){
	echo returnMsg(0,"缺少参数");
	exit();
}

if(!$g_user['id']){
	echo returnMsg(0,"登录超时，请重新登录");
	exit();
}

//删除
//
$conn = icharm_db::factory("stock");

$data = array(
	'user_id'=> $g_user['id'],
	'code' => $code,
	);

$result = $conn->delete("stock_list", $data, 1);

if($result){
	echo returnMsg(1, "删除成功");
	exit();
}else{
	echo returnMsg(0, "删除失败，系统异常请稍后再试");
	exit();
}
