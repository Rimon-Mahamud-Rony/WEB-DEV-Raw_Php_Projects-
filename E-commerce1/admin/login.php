<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/tutorial/core/init.php';
	include 'includes/head.php';
	//include 'includes/navigation.php';

	/*$password = 'password' ;
	$hashed = password_hash($password, PASSWORD_DEFAULT);
	echo $hashed;*/

	$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
	$email = trim($email);
	$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
	$password = trim($password);
	//$hashed = password_hash($password, PASSWORD_DEFAULT);
	$errors = array();
?>

<style>
	body{
		background-image: url("/tutorial/images/headerlogo/loginbgp.jpg");
		background-size: cover;
		background-repeat: no-repeat;
		background-attachment:fixed;

</style>
<div id="login-form">
	<div>
		<?php 
			if ($_POST) {
				//form validation
				if (empty($_POST['email']) || empty($_POST['email'])) 
				{
					$errors[]='You must provide email and password.';
				}
				//validate email

				if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
					$errors[] ='You must enter a valid email';
				}
				//password security...

				if (strlen($password) < 6) {
					$errors[] ='Password must be at least 6 characters';
				}

				///user exist ?! if exist...in our database

				$query = $db->query("SELECT *FROM users WHERE email = '$email' ");
				$user = mysqli_fetch_assoc($query);
				$userCount = mysqli_num_rows($query);
				//echo $userCount;

				if ($userCount < 1) {
					$errors[]='You have no email in our database or you are not registered with this email as: ' .$email;
				}
				if ($password != $user['password']) {
					$errors[] = 'The password does not match with the original password , please try again later.. ';
				}

				/*if (!password_verify($password,$user['password'] )) {
					$errors[] = 'The password does not match with the original password , please try again later.. ';
				}*/


				//check errors

				if (!empty($errors)) 
				{
					echo display_errors($errors);
				}else{
					// login user///hashed 
					$user_id =$user['id'];
					login($user_id); 
				}
			}
		?>
	</div>
	<h2 class="text-center" style="background-color:  #5D6D7E;border-radius: 5px;padding:2%;">Login</h2><hr>
	<form action="login.php" method="post" style="background-color: none;">
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" name="email" class="form-control" value="<?=$email;?>">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" class="form-control" value="<?=$password;?>">
		</div>
		<div class="form-group">
			<input type="submit" value="Login" class="btn btn-primary" style="background-color: #5D6D7E;">
		</div>
	</form>
	<p class="text-right"><a href="/tutorial/index.php" alt="home" class="btn btn-success" style="background-color: #5D6D7E;">Visit Site</a></p>
</div>


<?php
 include 'includes/footer.php' 
 ?>


 <!-- cockies is stored in clients side computer // session is stored on server side computer// session has no expired time but cockies has the expired time // session is closed when browser is closed -->