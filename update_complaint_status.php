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
	$complaint_id = $_POST['id'];
	
	$show_complaint_sql = mysql_query("SELECT * from mprts_complaints where complaint_id='$complaint_id'");
		while ($row = mysql_fetch_array($show_complaint_sql)) {
			$complaint_id = $row['complaint_id'];
			$complaint_status = $row['complaint_status'];
		}
		if($complaint_status=='000'){
			$update_complaint_sql = mysql_query("UPDATE mprts_complaints set complaint_status  = '111'  where complaint_id='$complaint_id'");
		}
		
	
?>