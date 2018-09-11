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

	$new_notification_title = $data_passed_split[0];
	$new_notification_text = $data_passed_split[1];
	$notification_id = $data_passed_split[2];


	// $pmt_tenant_id = substr($pmt_tenant_id, 3);

	$update_notification_sql = mysql_query("UPDATE mprts_notifications set notification_title = '$new_notification_title', notification_text = '$new_notification_text' where notification_id = '$notification_id'");
	if($update_notification_sql) {
		echo "<script>alert('Updation Successful');</script>";
	}
	else{
		echo mysql_error();
	}
?>