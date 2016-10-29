 <nav class="navbar navbar-inverse navbar-embossed" role="navigation">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <a class="navbar-brand" href="#">股票预警</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-01">
              <ul class="nav navbar-nav navbar-left">
                <!-- <li><a href="#fakelink">添加股票<span class="navbar-unread">1</span></a></li> -->
                <!-- <li class="dropdown">
                  <a href="addstock.php" class="dropdown-toggle" data-toggle="dropdown">addstock <b class="caret"></b></a>
                  <span class="dropdown-arrow"></span>
                  <ul class="dropdown-menu">
                    <li><a href="addstock.php">addstock</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </li> -->
                <!-- <li><a href="#fakelink">About Us</a></li> -->
               

               
               <li class="dropdown" style="position:fixed;right:2px;">
                  <a href="addstock.php" class="dropdown-toggle" data-toggle="dropdown"><?php echo $g_user['mail'];?> <b class="caret"></b></a>
                  <span class="dropdown-arrow"></span>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo GURL_ROOT.'login.php?action=out' ?>">登出</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->
       <!-- /row -->