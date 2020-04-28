<?php
    include '../classes/Member.php';
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

<?php
    date_default_timezone_set('Asia/Dhaka');
    error_reporting(0);

    $dt = $_GET['dt'];
    $mbr = new Member();
    $curr_date = date('d F Y');
    $current_date = date('Y-m-d');

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ok'])){
        echo "<script>window.location = 'mealhistory.php'; </script>";
    }
?>

<style type="text/css">
.custom-radios div {
  display: inline-block;
}
.custom-radios input[type="radio"] {
  display: none;
}
.custom-radios input[type="radio"] + label {
  color: #333;
  font-family: Arial, sans-serif;
  font-size: 14px;
}
.custom-radios input[type="radio"] + label span {
  display: inline-block;
  width: 40px;
  height: 40px;
  margin: -1px 4px 0 0;
  vertical-align: middle;
  cursor: pointer;
  border-radius: 50%;
  border: 2px solid #FFFFFF;
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
  background-repeat: no-repeat;
  background-position: center;
  text-align: center;
  line-height: 44px;
}
.custom-radios input[type="radio"] + label span img {
  opacity: 0;
  transition: all .3s ease;
}
.custom-radios input[type="radio"]#color-1 + label span {
  background-color: #2ecc71;
}
.custom-radios input[type="radio"]#color-2 + label span {
  background-color: #3498db;
}
.custom-radios input[type="radio"]#color-3 + label span {
  background-color: #f1c40f;
}
.custom-radios input[type="radio"]#color-4 + label span {
  background-color: #e74c3c;
}
.custom-radios input[type="radio"]:checked + label span {
  opacity: 1;
  background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg) center center no-repeat;
  width: 40px;
  height: 40px;
  display: inline-block;

}
</style>


        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h3>Administrator Zone</h3>
                     <div class="left" style="float: right; margin-top: -43px;">
                     Welcome back, <img src="assets/img/img-profile.jpg" style="" /> <b><?php echo Session::get('adminName') ?></b><br>
                     Logged in as <b>Administrator</b>
                    </div>   
                    </div>
                
                </div>              

                <div class="panel panel-primary">
                    <div class="panel-heading text-center" style="font-size: 20px;">
                        Previous Meals
                    </div>
                <div class="panel-body">

                    <div class="well text-center" style="font-size: 22px;">
                        Date : <b><?php $date = date('d F Y', strtotime($dt)); 
                                  echo $date;
                        ?></b>
                    </div>
                    
                <form action="" method="post">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10%">Serial</th>
                                <th width="30%">Member's Name</th>
                                <th width="60%">Select Meal</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    $getdata = $mbr->getAllByDate($dt);
    if($getdata){
        $i = 0;
        while ($result = $getdata->fetch_assoc()) {
            $i++;
?>                           
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['username']; ?></td>

                                <td>
                                    <div class="pretty p-default p-round p-thick">
                                        <input onclick="javascript: return false;" type="radio" name="meal[<?php echo $result['memberId']; ?>]" value="0.0" <?php if($result['meal'] == '0.0'){echo "checked";} ?>>
                                        <div class="state p-primary-o">
                                            <label>0</label>
                                        </div>
                                    </div>


                                    <div class="pretty p-default p-round p-thick">
                                        <input onclick="javascript: return false;" type="radio" name="meal[<?php echo $result['memberId']; ?>]" value="0.5" <?php if($result['meal'] == '0.5'){echo "checked";} ?>>
                                        <div class="state p-primary-o">
                                            <label>0.5</label>
                                        </div>
                                    </div>


                                    <div class="pretty p-default p-round p-thick">
                                        <input onclick="javascript: return false;" type="radio" name="meal[<?php echo $result['memberId']; ?>]" value="1.0" <?php if($result['meal'] == '1.0'){echo "checked";} ?>>
                                        <div class="state p-primary-o">
                                            <label>1</label>
                                        </div>
                                    </div>

                                    <div class="pretty p-default p-round p-thick">
                                        <input onclick="javascript: return false;" type="radio" name="meal[<?php echo $result['memberId']; ?>]" value="1.5" <?php if($result['meal'] == '1.5'){echo "checked";} ?>>
                                        <div class="state p-primary-o">
                                            <label>1.5</label>
                                        </div>
                                    </div>

                                    <div class="pretty p-default p-round p-thick">
                                        <input onclick="javascript: return false;" type="radio" name="meal[<?php echo $result['memberId']; ?>]" value="2.0" <?php if($result['meal'] == '2.0'){echo "checked";} ?>>
                                        <div class="state p-primary-o">
                                            <label>2</label>
                                        </div>
                                    </div>

                                    <div class="pretty p-default p-round p-thick">
                                        <input onclick="javascript: return false;" type="radio" name="meal[<?php echo $result['memberId']; ?>]" value="2.5" <?php if($result['meal'] == '2.5'){echo "checked";} ?>>
                                        <div class="state p-primary-o">
                                            <label>2.5</label>
                                        </div>
                                    </div>

                                    <div class="pretty p-default p-round p-thick">
                                        <input onclick="javascript: return false;" type="radio" name="meal[<?php echo $result['memberId']; ?>]" value="3.0" <?php if($result['meal'] == '3.0'){echo "checked";} ?>>
                                        <div class="state p-primary-o">
                                            <label>3</label>
                                        </div>
                                    </div>

                                    <div class="pretty p-default p-round p-thick">
                                        <input onclick="javascript: return false;" type="radio" name="meal[<?php echo $result['memberId']; ?>]" value="3.5" <?php if($result['meal'] == '3.5'){echo "checked";} ?>>
                                        <div class="state p-primary-o">
                                            <label>3.5</label>
                                        </div>
                                    </div>

                                    <div class="pretty p-default p-round p-thick">
                                        <input onclick="javascript: return false;" type="radio" name="meal[<?php echo $result['memberId']; ?>]" value="4.0" <?php if($result['meal'] == '4.0'){echo "checked";} ?>>
                                        <div class="state p-primary-o">
                                            <label>4</label>
                                        </div>
                                    </div>

                                    <div class="pretty p-default p-round p-thick">
                                        <input onclick="javascript: return false;" type="radio" name="meal[<?php echo $result['memberId']; ?>]" value="4.5" <?php if($result['meal'] == '4.5'){echo "checked";} ?>>
                                        <div class="state p-primary-o">
                                            <label>4.5</label>
                                        </div>
                                    </div>

                                    <div class="pretty p-default p-round p-thick">
                                        <input onclick="javascript: return false;" type="radio" name="meal[<?php echo $result['memberId']; ?>]" value="5.0" <?php if($result['meal'] == '5.0'){echo "checked";} ?>>
                                        <div class="state p-primary-o">
                                            <label>5</label>
                                        </div>
                                    </div>

                                </td>                               
                            </tr>
<?php } } ?>                           
                        </tbody>
                    </table>
                    <div class="form-group text-center">
                        <input class="btn btn-success" style="padding: 8px 72px;" type="submit" name="ok" value="OK" />
                    </div>                    
                </form>
                    
                </div>
                <div class="panel-footer text-center">
                    Be happy for this moment. This moment is your life.
                </div>
                </div>
                    
            </div>
             <!-- /. PAGE INNER  -->
        </div>
         <!-- /. PAGE WRAPPER  -->
<?php
    include 'inc/footer.php';
?>