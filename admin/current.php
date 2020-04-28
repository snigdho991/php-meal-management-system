<?php include '../classes/Member.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="right">
                    <h3>Administrator Zone</h3>
                    </div>
                    <div class="left" style="float: right; margin-top: -43px;">
                     Welcome back, <img src="assets/img/img-profile.jpg" style="" /> <b><?php echo Session::get('adminName') ?></b><br>
                     Logged in as <b>Administrator</b>
                    </div> 
                    </div>
                </div>

    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            <b>Check Current Situation</b>
        </div>
        <div class="panel-body">

        
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <b>Cash in account</b>
                </div>
                <div class="panel-body">
<?php
    $mbr = new Member();
    $getuser = $mbr->getPaidUser();
    if($getuser){
        $sum = 0;
        while($result = $getuser->fetch_assoc()){
            $sum = $sum + $result['payment'];
        } 
    } 
?>
        <h5 style="text-align: center; font-size: 16px;">Total Paid : <b><?php global $sum; echo $sum; ?> Tk</b></h5> 
<?php
    $getexp = $mbr->getExpense();
    if($getexp){
        $sum1 = 0;
        while($result = $getexp->fetch_assoc()){
            $sum1 = $sum1 + $result['expense'];
        } 
    } 
?>
        <h5 style="text-align: center; font-size: 16px;">Total Expenses : <b><?php global $sum1; echo $sum1; ?> Tk</b></h5> 
                </div>
            <div class="panel-footer">
                <?php
                    if($sum >= $sum1){
                    $sub = $sum - $sum1;
                ?>
                   <h5 style="text-align: center; font-size: 18px;">Available Money : <b class="text-primary"><?php global $sub; echo $sub; ?> Tk</b></h5>
                <?php } elseif($sum < $sum1) { 
                    $sub = $sum1 - $sum;
                ?>
                    <h5 style="text-align: center; font-size: 18px;">Lack of Balance : <b class="text-danger"><?php global $sub; echo $sub; ?> Tk</b></h5>
                <?php } ?>
            </div>
            </div>
        </div>

        
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <b>Bazar Status</b>
                </div>
                <div class="panel-body">
<?php
    $query = "SELECT COUNT(*) AS sum3 FROM tbl_bazar";
    $results = $db->select($query);
    if($results){
        while ($value = $results->fetch_assoc()) {
            $sum2 = $value['sum3'];
        }
    }
?>
        <h5 style="text-align: center; font-size: 16px;">Predicted Bazar : <b><?php global $sum2; echo $sum2; ?></b></h5> 
<?php
    $query = "SELECT COUNT(*) AS sum2 FROM tbl_expense";
    $results = $db->select($query);
    if($results){
        while ($value = $results->fetch_assoc()) {
            $sum1 = $value['sum2'];
        }
    }
?>
        <h5 style="text-align: center; font-size: 16px;">Total Bazar Done : <b><?php global $sum1; echo $sum1; ?></b></h5> 
                </div>
            <div class="panel-footer">
                <?php
                    if($sum2 >= $sum1){
                    $sub = $sum2 - $sum1;
                ?>
                   <h5 style="text-align: center; font-size: 18px;">Available Bazar : <b class="text-primary"><?php global $sub; echo $sub; ?></b></h5>
                <?php } elseif($sum2 < $sum1) { 
                    $sub = $sum1 - $sum2;
                ?>
                    <h5 style="text-align: center; font-size: 18px;">Extra Bazar Done : <b class="text-danger"><?php global $sub; echo $sub; ?></b></h5>
                <?php } ?>
            </div>
            </div>
        </div>


        <div class="col-lg-4 col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <b>Balance Status</b>
                </div>
                <div class="panel-body">
<?php
    $fm = new Format();
    $getbzr = $mbr->getEstimatedBazar();
    if($getbzr){
        $sum = 0;
        while($result = $getbzr->fetch_assoc()){
            $sum = $sum + $result['budget'];
        } 
    } 
?>
        <h5 style="text-align: center; font-size: 16px;">Est. Budget : <b><?php global $sum; echo $sum; ?> Tk</b></h5> 

<?php
    $getexp = $mbr->getExpense();
    if($getexp){
        $sum1 = 0;
        while($result = $getexp->fetch_assoc()){
            $sum1 = $sum1 + $result['expense'];
        } 
    } 
?>
        <h5 style="text-align: center; font-size: 16px;">Total Expenses : <b><?php global $sum1; echo $sum1; ?> Tk</b></h5> 
                </div>
            <div class="panel-footer">
                <?php
                    if($sum >= $sum1){
                    $sub = $sum - $sum1;
                ?>
                   <h5 style="text-align: center; font-size: 18px;">Save Money : <b class="text-primary"><?php global $sub; echo $sub; ?> Tk</b></h5>
                <?php } elseif($sum < $sum1) { 
                    $sub = $sum1 - $sum;
                ?>
                    <h5 style="text-align: center; font-size: 18px;">Extra Money : <b class="text-danger"><?php global $sub; echo $sub; ?> Tk</b></h5>
                <?php } ?>
            </div>
            </div>
        </div>



        <div class="col-lg-4 col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <b>Meal Status</b>
                </div>
                <div class="panel-body">
<?php
    $fm = new Format();
    $getmeal = $mbr->getTotalMeal();
    if($getmeal){
        $meal = 0;
        while($result = $getmeal->fetch_assoc()){
            $meal = $meal + $result['meal'];
        } 
    } 
?>
        <h5 style="text-align: center; font-size: 16px;">Total Meal : <b><?php global $meal; echo $meal; ?></b></h5> 

<?php
    $query = "SELECT COUNT(*) AS sum3 FROM tbl_member";
    $results = $db->select($query);
    if($results){
        while ($value = $results->fetch_assoc()) {
            $member = $value['sum3'];
        }
    } 
?>
        <h5 style="text-align: center; font-size: 16px;">Total Member : <b><?php global $member; echo $member; ?></b></h5> 
                </div>
            <div class="panel-footer">
<?php
    $rate = $sum1/$meal;
?>

<h5 style="text-align: center; font-size: 18px;">Meal Rate : <b class="text-primary"><?php global $rate; echo number_format($rate, 3); ?></b></h5> 
            </div>
            </div>
        </div>


                        
        </div>

        <div class="panel-footer text-center">
            Be happy for this moment. This moment is your life.
        </div>
    </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>