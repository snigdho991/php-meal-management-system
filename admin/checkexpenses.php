<?php include '../classes/Member.php'; ?>

<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<style type="text/css">
    /* Customize the label (the container) */
.container {
  display: block;
  position: relative;
  padding-left: 37px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 15px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>

<?php
    if(!isset($_GET['expenseid']) || $_GET['expenseid'] == NULL){
        echo "<script>window.location = 'error.php'; </script>";
    } else {
        $id = $_GET['expenseid'];
    }
?>

<?php
    error_reporting(0);
    $mbr = new Member(); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateExp = $mbr->expenseUpdate($_POST, $id);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ok'])){
        echo "<script>window.location = 'expenselist.php';</script>";
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
    if(isset($updateExp)){
        echo $updateExp;
    }
?>
        <div class="panel-heading">
            Check Expenses
        </div>

        <div class="panel-body">            
            <form action="" method="post">
<?php
    $mbr = new Member();
    $fm = new Format();
    $getExp = $mbr->getExpenseById($id);
    if($getExp){
        while($result = $getExp->fetch_assoc()){
?>
                <div class="form-group">
                    <label for="member">Orginal Member</label> ★ <br>
                    <select class="form-control" id="" name="member">
                        <?php
                            $query = "SELECT * FROM tbl_member";
                            $member = $db->select($query);
                            if($member){
                                while ($value = $member->fetch_assoc()) {
                        ?>

                            <option
                            <?php 
                                if ($result['member'] == $value['username']){ ?>
                                    selected="selected"
                            <?php } ?> value="<?php echo $value['username']; ?>"><?php echo $value['username']; ?>
                            </option>

                        <?php } } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="username">Additional Member</label> ★ <br>
                    <select class="form-control" id="" name="username">
                    <option value="none">None</option>
                        <?php
                            $query = "SELECT * FROM tbl_member";
                            $username = $db->select($query);
                            if($username){
                                while ($value = $username->fetch_assoc()) {
                        ?>

                            <option
                            <?php 
                                if ($result['username'] == $value['username']){ ?>
                                    selected="selected"
                            <?php } ?> value="<?php echo $value['username']; ?>"><?php echo $value['username']; ?>
                            </option>

                        <?php } } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="budget">Edit Expenses (Tk)</label> ★
                    <input type="number" name="expense" class="form-control" value="<?php echo $result['expense']; ?>">
                </div>

                <div class="form-group">
                    <label for="about">Edit Receipt</label>
                    <textarea name="list" id="about" cols="5" rows="6" class="form-control"><?php echo $result['receipt']; ?></textarea>
                </div>

                <div class="form-group"> <!-- Date input -->
                    <label class="control-label" for="date">Change Date</label> ★
                    <input class="form-control" value="<?php echo $result['date']; ?>" id="date" name="date" placeholder="MM/DD/YYYY" type="text"/>
                </div>

                <div class="form-group text-center">
                    <input class="btn btn-primary" style="padding: 8px 40px; margin: 10px;" type="submit" name="ok" value="Ok"/>
                    <input class="btn btn-success" style="padding: 8px 72px;" type="submit" name="submit" value="Edit Expense"/>
                </div>
<?php } } ?>
            </form>
        </div>

        <div class="alert alert-info">
             <strong>Want To Select/Change Members ? </strong> Simply copy the necessary details from here and add a <a target="_blank" href="addexpense.php">New Expense</a>.
        </div>

        <div class="panel-footer text-center">
            Be happy for this moment. This moment is your life.
        </div>
    </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>