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

	$new_expense_date = $data_passed_split[0];
	$new_expense_amount = $data_passed_split[1];
	$new_expense_cause = $data_passed_split[2];
	$new_expense_description = $data_passed_split[3];
	$new_expense_assc_id = $data_passed_split[4];
	$expense_id = $data_passed_split[5];


	// $pmt_tenant_id = substr($pmt_tenant_id, 3);

	$update_expense_sql = mysql_query("UPDATE mprts_expenses set expense_date = '$new_expense_date', expense_amount = '$new_expense_amount', expense_cause = '$new_expense_cause', expense_description = '$new_expense_description', expense_association = '$new_expense_assc_id'  where expense_id = $expense_id");
	if($update_expense_sql) {
		echo "<script>alert('Updation Successful');</script>";
	}
	else{
		echo mysql_error();
	}
?>