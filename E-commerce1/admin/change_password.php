<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/tutorial/core/init.php';

	if (!is_logged_in()) {
		login_error_redirect();
	}
	include 'includes/head.php';
	//include 'includes/navigation.php';

	/*$password = 'password' ;
	$hashed = password_hash($password, PASSWORD_DEFAULT);
	echo $hashed;*/
	$hashed = $user_data['password'];
	$old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
	$old_password = trim($old_password);

	$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
	$password = trim($password);
	$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
	$confirm = trim($confirm);
	//$hashed = password_hash($password, PASSWORD_DEFAULT);

	//$new_hashed = password_hash($password, PASSWORD_DEFAULT);
	$new_hashed = $hashed;
	$user_id = $user_data['id'];
	$errors = array();
?>

<div id="login-form">
	<div>
		<?php 
			if ($_POST) {
				//form validation
				if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])) 
				{
					$errors[]='You must fill out all field';
				}
				
				//password security...more than 6 characters

				if (strlen($password) < 6) {
					$errors[] ='Password must be at least 6 characters';
				}

				///user exist ?! if exist...in our database

				//if new pasword matches confirm
				if ($password != $confirm) {
					$errors[] = 'The new password and confirm new pasword does not match';
				}


				///apatoto ami hash algo charai kaj ta kore zacchi.....
				if ($old_password != $hashed) {
					$errors[] = 'Your old password does not match our records';
				}

				/*if ekhane kintu sathe sathe ager kajti kore zacchi..... becareful about that. (!password_verify($old_password,$hashed )) {
					$errors[] = 'Your old password does not match our records ';
				}*/


				//check errors

				if (!empty($errors)) 
				{
					echo display_errors($errors);
				}else{
					//change password

					$db->query("UPDATE users SET password = '$confirm' WHERE id='$user_id'  ");
					$_SESSION['success_flash'] = 'Your password has been updated';
					header('Location: index.php');
					///ei logik ta purapuri new kore deya hoise .... ami ekhane ze pasword ta confim kortesi sei password tai new kore database pathaisi... zodiO age md5 algo kore eta kaj korto ...so ... set password = $new_hashed hoite hobe
				}
			}
		?>
	</div>
	<h2 class="text-center" style="background-color:  #5D6D7E;border-radius: 5px;padding:2%;">Change Password</h2><hr>
	<form action="change_password.php" method="post" style="background-color: none;">
		<div class="form-group">
			<label for="old_password">Old Password</label>
			<input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
		</div>
		<div class="form-group">
			<label for="password">New Password</label>
			<input type="password" name="password" class="form-control" value="<?=$password;?>">
		</div>
		<div class="form-group">
			<label for="confirm">Confirm New Password</label>
			<input type="password" name="confirm" class="form-control" id="confirm" value="<?=$confirm;?>">
		</div>
		<div class="form-group">
			<a href="index.php" class="btn btn-warning">Cancel</a>
			<input type="submit" value="Login" class="btn btn-primary" style="background-color: #5D6D7E;">
		</div>
	</form>
	<p class="text-right"><a href="/tutorial/index.php" alt="home" class="btn btn-success" style="background-color: #5D6D7E;">Visit Site</a></p>
</div>


<?php
 include 'includes/footer.php' 
 ?>


 <!-- cockies is stored in clients side computer // session is stored on server side computer// session has no expired time but cockies has the expired time // session is closed when browser is closed -->