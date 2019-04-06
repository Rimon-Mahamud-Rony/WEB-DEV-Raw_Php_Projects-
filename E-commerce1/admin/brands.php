<?php
  require_once'../core/init.php';
  if (!is_logged_in()) {
    login_error_redirect();
  }
  include 'includes/head.php';
  require_once'../config.php';
  //get brands from database
  include 'includes/navigation.php';
  $sql = "SELECT *FROM brand ORDER BY brand";
  $results = $db->query($sql);

  $errors = array();
  //Edit brand

  if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $edit_id =sanitize($edit_id);
    //echo $edit_id;
    $sql2 ="SELECT *FROM brand WHERE id ='$edit_id'";
    $edit_result = $db->query($sql2);
    $eBrand = mysqli_fetch_assoc($edit_result);
  }

  //delete brand
  if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $delete_id = sanitize($delete_id);
   //echo $delete_id;
    $sql = "DELETE FROM brand WHERE id = '$delete_id'";
    $db->query($sql);
    header('Location: brands.php');
  }
  //if add form is submitted
  //
  ?>
  <!-- functions of helpers function is start here-->
  <!-- -------------------------  ------------------------------------------------------------------------------------  -->
  <?php
  //add is submitted
  if (isset($_POST['add_submit'])){
    $brand = sanitize($_POST['brand']);
  	//check blank?!
  	if($_POST['brand'] == ''){
  		$errors[].= 'you must enter a brand';
  	}
    //check brand in database EXIST?!
    $sql = "SELECT * FROM brand WHERE brand = '$brand'";

    if (isset($_GET['edit'])) {
      $sql = "SELECT *FROM brand WHERE brand ='$brand' AND id !='$edit_id'";
    }

    $result = $db->query($sql);
    $count = mysqli_num_rows($result);
    //echo $count;
    if ($count>0) {
      $errors[] .='"'. $brand.'" is already exists.Please choose another brand name......';
    }
  	///errors
  	if(!empty($errors))
  	{
  		echo display_errors($errors);
  	}  

  	else
  	{
  		//ad brand to the database.............................
      $sql = "INSERT INTO brand (brand) VALUES ('$brand')";
      if(isset($_GET['edit'])){
        $sql= "UPDATE brand SET brand = '$brand' WHERE id = '$edit_id' ";
      }
      $db->query($sql);
      header('Location: brands.php');
  	}
  }
?>

<!-- functions of helpers function is ended here-->
<!-- --------------------------------------------------------------------------------------------------------------------------------  -->


<h3 class="text-center" style="background-color:#2e4053; width: 100%; height: 50px; color: white; padding: 10px;">This Is The Brands Page: Admins are adding brands from here</h3>
<!--form-->
<form class="form-inline" action="brands.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
  <div class="text-center">
	<div class="form-group">
    <?php
      $brand_value = '';
     if(isset($_GET['edit'])) {
      $brand_value = $eBrand['brand'];
    }
    else
    {
      if(isset($_POST['brand'])){
        $brand_value = sanitize($_POST['brand']);
      }
    }
    ?>


		<label for="brand"><?=((isset($_GET['edit']))?'Edit ' : 'Add A '); ?>Brand: </label>
		<input type="text" name="brand" id="brand" class="form-control" value="<?=$brand_value; ?>">

    <?php if(isset($_GET['edit'])): ?>
      <a href="brands.php" class="btn btn-warning">Cancel</a>
    <?php endif; ?> 
		<input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Edit ':'Add '); ?>brand" class="btn btn-success">
	</div>
</form>
</div>


<table class="table table-boarder table-striped table-auto ">
	<thead>
		<th></th><th>Brand</th><th></th>
	</thead>
	<tbody>
		<?php while ($brand = mysqli_fetch_assoc($results)): ?>
				<tr>
					<td><a href="brands.php?edit=<?=$brand['id'];?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span>EDIT</a></td>
					<td><?=$brand['brand']; ?></td>
					<td><a href="brands.php?delete=<?=$brand['id'];?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>DELETE</a></td>
				</tr>
		<?php endwhile;  ?>
	</tbody>
</table>
<br>
<?php include 'includes/footer.php';?>