<?php
	require_once 'core/init.php';

	//require_once 'config.php'; //eivabe thakle purota kaj kore
   include "includes/head.php";
   include "includes/navigation.php";

   		if (isset($_GET['cat'])) {
   			$cat_id = sanitize($_GET['cat']);
   		}else{
   			$cat_id ='';
   		}

   $sql = "SELECT * FROM Products WHERE categories  = '$cat_id' ";
   $productQ = $db->query($sql);
   $category = get_category($cat_id);
   //var_dump($category);
?>
<style>
	#headerWrapper{
	position: relative;
	padding: 0;
	margin: 0;
	/*overflow: hidden;*/
	height: 200px;
	background-image: url("/tutorial/images/headerlogo/sifat.png");
	background-size: 100% 200px;
	background-repeat: no-repeat;
	background-position: top center;
	margin-bottom: -25px; 
	}
</style>

<div id="headerWrapper">
	<marquee><p class="fixed-bottom" style="font-size: 25px;">Thank you for visiting our site , for any query you can call us: 01862117112 or email us: rimonronycste11@gmail.com</p></marquee>
</div>
<br>
<div class="container-fluid" style="background-color: white;">
	<!--left side bar -->
	<?php
		include "includes/leftbar.php";
	?>

	<!-- main content -->
	<div class="col-md-8">
		<div class="row" style="text-align: center;">
			<h2 class="text-center" style="color: black;">Corner of : <?= $category['parent'].' '.$category['child'];?></h2><hr>
			<?php while($product = mysqli_fetch_assoc($productQ)): ?>
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
