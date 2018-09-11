<?php
	session_start();
	if(isset($_SESSION["user_name"])){
		$user_name = $_SESSION["user_name"];
		$user_access_code = $_SESSION["user_access_code"];
	}
	else {
		header('Location: login.php');
	}
	
?>
<title>MPRTS | Home</title>
<?php include 'db_config.php'; ?>
<?php include 'headers.php'; ?>
<?php include 'left_content.php'; ?>
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<script>
	$(document).ready(function(){
		sessionStorage.setItem('PageOpened', '');
	});
</script>


<script>
$(document).ready(function(){
  $('.slider').slider();
});
</script>
<style>
	.slider .indicators .indicator-item {
  background-color: #666666;
  border: 3px solid #ffffff;
  -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
}
.slider .indicators .indicator-item.active {
  background-color: #ffffff;
}
.slider {
  width: 900px;
  margin: 0 auto;
  height:200px !important;
}
.slider .indicators {
	display:none;
  bottom: 60px;
  z-index: 100;
  /* text-align: left; */
}
.slider ul {
	height: 200px !important;
}
.slider li {
	height:200px !important;
	background-color:#2980b9;
	text-align:center;
}
.slider img {
	width:50px !important;
	height:50px !important;
	margin:0px !important;
}
</style>


<?php 
	if(substr($user_access_code, 0, 2)=='AA'){

	$get_building_access_code = mysql_query("SELECT * from mprts_buildings where building_access_code = '$user_access_code'");
	$building_count = mysql_num_rows($get_building_access_code);
	while($building_details = mysql_fetch_array($get_building_access_code)) {
		$building_name = $building_details['building_name'];
	}

	$get_owners_count = mysql_query("SELECT * from mprts_owner where substr(access_code, 3, 4) = substr('$user_access_code', 3, 4)");
	$owners_count = mysql_num_rows($get_owners_count);

	$get_assets_count = mysql_query("SELECT * from mprts_property where substr(access_code, 3, 4) = substr('$user_access_code', 3, 4)");
	$assets_count = mysql_num_rows($get_assets_count);

	$get_tenants_count = mysql_query("SELECT * from mprts_tenants where substr(access_code, 3, 4) = substr('$user_access_code', 3, 4)");
	$tenants_count = mysql_num_rows($get_tenants_count);

	$get_payments_count = mysql_query("SELECT * from mprts_payments where substr(mprts_access_code, 3, 4) = substr('$user_access_code', 3, 4)");
	$payments_count = mysql_num_rows($get_payments_count);

	$get_expenses_count = mysql_query("SELECT * from mprts_expenses where substr(expense_access_code, 3, 4) = substr('$user_access_code', 3, 4)");
	$expenses_count = mysql_num_rows($get_expenses_count);
	
	$get_notifications_count = mysql_query("SELECT * from mprts_notifications where substr(notification_access_code, 3, 4) = substr('$user_access_code', 3, 4)");
	$notifications_count = mysql_num_rows($get_notifications_count);


	if($building_count==0){
		// header('Location: add_content.php');
		//echo "<script>alert('No records found');</script>";
		echo "<script>alert('Please create your Property before proceeding');</script>";
		
	}
	else {
		// header('Location: add_content.php');
		// echo "<script>alert('Records exist');</script>";


	}

		// echo "<style>
		// 		#details_owners, #details_expenses, #details_inventories, #details_deposits, #details_invoice, #details_reports, #details_notifications, #details_complaints, #details_classifieds,  #details_calender {
		// 			display:none !important;
		// 		}
		// 	</style>";
	}
	else if(substr($user_access_code, 0, 2)=='OO'){
		echo "<style>
				.card_col {
					pointer-events: none !important;
				}
			</style>";
	}
	else if(substr($user_access_code, 0, 2)=='TT'){
		echo "<style>
				#details_owners, #details_expenses, #details_inventories, #details_deposits, #details_invoice, #details_reports,  #details_complaints, #details_classifieds,  #details_calender {
					display:none !important;
				}
			</style>";
	}
