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
	if(isset($_POST["notes_details"])){
		$notes_details = $_POST['notes_details'];
		$notes_details_split = explode("|",$notes_details);
		$notes_category = $notes_details_split[0];
		$notes_date = $notes_details_split[1];
		$notes_description = $notes_details_split[2];

		$insert_notes_sql = mysql_query("INSERT into mprts_notes(notes_category, notes_description, notes_date, notes_access_code) values('$notes_category', '$notes_description', '$notes_date', '$user_access_code')");
	}
	if ($insert_notes_sql) {
		echo "Notes Added Successfully";
	}
	else{
		echo "Please Check the following Error in adding your notes:".mysql_error();
	}
?>
