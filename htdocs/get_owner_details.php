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
<?php
	if(isset($_POST["id"])){
		$owner_id = $_POST['id'];
		$owner_id = substr($owner_id, 3);

		$get_owner_details_sql = mysql_query("SELECT * FROM mprts_owner WHERE owner_id = '$owner_id'"); 
		$owner_row = mysql_fetch_array($get_owner_details_sql);
		$owner_name = $owner_row['owner_name'];

		echo $owner_id."|".$owner_name;
	}
?>