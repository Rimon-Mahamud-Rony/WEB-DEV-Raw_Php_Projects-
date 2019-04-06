<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/tutorial/core/init.php';
	if (!is_logged_in()) {
		login_error_redirect();
	}
	include 'includes/head.php';
	include 'includes/navigation.php';

	///DELETE is stablishing in here

	if (isset($_GET['delete'])) {
		$id = sanitize($_GET['delete']);
		$db->query("UPDATE products SET deleted =1 WHERE id ='$id' ");
		header('Location: products.php');  
	}



	//apatoto eikhanei db path ke undefined free kora hoilo..

	$dbpath ='';

	/// vai dekh.... kheyal rakh eikhan thekei pura code ta if else er maddhome control kora hoitese.... if .. ta ... shudhu if nare .... eita khub e dangerous if......select
	if (isset($_GET['add']) || isset($_GET['edit'])) {
		$brandQuery = $db->query("SELECT *FROM brand ORDER BY brand");
		$parentQuery = $db->query("SELECT *FROM categories WHERE parent = 0 ORDER BY category");

		$title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
		$brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):'');
		$parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
		$category =((isset($_POST['child'])) && !empty($_POST['child'])?sanitize($_POST['child']):'');
		$price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):'');
		$list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):'');
		$list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):'');
		$description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
		$sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '')?sanitize($_POST['sizes']):'');
		$sizes= rtrim($sizes,',');
		$saved_image ='';


		if (isset($_GET['edit'])) {
			$edit_id = (int)$_GET['edit'];
			$productResults = $db->query("SELECT *FROM products WHERE id ='$edit_id' ");
			$product = mysqli_fetch_assoc($productResults);
			//handling the image deleting from the adding image or editing product image page
				if (isset($_GET['delete_image'])) {
					$image_url = $_SERVER['DOCUMENT_ROOT'].$product['image']; 
					//echo $image_url;
					unlink($image_url);
					$db->query("UPDATE products SET image ='' WHERE id = '$edit_id' ");
					header('Location: products.php?edit='.$edit_id);
				}
			$category = ((isset($_POST['child']) && $_POST['child'] != '')? sanitize($_POST['child']):$product['categories']);

			$title = ((isset($_POST['title']) && $_POST['title'] !='')?sanitize($_POST['title']):$product['title']);
			$brand = ((isset($_POST['brand']) && $_POST['brand'] !='')?sanitize($_POST['brand']):$product['brand']);
			$parentQ = $db->query("SELECT *FROM categories WHERE id = '$category' ");
			$parentResult = mysqli_fetch_assoc($parentQ); //karon rimon vai cacchen database theke shudhu ekta row niye kaj korar jonno
			$parent = ((isset($_POST['parent']) && $_POST['parent'] !='')?sanitize($_POST['parent']):$parentResult['parent']);
			$price = ((isset($_POST['price']) && $_POST['price'] !='')?sanitize($_POST['price']):$product['price']);
			$list_price = ((isset($_POST['list_price']) && $_POST['list_price'] !='')?sanitize($_POST['list_price']):$product['list_price']);
			$description = ((isset($_POST['description']) && $_POST['description']!='')?sanitize($_POST['description']):$product['description']);
			$sizes = ((isset($_POST['sizes']) && $_POST['sizes']!='')?sanitize($_POST['sizes']):$product['sizes']);
			$sizes= rtrim($sizes,',');
			$saved_image = (($product['image'] != '')?$product['image']:'');
			$dbpath = $saved_image;


		}////////////////////////////////close/////////


		//ei nicher kaj ta kora holo oize form er vetor product er size gula zate stay kore update korar ag porzonto

		if (!empty($sizes)) {
				$sizeString = sanitize($sizes);
				$sizeString = rtrim($sizeString, ',');
				//echo $sizeString;
				$sizesArray = explode(',', $sizeString);
				$sArray = array();
				$qArray = array();
				foreach ($sizesArray as $ss) {
					$s = explode(':',$ss);
					$sArray[] = $s[0];
					$qArray[] = $s[1];
				}
			}else{
				$sizesArray = array();
			}


		$sizesArray = array();

		if ($_POST) {
			//$title = sanitize($_POST['title']);
			//$brand = sanitize($_POST['brand']);
			//$categories = sanitize($_POST['child']);
			//$price = sanitize($_POST['price']);
			//$list_price = sanitize($_POST['list_price']);
			//$sizes = sanitize($_POST['sizes']);
			//$description = sanitize($_POST['description']);

			// mama uporer gula apatoto raikha dao ... somoy asle thik kormu ne....... eror er mayre ami aunti daki.........

			//$dbpath = '';
			$errors= array();

			

			$required = array('title','brand', 'price' ,'parent',  'child','sizes');
			foreach ($required as $field) {
				if ($_POST[$field] == '') {
					$errors [] = 'All fields with and astrisk are required';
					break;
				}
			}

			///validation for image..... ekhane [er vtor] za asbe ta vardump diye chek kore dite hobe ... machile er reply onuzayi..
			if (!empty($_FILES)) {
				//var_dump($_FILES);
				$photo = $_FILES['photo'];
				$name = $photo['name'];
				$nameArray = explode('.',$name);
				$filename = $nameArray[0];
				$fileExt = $nameArray[1];
				$mime = explode('/',$photo['type']);
				$mimeType = $mime[0];
				$mimeExt = $mime[1];
				$tmpLoc = $photo['tmp_name'];
				$fileSize = $photo['size'];
				$allowed = array('png','jpg','jpeg','gif');
				$uploadName = md5(microtime()).'.'.$fileExt;
				$uploadPath = BASEURL.'images/products/'.$uploadName;
				$dbpath = '/tutorial/images/products/'.$uploadName;

				if ($mimeType != 'image') {
					$errors[] ='The file must be an image';
				}
				if (!in_array($fileExt, $allowed)) {
					$errors[] = 'The photo extension must be a png/jpg/jpeg/gif.';
				}
				if ($fileSize > 25000000) {
					$errors[] = "the file size must be under 25 mb";
				}
				if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')) {
					$errors[] = 'File extension does not match the file.';
					//thik ekhane ekta advance security er kaj ache(not worked properly..... hudaai wast hoise 4 hour) , zeta thik korar jonno eta kora hoise... ekhane hacker ra sshl (shell uploading ) korte pare ... pore arektu research kore thik korte hobe .... but now ami eta skip kore zacchi...
				}
				//ending image validation

				///

			}
			if (!empty($errors)) {
				echo display_errors($errors);
			}
			else{
				//upload file and inser into database

				if (!empty($_FILES)){
					move_uploaded_file($tmpLoc, $uploadPath);
				}
				
				$insertSql = "INSERT INTO products (`title`,`price`,`list_price`,`brand`,`categories`,`sizes`,`image`,`description`) VALUES ('$title','$price','$list_price','$brand','$category','$sizes','$dbpath','$description')";

				if (isset($_GET['edit'])) {/*
					$insertSql = "UPDATE products SET `title` = '$title', `price` = '$price', `list_price` = '$list_price', `brand` = '$brand' ,`categories` = '$category', `sizes` = '$sizes' `image` = '$dbpath', `description` = '$description' WHERE id = '$edit_id' ";*/
					$insertSql =" UPDATE `products` SET `title` = '$title', `price` = '$price', `list_price` = '$list_price', `brand` = '$brand', `categories` = '$category', `image` = '$dbpath', `description` = '$description', `sizes` = '$sizes' WHERE `products`.`id` = $edit_id";
				}

				$db->query($insertSql);
				header('Location: products.php');

			}

		}
