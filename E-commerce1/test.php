
<?php
 require_once'core/init.php';
 ob_start();
 include "includes/head.php";
   include "includes/navigation.php";
 $dhor='';
if (isset($_GET['order'])) {
   			 $order_id = $_GET['order'];
   			$dhor = $order_id;

   		}else{
   			$order_id ='';
   		}

 			

   //$sql = "SELECT * FROM Products WHERE categories  = '$cat_id' ";
   		$sql = "SELECT * FROM products WHERE id = '$dhor' ";
   		$result = $db->query($sql);
		$product = mysqli_fetch_assoc($result);
		//echo $dhor;
		//echo'<br>';
		
		//echo $sizestring = $product['sizes'];
		$sizestring = $product['sizes'];

		//echo'<br>';
	     $sizestring = rtrim($sizestring,',');
	     $size_array = explode(',', $sizestring);
	    $a='';
 		$b='';	


 ?>
 <!DOCTYPE html>
 <html>
 <body>
 
 

<div id="totaltest" style="width:100%; margin:2%; margin-left: 10%;">

 						
								<h2 class="col-sm-10" >Product name: <span style="color: green">"<?= $product['title'];?>"</span> and Price for each is BDT/= <span style="color: green"><?= $product['price'];?> only</span></h2>
								<div><br></div>
								<br>
								<?php //echo $dhor;
									//echo '<br>';
									$a = $product['title'];
									$b =  $product['price'];
									//echo $a;
									//echo '<br>';
									//echo $b;
									echo'<br>';

									echo '<h4 style="color:green;background-color:white;padding:5px; width:70%;"> Available size for your product= " '. $sizestring.' "</h4>';
								?>
					
							<br>


<?php

              
               		$c_quantity ='';
					$size='';
					$c_name='';
					$c_phone='';
					$c_address='';
					$c_email='';
					$c_password='';
					$c_password2='';
					$a='';
					$b='';
					$parts='';
					$tprice=0;

				if (isset($_POST['sub'])) {
					$a = $product['title'];
					$b =  $product['price'];
					$c_quantity =$_POST['c_quantity'];
					$c_name =$_POST['c_name'];
					$size =$_POST['size'];
					$c_phone =$_POST['c_phone'];
					$c_address =$_POST['c_address'];
					$c_email =$_POST['c_email'];
					$c_password =$_POST['c_password'];
					$c_password2 =$_POST['c_password2'];

					if ( $_POST['c_quantity']!='' && $_POST['c_name']!='' && $_POST['c_phone']!='' && $_POST['c_address']!='' && $_POST['c_email']!='' && $_POST['c_password']!='' && $_POST['c_password2']!='' && $_POST['size']){

						print_r($size);
						echo '<br>';
						$parts = 0;
						$parts = explode(',',$size);
						print_r($parts);
						echo'<br>';
						echo 'available='.(int)$parts[1];
						

						echo '<br>';
						echo 'quantity='.(int)$c_quantity;

						
						echo'<hr>';
						if ($c_quantity*5 > $parts[1]*5) {
							echo 'sorry we dont have'.$c_quantity.' pieces of product of '. $parts[0].' size. we have only '. $parts[1];
							echo '<hr>';
						}
						else if ($c_password != $c_password2) {
							echo "your reference key does not match";
							echo '<hr>';
						}
						else{
							/*
						echo '<hr>';



						echo "ok go ahead new size";
						echo'<br>';
						
						echo 'quantity='.$c_quantity;
						echo'<br>';
						echo 'size='. $size;
						echo'<br>';
						
						echo 'customer name='.$c_name ;
						echo'<br>';
						echo 'customer mobile='.$c_phone ;
						echo'<br>';
						echo 'customer address='.$c_address ;
						echo'<br>';
						echo 'customer email='.$c_email ;
						echo'<br>';
						echo 'customer 1st password'.$c_password ;
						echo'<br>';
						echo 'customer 2nd password='.$c_password2 ;
						echo '<br>';
						echo 'product name='.$a;
						echo '<br>';
						echo 'each product price='.$b;
						echo '<br>';

						$tprice = $c_quantity*$b;

						echo 'total product price='.$tprice;
						echo '<br>';

						*/
							/*$db->query("INSERT INTO users (full_name,email,password,permissions) VALUES ('$name','$email','$confirm','$permissions')");
				$_SESSION['success_flash'] = 'User has been added';
				header('Location: users.php');*/

							$tprice = $c_quantity*$b;


						$db->query("INSERT INTO `product_order` (`name`, `phone`, `email`, `address`, `password`, `product_id`, `product_title`, `size`, `quantity`, `each_price`, `total_price`) VALUES ('$c_name', '$c_phone', '$c_email', '$c_address', '$c_password2', '$dhor', '$a', '$size', '$c_quantity', '$b', '$tprice')");

							$_SESSION['success_flash'] = 'Your order is successfully done';
							header('Location: orderconfirmation.php?order='.$dhor);
							ob_end_flush();
						


						
					}
					 
					}
					else
							echo '<p class="bg-danger" style="width:70%; color:red;">you have to fill up all the data </p>';

					}
				
 ?>

 						<div id="fromtake">
							<form action="test.php?order=<?=$product['id'];?>" method="post" enctype="multipart/form-data">

						    	<div class="form-group col-sm-5">
										<lebel for="quantity">Quantity:</lebel>
										<input type="number" class="form-control" id="c_quantity" name="c_quantity" min="0"> 
								</div>
									<div class="form-group col-sm-5">
									<label for="size">Select your size</label>
									<select name="size" id="size" class="form-control">
										<option value=""></option>
										<?php 
										foreach ($size_array as $key => $string) {
										$string_array = explode(':',$string);
										$size = $string_array[0];
										$available = $string_array[1];
											echo '<option value=" '.$size.','.$available.' " data-available=" '.$available.' ">'.$size.' </option>';
											
										} ?>
									</select>

								</div>
						    	<div class="form-group col-sm-5">
								    <label for="c_name">Name: </label>
								    <input type="text" class="form-control"  name="c_name"  placeholder="Enter your name">
								    <small id="c_name" class="form-text text-muted">We'll never share your name with anyone else.</small>
								  </div>
								  <div class="form-group col-sm-5">
								    <label for="c_phone">Phone</label>
								    <input type="text" class="form-control"  name="c_phone"  placeholder="Enter your phone">
								    <small id="c_phone" class="form-text text-muted">We'll never share your phone number with anyone else.</small>
								  </div>
								  <div class="form-group col-sm-5">
								    <label for="c_address">Home address</label>
								    <input type="text" class="form-control"  name="c_address"  placeholder="Please give your current address to get the product">
								    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
								  </div>
								  <div class="form-group col-sm-5">
								    <label for="c_email">Email address</label>
								    <input type="text" class="form-control"  name="c_email"  placeholder="Enter your email">
								    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
								  </div>
								  <div class="form-group col-sm-5">
								    <label for="c_password">Password or reference key</label>
								    <input type="password" class="form-control"  name="c_password" placeholder=" Password or reference key">
								  </div>
								  <div class="form-group col-sm-5">
								    <label for="c_password2">Confirm password or reference key</label>
								    <input type="password" class="form-control" name="c_password2" placeholder="confirm your password or reference key">
								  </div>
								  <div class="form-group col-sm-5">
								    <input style="width: 50%;" type="submit" name="sub" value="Order for buy">
								 </div>
							</form>
						</div>
</div>	

</body>
 </html>

					