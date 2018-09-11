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
	$mail_data_to_pass = $_POST['payment_details_to_mail'];
	echo "<script>console.log($mail_data_to_pass);</script>";
	$data_passed_split = explode("#$#",$mail_data_to_pass);
	$mail_sub = $data_passed_split[0];
	$message = $data_passed_split[1];
	$user_email = $data_passed_split[2];

	
	$_SESSION['mail_sub'] = $mail_sub;
	$_SESSION['message'] = $message;
	$_SESSION['user_email'] = $user_email;
	echo "<script>console.log('Success');</script>";
	header('Location: Mailnow/send_mail.php');
?>