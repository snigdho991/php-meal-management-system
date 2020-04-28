<?php include '../classes/Member.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    $mbr = new Member();
    if(isset($_GET['delbazar'])){
        $id = preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['delbazar']);
        $delBzr = $mbr->delBazarById($id);
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
                <th>Members</th>
                <th>List</th>
                <th>Estimated Budget</th>
                <th>Est. Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php
    $fm = new Format();
    $getbzr = $mbr->getEstimatedBazar();
    if($getbzr){
        $i = 0;
        $sum = 0;
        while($result = $getbzr->fetch_assoc()){
            $i++;
?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $result['username']; ?></td>
                <td><a href="checkbazar.php?bazarid=<?php echo $result['id']; ?>" class="btn btn-xs btn-default"><?php echo $fm->textShorten($result['list'], 25); ?></a></td>
                <td><?php echo $result['budget']; ?> Tk</td>
                <td><button class="btn btn-xs btn-info"><?php echo $result['date']; ?></button></td>
                <td><a href="checkbazar.php?bazarid=<?php echo $result['id']; ?>" class="btn btn-xs btn-primary">Edit</a> <b>||</b> <a onclick="return confirm('Are You Sure To Delete ?')" href="?delbazar=<?php echo $result['id']; ?>" class="btn btn-xs btn-danger">Delete</a>
                </td>
            </tr>
    <?php $sum = $sum + $result['budget']; ?>
<?php } } ?>            
        </tbody>

<?php
    $query = "SELECT COUNT(*) AS sum3 FROM tbl_bazar";
    $results = $db->select($query);
    if($results){
        while ($value = $results->fetch_assoc()) {
            $sum2 = $value['sum3'];
        }
    }
?>

        <tfoot>
            <tr>
                <td style="text-align: center;" colspan="3">Estimated Bazar : <b><?php global $sum2; echo $sum2; ?></td>
                <td style="text-align: center;" colspan="3">Total Est. Budget : <b><?php global $sum; echo $sum; ?> Tk</b></td>
            </tr>
        </tfoot>
    </table>
</div>
</div>

<?php include 'inc/footer.php'; ?>