z<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tutorial/core/init.php';
$parentID = (int)$_POST['parentID']; //ekhane data asbe footer page er ajax request theke
$selected = sanitize($_POST['selected']);
$childQuery = $db->query("SELECT *FROM categories WHERE parent = '$parentID' ORDER BY category");
ob_start(); //start buffering.......
?>
	<option value=""></option>
	<?php while($child = mysqli_fetch_assoc($childQuery)): ?>
		<option value="<?=$child['id'];?>"<?=(($selected==$child['id'])?' selected':'');?>><?=$child['category'];?></option>
	<?php endwhile; ?>
<?php echo ob_get_clean();  // released the memory ?> 
