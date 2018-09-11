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



// if (!empty($_FILES) && isset($_FILES['fileToUpload'])) {
//     switch ($_FILES['fileToUpload']["error"]) {
//         case UPLOAD_ERR_OK:
//             $target = "uploads/";
//             $target = $target . basename($_FILES['fileToUpload']['name']);

//             if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target)) {
//                 $status = "The file " . basename($_FILES['fileToUpload']['name']) . " has been uploaded";
//                 $file_name = 'uploads/'.basename($_FILES['fileToUpload']['name']);
//                 $imageFileType = pathinfo($target, PATHINFO_EXTENSION);
//                 $check = getimagesize($target);

//                 if ($check !== false) {
//                     echo "File is an image - " . $check["mime"] . ".<br>";
//                     $uploadOk = 1;
//                 } else {
//                     echo "File is not an image.<br>";
//                     $uploadOk = 0;
//                 }

//             } else {
//                 $status = "Sorry, there was a problem uploading your file.";
//             }
//             break;
//     }
// }




if(isset($_POST["ownersubmit"])){

	 switch ($_FILES['fileToUpload']["error"]) {
        case UPLOAD_ERR_OK:
            $target = "uploads/";
            $target = $target . basename($_FILES['fileToUpload']['name']);

            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target)) {
                $status = "The file " . basename($_FILES['fileToUpload']['name']) . " has been uploaded";
                $file_name = 'uploads/'.basename($_FILES['fileToUpload']['name']);
                $imageFileType = pathinfo($target, PATHINFO_EXTENSION);
                $check = getimagesize($target);

                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".<br>";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.<br>";
                    $uploadOk = 0;
                }

            } else {
                $status = "Sorry, there was a problem uploading your file.";
            }
            break;
    }

    switch ($_FILES['IdToUpload']["error"]) {
        case UPLOAD_ERR_OK:
            $target = "uploads/OwnerIds/";
            $target = $target . basename($_FILES['IdToUpload']['name']);

            if (move_uploaded_file($_FILES['IdToUpload']['tmp_name'], $target)) {
                $status = "The file " . basename($_FILES['IdToUpload']['name']) . " has been uploaded";
                $id_file_name = 'uploads/OwnerIds/'.basename($_FILES['IdToUpload']['name']);
                $imageFileType = pathinfo($target, PATHINFO_EXTENSION);
                $check = getimagesize($target);

                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".<br>";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.<br>";
                    $uploadOk = 0;
                }

            } else {
                $status = "Sorry, there was a problem uploading your file.";
            }
            break;

    }



	$owner_name = $_POST['owner_name'];
	$owner_mobile = $_POST['owner_mobile'];
	$owner_email = $_POST['owner_email'];
	$owner_address = $_POST['owner_address'];


	$insert_owner_sql = "INSERT into mprts_owner (owner_name, owner_mobile, owner_photo, owner_id_proof, owner_email, owner_address) values ('$owner_name', '$owner_mobile', '$file_name', '$id_file_name', '$owner_email', '$owner_address')";

	$insert_execute = mysql_query($insert_owner_sql);
	
	$building_code = substr($user_access_code, 2, 4);
	$asset_code = substr($user_access_code, 6, 4);

	$latest_oo = mysql_query("SELECT access_code from mprts_owner where substr(access_code, 3, 4) = '$building_code' order by substr(access_code, 9) DESC LIMIT 1 ");
	if(mysql_num_rows($latest_oo)<1){
					$max_owner_id_0 = 1;
					$max_owner_id_3 = '000'.$max_owner_id_0;
				}
				else{
	while($row_owner_id = mysql_fetch_array($latest_oo)){
		$max_owner_id = $row_owner_id['access_code'];
		$max_owner_id_2 = (int)substr($max_owner_id, 6, 4)+1;
		$max_owner_id_3 = '000'.$max_owner_id_2;
	}
}

	$get_present_owner_id_sql = mysql_query("SELECT owner_id from mprts_owner order by owner_id desc limit 1 ");
	while($row_owner_id_present = mysql_fetch_array($get_present_owner_id_sql)){
		$owner_id_present = $row_owner_id_present['owner_id'];
	}

	$update_access_code_sql = mysql_query("UPDATE mprts_owner set access_code = concat('OO', '$building_code', '$max_owner_id_3') where owner_id = '$owner_id_present' ");

	$add_asset_owner_sql = mysql_query("INSERT into mprts_users (user_type, user_name, user_pass, user_email, user_mobile) values ('OO', '$owner_name', 'pass1234', '$owner_email', '$owner_mobile')");

	$get_latest_user_id_sql = mysql_query("SELECT user_id from mprts_users order by user_id desc limit 1");
	while($row_user_id = mysql_fetch_array($get_latest_user_id_sql)){
		$max_user_id = $row_user_id['user_id'];
	}

	$update_access_code_sql = mysql_query("UPDATE mprts_users set user_access_code = concat('OO', '$building_code', '$max_owner_id_3') where user_id = '$max_user_id' ");

	if($latest_oo) {
		header('Location: owner_content.php');
	}
	else {
		echo mysql_error();
	}

}

?>
