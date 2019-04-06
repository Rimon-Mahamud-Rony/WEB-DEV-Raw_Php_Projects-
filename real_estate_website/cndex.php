<?php include ('rheader.php'); ?>
<?php include ('cnewserv.php');

  //fetch the records to be updated
    if (isset($_GET['edit'])) {
    	$id = $_GET['edit'];
        $edit_state =true;
    	$rec = mysqli_query($db , "SELECT * FROM info WHERE id = $id");
    	$record = mysqli_fetch_array($rec);
    	$name = $record['name'];
    	$address = $record ['address'];
    	$mobile = $record ['mobile'];
    	$psn = $record ['psn'];
    	$id = $record['id'];
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
	<link rel="stylesheet" type="text/css" href="cstl.css">
</head>
<body>
	<marquee behavior=scroll direction="left" scrollamount="6"> <po2 style="background-color: #253856; color: white;text-align: center; ">To buy your desire place you have to fill up these important form, without that we cant sell our product to you.... আপনার কাঙ্খিত জায়গা ক্রয় করার জন্য আপনাকে অবশ্যই নিম্নের গুরুত্বপূর্ণ তথ্য দিয়ে ফর্ম পূরন করতে হবে । নতুবা , আমরা কোন ভাবেই আপনার নিকট পণ্য বিক্রি করতে পারবোনা ।  </po2> </marquee>

<?php if (isset($_SESSION['msg'])): ?>	
	<div class="msg">
		<?php 
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
		?>
	</div>
<?php endif ?>
	<table>
		<thead style="background-color:gray; color:white; text-align: left;">
			<tr><th style="width: 6%;border-right: solid .2px white;">Confirmation no.</th>
				<th style="width: 12%;border-right: solid .2px white;">Name</th>
				<th style="width: 15%;border-right: solid .2px white;">Adress</th>
				<th style="width: 11%;border-right: solid .2px white;">Mobile</th>
				<th style="width: 12%;border-right: solid .2px white;">Your desire place serial no.</th>
				<th colspan="2" style="width: 16%;border-right: solid .2px white;">Action</th>
				<th style="width: 40%;">Booking decision</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($results)) { ?>
			<tr style="text-align: center;">
				<td><?php echo $row['id'] ;?></td>
				<td><?php echo $row['name'] ;?></td>
				<td><?php echo $row['address'];?></td>
				<td><?php echo $row['mobile'];?></td>
				<td><?php echo $row['psn'];?></td>
				<td>
					<a class="edit_btn" href="cndex.php?edit=<?php echo $row['id']; ?>">Edit</a>
				</td>
				<td>
				<a class="del_btn" href="cnewserv.php?del=<?php echo $row['id']; ?>">Delete</a>
				</td>
				<td>
				<p>I am going to buy the place&nbsp;&nbsp;<br><a href="llogin.php"><button style="background-color: green; color: white; font-size: 120%;">Yes</button></a> &nbsp;&nbsp;/ &nbsp;&nbsp;<a href="mainhomepage.php"><button style="background-color: green; color: white; font-size: 120%;">NO 
				</button> </a></p>
				</td>
			</tr>


			<?php } ?>

			
		</tbody>



	</table>


	<form method="post" action="cnewserv.php" style="text-align: center; font-size: 100%;">
	<input type="hidden" name="id" value="<?php echo $id; ?>"> 
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="name"value="<?php echo $name; ?>">
		</div>
		<div class="input-group">
			<label>Address</label>
			<input type="text" name="address"value="<?php echo $address; ?>">
		</div>
		<div class="input-group">
			<label>Mobile/Telephone</label>
			<input type="text" name="mobile" value="<?php echo $mobile; ?>">
		</div>
		<div class="input-group">
			<label>Your desire place/hotel serial no.</label>
			<input type="text" name="psn" placeholder="please enter your desire place/hotel serial no" value="<?php echo $psn; ?>">
		</div>
		<div class="input-group">
			<?php if ($edit_state == false): ?>
			 <button type="submit" name="save" class="btn">Save</button>
			<?php else: ?>
			<button type="submit" name="update" class="btn">Update</button> 
			<?php endif ?>
			
		</div>
	</form>

</body>

<?php include ('myfot.php'); ?>
</html>