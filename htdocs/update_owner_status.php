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
	$owner_id = $_POST['id'];
	$update_owner_sql = mysql_query("UPDATE mprts_owner set access_code  = SUBSTRING(access_code, 1, CHAR_LENGTH(access_code)-1)  where owner_id=$owner_id");
		if ($update_owner_sql) {
		echo "<script>alert('Owner Successfully Re-Activated');</script>";
		header('Location: owner_content.php');
		}
		else{
			echo "<script>alert('Please check the action once');</script>";
		}
?>