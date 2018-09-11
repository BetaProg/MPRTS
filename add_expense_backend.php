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
<?php include'headers.php'; ?>

<?php
//header('Location: owner_content.php');
if(isset($_POST["expensesubmit"])){
	$expense_amount = $_POST['expense_amount'];
	$expense_date = $_POST['expense_date'];
	$expense_cause = $_POST['expense_cause'];
	$expense_description = $_POST['expense_description'];
	$expense_assc_id = $_POST['expense_assc_id'];

	// echo $expense_amount.'-'.$expense_date.'-'.$expense_cause.'-'.$expense_description;


	$insert_expense_sql = mysql_query("INSERT into mprts_expenses (expense_date, expense_amount, expense_cause, expense_description, expense_access_code, expense_association) values ('$expense_date', '$expense_amount', '$expense_cause', '$expense_description', '$user_access_code', '$expense_assc_id')");

	// $insert_expense_execute = mysql_query($insert_expense_sql);


	if($insert_expense_sql) {
		header('Location: expense_content.php');
	}
	else {
		echo mysql_error();
	}
}

?>
