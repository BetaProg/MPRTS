<?php 
	$get_building_access_code = mysql_query("SELECT building_id from mprts_buildings where building_access_code = '$user_access_code'");
		$building_count = mysql_num_rows($get_building_access_code);
		if($building_count==0){
			// header('Location: add_content.php');
			// echo "<script>alert('No records found');</script>";
			
		}
		else {
			// header('Location: add_content.php');
			// echo "<script>alert('Records exist');</script>";
		}

		$access_type = substr($user_access_code, 0, 2);
		if($access_type == 'AA' && $building_count==0){
			// header('Location: add_content.php');
			echo "<script>$('body').load('add_content.php');document.getElementsByClassName('left_content')[0].style='display:none !important;'</script>";
		}
		else {
			
		}
?>