<?php include ('rheader.php');?>
<?php include ('cnewserv.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="mycss.css">
</head>
<body>

	<?php $count=0 ?>
	<?php while ($row = mysqli_fetch_array($results)) { ?> 
		<?php $count = $count+1; ?>
		<div id="message">
			<strong><p style="color: yellow; font-size: 25px;"><?php echo $row['name']; ?>,Your booking confirmation no: <?php echo $row['id']; ?></p></strong> 
			<strong><p style="color: yellow;"> Date : <?php echo date("d.m.y"); ?> </p></strong> <br>

	Welcome <?php echo $row['name']; ?> you just select the palce , serial no: <?php echo $row['psn']; ?> . <br>
	We will send you the confirmation message and call on your mobile no: <?php echo $row['mobile']; ?> <br> Within 2 days we will send original copy of deeds to your home: <?php echo $row['address']; ?>. <br>
	Thank you for being with us!!
	<hr>
	If you have any kinds of confusion about your given information you can resubmission from <a href="cndex.php"><button style="background-color: green; color: white;">&nbsp;&nbsp;&nbsp;&nbsp;here&nbsp;&nbsp;&nbsp;&nbsp;</button></a> . 
	<hr>
	</div>

	<?php } ?>
	

</body>
<?php include ('myfot.php'); ?>
</html>