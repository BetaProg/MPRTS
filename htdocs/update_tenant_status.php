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
	$tenant_id = $_POST['id'];
	$update_tenant_sql = mysql_query("UPDATE mprts_tenants set access_code  = SUBSTRING(access_code, 1, CHAR_LENGTH(access_code)-1)  where tenant_id=$tenant_id");
		if ($update_tenant_sql) {
		echo "<script>alert('Tenant Successfully Re-Activated');</script>";
		header('Location: tenant_content.php');
		}
		else{
			echo "<script>alert('Please check the action once');</script>";
		}
?>