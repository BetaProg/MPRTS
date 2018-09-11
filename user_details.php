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
	$accno = $_POST['id'];
	// echo $accno;
	//$show_user_sql = "SELECT * from mprts_users where user_name='$accno'";
	$show_user_sql = "SELECT * from mprts_users where user_email='$accno'";
	$show_user_execute = mysql_query($show_user_sql);
	while ($row = mysql_fetch_array($show_user_execute)) {
		$user_id = $row['user_id'];
		$user_new_name = $row['user_name'];
		$user_mobile = $row['user_mobile'];
		$user_email = $row['user_email'];
		$user_access_code = $row['user_access_code'];
		$user_status = $row['user_status'];
		$user_usc_no = $row['user_usc_no'];
		$user_pincode = $row['user_pincode'];
		$user_image = 'images/icons/user.png';
		
		if($user_status == 'Activated'){
			$color = '#B3FFB3';
		}
		else {
			$color = '#FFEBCC';	
		}
	}
	// echo $user_new_name.$user_mobile.$user_email.$user_image ;
	echo "<div class='user_details_main_content'>
		<h5>User Details: $user_new_name </h5>
		<div class='row' style='background-color:$color;'>
			<div class='col l3 m3 s2' style='padding-top:1%;padding-bottom:1%;'>
				<img class='user_image' src=$user_image >
			</div>
			<div class='col l9 m9 s12 user_details' style='padding-top:2%;padding-bottom:1%;'>
				<div class='row'>
					<div class='col s12' style='padding-bottom:1%;'>
						<div class='row'>
							<div class='col s3'>
								Name: 
							</div>
							<div class='col l8 m8 s9' style='font-weight:bolder;'>
								$user_new_name
							</div>
						</div>
					</div>
					<div class='col s12' style='padding-bottom:1%;'>
						<div class='row'>
							<div class='col s3'>
								Mobile:
							</div>
							<div class='col l8 m8 s9' style='font-weight:bolder;'>
								$user_mobile
							</div>
						</div>
					</div>
					<div class='col s12' style='padding-bottom:1%;'>
						<div class='row'>
							<div class='col s3'>
								Email:
							</div>
							<div class='col l8 m8 s9' style='font-weight:bolder;'>
								$user_email
							</div>
						</div>
					</div>
					<div class='col s12' style='padding-bottom:1%;'>
						<div class='row'>
							<div class='col s3'>
								Access Code:
							</div>
							<div class='col l8 m8 s9' style='font-weight:bolder;'>
								$user_access_code
							</div>
						</div>
					</div>
					<div class='col s12' style='padding-bottom:1%;'>
						<div class='row'>
							<div class='col s3'>
								Status:
							</div>
							<div class='col l8 m8 s9' style='font-weight:bolder;'>
								$user_status
							</div>
						</div>
					</div>
					<div class='col s12' style='padding-bottom:1%;'>
						<div class='row'>
							<div class='col s3'>
								USC No. :
							</div>
							<div class='col l8 m8 s9' style='font-weight:bolder;'>
								$user_usc_no
							</div>
						</div>
					</div>
					<div class='col s12' style='padding-bottom:1%;'>
						<div class='row'>
							<div class='col s3'>
								PINCODE :
							</div>
							<div class='col l8 m8 s9' style='font-weight:bolder;'>
								$user_pincode
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>";
?>