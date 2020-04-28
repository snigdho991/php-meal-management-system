<?php include '../classes/Member.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (!Session::get('role') == '0'){
        Session::destroy();
    }
?>

<?php
    $mbr = new Member();
    if(isset($_GET['delmngr'])){
        $id = preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['delmngr']);
        $delAd = $mbr->delAdminById($id);
    }
?>

<div id="page-wrapper" >
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
        <div class="right">
        <ul class="list-group">
            <li class="list-group-item"><h4>All Managers</h4></li>
        </ul>
        </div> 
        </div>
    </div>
<?php
    if(isset($delAd)){
        echo $delAd;
    }
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
    $getmanager = $mbr->onlyManagers();
    if($getmanager){
        $i = 0;
        while($result = $getmanager->fetch_assoc()){
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
                    <a onclick="" class="btn btn-xs btn-primary">Edit</a> 
                    <b>||</b> <a onclick="return confirm('Are You Sure To Delete ?')" href="?delmngr=<?php echo $result['adminId']; ?>" class="btn btn-xs btn-danger">Remove</a>
                </td>
            </tr>
<?php } } ?>            
        </tbody>
    </table>
</div>
</div>

<?php include 'inc/footer.php'; ?>