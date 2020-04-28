<?php include '../classes/Member.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

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
    /* if(isset($delAd)){
        echo $delAd;
    } */
?>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Contact No.</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php
    $mbr = new Member(); 
    $getadmin = $mbr->adminPanel();
    if($getadmin){
        $i = 0;
        while($result = $getadmin->fetch_assoc()){
            $i++;
?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $result['adminName']; ?></td>
                <td><?php echo $result['adminUser']; ?></td>
                <td><?php echo $result['adminEmail']; ?></td>
                <td><?php echo $result['adminContact']; ?></td>
                <td><?php if ($result['role'] == '0'){
                            echo "<b>Administrator</b>";
                        } elseif ($result['role'] == '1'){
                            echo "<b>Manager</b>";
                        } elseif ($result['role'] == '2'){
                            echo "<b>Co-Manager</b>";
                        } elseif ($result['role'] == '3'){
                            echo "<b>Superviser</b>";
                        } ?>                            
                </td>
                <td>
<?php
    if (Session::get('adminId') == $result['adminId']){
?>
                    <a onclick="" href="?deladmin=<?php echo $result['adminId']; ?>" class="btn btn-xs btn-primary">Edit</a>
<?php } ?>
                </td>
            </tr>
<?php } } ?>            
        </tbody>
    </table>
    </div>
</div>

<?php include 'inc/footer.php'; ?>