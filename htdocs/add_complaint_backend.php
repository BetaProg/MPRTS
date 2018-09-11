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
	if(isset($_POST["complaint_data"])){
		$complaint_status_details = $_POST['complaint_data'];
		$complaint_id = $_SESSION["complaint_id"];
		echo "<script>alert($complaint_id)</script>";
		$complaint_status_details_split = $complaint_status_details;
		//$complaint_id = echo "<script>debugger;sessionStorage.getItem('complaint_id');</script>";
		$complaint_status = $complaint_status_details;
		if($complaint_status=="read"){
			$complaint_status = "111";
		}
		else if($complaint_status=="inprogress"){
			$complaint_status = "222";
		}
		else if($complaint_status=="completed"){
			$complaint_status = "333";
		}
		$sqlit = "update mprts_complaints set complaint_status = '$complaint_status' where complaint_id = '$complaint_id'";
		$update_complaint_sql = mysql_query($sqlit);
	}
	
	if(isset($_POST["complaint_details"])){
		$complaint_details = $_POST['complaint_details'];
		$complaint_details_split = explode("#|#",$complaint_details);
		$complaint_title = $complaint_details_split[0];
		$complaint_desc = $complaint_details_split[1];
		$complaint_date = $complaint_details_split[2];
		
		//$get_complaint_association = mysql_query("select * from mprts_property where prty_id = substr('$user_access_code', 3, 4)");
		$get_complaint_association = mysql_query("select * from mprts_property where prty_id = (select prty_id from mprts_property where substr(access_code, 3, 8) = substr('$user_access_code', 3, 8))");
		while($association_row = mysql_fetch_array($get_complaint_association)){
			$complaint_association = $association_row['prty_id'];
		
		
		

		$insert_complaint_sql = mysql_query("INSERT into mprts_complaints(complaint_date, complaint_title, complaint_desc, user_access_code, complaint_association) values('$complaint_date', '$complaint_title', '$complaint_desc', '$user_access_code', '$complaint_association')");
		}
	}
	if ($insert_complaint_sql) {
		echo "Complaint Registered Successfully";
	}
	if ($update_complaint_sql) {
		echo "<script>console.log($sqlit)</script>";
	}
	else if (!($update_complaint_sql)) {
		echo "<script>console.log($sqlit)</script>";
	}
	
	else{
		echo "Please Check the following Error in adding your notes:".mysql_error();
	}
?>