?>

	<h2 class="text-center"><?=((isset($_GET['edit']))?'&#x25B6; EDIT ':'&#10004; ADD A NEW ');?>PRODUCT</h2><hr>
		<form action="products.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" enctype="multipart/form-data">
			<div class="form-group col-md-3">
				<label for="title">Title*:</label>
				<input type="text" name="title" class="form-control" id="title" value="<?=$title ;?>">
			</div>
			<div class="form-group col-md-3">
				<label for="brand">Brand*</label>
				<select class="form-control" id="brand" name="brand">
					<option value=""<?=(($brand =='')?' selected':'') ;?>></option>
					<?php while($b = mysqli_fetch_assoc($brandQuery)): ?>
						<option value="<?=$b['id'];?>"<?=(($brand== $b['id'])?' selected':'');?>><?=$b['brand'];?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="parent">Parent Category*:</label>
				<select class="form-control" id="parent" name="parent">
					<option value=""<?=(($parent == '')?' selected':'');?>></option>
					<?php while($p = mysqli_fetch_assoc($parentQuery)): ?>
						<option value="<?=$p['id'] ;?>"<?= (($parent == $p['id'] )?' selected':'');?>><?=$p['category'];?></option> 
					<?php endwhile;  ?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="child">Child Category*:</label>
				<select id="child" name="child" class="form-control"></select>
			</div>
			<div class="form-group col-md-3">
				<label for="price">Price*:</label>
				<input type="text" id="price" name="price" class="form-control" value="<?=$price;?>" >
			</div>
			<div class="form-group col-md-3">
				<label for="list_price">List Price:</label>
				<input type="text" id="list_price" name="list_price" class="form-control" value="<?=$list_price;?>">
			</div>

			<div class="form-group col-md-3">
				<label>Quantity and Sizes*:</label>
				
				<button class="btn btn-primary form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">Quantity and Sizes</button>
			</div>
			<div class="form-group col-md-3">
				<label for="sizes">Sizes & Quantity Preview</label>
				<input type="text" class="form-control" name="sizes" id="sizes" value="<?=$sizes;?>" readonly>
			</div>
			<div class="form-group col-md-6">
				<?php if($saved_image !=''): ?>
					<div class="saved-image">
						<img src="<?=$saved_image;?>" alt="saved image"/>
						<br>
						<a href="products.php?delete_image=1&edit=<?=$edit_id;?>" class="text-danger">DELETE IMAGE??</a>
					</div>
					<?php else: ?>
					<label for="photo">Product Photo:</label>
					<input type="file" name="photo" id="photo" class="form-control">
				<?php endif; ?>
			</div>
			<div class="form-group col-md-6">
				<label for="description">Description:</label>
				<textarea id="description" name="description" class="form-control" rows="6"><?=$description ;?></textarea>
			</div>
			<div class="form-group pull-right" style="margin-right: 1%;">
				<a href="products.php" class="btn btn-danger">Cancel</a>
				<input type="submit"  value="<?=((isset($_GET['edit']))?'&#x25B6; EDIT':'&#10004; ADD');?> Product" class="btn btn-success pull-right">
			</div>
			<div class="clearfix"></div>

		</form>


		<!-- Modal -->
