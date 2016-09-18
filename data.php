<?php

class Stock
{

	/**
	 * GET 请求
	 * @param string $url
	 */
	public function http_get($url){
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if(intval($aStatus["http_code"])==200){
			return $sContent;
		}else{
			 return false;
		}
	}


	/**
	 * 从新浪股票数据接口中获取数据
	 * @param string $code //股票代码
	 * @return 数组
	 */
	public function getDataAll($code){

		$url = 'http://hq.sinajs.cn/list=sh'.$code;

		$data = self::http_get($url);

		//切割字符串通过特定的字符
		$data_arr = array();
		$data_arr = explode(",",$data);

		return $data_arr;
	}
}

$code = 600606;
$obj = new Stock;
$obj->getDataAll($code);