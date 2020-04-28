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
    error_reporting(0);
    $mbr = new Member(); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertExp = $mbr->expenseInsert($_POST);
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
    if(isset($insertExp)){
        echo $insertExp;
    }
?>
        <div class="panel-heading">
            Add New Expense
        </div>

        <div class="panel-body">            
            <form action="" method="post">

                <div class="form-group">
                    <label for="member">Select orginal Member</label>
                    <select class="form-control" id="" name="member">
<?php
    $getmember = $mbr->getAllMember();
    if($getmember){
        while ($result = $getmember->fetch_assoc()){
?>
                        <option value="<?php echo $result['username']; ?>"><?php echo $result['username']; ?></option>
<?php } } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="username">Select additional Member </label> (optional)
                    <select class="form-control" id="" name="username">
                    <option value="none">None</option>
<?php
    $getmember = $mbr->getAllMember();
    if($getmember){
        while ($result = $getmember->fetch_assoc()){
?>
                        <option value="<?php echo $result['username']; ?>"><?php echo $result['username']; ?></option>
<?php } } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="budget">Expenses (Tk)</label>
                    <input type="number" name="expense" class="form-control">
                </div>

                <div class="form-group">
                    <label for="about">Bill receipt </label> (optional)
                    <textarea name="receipt" placeholder="e.g. Demo(1kg) - 250 Tk" id="about" cols="5" rows="6" class="form-control"></textarea>
                </div>

                <div class="form-group"> <!-- Date input -->
                    <label class="control-label" for="date">Select Date</label>
                    <input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text"/>
                </div>

                <div class="form-group text-center">
                    <input class="btn btn-success" style="padding: 8px 72px;" type="submit" name="submit" value="Add Expense"/>
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