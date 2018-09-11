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
	if(isset($_POST['id'])){
		$tenant_id = $_POST['id'];
		//$tenant_id = substr($tenant_id, 3);
		$get_tenant_details_sql = mysql_query("SELECT * FROM mprts_tenants WHERE tenant_id = '$tenant_id'"); 
		$tenant_row = mysql_fetch_array($get_tenant_details_sql);
		$tenant_name = $tenant_row['tenant_name'];
		$tenant_propid = $tenant_row['tenant_propid'];

		$get_owner_details_sql = mysql_query("SELECT * FROM mprts_owner WHERE owner_id = (select prty_owner from mprts_property where prty_id = $tenant_propid)"); 
		$owner_row = mysql_fetch_array($get_owner_details_sql);
		$owner_name = $owner_row['owner_name'];

		$get_prop_details_sql = mysql_query("SELECT * FROM mprts_property WHERE prty_id = (select tenant_propid from mprts_tenants where tenant_id = $tenant_id)"); 
		$prty_row = mysql_fetch_array($get_prop_details_sql);
		$prty_no = $prty_row['prty_no'];

		$get_address_details = mysql_query("SELECT * from mprts_buildings where building_id = (select prty_building_id from mprts_property where prty_id = $tenant_propid)");
		$address_row = mysql_fetch_array($get_address_details);
		$address_building_name = $address_row['building_name'];
		$address_building_locality = $address_row['building_locality'];
		$address_building_city = $address_row['building_city'];
		$address_building_type = $address_row['building_type'];

		$building_address = $address_building_name.' - '.$address_building_locality.' - '.$address_building_city;

		echo $tenant_id."|".$tenant_name."|".$owner_name."|".$building_address."|".$prty_no;
	}
?>