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
<?php 
	// $tenant_id = $_POST['tenant_id'];
	$tenant_id = $_POST['id'];

	$tenant_id = substr($tenant_id, 3, 4);

	$result = mysql_query("SELECT * FROM mprts_tenants WHERE tenant_id = '$tenant_id'"); 
	$all_tenant_data = mysql_fetch_array($result);
	$tenant_name = $all_tenant_data['tenant_name'];
	$tenant_propid = $all_tenant_data['tenant_propid'];
	$tenant_owner_id = $all_tenant_data['tenant_owner_id']; 

	$tenant_propid_add = 'AST'.$tenant_propid;

	$get_property_details_sql = mysql_query("SELECT * FROM mprts_property WHERE prty_id = '$tenant_propid'"); 
	$prop_row = mysql_fetch_array($get_property_details_sql);
	$prty_location = $prop_row['prty_location'];
	$prty_building_id = $prop_row['prty_building_id'];
	$prty_rent = $prop_row['prty_rent'];

	$get_owner_details_sql = mysql_query("SELECT * FROM mprts_owner WHERE owner_id = '$tenant_owner_id'"); 
	$owner_row = mysql_fetch_array($get_owner_details_sql);
	$owner_name = $owner_row['owner_name'];

	$get_building_details_sql = mysql_query("SELECT * FROM mprts_buildings WHERE building_id = '$prty_building_id'"); 
	$building_row = mysql_fetch_array($get_building_details_sql);
	$building_name = $building_row['building_name'];
	$building_locality = $building_row['building_locality'];
	$building_city = $building_row['building_city'];
	$building_state = $building_row['building_state'];

	$building_address = $building_name.' - '.$building_locality.' - '.$building_city.' - '.$building_state;
	echo $tenant_name.",".$tenant_propid_add.",".$building_address.",".$owner_name.",".$prty_rent;
	// exit();   
?>

<?php

	if(isset($_POST["payment_details"])){
		$payment_details = $_POST['payment_details'];
		$payment_details_split = explode("#|#",$payment_details);
		$pmt_tenant_id = $payment_details_split[0];
		$pmt_from_date = $payment_details_split[1];
		$pmt_to_date = $payment_details_split[2];
		$pmt_reciept_no = $payment_details_split[3];
		$pmt_amt_actual = $payment_details_split[4];
		$pmt_amt_paid = $payment_details_split[5];
		$pmt_cause = $payment_details_split[6];
		$pmt_due = $payment_details_split[7];

		$pmt_tenant_id = substr($pmt_tenant_id, 3);

		$get_asset_details_sql1 = mysql_query("SELECT * from mprts_tenants where tenant_id = '$pmt_tenant_id'");
		$pmt_asset1 = mysql_fetch_array($get_asset_details_sql1)['tenant_propid'];


		$insert_payment_sql = mysql_query("INSERT into mprts_payments(mprts_pmt_tnt, mprts_pmt_asset, mprts_pmt_from_date, mprts_pmt_to_date, mprts_pmt_act_amt, mprts_pmt_paid_amt, mprts_receipt_no, mprts_access_code, mprts_pmt_cause, mprts_pmt_due) values('$pmt_tenant_id', '$pmt_asset1', '$pmt_from_date', '$pmt_to_date', '$pmt_amt_actual', '$pmt_amt_paid', '$pmt_reciept_no', '$user_access_code', '$pmt_cause', '$pmt_due')");
	}
	else if(isset($_POST["payment_details_owner"])){
		$payment_details = $_POST['payment_details_owner'];
		$payment_details_split = explode("#|#",$payment_details);
		$pmt_tenant_id = $payment_details_split[0];
		$pmt_from_date = $payment_details_split[1];
		$pmt_to_date = $payment_details_split[2];
		$pmt_reciept_no = $payment_details_split[3];
		$pmt_amt_actual = $payment_details_split[4];
		$pmt_amt_paid = $payment_details_split[5];
		$pmt_cause = $payment_details_split[6];
		$pmt_due = $payment_details_split[7];

		//$pmt_tenant_id = substr($pmt_tenant_id, 3);

		$get_asset_details_sql2 = mysql_query("SELECT * from mprts_property where prty_owner = $pmt_tenant_id");
		$asset_count = mysql_num_rows($get_asset_details_sql2);
		if($asset_count>0){
				$asset_row = mysql_fetch_array($get_asset_details_sql2);
				$pmt_asset2 = $asset_row['prty_id'];
				//echo "mprts_pmt_tnt = ".$pmt_tenant_id." mprts_pmt_asset = ".$pmt_asset2;
		}
		else{
			echo mysql_error;
		}
		
		$payment_tenant_num = (string)$pmt_tenant_id;
		//echo "<br>";
		//echo $payment_tenant_num;
		
		$insert_payment_sql = mysql_query("INSERT into mprts_payments(mprts_pmt_tnt, mprts_pmt_asset, mprts_pmt_from_date, mprts_pmt_to_date, mprts_pmt_act_amt, mprts_pmt_paid_amt, mprts_receipt_no, mprts_access_code, mprts_pmt_cause, mprts_pmt_due) values($payment_tenant_num, '$pmt_asset2', '$pmt_from_date', '$pmt_to_date', '$pmt_amt_actual', '$pmt_amt_paid', '$pmt_reciept_no', '$user_access_code', '$pmt_cause', '$pmt_due')");
		if($insert_payment_sql){
			
		}
		else{
			echo mysql_error;
		}
	}
?>