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
<?php include 'headers.php'; ?>
<?php
	$data_passed = $_POST['data_passed'];
	$data_passed_split = explode("-",$data_passed);

	$new_building_name = $data_passed_split[0];
	// $new_building_type = $data_passed_split[1];
	$new_building_units = $data_passed_split[2];
	$new_building_locality = $data_passed_split[3];
	$new_building_city = $data_passed_split[4];
	$new_building_state = $data_passed_split[5];
	$new_building_pincode = $data_passed_split[6];
	$new_building_current_meter = $data_passed_split[7];
	$new_building_water_meter = $data_passed_split[8];

	$building_id = $data_passed_split[9];



	// $pmt_tenant_id = substr($pmt_tenant_id, 3);

	$update_building_sql = mysql_query("UPDATE mprts_buildings set building_name = '$new_building_name', building_units = '$new_building_units', building_locality = '$new_building_locality', building_city = '$new_building_city', building_state = '$new_building_state', building_pincode = '$new_building_pincode', building_current_meter = '$new_building_current_meter', building_water_meter = '$new_building_water_meter'  where building_id = $building_id");
	if($update_building_sql) {
		echo "<script>alert('Updation Successful');</script>";
	}
	else{
		echo mysql_error();
	}
?>