<?php
 	$sql = "SELECT * FROM  categories WHERE parent = 0";
 	$pquery = $db->query ($sql);
?>

<nav class="navbar navbar-expand-lg navbar-default navbar-fixed-top bg-dark" style="background-color: #2e4053; padding: .5%;  border-radius: 15px; margin:0;">
	<div class="container-fluid">
    	<div class="navbar-header">
      		<a class="navbar-brand" href="index.php" style="background-color: #8a99b0; color: #b4e35b; border-radius: 55%; margin-right: 20px;">projects ecommerce</a>
	      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse">
		        	<span class="sr-only">Toggle navigation</span>
		        	<div class="loader"></div>
		        	<span style="color: white;">Menu</span>
	      		</button>
    	</div>
    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse">
      		<ul class="nav navbar-nav">
      		<?php while ($parent = mysqli_fetch_assoc($pquery)) :?>
      			<?php 
      				$parent_id = $parent['id']; 
      				$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id' ";
      				$cquery = $db->query($sql2);
      			?>
      			<!-- hover-->
      			<style>
      				ul li:hover { 
 					 background-color: #CACFD2;
					}
      			</style>
      			<!-- menu items -->
        		<li class="dropdown">
					<a href="#" class="dropdown-toggole" data-toggle="dropdown" style="color:  #ca6f1e ;"><?php echo $parent['category']; ?><span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
					<?php while( $child = mysqli_fetch_assoc($cquery) ): ?>	
						<li><a href="category.php?cat=<?=$child['id'];?>" style="color: #2e4053;"><?php echo $child['category']; ?></a></li>
					<?php endwhile; ?>	
					</ul>
				</li>
			<?php endwhile; ?>
       		</ul>
       			<ul class="nav navbar-nav navbar-right">
                   <button class="btn btn-warning"> <a href="contact.php" style="color: black ;"> Connect with us</a> </button>
                 </ul>
       			<!--
		      	<ul class="nav navbar-nav navbar-right">
		          
		        <button type="button" class="btn btn-success">Log in</button>
		        <button type="button" class="btn btn-success">Sign up</button>
		        <button type="button" class="btn btn-danger">Log Out</button>
		      	</ul> 
		      	--> 
   		</div>
  </div>
</nav>