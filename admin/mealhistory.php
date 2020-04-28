<?php
    include '../classes/Member.php';
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

<?php
    error_reporting(0);
    $mbr = new Member();
    $curr_date = date('d F Y');
    $current_date = date('Y-m-d');
    $date = date('F', strtotime($current_date));
?>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h3>Administrator Zone</h3>
                     <div class="left" style="float: right; margin-top: -43px;">
                     Welcome back, <img src="assets/img/img-profile.jpg" style="" /> <b><?php echo Session::get('adminName') ?></b><br>
                     Logged in as <b>Administrator</b>
                     </div>   
                    </div>                
                </div>              

                <div class="panel panel-primary">
                    <div class="panel-heading text-center" style="font-size: 20px;">
                        Meal History
                    </div>
                <div class="panel-body">

                    <div class="well text-center" style="font-size: 22px;">
                        This Month : <b><?php echo $date; ?></b>
                    </div>
                    
                <form action="" method="post">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="20%">Serial</th>
                                <th width="40%">Date ( YYYY-MM-DD )</th>
                                <th width="30%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    $getdata = $mbr->getMealHistory();
    if($getdata){
        $i = 0;
        while ($value = $getdata->fetch_assoc()) {
            $i++;
?>                           
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><button class="btn btn-default btn-sm"><b><?php echo $value['meal_time']; ?></b></button></td>
                                <td>
                                  <a class="btn btn-info btn-xs" href="viewmeal.php?dt=<?php echo $value['meal_time']; ?>">View</a> <b>||</b> 
                                  <a class="btn btn-success btn-xs" href="datewisemeal.php?dt=<?php echo $value['meal_time']; ?>">Update</a>
                                </td>                               
                            </tr>
<?php } } ?>                           
                        </tbody>
                    </table>                    
                </form>
                    
                </div>
                <div class="panel-footer text-center">
                    Be happy for this moment. This moment is your life.
                </div>
                </div>
                    
            </div>
             <!-- /. PAGE INNER  -->
        </div>
         <!-- /. PAGE WRAPPER  -->
<?php
    include 'inc/footer.php';
?>