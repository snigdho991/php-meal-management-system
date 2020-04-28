<?php
    include '../classes/Adminlogin.php';
    
    $al = new Adminlogin();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $adminUser = $_POST['adminUser'];
        $adminPass = md5($_POST['adminPass']);

        $loginChk = $al->adminLogin($adminUser, $adminPass);
    }
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Manager Panel</title>
    <link rel="stylesheet" type="text/css" href="assets/css/stylelogin.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" media="screen" />
</head>
    
<body style="background: #DCDDDF;
    color: #000;
    font: 14px Arial;
    margin: 0 auto;
    padding: 0;
    position: relative;">
<div class="container">
  <section id="content">
<?php
  if (isset($loginChk)){
    echo $loginChk;
  }
?>
    <form action="" method="post">
      <h1>Manager Login</h1>
    
      <div>
        <input type="text" style="width: 92%;" placeholder="Username" name="adminUser"/>
      </div>
      <div>
        <input type="password" style="width: 92%;" placeholder="Password" name="adminPass"/>
      </div>
      <div>
        <input type="submit" value="Log in" />
      </div>
    </form><!-- form -->
    <div class="button">
      <a href="mailto:Snigdho2011@gmail.com">&copy; Snigdho 2018</a>
    </div><!-- button -->
  </section><!-- content -->
</div><!-- container -->
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>