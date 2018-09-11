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

<?php
	if(isset($_POST["id"])){
		$asset_id = $_POST['id'];
		$asset_id_substr = substr($asset_id, 3);
		$get_asset_details_sql = mysql_query("SELECT * FROM mprts_property WHERE prty_id = '$asset_id_substr'"); 
		$asset_row = mysql_fetch_array($get_asset_details_sql);
		$asset_owner = $asset_row['prty_owner'];
		$asset_prty_no = $asset_row['prty_no'];
		$ast_prty_id = $asset_row['prty_building_id'];

		$get_owner_details_sql = mysql_query("SELECT * FROM mprts_owner WHERE owner_id = '$asset_owner'"); 
		$owner_row = mysql_fetch_array($get_owner_details_sql);
		$owner_id = $owner_row['owner_id'];
		$owner_name = $owner_row['owner_name'];

		$get_address_details = mysql_query("SELECT * from mprts_buildings where building_id = $ast_prty_id");
		$address_row = mysql_fetch_array($get_address_details);
		$address_building_name = $address_row['building_name'];
		$address_building_locality = $address_row['building_locality'];
		$address_building_city = $address_row['building_city'];
		$address_building_type = $address_row['building_type'];

		$building_address = $address_building_name.' - '.$address_building_locality.' - '.$address_building_city;

		echo $owner_id."|".$building_address."|".$asset_owner."|".$asset_id."|".$asset_prty_no."|".$owner_name;
	}
?>