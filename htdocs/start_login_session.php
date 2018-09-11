<?php
	session_start();
	if(isset($_POST["session_details"])){
		$session_details = $_POST['session_details'];
		$session_details_split = explode("|#|",$session_details);
		$user_access_code = $session_details_split[0];
		$user_name = $session_details_split[1];
		$_SESSION["user_name"] = $user_name;
		$_SESSION["user_access_code"] = $user_access_code;
		header('Location: index.php');
	}
?>