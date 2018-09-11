<?php 
	session_start();
	$user_email = $_SESSION["user_email"] ;
?>
<?php include 'db_config.php'; ?>
<?php include 'headers.php'; ?>
<?php 

	/*$user_name = $_SESSION["user_name"];
	//$_SESSION["user_access_code"] = $user_access_code;
	$user_email = $_SESSION["user_email"];
	$prty_id = $_SESSION["prty_id"];
	$prty_no = $_SESSION["prty_no"];
	$prty_location = $_SESSION["prty_location"];*/
	
	$assets_array = $_SESSION["user_details"];
	
	//print_r($assets_array);
	//$withComma = implode(",", $assets_array);
	
	/*foreach ($assets_array as $value) {
		echo "$value <br>";
	}*/
	
	//echo $withComma;
	
?>
<style>
	.user_properties{
		margin:8% 3% auto 3%;
	}
	.head_bar{
		width: 100%;
		height: 7%;
		background-color: #336699;
	}
	
	.logout_button_div h5{
		margin-top: 0px !important;
		margin-bottom: 0px !important;
	}
	.main_title{
		display:block;
		text-align:center;
		height:auto;
		margin: 6% 25% auto auto;
	}
	.user_property{
		width:98% !important;
		border: 1px solid #ddd;
		border-radius: 2%;
		padding:2% !important;
		box-shadow:none;
		margin:2%;
	}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MPRTS | Complaint Details</title>

<div class="head_bar">
	
	<!--<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>-->
	
	
	<div class="row">
		<div class="col s4" style="margin-top:2%;">
			<a href='#'><img src="images/logo/maa_logo_light.jpg"></a>
		</div>
		<div class="col s6">
			<h5 class="main_title"><a style="color: #fff;font-size: 15px;text-align: center;margin-top: 10%;padding-top:15%;">Maa Properties</a></h5>
		</div>
		<div class="col s2 logout_button_div">
			<h5><a href="logout.php" style="font-weight: bolder !important;float: right;position: fixed;top:11;right:28;font-size: 15px;font-weight: bolder;/*color:#666;*/color:#EE4D43;" title="Logout"><i class="material-icons">power_settings_new</i></a></h5>
		</div>
	</div>
	
	
	
	
	
</div>


<div class="user_prty_content">
<center><h5>Welcome <?php echo $user_email; ?></h5>Please chose an asset to proceed</center>
	<div class="row user_properties">
		<?php
			foreach ($assets_array as $value) {
				//echo "$value <br>";
				$user_details = explode("|#|",$value);
				$user_name = $user_details[0];
				$user_email = $user_details[1];
				$building_name = $user_details[3];
				$building_locality = $user_details[4];
				$user_access_code = $user_details[5];
				
				echo "<div class='col s10 user_property z-depth-1' id='$user_access_code' onclick='login_session(this.id)'>
					<div class='row'>
						<div class='col s3'>
							<img src='images/home.png' width='60px;' style='margin-top:6%;' />
						</div>
						<div class='col s9'>
							<!--<div class='col s12'>
								$user_email
							</div>-->
							
							<div class='col s12'>
								$building_name
							</div>
							<div class='col s12'>
								$building_locality
							</div>
						</div>
						
					</div>
				</div>";	
			}
		?>
	</div>
</div>
<script>
	function login_session(access_code){
		var complaint_data = access_code;
		$.ajax({
		  url: "start_login_session.php",
		  data: {
			session_details: access_code+"|#|"+'<?php echo $user_name ?>'
		  },
		  type: 'post',
		  cache: false,
		  success: function(login_status){
			  //alert("Complaint updated Successfully");
			  window.location = 'index.php';
		  }
		});
	}
</script>