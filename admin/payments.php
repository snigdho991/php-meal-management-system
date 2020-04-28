<?php include '../classes/Member.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    $mbr = new Member();
    if(isset($_GET['delpayment'])){
        $id = preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['delpayment']);
        $delPay = $mbr->delPaymentById($id);
    }
?>

<div id="page-wrapper" >
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
        <div class="right">
        <ul class="list-group">
            <li class="list-group-item"><h4>Admin Panel</h4></li>
        </ul>
        </div> 
        </div>
    </div>
<?php
    if(isset($delPay)){
        echo $delPay;
    }
?>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Contact No.</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php
    $fm = new Format();
    $getuser = $mbr->getPaidUser();
    if($getuser){
        $i = 0;
        $sum = 0;
        while($result = $getuser->fetch_assoc()){
            $i++;
?>
            <tr>
                <td><?php echo $i; ?></td>
<?php
    $memberId = $result['memberId'];
    $getdata = $mbr->getUserDeatails($memberId);
    if($getdata){
        while ($value = $getdata->fetch_assoc()) {
?>
                <td><?php echo $value['username']; ?></td>
                <td><?php echo $value['contact']; ?></td>
<?php } } ?>
                <td><a href="memberwallet.php?walletid=<?php echo $result['memberId']; ?>"><?php echo $result['payment']; ?> Tk</a></td>
                <td><?php echo $fm->formatDate($result['date']); ?></td>
                <td><a onclick="return confirm('Are You Sure To Delete ?')" href="?delpayment=<?php echo $result['id']; ?>" class="btn btn-xs btn-danger">Delete</a></td>
            </tr>
    <?php $sum = $sum + $result['payment']; ?>
<?php } } ?>            
        </tbody>

        <tfoot>
            <tr>
                <td style="text-align: center;" colspan="6">Total Amount : <b><?php global $sum; echo $sum; ?> Tk</b></td>
            </tr>
        </tfoot>
    </table>
</div>
</div>

<?php include 'inc/footer.php'; ?>