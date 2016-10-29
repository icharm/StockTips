<?php
/**
 * @abstract 登录后台操作
 */

require_once("../inc/global.php");

$mail = trim($_POST['mail']);
$password = trim($_POST['pwd']);
$token = trim($_POST['token']);

$user = new JLAdmin();


if(!$mail || !$password){
	echo returnMsg(0,"有关键内容未填写！");
	exit();
}

$conn = icharm_db::factory("stock");
$sql = "SELECT * FROM `stock_users` WHERE `mail`= :mail";
$result = $conn->fetchRow($sql, array(':mail'=>$mail));
if(!$result){
	echo returnMsg(0, "用户不存在！");
	exit();
}
//验证密码
if(!$user->checkPassword($password, $result['password'], $result['salt'])){
	echo returnMsg(0,"密码错误!");
	exit();
}
//设置为登录状态
$user->setCurrent($result);

echo returnMsg(1,"登录成功!");
exit();