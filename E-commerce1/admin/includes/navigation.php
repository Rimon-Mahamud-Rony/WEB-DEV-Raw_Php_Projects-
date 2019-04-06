</div>
<nav class="navbar navbar-expand-lg navbar-default navbar-fixed-top bg-dark" style="background-color: #2e4053; padding: .5%;  border-radius: 15px; margin:0;">
	<div class="container-fluid">
    	<div class="navbar-header">
      		<a class="navbar-brand" href="index.php" style="background-color: #8a99b0; color: #b4e35b; border-radius: 55%; margin-right: 20px;">projects ecommerce</a>
	      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse">
		        	<span class="sr-only">Toggle navigation</span>
		        	<div class="loader"></div>
		        	<p style="color: white;">Menu</p>
	      		</button>
      		
    	</div>
    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse">
      		<ul class="nav navbar-nav">
      			<!-- hover use -->
      			<style>
      				ul li:hover { 
 					 background-color: #CACFD2;
					}
      			</style>


      			<!-- menu items -->
            <li ><a href="brands.php" style="color: #ca6f1e;">Brands</a></li>
            <li ><a href="categories.php" style="color: #ca6f1e;">Categories</a></li>
            <li ><a href="products.php" style="color: #ca6f1e;">Products</a></li>
            <li ><a href="checkorder.php" style="color: #ca6f1e;">Checkorder</a></li>

            <?php if(has_permission('admin')): ?>
              <li ><a href="users.php" style="color: #ca6f1e;">Users</a></li>
            <?php endif; ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggole" data-toggle="dropdown">Hello <?=$user_data['first'];?>!<span class="caret"></span>
                </a>
                 <ul class="dropdown-menu" role="menu">
                   <li> <a href="change_password.php">Change Password</a> </li>
                   <li> <a href="logout.php">Logout</a> </li>
                 </ul>
            </li>
        <!--
        		<li class="dropdown">
					<a href="#" class="dropdown-toggole" data-toggle="dropdown" style="color:  #ca6f1e ;"><?php echo $parent['category']; ?><span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">

						<li><a href="#"><?php echo $child['category']; ?></a></li>

					</ul>
				</li>
      -->
          <!--
       		</ul>

		      	<ul class="nav navbar-nav navbar-right">

		        <button type="button" class="btn btn-success"><a href="tutorial/admin/login.php">Log in</a></button>
		        <button type="button" class="btn btn-success">Sign up</button>
		        <button type="button" class="btn btn-danger">Log Out</button>
		      	</ul>
          -->
   		</div>
  </div>
</nav>

