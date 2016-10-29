<?php
/**
 * @abstract 注册页面后台处理程序
 * @author ICHARM <icharm.me@outlook.com>
 */

require_once("../inc/global.php");

$mail = trim($_POST['mail']);
$phone = trim($_POST['phone']);
$password = trim($_POST['pwd']);
$code = trim($_POST['code']);

$codeFlag = echoVerifyCode($code);
if(!$codeFlag){
	echo returnMsg(0, "验证码错误");
	exit();
}
if(!$mail || !$password){
	echo returnMsg(0, "有重要内容未填写");
	exit();
}

if(!checkMail($mail)){
	echo returnMsg(0, "邮箱格式不正确");
	exit();
}

if($phone){
	if(!checkPhone($phone)){
		echo returnMsg(0, "手机号格式不正确");
		exit();
	}
}



//创建SQL连接
$conn = icharm_db::factory("stock");

//查找该邮箱是否已注册
$sql = "SELECT id FROM `stock_users` WHERE `mail`= :mail";
$result = $conn->fetchRow($sql, array(':mail'=>$mail));
if($result){
	echo returnMsg(0, "邮箱已注册，请使用其他邮箱");
	exit();
}

//插入用户信息
$login_obj = new JLAdmin();
$salt = $login_obj->makeSalt(16);
$password = $login_obj->makePassword($password, $salt);
$data = array(
	'mail' => $mail,
	'phone' => $phone,
	'password' => $password,
	'salt' => $salt,
	'datetime' => date("Y-m-d H:i:s"), 
	);
$result = $conn->insert("stock_users", $data);
if($result){
	echo returnMsg(1,"注册成功");
	exit();
}else{
	echo returnMsg(0,"网络异常，请稍后再试或与管理员ICHARM <icharm.me@outlook.com> 取得联系");
	exit();
}

