<?php 
	session_start();
	$user_access_code = $_SESSION["user_access_code"];
	if(isset($_SESSION["user_name"])){
		// header('Location: index.php');
	}
	$get_building_access_code = mysql_query("SELECT building_id from mprts_buildings where building_access_code = '$user_access_code'");
	$building_count = mysql_num_rows($get_building_access_code);
	if($building_count>0){
		// header('Location: index.php');
		echo "<script>window.location='index.php'</script>";
	}
	else {
		// header('Location: add_content.php');
		echo "<script>window.location='add_content.php'</script>";
	}
?>
<body>
<title>MPRTS | Add Payment</title>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
	<script type="text/javascript">
		 $(document).ready(function() {
	    $('select').material_select();
	  });
	</script>
	<style type="text/css">
		input:read-only{
			cursor:not-allowed;
		}
	</style>
</body>