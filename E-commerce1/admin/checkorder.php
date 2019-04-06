<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/tutorial/core/init.php';
	include 'includes/head.php';
	include 'includes/navigation.php'; 
	//echo $_SESSION['SBUser'];

	if (!is_logged_in()) {
		login_error_redirect();
	}


?>

<br>
<div id="checkorder" style="border:1px solid black; margin:.3%;">

<h3 style="margin-left: 1%; ">To know your deatils of all order , give your phone number , email and referencs key</h3><hr>
						
 							<form action="" method="post">
 								
								  <div class="form-group col-sm-6">
								    <label for="c_phone">Phone</label>
								    <input type="text" class="form-control"  name="c_phone"  placeholder="Enter your phone">
								    <small id="c_phone" class="form-text text-muted">We'll never share your phone number with anyone else.</small>
								 </div>
								 <div class="form-group col-sm-8">
								    <input style="width: 30%;" type="submit" name="sub" value="submit">
								 </div>
 							</form>
 							<hr class="col-sm-12 hr-primary" >
 							
 						

	<table class="table table-bordered" ">
		<tr style=" border-right:1px solid black; ">
			<td style="background-color: #154360; color: white;"><b>name</b></td>
			<td style="background-color: #154360; color: white;"><b>date</b></td>
			<td style="background-color: #154360; color: white;"><b>product_title</b></td>
			<td style="background-color: #154360; color: white;"><b>size</b></td>
			<td style="background-color: #154360; color: white;"><b>quantity</b></td>
			<td style="background-color: #154360; color: white;"><b>each price</b></td>
			<td style="background-color: #154360; color: white;"><b>total price</b></td>
			<td style="background-color: #154360; color: white;"><b>order no</b></td>
			<td style="background-color: #154360; color: white;"><b>product no</b></td>

		</tr>
	


<?php

	$c_phone=''; 

	if (isset($_POST['sub'])) {
					$c_phone =$_POST['c_phone'];

					$sql1 = $db->query("SELECT * FROM `product_order` WHERE phone='$c_phone' ORDER BY date");
					$var1=mysqli_fetch_assoc($sql1);
					$rowcount=mysqli_num_rows($sql1);
					//echo'<br>';
					
					echo'<h3 style="color:green;">for mobile no: =>'.$var1['phone'].'</h3>';

					if($var1['phone']!= $c_phone) {
							echo "you must enter a valid phone name";
							echo '<br>';
					}
					else{

						echo 'we have found total '.$rowcount.' records';

						foreach ($sql1 as $record1){

						echo '<tr>
							<td>'.$record1['name'].'</td>
							<td>'.$record1['date'].'</td>
							<td>'.$record1['product_title'].'</td>
							<td>'.$record1['size'].'</td>
							<td>'.$record1['quantity'].'</td>
							<td>'.$record1['each_price'].'</td>
							<td>'.$record1['total_price'].'</td>
							<td>'.$record1['id'].'</td>
							<td>'.$record1['product_id'].'</td>
						 </tr>';
						
 					/*echo ' name= '.$record1['name'];
 
 					echo ' date= '.$record1['date'];
 
 					echo ' product_title= '.$record1['product_title'];
 
 					echo ' size = '.$record1['size'];
 
 					echo ' quantity= '.$record1['quantity'];
 
 					echo ' each price= '.$record1['each_price'];
 
 					echo ' totalprice= '.$record1['total_price'];
  
 					echo ' order no= '.$record1['id'];

 					echo ' product_id= '.$record1['product_id'];*/

 				
  
 						}
 					}
 				}

 ?>
 </table>
 </div>

                      