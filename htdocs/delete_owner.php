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
		$owner_id = $_POST['id'];
		// $owner_id = '0001';
		// echo $accno;
		// echo "<script>alert('$owner_id');</script>";
		$delete_user_sql = mysql_query("UPDATE mprts_owner set access_code  = concat(access_code, 'D')  where owner_id=$owner_id");
		if ($delete_user_sql) {
		echo "<script>alert('Owner Successfully Deleted');</script>";
		header('Location: property_content.php');
		}
		else{
			echo "<script>alert('Please check the action once');</script>";
		}
	}

	
	else if($access_type == 'OO'){
			header('Location: owner_content.php');
	}
?>