?>
<html>
<style type="text/css">
	.cards_cat{
		width: 100% !important;
	}
	.cards_cat img{
		width:64px !important;
	}
	.logo_div {
		display: block !important;
	}
	#slide-out1{
		height: 100%;
		margin-top: 0px !important;
	}
</style>
<?php include 'headers.php'; ?>

	<body>
		<div class="all_content" style='position:fixed;'>
			<div class="right_content" style="float: right;">
			<?php include 'nav_thread.php' ?>
			<?php 
				$access_type = substr($user_access_code, 0, 2);
				if($access_type == 'AA' && $building_count==0){
					// header('Location: add_content.php');
					//echo "<script>$('body').load('add_content.php');document.getElementsByClassName('left_content')[0].style='display:none !important;'</script>";
				}
				else {
					
				}
			?>
				<div class="title_bar">
					<div class="row">
						<div class="col s6">
							<h5>Admin Dashboard</h5>
						</div>
						<!-- <div class="col s4">
							<h5 style="float: right;">Welcome <b>&nbsp<?php echo $user_name;  ?></b></h5>
						</div> -->
						<!-- <div class="col s2">
							<h5><a href="logout.php" style="float: right;">Logout</a></h5>
						</div> -->
					</div>
				</div>
				<div class="row user_details_content">
					<!--<div class="col s3">
						<img src="images/icons/user_image.png">
					</div>-->
					<div class="col s12">
						<center><h5>Welcome to Maa Properties</h5></center>
					</div>
					<div class="col s12 index_banner" style="width:100% !important;margin:0px;padding:5px;">
						
						
					<!--<div class="z-depth-5"  style='background-color:#2980b9;height:200px;'>
						<!-- <img src="images/loginimages/house4.jpg"> -->
						<!--<div class="" style='background-color:#2980b9;padding-top:20px;'>
							<center><h5 style="color: #fff;font-size: 20px;">Your Property Gaurdian</span></h5></center>
						</div>
						<center><img src="images/icons/houses2.png" width="100px" style="margin:10px;" /></center>
						<center>
							<h5 style='font-size: 20px;color: #fff;font-style: italic;'><i style="margin-right: 2%;" class="fa fa-leaf" aria-hidden="true"></i>Your property - Now just a click away</h5>
						</center>
					</div>-->
					<div class="z-depth-5"  style='background-color:#2980b9;height:200px;'>
					<div class="slider">
    <ul class="slides">
      <li>
        <div class="" style='background-color:#2980b9;padding-top:20px;'>
			<h5 style="color: #fff;font-size: 20px;">Your Property Gaurdian</span></h5>
		</div>
		<img src="images/icons/houses2.png" width="60px" style="margin:20px !important;" />
		<h5 style='font-size: 20px;color: #fff;font-style: italic;'>Now just a click away</h5>
      </li>
	  <li>
		<i style="margin: 10% 10% 5% 10%;color: #fff;font-size: 40px;" class="fab fa-envira" aria-hidden="true"></i>
        <div class="" style='background-color:#2980b9;padding-top:0px;'>
			<h5 style="color: #fff;font-size: 20px;">Say no to Paper bills</span></h5>
			<h5 style="color: #fff;font-size: 20px;">Get instant bills on email</span>&nbsp&nbsp<a href="payments_content.php" style='color: #f2f2f2 !important;'><i class="fas fa-arrow-alt-circle-right"></i></a></h5>
		</div>
      </li>
	  <li>
		<i style="margin: 10% 10% 5% 10%;color: #fff;font-size: 40px;" class="fa fa-address-card" aria-hidden="true"></i>
        <div class="" style='background-color:#2980b9;padding-top:0px;'>
			<h5 style="color: #fff;font-size: 20px;">Keep your vendors' contacts handy</span><br>
			<h5><a href="vendors_content.php" style='color: #f2f2f2 !important;'><i class="fas fa-arrow-alt-circle-right"></i></a></h5>
			</h5>
		</div>
      </li>
	  <li>
		<i style="margin: 10% 10% 5% 10%;color: #fff;font-size: 40px;" class="fa fa-bell" aria-hidden="true"></i>
        <div class="" style='background-color:#2980b9;padding-top:0px;'>
			<h5 style="color: #fff;font-size: 20px;">Stay Informed about your assets</span></h5>
			<h5><a href="notifications_content.php" style='color: #f2f2f2 !important;'><i class="fas fa-arrow-alt-circle-right"></i></a></h5>
		</div>
      </li>
      <!--<li>
        <img src="http://lorempixel.com/580/250/nature/2"> 
        <div class="caption left-align">
          <h3>Left Aligned Caption</h3>
        </div>
      </li>
      <li>
        <img src="http://lorempixel.com/580/250/nature/3"> 
        <div class="caption right-align">
          <h3>Right Aligned Caption</h3>
        </div>
      </li>
      <li>
        <img src="http://lorempixel.com/580/250/nature/4">
        <div class="caption center-align">
          <h3>This is our big Tagline!</h3>
        </div>
      </li>-->
    </ul>
  </div>
  </div>
						
						
						
						
						
						
					</div>
				</div>
				<div class="cards_content">
					<!-- ------------------------------------ Dashboard Design Start -------------------------------------- -->

					<div class="row cards_row" style="margin:auto 1% auto 1%;">
						
						<!-- <div class="col l3 m3 s6"> -->
							<!-- <div class="card sticky-action">
							    <div class="card-image waves-block waves-light">
							      <img class="activator" src="images/property1.jpg">
							    </div>
							    <div class="card-content">
							      <span class="card-title activator grey-text text-darken-4">Properties<i class="material-icons right">more_vert</i></span>
							      <label><?php echo $building_name; ?></label>
							    </div> -->
							    <!-- <div class="card-action">
							    	<p><a href="#">Open</a></p>
							    </div> -->
							    <!-- <div class="card-reveal">
							      <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
							      <p>Here is some more information about this product that is only revealed once clicked on.</p>
							    </div>
						  	</div>-->
					  	<!-- </div> -->
					  	<div class="col l3 m3 s4 card_col">
							<div class="card sticky-action">
							    <div class="card-image waves-block waves-light">
							      <img class="activator" src="images/icons/index_owner.png">
							    </div>
							    <div class="card-content">
							      <center>
								  <span class="card-title activator grey-text text-darken-4">Owners<i class="material-icons right">more_vert</i></span>
							      <label><?php echo $building_name; ?></label>
								</center>
							    </div>
							    <!-- <div class="card-action">
							    	<p><a href="#">Open</a></p>
							    </div> -->
							    <div class="card-reveal">
							      <span class="card-title grey-text text-darken-4">Owners Summary<i class="material-icons right">close</i></span>
							      <p>Total Number of Owners: <?php echo $owners_count ?></p>
							      <p><a href="#" onclick="$('.index_banner').hide();$('.cards_row').load('owner_activate.php');">Open</a></p>
							    </div>
						  	</div>
					  	</div>
					  	<div class="col l3 m3 s4 card_col">
							<div class="card sticky-action">
							    <div class="card-image waves-block waves-light">
							      <img class="activator" src="images/icons/index_asset.png">
							    </div>
							    <div class="card-content">
								<center>
							      <span class="card-title activator grey-text text-darken-4">Assets<i class="material-icons right">more_vert</i></span>
							      <label><?php echo $building_name; ?></label>
								</center>
							    </div>
							    <!-- <div class="card-action">
							    	<p><a href="#">Open</a></p>
							    </div> -->
							    <div class="card-reveal">
							      <span class="card-title grey-text text-darken-4">Assets Summary<i class="material-icons right">close</i></span>
							      <p>Total Number of Assets: <?php echo $assets_count ?></p>
							    </div>
						  	</div>
					  	</div>
					  	<div class="col l3 m3 s4 card_col">
							<div class="card sticky-action">
							    <div class="card-image waves-block waves-light">
							      <img class="activator" src="images/icons/index_tenant.png">
							    </div>
							    <div class="card-content">
								<center>
							      <span class="card-title activator grey-text text-darken-4">Tenants<i class="material-icons right">more_vert</i></span>
							      <label><?php echo $building_name; ?></label>
								</center>
							    </div>
							    <!-- <div class="card-action">
							    	<p><a href="#">Open</a></p>
							    </div> -->
							    <div class="card-reveal">
							      <span class="card-title grey-text text-darken-4">Tenants Summary<i class="material-icons right">close</i></span>
							      <p>Total Number of Tenants: <?php echo $tenants_count ?></p>
							      <p><a href="#" onclick="$('.index_banner').hide();$('.cards_row').load('tenant_activate.php');">Open</a></p>
							    </div>
						  	</div>
					  	</div>
					  	<div class="col l3 m3 s4 card_col">
							<div class="card sticky-action">
							    <div class="card-image waves-block waves-light">
							      <img class="activator" src="images/icons/index_payment.png">
							    </div>
							    <div class="card-content">
								<center>
							      <span class="card-title activator grey-text text-darken-4">Payments<i class="material-icons right">more_vert</i></span>
							      <label><?php echo $building_name; ?></label>
								</center>
							    </div>
							    <!-- <div class="card-action">
							    	<p><a href="#">Open</a></p>
							    </div> -->
							    <div class="card-reveal">
							      <span class="card-title grey-text text-darken-4">Payments Summary<i class="material-icons right">close</i></span>
							      <p>Total Number of Payments: <?php echo $payments_count ?></p>
							    </div>
						  	</div>
					  	</div>
					  	<div class="col l3 m3 s4 card_col">
							<div class="card sticky-action">
							    <div class="card-image waves-block waves-light">
							      <img class="activator" src="images/icons/index_expense.png">
							    </div>
							    <div class="card-content">
								<center>
							      <span class="card-title activator grey-text text-darken-4">Expenses<i class="material-icons right">more_vert</i></span>
							      <label><?php echo $building_name; ?></label>
								</center>
							    </div>
							    <!-- <div class="card-action">
							    	<p><a href="#">Open</a></p>
							    </div> -->
							    <div class="card-reveal">
							      <span class="card-title grey-text text-darken-4">Expenses Summary<i class="material-icons right">close</i></span>
							      <p>Total Number of Expenses: <?php echo $expenses_count ?></p>
								  <p><a href="#" onclick="$('.index_banner').hide();$('.cards_row').load('expense_activate.php');">Open</a></p>
							    </div>
						  	</div>
					  	</div>
						<div class="col l3 m3 s4 card_col">
							<div class="card sticky-action">
							    <div class="card-image waves-block waves-light">
							      <img class="activator" src="images/icons/index_notifications.png">
							    </div>
							    <div class="card-content">
							      <span class="card-title activator grey-text text-darken-4">Notifications<i class="material-icons right">more_vert</i></span>
							      <label><?php echo $building_name; ?></label>
							    </div>
							    <!-- <div class="card-action">
							    	<p><a href="#">Open</a></p>
							    </div> -->
							    <div class="card-reveal">
							      <span class="card-title grey-text text-darken-4">Notifications Summary<i class="material-icons right">close</i></span>
							      <p>Total Number of Notifications: <?php echo $notifications_count ?></p>
								  <p><a href="#" onclick="$('.index_banner').hide();$('.cards_row').load('notifications_activate.php');">Open</a></p>
							    </div>
						  	</div>
					  	</div>

					</div>


					<!-- ------------------------------------ Dashboard Design End   -------------------------------------- -->

				</div>
			</div>
		</div>
	</body>
</html>