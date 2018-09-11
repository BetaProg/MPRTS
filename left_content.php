<?php
	session_start();
	if(isset($_SESSION["user_name"])){
		$user_name = $_SESSION["user_name"] ;
		$user_access_code = $_SESSION["user_access_code"];
		$user_email = $_SESSION["user_email"];
	}
	else {
		header('Location: login.php');
	}
	echo "<script>console.log('$user_access_code');</script>";
	echo "<script>console.log('$user_email');</script>";
	
?>

<link rel='stylesheet' href='styles/left_content.css' />

<?php include 'db_config.php'; ?>
<?php include 'headers.php'; ?>

<?php 
	$access_type = substr($user_access_code, 0, 2);
	if($access_type=='AA'){
		echo "<style>
				#masteradmin_panel,  #details_inventories, #details_deposits, #details_invoice, #details_reports, #details_classifieds,  #details_calender {
					display:none !important;
				}
			</style>";
	}
	else if($access_type=='TT'){
		echo "<style>
				#masteradmin_panel, #details_owners, #details_tenants, #details_expenses, #details_inventories, #details_deposits, #details_invoice, #details_reports,  #details_complaints, #details_classifieds,  #details_calender {
					display:none !important;
				}
			</style>";
	}
	else if($access_type=='OO'){
		echo "<style>
				#masteradmin_panel, #details_owners, #details_inventories, #details_deposits, #details_invoice, #details_reports, #details_classifieds,  #details_calender {
					display:none !important;
				}
			</style>";
	}
?>

