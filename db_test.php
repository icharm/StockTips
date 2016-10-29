<?php
require_once("inc/global.php");

$con = icharm_db::factory('stock');

/*$data = $con->prepare("SELECT * FROM stock_users");
$data->execute();

$data = $data->fetchAll();
*/

//$data = $con->fetchRows("SELECT * FROM stock_users");

//print_r($data);
//
/*$data = array(
	'mail' => "meiyan@icharm.mf",
	'phone' => '17768100276',
	'password' => 1234567,
	'salt' => 'sasdadsxasde',
	'datetime' => date("Y-m-d H:i:s"),
	);
	*/
/*$data = array(
	'user_id' => 1,
	'code' => '01',
	'name' => '02',
	'buy_price' => '03',
	'rising_range' => '04',
	'drop_range' => '05',
	'rising_price' => '06',
	'drop_price' => '07',
	'created' => '0000-00-00 00:00:00',
	'modify_datetime' => '0000-00-00 00:00:00',
	'notice_times'=> 0,
	);
$result = $con->insert("stock_list", $data);*/
//$result = $con->update("stock_users", $data, "`password` = 123456");



/*$sql = "SELECT id FROM `stock_users` WHERE `mail`= :mail";

$result = $con->fetchRow($sql, array(':mail'=>"mei@icharm.m"));*/
//$result = verifyMailCode();

//$result = checkMail("mei");
//
//$mail = "icharm.me@outlook.com";
//preg_match('/(.*)@/i', $mail, $match);
//
//$result = strlen("var hq_str_sh300172='';");

//$obj = new Stock("600606");
//$result = $obj->getStockName();
//$name = "var hq_str_sh600606=\"绿地控股\"";
//preg_match('/\"(.*)\"/i', $name, $result);
/*function delete($tablename, $data = array(), $limit = null){
		if(!$tablename || !$data){
			return false;
		}

		$set = array();
		foreach ($data as $k => $v) {
			$set[] = "`{$k}`=:{$k}";
		}		
		$param = array();
		foreach ($data as $key => $value) {
			$param[":"."$key"] = $value;
		}

		$query = "DELETE FROM `{$tablename}` WHERE ".join(" AND ", $set).($limit?" LIMIT {$limit}": "");
		return $query;
		//$tmp = $this->conn->prepare($query);
		$result = $tmp->execute($param);
		return $result;
	}
$data= array('user_id'=>'22','code'=>'000001',);
$result = delete("stock_list",$data,1);*/
$result = getMailByUserId('22');

echo $result;
varDump($result);