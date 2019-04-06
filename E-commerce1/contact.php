<?php
	require_once 'core/init.php';
	//require_once 'config.php'; //eivabe thakle purota kaj kore
   include "includes/head.php";
   include "includes/navigation.php";
   $sql = "SELECT * FROM Products WHERE featured = '1' ";
   $featured = $db->query($sql);
?>
<br>
<p class="text-center">
  <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Developer</a>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Super Admin</button>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample3" aria-expanded="false" aria-controls="multiCollapseExample3">Editor & Admin</button>
</p>
<div class="row" style="margin-left: 20px;">
  <div class="col" style="float: left; width: 30%; color: black;">
    <div class="collapse multi-collapse" id="multiCollapseExample1">
      <div class="card card-body" style="background-color: white;  border-radius: 5px; margin:2%; ">
      	<h2 style="background-color: red; color: white; text-align: center;">Full stack Developer</h2><hr>
			  	<img src="images/headerlogo/me.jpg" width="100" height="100"  style="float: left; border-radius: 5px; border: solid 2px green; margin:1%;">
			  	<style>
			  		.col{
			  			color: green;
			  		}
			  		.col1{
			  			color: red;
			  		}
			  	</style>
			    <p align="left" style="font-family: 'sofia'; font-size:18px; margin-left: 1%;">
				    	<br>
				    	Hi I am Rimon Mahmud Rony , working in this project as a full stack developer. To know more about me <a href="http://rimonstechblog.epizy.com/" target="_blank">click here</a>
				</p>
			  </div>
    </div>
  </div>
  <div class="col" style="float: left; width: 25%;">
    <div class="collapse multi-collapse" id="multiCollapseExample2">
      <div class="card card-body"  style="background-color: white;  border-radius: 5px; margin:2%;">
      	<h2 style="background-color: red; color: white; text-align: center;">Owner & Super Admin</h2><hr>
        <ul>
        	<li><a href="http://rimonstechblog.epizy.com/" target="_blank" type="link">Rimon Mahamud Rony</a></li>
        	<li>email: rimonronycste11@gmail.com</li>
        	<li>Mobile: 01862117112</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col" style="float: left; width: 40%;">
    <div class="collapse multi-collapse" id="multiCollapseExample3">
      <div class="card card-body" style="background-color: white;  border-radius: 5px; margin:2%;">
      	<h2 style="background-color: red; color: white; text-align: center;">Active Member & Editor</h2>
        <div class="col-sm-5" style=" border: solid 2px black; margin-left: 5%; background-color: white; border-radius: 5px;">
        	<li><a href="http://rimonstechblog.epizy.com/" target="_blank" type="link">Tasniya Binta Noor</a></li>
        	<li>email: tasniyabintanoor92@gmail.com</li>
        	<li>ID: BKH1601013F</li>
        </div>
        <div class="col-sm-5" style=" border: solid 2px black;margin-left: 5%; background-color: white; border-radius: 5px; ">
        	<li><a href="http://rimonstechblog.epizy.com/" target="_blank" type="link">Sumiya Tun Noor</a></li>
        	<li>email: sumaiyanoor11787@gmail.com</li>
        	<li>ID: BKH1601014F</li>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
		include "includes/footer.php";
?>