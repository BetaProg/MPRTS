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
	$access_type = substr($user_access_code, 0, 2);
	if($access_type == 'AA'){
		$expense_id = $_POST['id'];
		$delete_expense_sql = mysql_query("UPDATE mprts_expenses set expense_access_code  = concat(expense_access_code, 'D')  where expense_id=$expense_id");
		if ($delete_expense_sql) {
		echo "<script>alert('Expense Successfully Deleted');</script>";
		header('Location: expense_content.php');
		}
		else{
			echo "<script>alert('Please check the action once');</script>";
		}
	}

	
	else if($access_type == 'OO'){
			echo "<script>alert('Action Not supported for Owners');</script>";
			header('Location: expense_content.php');
	}
?>