<?php



?>

<!DOCTYPE html>
<html lang="zh-ch">
  <head>
    <meta charset="utf-8">
    <title>注册-股票预警|ICHARM</title>
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
              <input type="text" class="form-control login-field " value="" placeholder="手机号" id="reg-phone" />
              <label class="login-field-icon fui-window" for="reg-phone"></label>
            </div>

            <div class="form-group">
              <div style="width:100%;">
              <input style="width:78%;display:inline-block;" type="text" class="form-control login-field" value="" placeholder="验证码" id="reg-code" />
              <label id="code-check" style="margin-right:20%;" class="login-field-icon" for="reg-code"></label>
              <a onclick="changeCode()" title="看不清？点击换一张" data-toggle="tooltip"><img id="code-img" style="width:20%;height:38px;" src="inc/captcha.php?r=<?php echo rand();?>"></a>
              
              </div>
            </div>

            <a id="btn-sub" class="btn btn-primary btn-lg btn-block">注册</a>
            <!-- <a class="login-link" href="#">Lost your password?</a> -->
          </div>
        </div>
      </div>

    <!-- <div class="copyright">
        <p>Copyright © 2016 ICHARM lnc. All Rights Reserved</p>
    </div> -->



    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/flat-ui.min.js"></script>
    <script type="text/javascript">

        var codeFlag = false;

        //激活悬停提示工具tooltip
        $(function(){
          $("[data-toggle='tooltip']").tooltip();
        });

        //点击变换验证码
        function changeCode(){
          $("#code-img").attr("src","inc/captcha?r="+Math.random());
          return true;
        }

        $("#reg-code").blur(function(){
            var data = {};
            data.code = $("#reg-code").val();
            var flag = false;
            $.ajax({
              'url':'control/authCodeVerify.php',
              'type':'get',
              'dataType':'json',
              'data':data,
              'success': function(ret){
                if(ret.flag){
                  $("#code-check").removeClass("fui-cross");
                  $("#code-check").addClass("fui-check");
                  codeFlag = true;
                }else{
                  $("#code-check").removeClass("fui-check");
                  $("#code-check").addClass("fui-cross");
                }
              },
              'error': function(ret){
                $("#code-check").removeClass("fui-check");
                $("#code-check").addClass("fui-cross");
              },
            });
            return true;
        })
        

        $("#btn-sub").click(function(){
            var data = {};
            data.mail = $("#reg-mail").val();
            data.pwd = $("#reg-pwd").val();
            data.pwd_s = $("#reg-pwd-r").val();
            data.phone = $("#reg-phone").val();
            data.code = $("#reg-code").val();
            if(!data.mail){
              alert("请输入邮箱！");
              return false;
            }
            if(!data.pwd){
              alert("请输入密码！");
              return false;
            }
            if(data.pwd != data.pwd_s){
              alert("两次输入的密码不一致！");
              return false;
            }
            if(!data.phone){
              var r = confirm("未填写手机号，可能无法享受高级通知服务！");
              if(r == false)
                return false;
            }
            console.log(codeFlag);
            if(!codeFlag){
              alert("验证码错误！");
              return false;
            }

            console.log(data);

          $.ajax({
            'url' : "control/register.php",
            'type' : "post",
            'dataType' : 'json',
            'data' : data,
            'success' : function(ret){
                if(ret.flag){
                  alert(ret.msg);
                  window.location.href="login.php";
                }else{
                  alert(ret.msg);
                  return false;
                }
            },
            'error' : function(ret){
              alert("网络异常，请稍后再试！");
            }
          })
          return true;
        })

    </script>
  </body>
</html>
