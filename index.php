<?php
require_once("inc/global.php");
//检查登录
$g_userObj->checkLogin();
//检查邮箱是否激活
if($g_user['is_active']=="0"){
  echo "<script>window.location.href='mailVerify.php'</script>";
}
//varDump($g_user);

$sql = "SELECT * FROM `stock_list` WHERE `user_id` = :user_id";
$param = array(
    ':user_id' => $g_user['id'],
  );
$conn = icharm_db::factory("stock");

$data = $conn->fetchRows($sql,$param);

//varDump($data);exit();

//计数有多少已添加的股票预警规则
$number = 0;

?>
<!DOCTYPE html>
<html lang="zh-ch">
  <head>
    <meta charset="utf-8">
    <title>首页-股票预警|ICHARM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body >
    
        
<?php require_once("nav.php"); ?>
    <div style="width:100%;border:red solid 1px;height:auto;padding-top:20px;padding-left:10%;padding-right:10%;">
    <h4><span class="fui-plus"></span>&nbsp;添加股票</h4>
    <hr>
    <form id="addstock">
      <table style="width:100%;">
        <thead></thead>
        <tbody>
          <tr>
            <td style="width:30%;text-align:right;">股票代码：&nbsp;&nbsp;</td>
            <td>
              <input id="sotck-code" type="text" style="background-color:#edeff1;width:40%;margin-bottom:10px;" class="form-control login-field" value="" placeholder="" id="login-name" />
              </td>
          </tr>
          <tr>
            <td style="width:30%;text-align:right;">股票名称：&nbsp;&nbsp;</td>
            <td>
              <input id="stock-name" type="text" style="background-color:#edeff1;width:40%;margin-bottom:10px;color:red;" class="form-control login-field" value="" placeholder="" id="login-name" readonly="readonly" />
              </td>
          </tr><tr>
            <td style="width:30%;text-align:right;">买入价格：&nbsp;&nbsp;</td>
            <td>
              <input id="buy-price" type="text" style="background-color:#edeff1;width:40%;margin-bottom:10px;" class="form-control login-field" value="" placeholder="" id="login-name" />
              </td>
          </tr>
          <tr>
            <td style="width:30%;text-align:right;">预警位：&nbsp;&nbsp;</td>
            <td>
              <p style="display:inline;vertical-align:middle;">涨幅 &nbsp;&nbsp;</p><input id="rising" type="text" style="background-color:#edeff1;width:12%;margin-bottom:10px;display:inline;margin-top:11px;" class="form-control login-field" value="" placeholder="10" id="login-name" />
              <p style="display:inline;vertical-align:middle;">%&nbsp;&nbsp;&nbsp;&nbsp;</p><input id="rising-price" type="text" style="background-color:#edeff1;width:12%;margin-bottom:10px;display:inline;margin-top:11px;color:red;" class="form-control login-field" value="" placeholder="价格" id="login-name" readonly="readonly" />
              </td>
          </tr> 
          <tr>
            <td style="width:30%;text-align:right;"></td>
            <td>
              <p style="display:inline;vertical-align:middle;">跌幅 &nbsp;&nbsp;</p><input id="drop" type="text" style="background-color:#edeff1;width:12%;margin-bottom:10px;display:inline;margin-top:11px;" class="form-control login-field" value="" placeholder="10" id="login-name" />
              <p style="display:inline;vertical-align:middle;">%&nbsp;&nbsp;&nbsp;&nbsp;</p><input id="drop-price" type="text" style="background-color:#edeff1;width:12%;margin-bottom:10px;display:inline;margin-top:11px;color:red;" class="form-control login-field" value="" placeholder="价格" id="login-name" readonly="readonly"/>
              </td>
          </tr>
          <tr>
            <td style="width:30%;text-align:right;"></td>
            <td>
              <a class="btn btn-primary btn-lg btn-block" onclick="addStockAction()" style="width:20%;margin-top:11px;">添&nbsp;加</a>
              <input type="hidden" name="" id="gPrice">
              </td>
          </tr>    
        </tbody>

      </table>
        
    </form>
    
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h4><span class="fui-star-2"></span>&nbsp;已添加列表</h4>
    <hr>

<?php foreach ($data as $key => $value) { $number++; ?>


    <div style="width:945px; height:auto; margin:50px 10%; background-color:#edeff1;">
    <label style="width:32px; height:32px; background-color:#1abc9c;float:left; position:relative; right:20px; bottom:20px; text-align:center; color:white;"><?php echo $number;?></label>
      <table style="width:420px; display:inline; position:relative; bottom:40px;">
        <tbody>
          <tr>
            <td style="width:40%;text-align:right;">股票代码：&nbsp;&nbsp;</td>
            <td><?php echo $data[$key]['code'];?></td>
          </tr>
          <tr>
            <td style="width:40%;text-align:right;">股票名称：&nbsp;&nbsp;</td>
            <td><?php echo $data[$key]['name'];?></td>
          </tr>
          <tr>
            <td style="width:40%;text-align:right;">预警涨幅：&nbsp;&nbsp;</td>
            <td><?php echo $data[$key]['rising_range'];?>%&nbsp;&nbsp;&nbsp;价格：<?php echo $data[$key]['rising_price'];?></td>
          </tr>
          <tr>
            <td style="width:40%;text-align:right;">预警跌幅：&nbsp;&nbsp;</td>
            <td><?php echo $data[$key]['drop_range'];?>%&nbsp;&nbsp;&nbsp;价格：<?php echo $data[$key]['drop_price'];?></td>
          </tr>
          <tr>
            <td style="width:40%;text-align:right;">修改时间：&nbsp;&nbsp;</td>
            <td><?php echo $data[$key]['modify_datetime'];?></td>
          </tr>
        </tbody>

      </table>
      <div style="display:inline;">
        <img style="width:400px;height:200px;margin-top:15px;margin-left:10px;" src="http://image.sinajs.cn/newchart/min/n/<?php echo $data[$key]['type'].$data[$key]['code'];?>.gif">
      </div>
      <a class="btn btn-primary btn-lg btn-block" onclick="login()" style="width:20%;margin-top:11px;display:inline;position:relative;right:-20px;top:-20px;" >修&nbsp;改</a>

      <a class="btn btn-inverse btn-lg btn-block" onclick="deleteStock('<?php echo $data[$key]['code'];?>')" style="width:20%;margin-top:11px;display:inline;position:relative;right:60px;top:40px;">删&nbsp;除</a>

    </div>

  <?php } ?>
    </div>
      <!-- 幻灯片 -->
         <!-- <div class="ppt">
            <img src="img/timg.jpg" />
         </div> -->

      <!-- 填  写 -->
      <div style="height:500px;">
      </div>



<?php require_once("footer.php"); ?>