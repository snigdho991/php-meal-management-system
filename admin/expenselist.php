<?php include '../classes/Member.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    $mbr = new Member();
    if(isset($_GET['delexpense'])){
        $id = preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['delexpense']);
        $delBzr = $mbr->delExpenseById($id);
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
    if(isset($delBzr)){
        echo $delBzr;
    }
?>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Main Member</th>
                <th>Add. Member</th>
                <th>Expense</th>
                <th>Receipt</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php
    $fm = new Format();
    $getexp = $mbr->getExpense();
    if($getexp){
        $i = 0;
        $sum = 0;
        while($result = $getexp->fetch_assoc()){
            $i++;
?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><a href="particularbazar.php?member=<?php echo $result['member']; ?>"><?php echo $result['member']; ?></a></td>
                <td><?php if ($result['username'] == 'none') {
                    echo $result['username'];
                } else {
                ?>
                    <a href="particularbazar.php?member=<?php echo $result['username']; ?>"><?php echo $result['username']; ?></a>
                <?php } ?>
                </td>
                <td><?php echo $result['expense']; ?> Tk</td>
                <td><a href="checkexpenses.php?expenseid=<?php echo $result['id']; ?>" class="btn btn-xs btn-default"><?php echo $fm->textShorten($result['receipt'], 25); ?></a></td>
                <td><button class="btn btn-xs btn-info"><?php echo $result['date']; ?></button></td>
                <td><a href="checkexpenses.php?expenseid=<?php echo $result['id']; ?>" class="btn btn-xs btn-primary">Edit</a> <b>||</b> <a onclick="return confirm('Are You Sure To Delete ?')" href="?delexpense=<?php echo $result['id']; ?>" class="btn btn-xs btn-danger">Delete</a>
                </td>
            </tr>
    <?php $sum = $sum + $result['expense']; ?>
<?php } } ?>            
        </tbody>
<?php
    $query = "SELECT COUNT(*) AS sum2 FROM tbl_expense";
    $results = $db->select($query);
    if($results){
        while ($value = $results->fetch_assoc()) {
            $sum1 = $value['sum2'];
        }
    }
?>
        <tfoot>
            <tr>
                <td style="text-align: center;" colspan="3">Total Bazar : <b><?php global $sum1; echo $sum1; ?></td>
                <td style="text-align: center;" colspan="4">Total Expense : <b><?php global $sum; echo $sum; ?> Tk</td>
            </tr>
        </tfoot>
    </table>
</div>
</div>

<?php include 'inc/footer.php'; ?>