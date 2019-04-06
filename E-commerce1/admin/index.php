<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/tutorial/core/init.php';
	include 'includes/head.php';
	include 'includes/navigation.php'; 
	//echo $_SESSION['SBUser'];

	if (!is_logged_in()) {
		header('Location: login.php');
	}

	//session_destroy();
?>

<body>
<div id="page show" class="col-md-8"  style=" margin: 10%; ">
	<p style="font-size: 30px; color: black; border:solid 2px green; text-align: center;"> Hi this is admin index page , admins are strating their job from here. </p>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</body>


