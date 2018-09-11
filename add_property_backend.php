<?php
	session_start();
	$user_name = $_SESSION["user_name"] ;
	$user_access_code = $_SESSION["user_access_code"];
?>
<?php include'db_config.php'; ?>
<?php include'headers.php'; ?>

<script type="text/javascript">
	alert('<?php echo $user_access_code; ?>');
</script>
<?php
// header('Location: property_content.php');
	
if(isset($_POST["propertysubmit"])){
	$prty_rooms = $_POST['prty_rooms'];
	$prty_no = $_POST['prty_no'];
	$prty_type = $_POST['prty_type'];
	$prty_building_id = $_POST['prty_building_id'];
	// $prty_building_id = 'PTY4';
	$prty_rent = $_POST['prty_rent'];
	$prty_owner = $_POST['prty_owner_id'];
	$prty_current_meter = $_POST['prty_current_meter'];
	$prty_gas_meter = $_POST['prty_gas_meter'];
	$prty_water_meter = $_POST['prty_water_meter'];
	// $prty_intercomm_meter = $_POST['prty_intercomm_meter'];

	$prty_building_id = substr($prty_building_id, 3);
	// $prty_building_id = substr($user_access_code, 2, 4);
	$prty_owner = substr($prty_owner, 3);
	

	$get_building_sql = "SELECT * from mprts_buildings where building_id = '$prty_building_id'";
	$get_building_execute = mysql_query($get_building_sql);

	$prty_building_count = mysql_num_rows($get_building_execute);
		$i=0;
		while($i<$prty_building_count){
			$row = mysql_fetch_array($get_building_execute);

			$building_id = $row['building_id'];
			$building_locality = $row['building_locality'];
			$building_city = $row['building_city'];
			$building_state = $row['building_state'];
			$building_pincode = $row['building_pincode'];
			$building_access_code = $row['$building_access_code'];

			$prty_address = $building_id.','.$building_locality.','.$building_city.','.$building_state.','.$building_pincode;

			$i++;
		}

	$get_owner_sql = "SELECT * from mprts_owner where owner_id = '$prty_owner'";
	$get_owner_execute = mysql_query($get_owner_sql);

	$prty_owner_count = mysql_num_rows($get_owner_execute);
		$j=0;
		while($j<$prty_owner_count){
			$row = mysql_fetch_array($get_owner_execute);

			$prty_owner_id = $row['owner_id'];
			$owner_access_code_full = $row['access_code'];
			$owner_asset_code = substr($owner_access_code_full, 6, 4);
			$j++;
		}	
	
		// $input_check = $building_locality.'-'.$prty_owner.'-'.$prty_address.'-'.$prty_no.'-'.$prty_type.'-'.$prty_rooms.'-'.$prty_water_meter.'-'.$prty_intercomm_meter.'-'.$prty_gas_meter.'-'.$building_id.'-'.$building_access_code;
	
		//$asset_access_code = substr($user_access_code, 0, 6).$prty_owner;
		$asset_access_code = substr($user_access_code, 0, 6).$owner_asset_code;

		//$insert_property_sql = mysql_query("INSERT into mprts_property(prty_location, prty_owner, prty_address, prty_no, prty_type, prty_rooms, prty_current_meter, prty_gas_meter, prty_building_id, access_code, prty_rent) values('$building_locality', '$prty_owner', '$prty_address', '$prty_no', '$prty_type', $prty_rooms, '$prty_current_meter', '$prty_gas_meter', '$prty_building_id', '$asset_access_code', '$prty_rent')");
		$insert_property_sql = mysql_query("INSERT into mprts_property(prty_location, prty_owner, prty_address, prty_no, prty_type, prty_rooms, prty_current_meter, prty_gas_meter, prty_building_id, access_code, prty_rent, prty_water_meter) values('$building_locality', '$prty_owner', '$prty_address', '$prty_no', '$prty_type', $prty_rooms, '$prty_current_meter', '$prty_gas_meter', '$prty_building_id', '$asset_access_code', '$prty_rent', '$prty_water_meter')");


	if($insert_property_sql) {
		echo "<script>alert('Insertion Successful');</script>";
		header('Location: property_content.php');

	}
	else {
		// echo "<script>alert('Error Insertion');</script>";
		echo mysql_error();
	}
}

?>
