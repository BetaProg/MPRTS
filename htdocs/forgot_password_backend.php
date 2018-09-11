<?php 
	session_start();
?>
<?php include 'db_config.php'; ?>
<?php
	if(isset($_POST['email_entered'])){
		$user_email = $_POST['email'];
		$email_sql = mysql_query("SELECT * from mprts_users where user_email = '$user_email'");
		$user_count2 = mysql_num_rows($email_sql);
		if($user_count2>0){
			while ($user_row = mysql_fetch_array($email_sql)) {
				$user_name = $user_row['user_name'];
				$user_email = $user_row['user_email'];
				$user_pass = $user_row['user_pass'];

				//$mail_string = "Hi <b>".$user_name.". </b><br><p>This is your recent password. Please login to Maaproperties with these credentials.</p><br>Password: <b style='color:green;'>".$user_pass."</b><br>Regards,<p>Admin | Maa Properties</p>";
				$mail_string = "<div style='margin:5%;height:80%;width:auto;font-family: arial;border:1px solid #ddd;'>
	<center><img src='images/logo/maa_logo_light.jpg' /><h3>Maa Properties</h3></center>
	<div style='background-color:#336699;color:#fff;'>
		<h4 style='margin: auto auto 1% 5%;padding: 1%;'>Password Assistance</h4>
	</div>
	<div style='margin: 2% auto auto 5%;'>
		<br>Hi <b>".$user_name."</b> <br><p>Seems you forgot your password. Here is your most recent password. Please login with these credentials here. <a href='http://www.missionmaa.epizy.com'>Maa Properties</a></p>

			<table border='1' style='border-collapse: collapse;'>
				<tr>
					<td style='width:100px;text-align: center;'><b>Password: </b></td>
					<td style='padding:5%;width: 100px;'><p style='color:green;font-weight: bolder;'>".$user_pass."</p></td>
				</tr>
			</table>
		<p>Regards,<br>Admin | Maa Properties.</p>
	</div>
	<hr style='margin-top: 10%;width: 100%;'>
	<center><footer>For any queries, feel free to reach out to <a href='http://www.missionmaa.epizy.com'>Admin | Maa Properties</a></footer></center>
</div>
";
				$data_to_pass = $user_email."##".$mail_string;
				$_SESSION['message'] = $mail_string;
				$_SESSION['user_email']   = $user_email;
				$_SESSION['mail_sub']   = "Password Assistance | Maa Properties";
				header('Location: Mailnow/send_mail.php');

				//header('Location: login.php');
			}
		}
		else if ($user_count2==0) {
			$_SESSION["error_message"] = 'Please ensure Proper inputs';
			echo "<script>alert('Please check your Email id..!');</script>";
			header('Location: login.php');
		}
	}