<?php include'building_check.php'; ?>
<script type="text/javascript">
	$(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
	// $('#show_notes').load('show_notes.php');
</script>
<script type="text/javascript">
	 $(document).ready(function() {
    $('select').material_select();
    $('#sideNav').load('nav_thread.php .slide-out1');
	//$('.button-collapse').click();
  });
</script>
<div class="head_bar">
	<a href="#" data-activates="slide-out1" class="button-collapse"><i class="material-icons">menu</i></a>
	<ul id="slide-out1" class="side-nav fixed" style=''>
		<!--<div class="logo_div">-->
			<!--<img src="images/logo/maa_logo_dark.png">-->
			<!--<img src="images/rounded_logo.png">-->
			<!--<h5 class="brand_name"><a href="index.php">Maa Properties</a></h5>-->
		<!--</div>--->
		  <li id='masteradmin_panel'><a href="masteradmin_panel.php"><i class="material-icons">settings</i>Master Admin Panel</a></li>
		  <li id='details_buildings'><a href="building_content.php"><i class="material-icons">business</i>Property Details</a></li>
		  <li id='details_owners'><a href="owner_content.php"><i class="material-icons">perm_identity</i>Owners Details</a></li>
		  <li id='details_property'><a href="property_content.php"><i class="material-icons">home</i>Asset Details</a></li>
		  <li id='details_tenants'><a href="tenant_content.php"><i class="material-icons">people</i>Tenants Details</a></li>
		  <li id='details_payments'><a href="payments_content.php"><i class="material-icons">attach_money</i>Payments Details</a></li>
		  <li id='details_expenses'><a href="expense_content.php"><i class="material-icons">credit_card</i>Expenses Details</a></li>
		  <li id='details_services'><a href="vendors_content.php"><i class="material-icons">build</i>Vendor Details</a></li>
		  <li id='details_inventories'><a href="#!"><i class="material-icons">store</i>Inventories Details</a></li>
		  <li id='details_deposits'><a href="#!"><i class="material-icons">monetization_on</i>Deposits Details</a></li>
		  <li id='details_invoice'><a href="#!"><i class="material-icons">assignment</i>Invoice</a></li>
		  <li id='details_reports'><a href="#!"><i class="material-icons">description</i>Reports</a></li>
		  <li id='details_notifications'><a href="notifications_content.php"><i class="material-icons">notifications_active</i>Notifications</a></li>
		  <li id='details_complaints'><a href="complaints_content.php"><i class="material-icons">call_to_action</i>Complaints</a></li>
		  <li id='details_classifieds'><a href="#!"><i class="material-icons">add_to_queue</i>Classifieds</a></li>
		  <li id='details_calender'><a href="#!"><i class="material-icons">date_range</i>Event Calender</a></li>
	</ul>

	<a href='index.php'><img src="images/logo/maa_logo_light.jpg"></a>
	<!--<a href='index.php'><img src="images/rounded_logo.png"></a>-->
	<!--<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>-->
	<h5 class="main_title"><a style="color: #fff;font-size: 20px;text-align: center;margin-left: 1%;" href="index.php">Maa Properties</a></h5>
	
	<div class="col s8 welcome_div"  onclick="$('.button-collapse').click();">
		<!--<center><h5>Hi <?php echo $user_name ?>!</h5></center>-->
		<center><h5>Hi <?php echo $user_name; ?> !</h5></center>
	</div>
	
	<div class="col s2 logout_button_div">
		<h5><a href="logout.php" style="font-weight: bolder !important;float: right;position: fixed;top:11;right:28;font-size: 15px;font-weight: bolder;/*color:#666;*/color:#EE4D43;" title="Logout"><i class="material-icons">power_settings_new</i></a></h5>
	</div>
	
	
</div>
<div class="left_content" style="font-family: Raleway;z-index: 4;">
	<!--<div class="logo_div">
		<img src="images/rounded_logo.png" style="width: 50px;position: absolute;left:1%;top:1%;">
		<h5 class="brand_name"><a style="color: #fff;font-size: 20px;text-align: center;margin-left: 20%;" href="index.php">Maa Properties</a></h5>
	</div>-->
	
	<div class="categories_div">
		<div id='sideNav'>
			
		</div>
	</div>

<!--<i class="material-icons" href="#modal1" style="position: absolute;bottom:50;right:20;font-size: 40px;cursor: pointer;color: #006666;">note_add</i>-->



</div>



          
          
         


	<!-- Modal Trigger -->
  

  <!-- Modal Structure -->


  <!--</div>-->
          
          


<script>
	if(sessionStorage.getItem('PageOpened')=='Buildings'){
		$('#details_buildings').css('background-color', '#ecf0f1');
	}
	else if(sessionStorage.getItem('PageOpened')=='Owners'){
		$('#details_owners').css('background-color', '#ecf0f1');
	}
	else if(sessionStorage.getItem('PageOpened')=='Assets'){
		$('#details_property').css('background-color', '#ecf0f1');
	}
	else if(sessionStorage.getItem('PageOpened')=='Expenses'){
		$('#details_buildings').css('background-color', '#ecf0f1');
	}
	else if(sessionStorage.getItem('PageOpened')=='Tenants'){
		$('#details_tenants').css('background-color', '#ecf0f1');
	}
	else if(sessionStorage.getItem('PageOpened')=='Payments'){
		$('#details_payments').css('background-color', '#ecf0f1');
	}
	else if(sessionStorage.getItem('PageOpened')=='Expenses'){
		$('#details_expenses').css('background-color', '#ecf0f1');
	}
	else if(sessionStorage.getItem('PageOpened')=='Vendors'){
		$('#details_services').css('background-color', '#ecf0f1');
	}
	else if(sessionStorage.getItem('PageOpened')=='Notifications'){
		$('#details_notifications').css('background-color', '#ecf0f1');
	}
	else if(sessionStorage.getItem('PageOpened')=='Complaints'){
		$('#details_complaints').css('background-color', '#ecf0f1');
	}
	
	$('#details_buildings').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Buildings');
	});
	$('#details_owners').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Owners');
	});
	$('#details_property').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Assets');
	});
	$('#details_tenants').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Tenants');
	});
	$('#details_payments').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Payments');
	});
	$('#details_expenses').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Expenses');
	});
	$('#details_services').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Vendors');
	});
	$('#details_notifications').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Notifications');
	});
	$('#details_complaints').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Complaints');
	});
	
	if(sessionStorage.getItem('PageOpened')!='Vendors'){
		$('.page_name').text(sessionStorage.getItem('PageOpened'));
	}
	
	
	//sessionStorage.setItem('PageOpened', '');
</script>


