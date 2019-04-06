<?php include ('rheader.php'); ?>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: llogin.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: llogin.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="lsty.css">
  <link rel="stylesheet" type="text/css" href="mycss.css">
</head>
<body>

<div class="header" style="width: 60%; height: 20%;">
  <h2>This is the log out page . </h2>
</div>
<div class="content" style="width: 60%;">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
      <p style="font-size: 130%;">Welcome <strong><?php echo $_SESSION['username']; ?></strong> Are you sure that you are going to log out from <strong>rimon's real_state</strong> ?</p><br>
      <p>Yes, I wanna <a href="lndex.php?logout='1'" style="color: red; font-size: 200%; margin-right: 40%;"> <button>logout</button></a> No, I dont. Keep me <a style="font-size: 200%;" href="mainhomepage.php" style="color: red;"> <button>Login</button></a></p>
    <?php endif ?>
</div>
    <?php include ('myfot.php'); ?>
</body>
</html>
