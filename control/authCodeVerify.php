<?php
/**
 * @abstract Ajax动态验证验证码
 * @author ICHARM <icharm.me@outlook.com>
 */

require_once("../inc/global.php");

$code = trim($_GET['code']);

$flag = echoVerifyCode($code);

if($flag){
	echo returnMsg(1,"正确");
}else{
	echo returnMsg(0,"错误");
}
