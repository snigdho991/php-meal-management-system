<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

<style type="text/css">


</style>

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

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                      <a href="current.php" >
 <i class="fa fa-circle-o-notch fa-5x fa-spin"></i>
                      <h4>Current Status</h4>
                      </a>
                    </div>                    
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                      <a href="adminpanel.php" >
 <i class="fa fa-key fa-5x"></i>
                      <h4>Admin Panel</h4>
                      </a>
                    </div>                    
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="addadmin.php" >
 <i class="fa fa-lightbulb-o fa-5x"></i>
                      <h4>Appoint Admin</h4>
                      </a>
                  </div>                    
                </div>
                
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="addmember.php" >
 <i class="fa fa-user fa-5x"></i>
                      <h4>Add Member</h4>
                      </a>
                      </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="memberslist.php" >
 <i class="fa fa-users fa-5x"></i>
                      <h4>All Members</h4>
                      </a>
                      </div>                     
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="addpayment.php" >
 <i class="fa fa-credit-card fa-5x"></i>
                      <h4>Add Payment</h4>
                      </a>
                      </div>                                          
                </div> 

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="payments.php" >
 <i class="fa fa-clipboard fa-5x"></i>
                      <h4>All Payment</h4>
                      </a>
                      </div>                                          
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="managers.php" >
 <i class="fa fa-refresh fa-5x"></i>
                      <h4>Managers</h4>
                      </a>
                      </div>                                          
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="comanagers.php" >
 <i class="fa fa-dot-circle-o fa-5x"></i>
                      <h4>Co-Managers</h4>
                      </a>
                      </div>                                          
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="supervisers.php" >
 <i class="fa fa-clipboard fa-5x"></i>
                      <h4>Supervisers</h4>
                      </a>
                      </div>                                          
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="addbazar.php" >
 <i class="fa fa-wechat fa-5x"></i>
                      <h4>Add Bazar</h4>
                      </a>
                      </div>                                          
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="bazarslist.php" >
 <i class="fa fa-envelope-o fa-5x"></i>
                      <h4>Bazar List</h4>
                      </a>
                      </div>                    
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="addexpense.php" >
 <i class="fa fa-plus-square fa-5x"></i>
                      <h4>Add Expenses</h4>
                      </a>
                      </div>                    
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="expenselist.php" >
 <i class="fa fa-copy fa-5x"></i>
                      <h4>All Expenses</h4>
                      </a>
                      </div>                    
                </div>


                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="dailymeal.php" >
 <i class="fa fa-edit fa-5x"></i>
                      <h4>Submit Meal</h4>
                      </a>
                      </div>                    
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="mealhistory.php" >
 <i class="fa fa-file-text-o fa-5x"></i>
                      <h4>Meal History</h4>
                      </a>
                      </div>                    
                </div>

            </div> 
                 <!-- /. ROW  -->   
                  <div class="row">
                    <div class="col-lg-12 ">
                    <br/>
                        <div class="alert alert-warning">
                             <strong>Want More Icons Free ? </strong> Checkout fontawesome website and use any icon <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Click Here</a>.
                        </div>
                       
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
