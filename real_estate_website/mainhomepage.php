
<?php include ('rheader.php'); ?>
<!-- welcome only for main home page -->

<a class="navbar-brand" href="mainhomepage.php" style="width: 50%; background-color: #424959; color: red; height: 40%; "><marquee behavior=scroll direction="left">Welcome to rimon's real_state company !!</marquee></a><a class="navbar-brand" href="mainhomepage.php" style="width: 50%; background-color: #424959; color: white; height: 40%;"><marquee behavior=scroll direction="right">Welcome to rimon's real_state company !!</marquee></a>
<!-- its end -->

<?php    
$mysqli=new mysqli('localhost','root','','all');
	if($mysqli->connect_error){

		printf("can not connect databse %s\n",$mysqli->connect_error);
		exit();
	}

	$query="SELECT * FROM propety";
	$read=$mysqli->query($query);

?>
<br><br><br>

<div id="showimage-1" style="width:100%; height: 30%; text-align: center; text-align: center;">

<img name="slide" width="1080" height="300" />

<script>
var i = 0;      // Start Point
//var images = [];
var images = ["images/mypic01.jpg","images/mypic02.jpg","images/mypic03.jpg","images/mypic04.jpg","images/mypic05.jpg","images/nstu.jpg","images/mypic06.jpg",];
  // Images Array
var time = 1000;  // Time Between Switch
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

<div class="container">

<h1> Property List  </h1> 


<hr style="color: black;">

<table class="table table-striped table-hover ">
  <thead style="background-color:gray; color:white;font-size: 100%; ">
    <tr>
      <th style="border-right: solid 1px black;">PROPERTY SERIAL NO.</th>
      <th style="border-right: solid 1px white;">PROPERTY NAME</th>
      <th style="border-right: solid 1px white;">MONTHLY CHARGE</th>
      <th style="border-right: solid 1px white;">ADDRESS</th>
      <th style="border-right: solid 1px white;">PHOTO</th>
      <th style="border-right: solid 1px black;">DETAILS</th>
      <th style="width: 10%;">BOOKING</th>
    </tr>
  </thead>
  <tbody>
  <?php while ($row=$read->fetch_assoc()) { ?>

    <tr class="info">
      <td style="border-right: solid 1px black;"><?php echo  "100"?><?php echo $row['id'];   ?></td>
      <td><?php echo  $row['name'];   ?></td>
      <td><?php echo  $row['monthly'];   ?></td>
      <td><?php echo  $row['address'];   ?></td>
      <td><img src="uploads/<?php echo  $row['images']; ?>"</td>
      <td style="border-right: solid 1px black;"> <a href="rsingle.php?posts=<?php echo  $row['id'];  ?>">Details</a> </td>
      <td><a href="cndex.php"><button style="background-color: green; color: white;font-size: 30px; border:4px solid black; border-radius: 40%; margin-top:60%;">&nbsp;&nbsp;Buy&nbsp;&nbsp;</button></a></td>
    </tr>

    <?php } ?>
  </tbody>
</table> 
	

</div>

<?php  include ('rfooter.php') ; ?>
<?php include  ('myfot.php');    ?>
