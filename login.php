<?php
require_once("inc/global.php");

$user = new JLAdmin();

//登出
if($_GET['action'] == 'out'){
    $user->outCurrent();
    header('Location:'.GURL_ROOT.'login.php');
    exit;
}

//已登录处理
$g_admin = $user->getCurrent();
if($g_admin){
    header('Location:'.GURL_ROOT.'index.php');
    exit;
}

//是否跳转来源页
$backurl = trim($_GET['backurl']);
if($backurl){
  $backFlag = 1;
}else{
  $backFlag = 2;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>登陆-股票提示|ICHARM</title>
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

          <div class="login-form" style="height:auto;">
            <div class="form-group">
              <input id="mail" type="text" class="form-control login-field" value="" placeholder="邮箱" id="login-name" />
              <label class="login-field-icon fui-mail" for="login-name"></label>
            </div>

            <div class="form-group">
              <input id="pwd" type="password" class="form-control login-field" value="" placeholder="密码" id="login-pass" />
              <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>
            <a class="btn btn-primary btn-lg btn-block" onclick="login()">登陆</a>
            <a class="login-link" href="register.php">没有账号?注册一个</a>
          </div>
        </div>


        
      </div>
    <?php require_once("copyright.php");?>


    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/vendor/video.js"></script>
    <script src="js/flat-ui.min.js"></script>
    <script type="text/javascript">
      function login(){
        data = {};
        data.mail = $("#mail").val();
        data.pwd = $("#pwd").val();
        if(!data.mail){
          alert("请输入用户名（邮箱）！");
          return false;
        }
        if(!data.pwd){
          alert("请输入密码!");
          return false;
        }

        $.ajax({
          'url':'control/login.php',
          'type':'post',
          'dataType':'json',
          'data':data,
          'success':function(ret){
            if(ret.flag){
              alert("登录成功");
              if(1 == <?php echo $backFlag;?>){
                window.location.href = "<?php echo $backurl;?>"
              }else{
                window.location.href='mailVerify.php';
              }
            }else{
              alert(ret.msg);
              return false;
            }
          },
          'error':function(ret){
            alert("网络错误,请稍后再试！");
            return false;
          },
        })
        return true;
      }

    </script>

  </body>
</html>
