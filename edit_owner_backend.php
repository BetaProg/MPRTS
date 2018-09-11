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
	$data_passed_split = explode("|",$data_passed);

	$new_owner_name = $data_passed_split[0];
	$new_owner_mobile = $data_passed_split[1];
	$new_owner_email = $data_passed_split[2];
	$new_owner_address = $data_passed_split[3];
	$owner_id = $data_passed_split[4];


	// $pmt_tenant_id = substr($pmt_tenant_id, 3);

	$update_owner_sql = mysql_query("UPDATE mprts_owner set owner_name = '$new_owner_name', owner_mobile = '$new_owner_mobile', owner_email = '$new_owner_email', owner_address = '$new_owner_address'  where owner_id = $owner_id");
	if($update_owner_sql) {
		echo "<script>alert('Owner Successfylly Updated');</script>";
	}
	else{
		echo mysql_error();
	}
?>