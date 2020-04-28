<?php include '../classes/Member.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php
    if(!isset($_GET['member']) || $_GET['member'] == NULL){
        echo "<script>window.location = 'error.php'; </script>";
    } else {
        $id = $_GET['member'];
    }
?>

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

    <div class="panel panel-info">
<?php
	$query = "SELECT * FROM tbl_member WHERE username = '$id'";
	$result = $db->select($query);
	if($result){
		while ($value = $result->fetch_assoc()) {
?>
        <div class="panel-heading">
            Bazar History of <b><?php echo $value['username']; ?></b>
        </div>
<?php } } ?>
        <div class="panel-body">          

<?php
	$query = "SELECT member, COUNT(member) AS tot1 FROM tbl_expense WHERE member = '$id'";
	$results = $db->select($query);
    if($results){
        while($result = $results->fetch_assoc()){
		$sum1 = $result['tot1'];
	   } 
    }

    $query = "SELECT username, COUNT(username) AS tot2 FROM tbl_expense WHERE username = '$id'";
    $results = $db->select($query);
    if($results){
        while($result = $results->fetch_assoc()){
        $sum2 = $result['tot2'];
       } 
    } 
?>



<h3 style="text-align: center;">
    <?php 
        $now = new \DateTime('now');
        $month = $now->format('F');
        $year = $now->format('Y'); 
    ?>
    Bazar in <?php echo $month; ?> (<?php echo $year; ?>) : <b><?php
        $sum = $sum1 + $sum2;
        echo $sum;
    ?></b>
</h3>
                        
        </div>

        <div class="panel-footer text-center">
            Be happy for this moment. This moment is your life.
        </div>
    </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>