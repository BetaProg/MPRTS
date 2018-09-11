<?php
	session_start();
	include 'db_config.php';
		$register_data = $_POST['register_data'];
		$register_details_split = explode("#|#",$register_data);
		$user_type = $register_details_split['0'];
		$user_name = $register_details_split['1'];
		$user_email = $register_details_split['2'];
		$user_mobile = $register_details_split['3'];
		$user_pass = $register_details_split['4'];
		$user_usc_no = $register_details_split['5'];
		$user_pincode = $register_details_split['6'];
		
		
		
		$aa_register_sql = mysql_query("INSERT into mprts_users(user_type, user_name, user_email, user_mobile, user_pass, user_usc_no, user_pincode) values('$user_type', '$user_name', '$user_email', '$user_mobile', '$user_pass', '$user_usc_no', '$user_pincode')");

		if ($aa_register_sql) {
		//echo "Success";
		
			$get_latest_userid = mysql_query("SELECT user_type, user_id from mprts_users order by user_id desc limit 1 ");
			while($access_array = mysql_fetch_array($get_latest_userid)){
				$max_user_id = $access_array['user_id'];
				$user_type = $access_array['user_type'];
			}

			$get_latest_aa = mysql_query("SELECT user_access_code from mprts_users WHERE substr(user_access_code, 1, 2) = '$user_type' ORDER BY user_id DESC LIMIT 1");
			if(mysql_num_rows($get_latest_aa)<1){
				$current_aa = 1;
				$current_aa = '000'.$current_aa;
			}
			else {
				while ($latest_array = mysql_fetch_array($get_latest_aa)) {
					$latest_aa = $latest_array['user_access_code'];
					$current_aa = (int)substr($latest_aa, 2, 4)+1;
					if((int)$current_aa>0 && (int)$current_aa<10){
						$current_aa = '000'.$current_aa;
					}
					else if($current_aa>9 && $current_aa<100){
						$current_aa = '00'.$current_aa;
					}
					else if($current_aa>99 && $current_aa<1000){
						$current_aa = '0'.$current_aa;
					}
				}
			}
			$update_access_code_sql = mysql_query("UPDATE mprts_users set user_access_code = concat('$user_type', '$current_aa', '0000') where user_id = $max_user_id ");

			if ($update_access_code_sql) {
				$mail_string = "<div style='width:100%;height:100%;background-color:#3297DB;color:#000;margin:0px;padding:0px;font-family:calibri;position:absolute;'>
								<div style='width:90%;height:10%;background-color:#fff;margin:2%;padding:2%;'>
									<img src='C:\Users\HP\Pictures\maa_logo_light.jpg' style='width:6%;float:left;'>
									<h style='font-size:40px;float:left;margin-left:2%;'>Maa Properties</h>
								</div>
								<div style='width:90%;height:20%;background-color:#fff;margin:2%;padding-top:1%;padding-right:2%;padding-bottom:3%;padding-left:2%;'>
									<p>Welcome ".$user_name."</p>
									<p>Your account with Email: <b>".$user_email."</b> and USC No: <b>".$user_usc_no."</b> has been registered with Maa Properties.</p>
									<p>You can try logging into your account once the verification process gets completed.</p>
									<p>You will receive a confirmation message shorty. (Usually with in 24 hours from time of registration)</p>
								</div>
								<div style='width:90%;height:20%;background-color:#fff;margin:2%;padding:1% 2%;'>
									<p>Regards,</p>
									<p>Admin | Maa Properties</p>
								</div>
							</div>";
				$data_to_pass = $user_email."##".$mail_string;
				$_SESSION['mail_sub']   = "Welcome to Maaproperties";
				$_SESSION['message'] = $mail_string;
				$_SESSION['user_email']   = $user_email;

				header('Location: Mailnow/send_mail.php');
			}
			else{
				echo 1;
			}
			
		}
		else {
			//echo "Failure";
			echo "Some Another account exists with the same credentials. Please try with some other credentials or contact administrator";
		}
?>