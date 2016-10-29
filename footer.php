      <!-- footer -->
      <footer>
      <div class="container">
        <div class="row">
          <div class="col-xs-7">
            <h3 class="footer-title">About Us</h3>
            <p>Do you like this freebie? Want to get more stuff like this?<br/>
              Subscribe to designmodo news and updates to stay tuned on great designs.<br/>
              Go to: <a href="http://designmodo.com/flat-free" target="_blank">designmodo.com/flat-free</a>
            </p>

            <!-- <p class="pvl">
              <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://designmodo.com/flat-free/" data-text="Flat UI Free - PSD&amp;amp;HTML User Interface Kit" data-via="designmodo">Tweet</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
              <iframe src="http://ghbtns.com/github-btn.html?user=designmodo&repo=Flat-UI&type=watch&count=true" height="20" width="107" frameborder="0" scrolling="0" style="width:105px; height: 20px;" allowTransparency="true"></iframe>
              <iframe src="http://ghbtns.com/github-btn.html?user=designmodo&repo=Flat-UI&type=fork&count=true" height="20" width="107" frameborder="0" scrolling="0" style="width:105px; height: 20px;" allowTransparency="true"></iframe>
              <iframe src="http://ghbtns.com/github-btn.html?user=designmodo&type=follow&count=true" height="20" width="195" frameborder="0" scrolling="0" style="width:195px; height: 20px;" allowTransparency="true"></iframe>
            </p>
 -->
            <!-- <a class="footer-brand" href="http://designmodo.com" target="_blank">
              <img src="docs/assets/img/footer/logo.png" alt="Designmodo.com" />
            </a> -->

            <div style="margin-top:140px;">
             <p>Copyright © 2016 ICHARM lnc. All Rights Reserved</p>
            </div>

          </div> <!-- /col-xs-7 -->

          <div class="col-xs-5">
            <div class="footer-banner">
              <h3 class="footer-title">更新通知：</h3>
              <ul>
                <li>Tons of Basic and Custom UI Elements</li>
                <li>A Lot of Useful Samples</li>
                <li>More Vector Icons and Glyphs</li>
                <li>Pro Color Swatches</li>
                <li>Bootstrap Based HTML/CSS/JS Layout</li>
              </ul>
              Go to: <a href="http://designmodo.com/flat" target="_blank">designmodo.com/flat</a>
            </div>
          </div>

        </div>
      </div>
    </footer>
    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/vendor/video.js"></script>
    <script src="js/flat-ui.min.js"></script>
    <script type="text/javascript">


        $("#sotck-code").blur(function(){
          var data = {};
          data.code = $("#sotck-code").val();
          data.ac = "nameandprice";
          if(data.code){
            $.ajax({
              'url':'control/stock_ajax.php',
              'type':'get',
              'dataType':'json',
              'data': data,
              //'async':false, //同步
              'success': function(ret){
                if(ret.flag){
                  $("#stock-name").val(ret.data.name);
                  $("#gPrice").val(ret.data.price);
                }else{
                  alert(ret.msg);
                  $("#stock-name").val(null);
                  $("#gPrice").val(null);
                  return false;
                }
              },
              'error':function(ret){
                alert("网络错误，请稍后再试");
                $("#stock-name").val(null);
                $("#gPrice").val(null);
                return false;
              }
            })
          }else{
            return false;
          }
        });

        $("#rising").blur(function(){
          var rising_price;
          if(!$("#buy-price").val() && $("#rising").val()){
            alert("请填写先买入价格");
            $("#rising").val(null);
            return false;
          }
          rising_price = Number($("#buy-price").val()) * (1 + Number($("#rising").val())/100);
          $("#rising-price").val(rising_price.toFixed(4));
          return false;
        });

        $("#drop").blur(function(){
          var drop_price;
          if(!$("#buy-price").val() && $("#drop").val()){
            alert("请填写先买入价格");
            $("#rising").val(null);
            return false;
          }
          drop_price = Number($("#buy-price").val()) * (1 - Number($("#drop").val())/100);
          $("#drop-price").val(drop_price.toFixed(4));
          return false;
        });



        function addStockAction(){
          var data = {};
          data.code = $("#sotck-code").val();
          data.name = $("#stock-name").val();
          data.buy = $("#buy-price").val();
          data.rising_range = $("#rising").val();
          data.rising_price = $("#rising-price").val();
          data.drop_range = $("#drop").val();
          data.drop_price = $("#drop-price").val();

          if(!data.code){
            alert("请填写股票代码!");
            return false;
          }
          if(!data.buy){
            alert("请填写买入价格!");
            return false;
          }
          if(!data.rising_range && !data.drop_range){
            alert("预警涨幅和跌幅至少填写一项！");
            return false;
          }
          if(!$("#gPrice").val()){
            alert("获取该股数据异常，请稍后再试");
            return false;
          }

          var r = confirm("确定提交？");
          if(r == true){
            $.ajax({
              'url': 'control/addstock.php',
              'type': 'post',
              'dataType': 'json',
              'data': data,
              'success':function(retu){
                if(retu.flag){
                  alert("提交成功");
                  window.location.href = "index.php";
                }else{
                  alert(retu.msg);
                  return false;
                }
              },
              'error': function(retu){
                alert("网络异常，请稍后再试");
                return false;
              },
            });
          }else{
            return false;
          }
        }

        function deleteStock(code){
          var data = {};
          data.code = code;
          var r = confirm("确定删除？");
          if(r == true){
            $.ajax({
              'url':'control/deleteStock.php',
              'type':'post',
              'dataType':'json',
              'data':data,
              'success':function(ret){
                if(ret.flag){
                  alert("删除成功");
                  window.location.href = "index.php";
                }else{
                  alert(ret.msg);
                  return false;
                }
              },
              'error':function(){
                alert("删除失败，网络异常请稍后再试");
                return false;
              },
            });
          }else{
            return false;
          }
        }

      </script>

  </body>
</html>
