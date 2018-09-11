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

	$new_tenant_name = $data_passed_split[0];
	$new_tenant_propid = substr($data_passed_split[1], 3, 4);
	$new_tenant_mobile = $data_passed_split[2];
	$new_tenant_address = $data_passed_split[3];
	$new_tenant_email = $data_passed_split[4];
	// $new_tenant_id_type = $data_passed_split[5];
	// $new_tenant_id_no = $data_passed_split[6];
	$new_tenant_joining_date = $data_passed_split[5];
	$new_tenant_vacating_date = $data_passed_split[6];
	$new_tenant_advance = $data_passed_split[7];

	$tenant_id = $data_passed_split[8];


	// $pmt_tenant_id = substr($pmt_tenant_id, 3);

	// $update_tenant_sql = mysql_query("UPDATE mprts_tenants set tenant_name = '$new_tenant_name', tenant_propid = '$new_tenant_propid', tenant_mobile = '$new_tenant_mobile', tenant_address = '$new_tenant_address', tenant_email =  '$new_tenant_email', tenant_id_type = '$new_tenant_id_type', tenant_id_no = '$new_tenant_id_no', tenant_joining_date = '$new_tenant_joining_date', tenant_vacating_date = '$new_tenant_vacating_date', tenant_advance = '$new_tenant_advance' where tenant_id = $tenant_id");

	$update_tenant_sql = mysql_query("UPDATE mprts_tenants set tenant_name = '$new_tenant_name', tenant_propid = '$new_tenant_propid', tenant_mobile = '$new_tenant_mobile', tenant_address = '$new_tenant_address', tenant_email =  '$new_tenant_email', tenant_joining_date = '$new_tenant_joining_date', tenant_vacating_date = '$new_tenant_vacating_date', tenant_advance = '$new_tenant_advance' where tenant_id = $tenant_id");

	if($update_owner_sql) {
		echo "<script>alert('Updation Successful');</script>";
	}
	else{
		echo mysql_error();
	}
?>