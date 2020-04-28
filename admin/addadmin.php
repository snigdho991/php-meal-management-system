<?php include '../classes/Member.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (!Session::get('role') == '0'){
        Session::destroy();
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

<?php
    $mbr = new Member(); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertAdmin = $mbr->appointAdmin($_POST);
    }
?>

<div class="panel panel-info">
<?php
    if(isset($insertAdmin)){
        echo $insertAdmin;
    }
?>
        <div class="panel-heading">
            Add New Admin
        </div>

        <div class="panel-body">            
            <form action="" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="title">Name</label> ★
                    <input type="text" name="adminName" class="form-control">
                </div>

                <div class="form-group">
                    <label for="title">Username</label> ★
                    <input type="text" name="adminUser" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label> ★
                    <input type="text" name="adminEmail" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password</label> ★
                    <input type="text" name="adminPass" class="form-control">
                </div>

                <div class="form-group">
                    <label for="contact">Contact No.</label>
                    <input type="text" name="adminContact" class="form-control">
                </div>

                <div class="form-group">
                    <label for="institution">Assign Role</label> ★
                    <select class="form-control" id="role" name="role">
                        <option>Select Role</option>
                        <option value="1">Manager</option>
                        <option value="2">Co-Manager</option>
                        <option value="3">Superviser</option>
                    </select>
                </div>

                <div class="form-group text-center">
                    <input class="btn btn-success" style="padding: 8px 72px;" type="submit" name="submit" Value="Add Admin" />
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