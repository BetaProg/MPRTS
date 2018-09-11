<?php include 'db_config.php'; ?>

<?php
	if(isset($_POST["id"])){
		$building_id = $_POST['id'];
		$building_id = substr($building_id, 3);
		$get_building_details_sql = mysql_query("SELECT * FROM mprts_buildings WHERE building_id = '$building_id'"); 
		$building_row = mysql_fetch_array($get_building_details_sql);
		$building_name = $building_row['building_name'];
		$building_locality = $building_row['building_locality'];
		$building_city = $building_row['building_city'];
		$building_state = $building_row['building_state'];

		$building_address = $building_name.' - '.$building_locality.' - '.$building_city.' - '.$building_state;
		echo $building_name.",".$building_address;
	}
?>