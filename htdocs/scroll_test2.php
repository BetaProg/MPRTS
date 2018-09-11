<?php
	session_start();
	if(isset($_SESSION["user_name"])){
		$user_name = $_SESSION["user_name"] ;
		$user_access_code = $_SESSION["user_access_code"];
	}
	else {
		header('Location: login.php');
	}
?>
<?php include 'db_config.php'; ?>
<?php include'headers.php'; ?>
<style>
		.main {
			width: 500px;
			overflow-x: auto;
			overflow-y: hidden;
			height: 140px;
			white-space: nowrap;
		}
		.sub {
			display: inline;
		}
	</style>
	<?php 
		function set_icon($vndr_profession) {
			if($vndr_profession == "Carpenter"){
				$vendor_icon = 'images/icons/saw.png';
			}
			else if($vndr_profession == "Current Line Man"){
				$vendor_icon = 'images/icons/electric_tower.png';
			}
			else if($vndr_profession == "Driver Services"){
				$vendor_icon = 'images/icons/driver.png';
			}
			else if($vndr_profession == "Painter"){
				$vendor_icon = 'images/icons/painter.png';
			}
			else if($vndr_profession == "Carpet Cleaner"){
				$vendor_icon = 'images/icons/carpet.png';
			}
			else if($vndr_profession == "Duplicate Key Makers"){
				$vendor_icon = 'images/icons/keys.png';
			}
			else if($vndr_profession == "Electricians"){
				$vendor_icon = 'images/icons/electrician.png';
			}
			else if($vndr_profession == "Maid"){
				$vendor_icon = 'images/icons/maid.png';
			}
			else if($vndr_profession == "Masons"){
				$vendor_icon = 'images/icons/worker.png';
			}
			else if($vndr_profession == "Pest Control"){
				$vendor_icon = 'images/icons/spray.png';
			}
			else if($vndr_profession == "Plumber"){
				$vendor_icon = 'images/icons/faucet.png';
			}
			else if($vndr_profession == "Repairs"){
				$vendor_icon = 'images/icons/wrench.png';
			}
			else if($vndr_profession == "Tyre - Punctures"){
				$vendor_icon = 'images/icons/tyre_expert.png';
			}
			else if($vndr_profession == "Others"){
				$vendor_icon = 'images/icons/cogwheel.png';
			}
			else if($vndr_profession == "Watchman"){
				$vendor_icon = 'images/icons/policeman.png';
			}
			else if($vndr_profession == "Water Tanker Services"){
				$vendor_icon = 'images/icons/tanker.png';
			}
			return $vendor_icon;
		}
	?>
	<div class='main'>
	<?php 
		$get_vendor_record_sql = mysql_query("SELECT * FROM mprts_vendors where access_code = '$user_access_code'");
			
			 while($vendors_array = mysql_fetch_array($get_vendor_record_sql)){
				$vndr_id = $vendors_array['vndr_id'];
				$vndr_name = $vendors_array['vndr_name'];
				$vndr_profession = $vendors_array['vndr_profession'];
				
				$get_icon_all = set_icon($vndr_profession);
				
				echo "<span class='col s2' id='$vndr_id' onclick='show_vndr_details(this.id);'><img src='$get_icon_all' width='50px;'/><b>$vndr_profession</b></span>";
			}
	?>
	</div>
	