<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sizesModalLabel">Sizes and Quantity</h4>
      </div>
      <div class="modal-body">
      	<!--  --->
	      	<div class="container-fluid">
	        	<?php for($i=1; $i<=12; $i++ ): ?>
	        		<div class="form-group col-md-4">
	        			<label for="size<?=$i;?>">Size:</label>
	        			<input type="text" name="size<?=$i ;?>" id="size<?=$i;?>" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>" class="form-control">
	        		</div>
	        		<div class="form-group col-md-2">
	        			<label for="qty<?=$i;?>">Quantity:</label>
	        			<input type="number" name="qty<?=$i ;?>" id="qty<?=$i;?>" min="0" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" class="form-control">
	        		</div>

	        	<?php endfor; ?>
	        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle'); return false;">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php } else { ///this elese take the all the code bellow it...
	$sql = "SELECT *FROM products WHERE deleted= 0";
	$presults = $db->query($sql);
	if (isset($_GET['featured'])) // er pore !empty($_GET['featured'] use kora hole zodi database e featured ==0 hoye zay , tokhon eta kaj kore na , keno korena ta ekhono janina exactly,  
{
		$id = (int)$_GET['id'];
		$featured = (int)$_GET['featured'];
		$featuredSql ="UPDATE products SET featured = '$featured' WHERE id ='$id' ";
		$db->query($featuredSql);
		header('Location: products.php');
	}
?>

<h2 class="text-center">Products</h2>
<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add Product</a><div class="clearfix"></div>
<br>
<br>
<table class="table table-bordered table-condensed table-striped" ">
	<thead><th></th><th>Product</th><th>Price</th><th>Category</th><th>Featured</th><th>Sold</th></thead>
	<tbody>
		<?php while($product = mysqli_fetch_assoc($presults)): 
				$childID = $product['categories'];
				$catSql= "SELECT *FROM categories WHERE id =$childID ";
				$result = $db->query($catSql);
				$child = mysqli_fetch_assoc($result);  ///arry no 1
				$parentID = $child['parent'];
				$pSql = "SELECT *FROM categories WHERE id = '$parentID' ";
				$presult = $db->query($pSql);
				$parent =mysqli_fetch_assoc($presult); ///array no 2
				$category = $parent['category'].'~'.$child['category'];
				//var_dump($category);
			?>
			<tr>
				<td>
					<a href="products.php?edit=<?=$product['id'] ;?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil">EDIT</span></a>
					<a href="products.php?delete=<?=$product['id'] ;?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove">DELETE</span></a>
				</td>
				<td><?=$product['title'];?></td>
				<td style="color: #008000;"><?=money($product['price']);?></td>
				<td><?=$category;?></td>
				<td>
					<a href="products.php?featured=<?=(($product['featured']==0)?'1':'0');?>&id=<?=$product['id'];?>" class="btn btn-xs btn-warning">
						<span class="glyphicon glyphicon-<?=(($product['featured']==1)?'minus':'plus') ;?>">
						</span>
					</a>
					&nbsp; <?=(($product['featured'] ==1)?'FEATURED PRODUCT':'') ?>
				</td>
				<td>0</td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>

<?php
	}
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
	include 'includes/footer.php';
?>
 
<script>
	jQuery('document').ready(function(){
		get_child_options('<?=$category;?>');
		//updateSizes();
		//ami bujhlam na eikhane function ta call korle zay na keno....... za bad ei project ... khellam na ...
	});
</script>
