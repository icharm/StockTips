<?php
/**
 * csrf攻击防御类
 */



class Csrf {

	// session中存储token的键
	public static $name = 'csrf_token';

	// 获取token
	public function getToken() {
		if (!isset($_SESSION)) {
			session_start();
		}
		$key = 'csrf_'.md5($_SERVER['PHP_SELF']);
		$token = $_SESSION[$key];
		if (!$token) {
			$token = self::makeToken();
			$_SESSION[$key] = $token;
		}
		return $token;
	}

	// 验证token
	public function checkToken($value, $clear = true) {
		if (!isset($_SESSION)) {
			session_start();
		}
		$key = 'csrf_'.md5($_SERVER['PHP_SELF']);
		$token = $_SESSION[$key];
		return $_SESSION[$key];
		if (!$token || $token != $value) {
			return false;
		}
		if ($clear) {
			unset($_SESSION[$key]);
		}
		return true;
	}

	// 清除token
	public function clearToken() {
		if (!isset($_SESSION)) {
			session_start();
		}
		$key = 'csrf_'.md5($_SERVER['PHP_SELF']);
		unset($_SESSION[$key]);
		return true;
	}

	// 生成token
	protected function makeToken() {
		return md5(uniqid().mt_rand());
	}
}
?>