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
<title>MPRTS | Home</title>
<?php include 'db_config.php'; ?>
<?php include 'headers.php'; ?>
<?php 
	$expense_id = $_POST['id'];
	$update_expense_sql = mysql_query("UPDATE mprts_expenses set expense_access_code  = SUBSTRING(expense_access_code, 1, CHAR_LENGTH(expense_access_code)-1)  where expense_id='$expense_id'");
		if ($update_expense_sql) {
		echo "<script>alert('Expense Successfully Re-Activated');</script>";
		header('Location: expense_content.php');
		}
		else{
			echo "<script>alert('Please check the action once');</script>";
		}
?>