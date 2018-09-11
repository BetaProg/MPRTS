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
	$data_passed_split = explode("#|#",$data_passed);

	$new_prty_location = $data_passed_split[0];
	$new_prty_address = $data_passed_split[1];
	$new_prty_no = $data_passed_split[2];
	$new_prty_current_meter = $data_passed_split[3];
	$new_prty_gas_meter = $data_passed_split[4];
	$new_prty_water_meter = $data_passed_split[5];
	// $new_prty_intercomm_meter = $data_passed_split[5];
	$new_prty_rent = $data_passed_split[6];
	$new_prty_rooms = $data_passed_split[7];
	//$new_prty_owner_id = substr($data_passed_split[8], 3, 4);
	$new_prty_owner_id = $data_passed_split[8];
	$prty_id = $data_passed_split[9];



	// $pmt_tenant_id = substr($pmt_tenant_id, 3);

	$update_asset_sql = mysql_query("UPDATE mprts_property set prty_location = '$new_prty_location', prty_address = '$new_prty_address', prty_no = '$new_prty_no', prty_current_meter = '$new_prty_current_meter', prty_gas_meter = '$new_prty_gas_meter', prty_water_meter = '$new_prty_water_meter', prty_rent = '$new_prty_rent', prty_rooms = '$new_prty_rooms', prty_owner = '$new_prty_owner_id'  where prty_id = $prty_id");
	if($update_asset_sql) {
		echo "<script>alert('Updation Successful');</script>";
	}
	else{
		echo mysql_error();
	}
?>