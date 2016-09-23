<?php


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

<!-- <div>
      <h1>ICHARM●股票提示</h1>
    </div> -->
    <div>
        <div >
          <!-- <div class="login-icon">
            <img src="img/login/icon.png" alt="Welcome to Mail App" />
            <h4>Welcome to <small>Mail App</small></h4>
          </div> -->

          <div class="login-form" style="height:404px;">

            <div class="form-group">
              <input type="text" class="form-control login-field" value="" placeholder="邮箱" id="reg-mail" />
              <label class="login-field-icon fui-mail" for="reg-mail"></label>
            </div>

            <div class="form-group">
              <input type="password" class="form-control login-field" value="" placeholder="密码" id="reg-pwd" />
              <label class="login-field-icon fui-lock" for="reg-pwd"></label>
            </div>

            <div class="form-group">
              <input type="password" class="form-control login-field" value="" placeholder="重复密码" id="reg-pwd-r" />
              <label class="login-field-icon fui-lock" for="reg-pwd-r"></label>
            </div>

            <div class="form-group">
              <input type="text" class="form-control login-field" value="" placeholder="手机号" id="reg-phone" />
              <label class="login-field-icon fui-window" for="reg-phone"></label>
            </div>

            <div class="form-group">
              <div style="width:100%;">
              <input style="width:78%;display:inline-block;" type="text" class="form-control login-field" value="" placeholder="验证码" id="reg-code" />
              <label style="margin-right:20%;" class="login-field-icon fui-check" for="reg-code"></label>
              <img style="width:20%;height:38px;" src="inc/captcha.php">
              <span id="codeTips" class="fui-check"></span>
              </div>
            </div>

            <a class="btn btn-primary btn-lg btn-block" href="#">注册</a>
            <!-- <a class="login-link" href="#">Lost your password?</a> -->
          </div>
        </div>
      </div>

    <div class="copyright">
        <p>Copyright © 2016 ICHARM lnc. All Rights Reserved</p>
    </div>



    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/flat-ui.min.js"></script>
    <script type="text/javascript">
        $("#codeTips").addClass("fui-check");
        $("#codeTips").removeClass("fui-check");


    </script>
  </body>
</html>
