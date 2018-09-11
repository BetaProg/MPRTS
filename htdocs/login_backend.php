<?php 
	session_start();
?>
<?php include 'db_config.php'; ?>
<?php
	if(isset($_POST['user_submit'])){
		$user_email = $_POST['user_email'];
		$user_pass = $_POST['user_pass'];
		//$login_sql = mysql_query("SELECT * from mprts_users where user_email = '$user_email' and user_pass = '$user_pass' and ( (user_status NOT IN ('Initial') and substr(user_access_code,1,2)='AA')   or   (substr(user_access_code,1,2)='OO' and user_id in (select user_id from mprts_users where substr(user_access_code, 3, 4) not in (select substr(user_access_code, 3, 4) from mprts_users where substr(user_access_code,1,2)='AA' and user_status IN ('Initial'))))   or  substr(user_access_code,1,2)='MM' )");
		$assets_array = array();
		$select_user_sql = mysql_query("SELECT * from mprts_users where user_email = '$user_email' and user_pass = '$user_pass' and ( (user_status NOT IN ('Initial') and substr(user_access_code,1,2)='AA')   or   (substr(user_access_code,1,2)='OO' and user_id in (select user_id from mprts_users where substr(user_access_code, 3, 4) not in (select substr(user_access_code, 3, 4) from mprts_users where substr(user_access_code,1,2)='AA' and user_status IN ('Initial'))))   or  substr(user_access_code,1,2)='MM' )");
		
		$user_count = mysql_num_rows($select_user_sql);
		if($user_count>0){
			while ($user_row = mysql_fetch_array($select_user_sql)) {
				$user_name = $user_row['user_name'];
				$user_access_code = $user_row['user_access_code'];
				$user_email = $user_row['user_email'];
				if(substr($user_access_code, 0, 1) == "O" && $user_count>1){
					$_SESSION["user_email"] = $user_email;
					$get_owner_sql = mysql_query("select distinct prty_owner from mprts_property where prty_owner IN (select owner_id from mprts_owner where access_code = '$user_access_code')");
					while ($owner_row = mysql_fetch_array($get_owner_sql)) {
						
						$prty_owner = $owner_row['prty_owner'];
						//$prty_no = $owner_row['prty_no'];
						//$prty_id = $owner_row['prty_id'];
						
						$get_building_sql = mysql_query("select * from mprts_buildings where building_id IN (select prty_building_id from mprts_property where prty_owner = '$prty_owner')");
						while ($building_row = mysql_fetch_array($get_building_sql)) {
							
							$building_id = $building_row['building_id'];
							$building_name = $building_row['building_name'];
							$building_locality = $building_row['building_locality'];
							$building_access_code = $building_row['building_access_code'];
							
							$array_input = $user_name."|#|".$user_email."|#|".$building_id."|#|".$building_name."|#|".$building_locality."|#|".$user_access_code."|#|"."<br>";
							
							array_push($assets_array,$array_input);
							header('Location: login_selection.php');
						}
				
						//$_SESSION["user_details"] = $user_name+"|#|"+$user_email+"|#|"+$prty_id+"|#|"+$prty_no+"|#|"+$prty_location;
						//$_SESSION["user_access_code"] = $user_access_code;
						
					}
					$_SESSION["user_details"] = $assets_array;
				}
				else if(substr($user_access_code, 0, 1) == "A" || substr($user_access_code, 0, 1) == "M"){
					$select_aa_sql = mysql_query("select * from mprts_users where user_email='$user_email' and user_pass='$user_pass' and (user_status NOT IN ('Initial'))");
					while ($aa_row = mysql_fetch_array($select_aa_sql)) {
						$user_name = $aa_row['user_name'];
						$user_email = $aa_row['user_email'];
						$user_access_code = $aa_row['user_access_code'];
				
						$_SESSION["user_name"] = $user_name;
						$_SESSION["user_access_code"] = $user_access_code;
						$_SESSION["user_email"] = $user_email;
						
						
						
						header('Location: index.php');
					}
				}
				else if(substr($user_access_code, 0, 1) == "O" && $user_count == 1){
					$select_aa_sql = mysql_query("select * from mprts_users where user_email='$user_email' and user_pass='$user_pass'");
					while ($aa_row = mysql_fetch_array($select_aa_sql)) {
						$user_name = $aa_row['user_name'];
						$user_email = $aa_row['user_email'];
						$user_access_code = $aa_row['user_access_code'];
				
						$_SESSION["user_name"] = $user_name;
						$_SESSION["user_access_code"] = $user_access_code;
						$_SESSION["user_email"] = $user_email;
						
						
						
						header('Location: index.php');
					}
				}
				
			}
		}
		else if ($user_count==0) {
			$_SESSION["error_message"] = 'Please ensure Proper inputs';
			echo "<script>alert('Invalid Email or Password..!');</script>";
			header('Location: login.php');
		}
		// else {
		// 	echo "<script>alert('Invalid Username or Password..!');</script>";
		// 	header('Location: login.php');
		// }

	}
?>