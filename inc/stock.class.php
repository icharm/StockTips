<?php

/**
 * @abstract 新浪股票API操作类
 */


class Stock
{
	//股票数据
	protected static $stock = array();

	//股票类型 sh,sz
	protected static $type = 'sh';

	/**
	 * 初始化
	 * @param string $code 股票代码
	 */
	public function __construct($code){
		self::getDataAll($code);
	}

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
	 * GBK和UTF-8互转，新浪股票使用GBK编码
	 * @param  string  $content 待转内容
	 * @param  integer $type    类型
	 * @return string           
	 */
	public function convEncoding($content, $type = 0) {
		if ($type == 1) {
			return mb_convert_encoding($content, 'gb2312', 'utf-8');//utf8->gb2312
		} else {
			return mb_convert_encoding($content, 'utf-8', 'gb2312');//gb2312->utf-8
		}
	}


	/**
	 * 从新浪股票数据接口中获取数据
	 * @param string $code //股票代码
	 * @return 数组
	 */
	public function getDataAll($code){

		$url_sh = 'http://hq.sinajs.cn/list=sh'.$code;
		$url_sz = 'http://hq.sinajs.cn/list=sz'.$code;

		$data = self::http_get($url_sh);
		if(strlen($data) < 25){
			$data = self::http_get($url_sz);
			self::$type = 'sz';
		}

		//切割字符串通过特定的字符
		$data_arr = array();
		$data_arr = explode(",",$data);
		self::$stock = $data_arr;
		return $data_arr;
	}

	/**
	 * 获取分时图的地址
	 * @param  string $code 股票代码
	 * @return string       图片地址
	 */
	public function getDataNow($code){
		$url = "http://image.sinajs.cn/newchart/min/n/".$code.".gif";
		return $url;
	}

	/**
	 * 获取股票名称
	 * @return string       股票名称
	 */
	public function getStockName(){
		if(self::$stock){
			preg_match('/=\"(.*)/i', self::$stock[0], $result);
			return self::convEncoding($result[1],0);
		}else{
			return false;
		}
	}

	/**
	 * 返回股票类型
	 * @return string 
	 */
	public function getStockType(){
		return self::$type;
	}

	/**
	 * 获取当前价格
	 * @return string 实时价格
	 */
	public function getPrice(){
		if(self::$stock){
			return self::$stock[3];
		}else{
			return false;
		}
	}

	//返回开盘价
	public function getOpenPrice(){
		if(self::$stock){
			return self::$stock[1];
		}else{
			return false;
		}
	}

	//返回昨日收盘价
	public function getClosePrice(){
		if(self::$stock){
			return self::$stock[2];
		}else{
			return false;
		}
	}

	//返回最高价
	public function getHighestPrice(){
		if(self::$stock){
			return self::$stock[4];
		}else{
			return false;
		}
	}

	//返回最低价
	public function getLowestPrice(){
		if(self::$stock){
			return self::$stock[5];
		}else{
			return false;
		}
	}

	//返回实时涨跌幅
	public function getRangeNow(){
		if(self::$stock){
			$now = self::$stock[3];
			$yes = self::$stock[2];
			return ($now - $yes)/$yes * 100;
		}else{
			return false;
		}
	}

}
