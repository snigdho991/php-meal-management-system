<?php include '../classes/Member.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php
    if(!isset($_GET['walletid']) || $_GET['walletid'] == NULL){
        echo "<script>window.location = 'error.php'; </script>";
    } else {
        $id = $_GET['walletid'];
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
	$query = "SELECT * FROM tbl_member WHERE memberId='$id'";
	$result = $db->select($query);
	if($result){
		while ($value = $result->fetch_assoc()) {
?>
        <div class="panel-heading">
            Wallet of <b><?php echo $value['username']; ?></b>
        </div>
<?php } } ?>
        <div class="panel-body">          

<?php
	$query = "SELECT SUM(payment) FROM tbl_payment WHERE memberId='$id'";
	$results = $db->select($query);
	foreach ($results as $result) {
?>
	<h3 style="text-align: center;">Total Paid Amount : <b><?php
		echo $result['SUM(payment)'];
	?> Tk</b>
	</h3>
<?php } ?>
                        
        </div>

        <div class="panel-footer text-center">
            Be happy for this moment. This moment is your life.
        </div>
    </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>