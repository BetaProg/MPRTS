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
<?php include'db_config.php'; ?>
<?php include'headers.php'; ?>

<?php
header('Location: building_content.php');
if(isset($_POST["contentsubmit"])){

	$building_name = $_POST['building_name'];
	$building_units = $_POST['building_units'];

	$building_locality = $_POST['building_locality'];
	$building_city = $_POST['building_city'];
	$building_state = $_POST['building_state'];
	$building_pincode = $_POST['building_pincode'];

	$get_authority_details = mysql_query("SELECT * from mprts_users where user_access_code = $user_access_code");
	while ($row_aa = mysql_fetch_array($get_authority_details)) {
		$building_phno = $row_aa['user_mobile'];
		$building_email = $row_aa['user_email'];
	}

	$building_phno = $_POST['building_phno'];
	// $building_phno2 = $_POST['building_phno2'];
	$building_email = $_POST['building_email'];
	$building_current_meter = $_POST['building_current_meter'];
	$building_water_meter = $_POST['building_water_meter'];

	$building_type = $_POST['building_type'];

	$insert_content_sql = "INSERT into mprts_buildings (building_name, building_units, building_locality, building_city, building_state, building_pincode, building_phno, building_email, building_type, building_access_code, building_current_meter, building_water_meter) values ('$building_name', $building_units, '$building_locality', '$building_city', '$building_state', '$building_pincode', '$building_phno', '$building_email', '$building_type', '$user_access_code', '$building_current_meter', '$building_water_meter')";


	$insert_execute = mysql_query($insert_content_sql);
	if($insert_execute) {
		echo "<script>alert('Insertion Successful');</script>";
		header('Location: building_content.php');
	}
	else {
		echo "<script>alert('Error Insertion');</script>";
	}
}

?>
