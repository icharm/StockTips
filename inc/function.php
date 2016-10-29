<?php

/**
 * 验证 验证码是否正确
 * @param  string $code 验证码
 * @return boolean      正确返回true
 */	
function echoVerifyCode($code){
	if (!isset($_SESSION)) {
		session_start();
	}
	if(strtolower($code) == $_SESSION['authcode'])
		return true;
	else
		return false;
}

/**
 * 构建返回信息json格式
 * @param  boolean $flag 标志 1成功，0失败
 * @param  string $msg   相关信息
 * @param  array  $data  相关数据
 * @return string        json格式数据
 */
function returnMsg($flag,$msg,$data = array()){
	$ret = array(
			'flag' => $flag,
			'msg' => urlencode($msg),
			'data' => $data,
		);
	return urldecode(json_encode($ret));
}

/**
 * @param  string str 错误信息
 * @param  boolean $output 是否输出
 * @return [type]
 */
function saveLog($str = '',$path = '../log/record.log', $output = false) {

	if ($output) {
		exit($str);
	} else {
		$str = date('Y-m-d H:i:s')."\t{$_SERVER['REQUEST_URI']}\n{$str}\n\n";
		file_put_contents($path, $str, FILE_APPEND);
	}
}

/**
 * 检查手机号是否符合要求
 * @param  string $phone 手机号
 * @return boolean       true手机号正确
 */
function checkPhone($phone) {
	if (!preg_match('/^1[0-9]{10}$/', $phone)) {
		return false;
	}
	return true;
}

/**
 * 检查邮箱格式
 * @param  string $mail 邮箱地址
 * @return boolean      正确true
 */
function checkMail($mail){
	if(filter_var($mail, FILTER_VALIDATE_EMAIL))
		return true;
	else
		return false;
}

/**
 * 格式化打印数据
 * @param  All $data 待打印的数据
 * @return NULL       
 */
function varDump($data){
	echo "<pre>";var_dump($data);echo "<pre>"; 
}

/**
 * 生成验证邮箱时的随机码
 * @return string 随机码url编码过
 */
function buildVerifyMailCode(){
	if (!isset($_SESSION)) {
		session_start();
	}
	//字典
	$words = '0123456789zxcvbnmasdfghjklqwertyuiop一二三四五六七八九爱一回解了渴如梦不开了我舍得再来尘埃连诸葛免费的腾讯云服务器首先需要通过学信网验证学生身份之后腾讯每月会赠送一个满减元的代金券直赠送到大学毕业云服务器建议选择安装版本安装时候需要记住系统镜像的密码后续通过SSH连接服务器时需要填写这个密码';
	for($i = 0; $i<40; $i++){
		$word = substr($words, rand(0,strlen($words)),1);
		$randwords .= $word;
	}
	$_SESSION['mailVerifyCode'] = $randwords;
	return urlencode($randwords);
}

/**
 * 验证邮箱是否随机码是否正确
 * @param  string $code 随机码
 * @return boolean      正确true
 */
function verifyMailCode($code){
	if(!$code)
		return false;
	$code = urldecode($code);
	if($code == $_SESSION['mailVerifyCode']){
		return true;
	}else{
		return false;
	}
}

/**
 * 邮箱激活信息写入数据库	
 * @param  int $user_id 用户ID
 * @return boolean      成功true;
 */
function verifyMailSql($user_id){
	
	$conn = icharm_db::factory("stock");

	$data = array(
		'is_active'=>1,
		);
	$cond = "`id` =".$user_id;
	$result = $conn->update("stock_users",$data,$cond);
	return $result;

}

/**
 * 匹配邮箱地址@前面的内容，返回出来
 * @param  string $mail 邮箱
 * @return string       
 */
function getNameFromMail($mail){
	//匹配邮箱@前面的内容
	preg_match('/(.*)@/i', $mail, $match);
	return  $match[1];
}

/**
 * 通过用户id取得用户邮箱
 * @param  string $user_id 用户id
 * @return string          邮箱地址
 */
function getMailByUserId($user_id){
	$conn = icharm_db::factory("stock");
	$query = "SELECT `mail` FROM `stock_users` WHERE `id` = :id";
	$param = array(':id' => $user_id,);
	$result = $conn->fetchRow($query,$param,null);
	return $result['mail'];
}