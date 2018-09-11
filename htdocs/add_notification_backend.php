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
<script>
	function send_notification_mail(notification_mail_id, notification_title, notification_assc_id){
		alert(notification_mail_id);
		//var r = confirm("Are you sure you want to mail this payment!");
		//var r = true;
		//if (r == true) {
		var mail_sub = "Maa Properties Notification | "+notification_assc_id;
		var message = "<h5><p>Hi Sir/Madam,</p><p> You have a new notification from Maa Properties. Please find the details below</p></h5>"+notification_title;
		var user_email = notification_mail_id;
		var mail_data_to_pass = mail_sub+"#$#"+message+"#$#"+user_email;
		$.ajax({
				  url: "send_payment_mail.php",
				  data: {
					payment_details_to_mail: mail_data_to_pass
				  },
				  type: 'post',
				  cache: false,
				  success: function(value){
						 //alert('Payment Added Successfully');
						 //location.reload();
						 console.log(value);
					}
				});
		//} 
		
	}
</script>
<?php
	if(isset($_POST["notification_data"])){
		//$notification_details = "Notifications mail 2503 8#|#Notifications mail 2503 8 content#|#180325#|#AST0012";
		$notification_details = $_POST['notification_data'];
		//echo "<script>alert('1');</script>";
		$notification_details_split = explode("#|#",$notification_details);
		$notification_title = $notification_details_split[0];
		$notification_text = $notification_details_split[1];
		$notification_date = $notification_details_split[2];
		$notification_assc_id = $notification_details_split[3];
		$notification_access_code = $user_access_code;

		$get_email_details = mysql_query("select * from mprts_owner where owner_id = (select prty_owner from mprts_property where prty_id = substr('$notification_assc_id', 4, 4))");
		while($email_row = mysql_fetch_array($get_email_details)){
			$email_id = $email_row['owner_email'];
		}
		//echo "<script>console.log('$email_id');</script>";
		
		//if($insert_execute) {
		echo "<script>send_notification_mail('$email_id', '$notification_title', '$notification_assc_id');</script>";
			header('Location: notifications_content.php');
		//}
		
		$insert_notification_sql = "INSERT into mprts_notifications (notification_title, notification_text, notification_date, notification_access_code, notification_association) values ('$notification_title', '$notification_text', '$notification_date', '$notification_access_code', '$notification_assc_id')";
		$insert_execute = mysql_query($insert_notification_sql);
		if($insert_execute) {
			header('Location: notifications_content.php');
		}
		
		else {
			echo "<script>alert('There is some issue with this notifications. Please review before adding it.');</script>";
		}
	}
?>