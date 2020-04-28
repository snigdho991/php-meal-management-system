<?php include '../classes/Member.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div id="page-wrapper" >
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
        <div class="right">
         <ul class="list-group">
  <li class="list-group-item"><h4>All Members</h4></li>
  </ul>
        </div> 
        </div>
    </div>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Email</th>
                <th>Contact No.</th>
                <th>Institution</th>
                <th>Department</th>
                <th>Home Town</th>
                <th>Blood Group</th>
                <th>About</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php
    $fm = new Format();
    $mbr = new Member(); 
    $getmember = $mbr->getAllMember();
    if($getmember){
        $i = 0;
        while($result = $getmember->fetch_assoc()){
            $i++;
?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $result['username']; ?></td>
                <td><?php echo $result['email']; ?></td>
                <td><?php echo $result['contact']; ?></td>
                <td><?php if ($result['institution'] == '0'){
                            echo "<b>MBSTU</b>";
                        } elseif ($result['institution'] == '1'){
                            echo "<b>Others</b>";
                        } ?>                            
                </td>
                <td><?php echo $result['department']; ?></td>
                <td><?php echo $result['hometown']; ?></td>
                <td><?php echo $result['blood']; ?></td>
                <td><?php echo $fm->textShorten($result['about'], 25); ?></td>
                <td><a href="" class="btn btn-xs btn-primary">Edit</a> <b>||</b>
                    <a href="" class="btn btn-xs btn-danger">Delete</a></td>
            </tr>
<?php } } ?>            
        </tbody>
    </table>
</div>
</div>

<?php include 'inc/footer.php'; ?>