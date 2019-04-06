<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/tutorial/core/init.php';
	include 'includes/head.php';
	include 'includes/navigation.php'; 
	//echo $_SESSION['SBUser'];

	if (!is_logged_in()) {
		login_error_redirect();
	}
	if (!has_permission('admin')) {
		permission_error_redirect('index.php') ;
	}

	if (isset($_GET['delete'])) {
		$delete_id = sanitize($_GET['delete']);
		$db->query("DELETE FROM users WHERE id ='$delete_id' ");
		$_SESSION['success_flash'] = 'User has been deleted';
		header('Location: users.php');
	}

	if (isset($_GET['add'])) {
		$name =((isset($_POST['name']))?sanitize($_POST['name']):'');
		$email =((isset($_POST['email']))?sanitize($_POST['email']):'');
		$password =((isset($_POST['password']))?sanitize($_POST['password']):'');
		$confirm =((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
		$permissions =((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
		$errors = array();

		/////////////////////

		if ($_POST) {

			$emailQuery = $db->query("SELECT *FROM users WHERE email = '$email' ");

			$emailCount = mysqli_num_rows($emailQuery); //email er jonno kotota row exist kortese..

			if ($emailCount != 0) {
				$errors[] = 'That email is already exist in our database.'; 
			}

			$required = array('name','email','password','confirm','permissions');
			foreach ($required as $f) {
				if (empty($_POST[$f])) {
					$errors[] = 'You must fill out all the fields.';
					break;
				}
			}
			//password 6..
			if (strlen($password) < 6) {
				$errors[] = 'Your password must be at least 6 characters';
			}


			//password matching 

			if ($password != $confirm) {
				$errors[] = 'Your password do not match';
			}

			/// email validation

			if (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
				$errors[] = 'Please enter a valid email';
			}
			if (!empty($errors)) {
				echo display_errors($errors);
			}else{
				//add user to database //kono error na thakle kebol data database e zabe .. zoto skill person e query koruk na keno
				//$hashed = password_hash($password,PASSWORD_DEFAULT);
				//$db->query("INSERT INTO users (full_name,email,password,permissions) VALUES ('$name','$email','$hased','$permissions')");


				$db->query("INSERT INTO users (full_name,email,password,permissions) VALUES ('$name','$email','$confirm','$permissions')");
				$_SESSION['success_flash'] = 'User has been added';
				header('Location: users.php');
			}
		}

	 ?> 
	 	<style>
			body{
				margin:1%;
				}
		</style>

	 <h2 class="text-center">Add A New User</h2><hr>
	 <form action="users.php?add=1" method="post" style="width: 50%; margin-left:25%;">
	 	<div class="form-group ">
	 		<label for="name">Full name:</label>
	 		<input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
	 	</div>
	 	<div class="form-group ">
	 		<label for="email">Email:</label>
	 		<input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">
	 	</div>
	 	<div class="form-group ">
	 		<label for="password">Password:</label>
	 		<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
	 	</div>
	 	<div class="form-group ">
	 		<label for="confirm">Confirm Password:</label>
	 		<input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
	 	</div>
	 	<div class="form-group ">
	 		<label for="name">Permissions:</label>
	 		<select class="form-control" name="permissions">
	 			<option value="" <?= (($permissions == '')?' selected':'') ;?>> </option>
	 			<option value="editor" <?= (($permissions == 'editor')?' selected':'') ;?>>Editor </option>
	 			<option value="admin,editor" <?= (($permissions == 'admin,editor')?' selected':'') ;?>> Admin</option>

	 		</select>
	 		<br>
	 		<div class="form-group ">
	 			<a href="users.php" class="btn btn-warning">Cancel</a>
	 			<input type="submit" value="Add User" class="btn btn-primary">
	 		</div>
	 	</div>
	 </form>

	 <?php
		
	}else{



	$userQuery = $db->query("SELECT *FROM users ORDER BY full_name");
?>
<style>
	body{
		margin:1%;
	}
</style>

 <h2 class="text-center">Users</h2>
 <a href="users.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add New User</a>
 <hr>
 <table class="table table-border table-striped table-condensed">
 	<thead><th></th><th>Name</th><th>Email</th><th>Join Date</th><th>Last Login</th><th>Permissions</th></thead>
 	<tbody>
 		<?php while($user =mysqli_fetch_assoc($userQuery)): ?>
	 		<tr>
	 			<td>
	 				<?php if($user['id'] != $user_data['id']): ?>
	 					<a href="users.php?delete=<?=$user['id'];?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span>DELETE?</a>
	 				<?php endif;?>
	 			</td>
	 			<td><?=$user['full_name'];?></td>
	 			<td><?=$user['email'];?></td>
	 			<td><?=pretty_date($user['join_date']);?></td>
	 			<td><?=(($user['last_login']== '0000-00-00 00:00:00')?'Never':pretty_date($user['last_login']));?></td>
	 			<td><?=$user['permissions'];?></td>
	 		</tr>
 		<?php endwhile; ?>
 	</tbody>
 	
 </table>
<?php } include 'includes/footer.php' ?>


<!-- ei page e user update er kaj ta kora hoy ni pore somoy kore add korbo --->