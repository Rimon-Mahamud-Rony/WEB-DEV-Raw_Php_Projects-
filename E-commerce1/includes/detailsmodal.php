<?php
     require_once'../core/init.php';
	$id = $_POST['id'];
	$id = (int)$id;
	$sql = "SELECT * FROM products WHERE id = '$id' ";
	$result = $db->query($sql);
	$product = mysqli_fetch_assoc($result);
	$brand_id = $product['brand'];
	$sql = "SELECT brand FROM brand WHERE id = '$brand_id' ";
	$brand_query = $db->query($sql);
	$brand = mysqli_fetch_assoc($brand_query);
	$sizestring = $product['sizes'];
	$sizestring = rtrim($sizestring,',');
	$size_array = explode(',', $sizestring);

	/////////////////////////


?>


<!-- details light Box -->
<?php
	ob_start(); 
?>

<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" onclick="closeModal()" aria-label="close">
				<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-center"><?= $product['title'];?></h4>
			</div>



			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<span id="modal_errors" class="btn-danger"></span>
						<div class="col-sm-6">
							<div class="center-block">
								<img src="<?= $product['image'];?> " alt=" <?= $product['title'];?> " class="details img-responsive">
							</div>
						</div>
						<div class="col-sm-6" style="border-left: .5px solid black;">
							<h4>Details</h4>
							<p> <?= nl2br($product['description']); ?> </p>
							<hr>
							<p style="color: #008000; font-size: 20px;"><b>Price: BDT/= <?= $product['price'];?>(&#2547;) </b></p>
							<p>Brand: <?= $brand['brand'];?></p>
							<form action="add_cart.php" method="post" id="add_product_form">
								<input type="hidden" name="product_id" value="<?=$id;?>">
								<input type="hidden" name="available" id="available" value="">
								<!--
								<div class="form-group">
									<div class="col-xs-3">
										<lebel for="quantity">Quantity:</lebel>
										<input type="number" class="form-control" id="quantity" name="quantity" min="0"> 
									</div>
									<div class="col-xs-9"></div>
								</div>
							-->
								<br>
								<br>
								<div class="form-group">
									<label for="size">See the available size</label>
									<select name="size" id="size" class="form-control">
										<option value=""></option>
										<?php foreach ($size_array as $key => $string) {
											
										$string_array = explode(':',$string);
										$size = $string_array[0];
										$available = $string_array[1];
											echo '<option value=" '.$size.'" data-available=" '.$available.' ">'.$size.' ('.$available.' pieces are Available)</option>';
										} ?>
									</select>
								</div>
				 		</div>
			   		</div>
				</div>
			</div>
				<div class="modal-footer">
					
					<!--
					<button class="btn btn-warning" onclick="add_to_cart(); return false;"><span class="glyphicon glyphicon-shopping-cart"></span> Add To cart</button>
					<hr>
					<h3 class="text-center" style="background-color:#9F9898; color: green;">If you want to bye it please click the order</h3>
				-->
					<a href="test.php?order=<?=$product['id'];?>" style="color: #2e4053;"><button type="button" class="btn btn-sm btn-success">Order this product</button></a>
					<button class="btn btn-danger" onclick="closeModal()">Close</button>
					
<!---------------------------------start the order -------------------------------------------------start the order----------------------------------------------------------------------------------

						<div data-toggle="collapse" data-target="#anotherdiv" class="text-center">
							<a href="order.php"></a><button class="btn btn-primary btn-lg" style="width: 20%;">Order</button>
						</div>

					</div>	


 -------------------------Order and add cart -----------------------------------------order and cart----------------------------------------------------order & cart------------------------------
					
				
						<div id="anotherdiv" class="collapse" class="text-center" class="form-group" style="margin: 10%; background-color:#A97575; border-radius: 5px;">
							<br>
							<div class="form-group col-sm-10">
								<b><p>Product name: "<?= $product['title'];?>" and Price for each is BDT/= <?= $product['price'];?> </p></b>
								<hr>
							</div>
							------------ order confirmation php code start--------------------------------------------order onfirmation php code start-------------------------------------------->

               <!-------------- order confirmation php code end--------------------------------------------order onfirmation php code end------------------------------------------------
						    <form action="" method="post" enctype="multipart/form-data">
						    	<div class="form-group col-sm-10">
										<lebel for="quantity">Quantity:</lebel>
										<input type="number" class="form-control" id="c_quantity" name="quantity" min="0"> 
								</div>
									<div class="form-group col-sm-10">
									<label for="size">Select your size</label>
									<select name="size" id="size" class="form-control">
										<option value=""></option>
										<?php foreach ($size_array as $key => $string) {
											
										$string_array = explode(':',$string);
										$size = $string_array[0];
										$available = $string_array[1];
											echo '<option value=" '.$size.'" data-available=" '.$available.' ">'.$size.'</option>';

										} ?>
									</select>
								</div>
						    	<div class="form-group col-sm-10">
								    <label for="c_name">Name: </label>
								    <input type="text" class="form-control"  name="c_name"  placeholder="Enter your name">
								    <small id="c_name" class="form-text text-muted">We'll never share your name with anyone else.</small>
								  </div>
								  <div class="form-group col-sm-10">
								    <label for="c_phone">Phone</label>
								    <input type="text" class="form-control"  name="c_phone"  placeholder="Enter your phone">
								    <small id="c_phone" class="form-text text-muted">We'll never share your phone number with anyone else.</small>
								  </div>
								  <div class="form-group col-sm-10">
								    <label for="c_address">Home address</label>
								    <input type="text" class="form-control"  name="c_address"  placeholder="Please give your current address to get the product">
								    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
								  </div>
								  <div class="form-group col-sm-10">
								    <label for="c_email">Email address</label>
								    <input type="text" class="form-control"  name="c_email"  placeholder="Enter your email">
								    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
								  </div>
								  <div class="form-group col-sm-10">
								    <label for="c_password">Password or reference key</label>
								    <input type="password" class="form-control"  name="c_password" placeholder=" Password or reference key">
								  </div>
								  <div class="form-group col-sm-10">
								    <label for="c_password2">Confirm password or reference key</label>
								    <input type="password" class="form-control" name="c_password2" placeholder="confirm your password or reference key">
								  </div><br>
								  <input type="submit" name="sub" value="submit">
								  <br>
							</form>
							

						</div>
-------------------------------end the order -------------------------------------------------end the order------------------------------------------------------------------------------------>


	    </div>
	    <br>
	    			  
	</div>

</div>
<script>

	jQuery('#size').change(function(){
		var available = jQuery('#size option:selected').data("available");
		jQuery('#available').val(available);
	});


	function closeModal(){
		jQuery('#details-modal').modal('hide');
		setTimeout(function(){
			jQuery('#details-modal').remove();
			jQuery('.modal-backdrop').remove();
		},20);

	}
</script>

<?php
	echo ob_get_clean();
?>