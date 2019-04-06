<?php
	require_once 'core/init.php';
	//require_once 'config.php'; //eivabe thakle purota kaj kore
   include "includes/head.php";
   include "includes/navigation.php";
   $sql = "SELECT * FROM Products WHERE featured = '1' ";
   $featured = $db->query($sql);
?>

<div id="headerWrapper">

	<div  id="female"></div>
	<div  id="male"></div>
</div>


						<div id="showimage-1" style="width:80%; height:50%; text-align: center; margin-left: 10%; right: 10%; margin-top:-30%;position: absolute; ">
							<marquee behavior="scroll" direction="left" scrollamount="12">

							<pwel>Welcome to project e commerce official website</pwel>

							</marquee >

							<img name="slide" style="width: 70%; height: 100%; border-radius: -20%;" />

							<script>
							var i = 0;      // Start Point
							//var images = [];
							var images = ["images/headerlogo/lopo.png","images/headerlogo/lopo.png","images/products/expic (1).jpg","images/products/expic (2).jpg","images/products/expic (3).jpg","images/products/expic (4).jpg","images/products/expic (5).jpg",];
							  // Images Array
							var time = 2000;  // Time Between Switch
							// Change Image
							function changeImg(){
							  document.slide.src = images[i];
							  // Check If Index Is Under Max
							  if(i < images.length - 1){
							    // Add 1 to Index
							    i++;
							  } else {
							    // Reset Back To O
							    i = 0;
							  }

							  // Run function every x seconds
							  setTimeout("changeImg()", time);
							}
							// Run function when page loads
							window.onload=changeImg;
							</script>
						</div>
							<br>
							<br>

<div class="container-fluid" style="background-color: gray;">
	<!--left side bar -->
	<?php
		include "includes/leftbar.php";
	?>

	<!-- main content -->
	<div class="col-md-8" >
		<div class="row" style="text-align: center;">
			<h2 class="text-center">Feature Products </h2>
			<?php while($product = mysqli_fetch_assoc($featured)): ?>
				<!-- <?php //var_dump($product); ?> -->
				<div class="col-md-3" style="border: solid 1px black;">
					<h4><?php echo $product['title']; ?></h4><hr>
					<img src="<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>" class="img-thumb"/>
					<p class="list-price text-danger">List price: <s>tk/=<?php echo $product['list_price']; ?></s></p>
					<p class="price"> Our price: tk/=<?php echo $product['price']; ?></p>
					<?php echo $product['id'];?>
					<button type="button" class="btn btn-sm btn-default" onclick="detailsmodal(<?= $product['id']; ?>)">Details</button>
					<br>
					<br>
					<a href="test.php?order=<?=$product['id'];?>" style="color: #2e4053;"><button type="button" class="btn btn-sm btn-success">Order this product</button></a>
					
					<br>
					<br>
				</div>
			<?php endwhile; ?>
            <!--------->

			<!-- copy -->
		</div>
	</div>

	<!-- right side bar -->

	<?php
		include "includes/rightbar.php";
	?>

<!--details modal-->

<!-- footer -->
   <?php
		include "includes/footer.php";
	?>
