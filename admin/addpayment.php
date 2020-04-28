<?php include '../classes/Member.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    $mbr = new Member(); 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertPay = $mbr->paymentInsert($_POST);
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
    if(isset($insertPay)){
        echo $insertPay;
    }
?>
        <div class="panel-heading">
            Add New Payment
        </div>

        <div class="panel-body">            
            <form action="" method="post">
                
                <div class="form-group">
                    <label for="payment">Payable Amount (Tk)</label>
                    <input type="number" name="payment" class="form-control">
                </div>

                <div class="form-group">
                    <label for="memberId">Select a Member</label>
                    <select class="form-control" id="" name="memberId">
<?php
    $getmember = $mbr->getAllMember();
    if($getmember){
        while ($result = $getmember->fetch_assoc()){
?>
                        <option value="<?php echo $result['memberId']; ?>"><?php echo $result['username']; ?></option>
<?php } } ?>
                    </select>
                </div>

                <div class="form-group text-center">
                    <input class="btn btn-success" style="padding: 8px 72px;" type="submit" name="submit" value="Add Payment" />
                </div>

            </form>
        </div>

        <div class="panel-footer text-center">
            Be happy for this moment. This moment is your life.
        </div>
    </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>