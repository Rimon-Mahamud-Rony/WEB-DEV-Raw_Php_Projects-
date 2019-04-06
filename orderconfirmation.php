<?php
 require_once'core/init.php';
  include "includes/head.php";
   include "includes/navigation.php";
 $dhor='';
if (isset($_GET['order'])) {
   			 $order_id = $_GET['order'];
   			$dhor = $order_id;

   		}else{
   			$order_id ='';
   		}
 ?>
  <?php //echo $dhor;?>
  <div id="confirm" style="margin-left: 7%; margin-right: 7%;">
 <h3>Your ordered product name: "<?php
 		$s= $db->query("SELECT * FROM `products` WHERE id = '$dhor' ");
 		$r  = mysqli_fetch_assoc($s);
  echo $r['title']; 
  ?>" <a href="payment.php"><button class="btn btn-primary btn-lg"> Yes I want to buy it with payment</button></a> <a href="index.php"><button class="btn btn-warning btn-lg"> No , wait..</button></a></h3>
  <img src="<?=$r['image'];?>"> 
  <hr>
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
 		$s= $db->query("SELECT * FROM `products` WHERE id = '$dhor' ");
 		$r  = mysqli_fetch_assoc($s);
 		//echo $r['title'];
 	$c_email='';
	$c_phone=''; 
	$c_password2='';
	if (isset($_POST['sub'])) {
					$c_email =$_POST['c_email'];
					$c_phone =$_POST['c_phone'];
					$c_password2 =$_POST['c_password2'];

					$sql1 = $db->query("SELECT * FROM `product_order` WHERE email='$c_email' && phone='$c_phone' && password='$c_password2' ORDER BY date DESC");
					//$record1  = mysqli_fetch_assoc($sql1);
					$var1=mysqli_fetch_assoc($sql1);
					$rowcount=mysqli_num_rows($sql1);
					//echo'<br>';
					
					echo'<h3 style="color:green;">for mobile no: =>'.$var1['phone']. ' with email:'.$var1['email'].'</h3><hr>';
					echo '<br>';

					if ($var1['email'] != $c_email ) {
						echo '<p class="bg-danger" style="color:red;">your email is not correct</p>';
						echo '<br>';
					}
					if($var1['phone']!= $c_phone) {
							echo '<p class="bg-danger" style="color:red;">You must enter a valid phone number</p>';
							echo '<br>';
					}
					else{
						echo '<p class="bg-danger" style="color:red;">we have found total '.$rowcount.' records</p>';
						foreach ($sql1 as $record1){

 					/*echo $record1['name'];
 					echo '<br>';
 					echo '<hr>';
 					echo $record1['date'];
 					echo '<br>';
 					echo '<hr>';
 					echo $record1['product_title'];
 					echo '<br>';
 					echo '<hr>';
 					echo $record1['size'];
 					echo '<br>';
 					echo '<hr>';
 					echo $record1['quantity'];
 					echo '<br>';
 					echo '<hr>';
 					echo $record1['each_price'];
 					echo '<br>';
 					echo '<hr>';
 					echo $record1['total_price'];
 					echo '<br>';
 					echo '<hr>'; 
 					echo $record1['id'];
 					echo '<br>';
 					echo '<hr>'; */

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
						}


 						}
 				}

 ?>
</table>
 
 						<hr>
                      <h4>It is important to give us your email , phone and reference key to know your product details: </h4><hr>
                      <div id="jomform" style="width: 60%; margin-left: 10%;">
 							<form action="" method="post">
 								<div class="form-group col-sm-8">
								    <label for="c_email">Email </label>
								    <input type="text" class="form-control"  name="c_email"  placeholder="Enter your email">
								    
								  </div>
								  <div class="form-group col-sm-8">
								    <label for="c_phone">Phone</label>
								    <input type="text" class="form-control"  name="c_phone"  placeholder="Enter your phone">
								 </div>
								 <div class="form-group col-sm-8">
								    <label for="c_password2">Password or reference key</label>
								    <input type="password" class="form-control"  name="c_password2" placeholder=" Password or reference key">
								  </div>
								  <div class="form-group col-sm-8">
								    <input style="width: 50%;" type="submit" name="sub" value="Check your data">
								 </div>
 							</form>
 						</div>



</div>