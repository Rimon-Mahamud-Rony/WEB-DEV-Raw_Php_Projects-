<?php
   session_start(); 
//initialize variables
   $name = "";
   $address = "";
   $mobile = "";
   $psn = "";
   $id = 0;
   $edit_state = false;
//connect to database
 $db = mysqli_connect('localhost','root','','all'); 

//if save button is clicked
if (isset($_POST['save'])) {
	$name = $_POST['name'];
	$address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $psn = $_POST['psn'];

	$query = "INSERT INTO `info`( `name`, `address`,`mobile`,`psn` ) VALUES ('$name','$address','$mobile','$psn')";
	mysqli_query($db, $query);
	$_SESSION['msg'] ="Your address has saved, please check it at last line with confirmation no.";
	header('location: cndex.php');
}


//update
if (isset($_POST['update'])) {
	$name = mysql_real_escape_string($_POST['name']);
	$address = mysql_real_escape_string($_POST['address']);
	$mobile = mysql_real_escape_string($_POST['mobile']);
	$psn = mysql_real_escape_string($_POST['psn']);
	$id = mysql_real_escape_string($_POST['id']);

	mysqli_query($db, "UPDATE info SET name='$name',address ='$address',mobile ='$mobile',psn ='$psn'  WHERE id = $id" );
	$_SESSION['msg'] ="You just updated your data , please check it at the last line of showing data bars, and noted your confirmation no. to check your confirmation message after , clicking the yes button.";
	header('location: cndex.php');
}
 //delete records 
if (isset($_GET['del'])) {
	$id = $_GET['del'];

	mysqli_query($db, "DELETE  FROM info WHERE id = $id");
	$_SESSION['msg'] ="You just deleted your data ";
	header('location: cndex.php');

}

//retrive records

$results = mysqli_query($db,"SELECT * FROM info");

?>


