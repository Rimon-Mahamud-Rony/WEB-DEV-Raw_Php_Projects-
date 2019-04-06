<?php include ('rheader.php'); ?>
<?php include('lserv.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="lsty.css">
  <link rel="stylesheet" type="text/css" href="mycss.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="llogin.php">
  	<?php include('lerrors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="lregister.php">Sign up</a>
  	</p>
  </form>
</body>
<?php include ('myfot.php'); ?>
</html>