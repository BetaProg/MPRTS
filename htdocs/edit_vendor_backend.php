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
	$data_passed_split = explode("#$#",$data_passed);

	$new_vndr_name = $data_passed_split[0];
	$new_vndr_phone1 = $data_passed_split[1];
	$new_vndr_email = $data_passed_split[2];
	$new_vndr_website = $data_passed_split[3];
	$new_vndr_locality = $data_passed_split[4];
	$new_vndr_city = $data_passed_split[5];
	$new_vndr_profession = $data_passed_split[6];
	
	
	$vendor_id = $data_passed_split[7];


	// $pmt_tenant_id = substr($pmt_tenant_id, 3);

	$update_vendor_sql = mysql_query("UPDATE mprts_vendors set vndr_name = '$new_vndr_name', vndr_profession = '$new_vndr_profession', vndr_website = '$new_vndr_website', vndr_locality = '$new_vndr_locality', vndr_city = '$new_vndr_city', vndr_phone1 = '$new_vndr_phone1', vndr_email = '$new_vndr_email' where vndr_id = '$vendor_id'");
	if($update_notification_sql) {
		echo "<script>alert('Vendor Updation Successful');</script>";
	}
	else{
		echo mysql_error();
	}
?>