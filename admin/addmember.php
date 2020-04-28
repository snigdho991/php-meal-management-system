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
        $insertMbr = $mbr->memberInsert($_POST,$_FILES);
    }
?>

<div class="panel panel-info">
<?php
    if(isset($insertMbr)){
        echo $insertMbr;
    }
?>
        <div class="panel-heading">
            Create New Member
        </div>

        <div class="panel-body">         
            <form action="" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="title">Username</label> ★
                    <input type="text" name="username" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label> ★
                    <input type="text" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password</label> ★
                    <input type="text" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="image">Featured Image</label> ★
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-group">
                    <label for="contact">Contact No.</label>
                    <input type="text" name="contact" class="form-control">
                </div>

                <div class="form-group">
                    <label for="institution">Institution</label> ★
                    <select class="form-control" id="institution" name="institution">
                        <option>Select Institution</option>
                        <option value="0">Mbstu</option>
                        <option value="1">Others</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="department">Department</label>
                    <input type="text" name="department" class="form-control">
                </div>

                <div class="form-group">
                    <label for="hometown">Home Town</label>
                    <input type="text" name="hometown" class="form-control">
                </div>

                <div class="form-group">
                    <label for="blood">Blood Group</label>
                    <input type="text" name="blood" class="form-control">
                </div>

                <div class="form-group">
                    <label for="about">About</label>
                    <textarea name="about" id="about" cols="5" rows="6" class="form-control"></textarea>
                </div>

                <div class="form-group text-center">
                    <input class="btn btn-success" style="padding: 8px 72px;" type="submit" name="submit" Value="Create User" />
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