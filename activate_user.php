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
	

		$user_id = $_POST['id'];
		$action = $_POST['actions'];
		$activate_user_sql = mysql_query("UPDATE mprts_users set user_status = '$action' where user_id=$user_id");
		if($activate_user_sql){
			echo "User has been Successfully Updated";
		}
		else {
			echo mysql_error();
		}
	

?>