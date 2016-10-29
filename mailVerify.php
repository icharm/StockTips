<?php

require_once("inc/global.php");
require_once("inc/phpmail/function.php");
//检查登录
$g_userObj->checkLogin();
//检查邮箱是否激活(已激活跳转主页)
if($g_user['is_active'] !="0"){
  echo "<script>window.location.href='index.php'</script>";
  exit();
}

$flag = 2;
$action = trim($_GET['ac']);

//匹配邮箱@前面的内容
preg_match('/(.*)@/i', $g_user['mail'], $match);
$username = $match[1];


if($action == "verify"){
  
  $code = trim($_GET['code']);
  if(verifyMailCode($code)){
    $ret = verifyMailSql($g_user['id']);
    if($ret){
      $info = "亲爱的".$username."，您的账号激活成功。";
      $flag = 1;
    }else{
      $info = "激活失败！出现未知错误，点击下面的按钮重新发送激活邮件！";

    }
  }else{
    $info = "链接已经失效！点击下面的按钮重新发送激活邮件！";
  }

}else{

  //发送账号激活邮件
  $random = buildVerifyMailCode();
  //激活地址
  $url = GURL_ROOT."mailVerify.php?ac=verify&code=".$random;
  //发送邮件
  $result = sendMailVerify($g_user['mail'],$username,$url);
  $info = "亲爱的".$username."，一封账号激活邮件已经发送至您的注册邮箱，请查收，点击邮件内的链接激活账号。";
}



?>
<!DOCTYPE html>
<html lang="zh-ch">
  <head>
    <meta charset="utf-8">
    <title>邮箱验证-股票提示|ICHARM</title>
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
  <body class="full-screen">
    <div>
        <div >
          <!-- <div class="login-icon">
            <img src="img/login/icon.png" alt="Welcome to Mail App" />
            <h4>Welcome to <small>Mail App</small></h4>
          </div> -->

          <div class="login-form" style="left:25%;width:50%;height:auto;">
          <p><?php echo $info;?></p>
          <!-- <p>&nbsp; </p> -->
          <button class="btn btn-primary btn-lg btn-block" id="send">没有收到邮件？点击重新发送</button>
        </div>
        
      </div>
    
    <?php require_once("copyright.php");?>


    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/vendor/video.js"></script>
    <script src="js/flat-ui.min.js"></script>
    <script type="text/javascript">
      var that = $("#send");
      $("html").ready(function(){
        if(1 == <?php echo $flag;?>){
          that.text("重新登录");
          return false;
        }else{

          $("#send").attr("disabled",true);
          var num=60;
          //var that = $("#send");
          var t = setInterval(function(){
            num--;
            that.text(num+"s");
            if(num == 0){
                that.attr('disabled',false);
                clearInterval(t);
                that.text("没有收到邮件？点击重新发送" );
            }
        },1000);
        }
      });

      that.click(function(){
        if(1 == <?php echo $flag;?>){
          window.location.href = "login.php?action=out";
        }else{
          window.location.href = "mailVerify.php";
        }
      });
    </script>
  </body>
</html>
