<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="right">
                     <h3>ADMIN DASHBOARD</h3>
                    </div>
                    <div class="left" style="float: right; margin-top: -43px;">
                     Welcome back, <img src="assets/img/img-profile.jpg" style="" /> <b><?php echo Session::get('adminName') ?></b><br>
                     Logged in as <b>Manager</b>
                    </div> 
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <div class="col-lg-12 ">
<?php 
  $loginmsg = Session::get("loginmsg");
  if(isset($loginmsg)){
    echo $loginmsg;
  }
  Session::set("loginmsg", NULL);
?> 
                    </div>
                    </div>
                  <!-- /. ROW  --> 
                            <div class="row text-center pad-top">
                  
                       
                    </div>
          </div>
                  <!-- /. ROW  --> 
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
<?php
    include 'inc/footer.php';
?>
