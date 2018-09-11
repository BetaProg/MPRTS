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
<?php include'headers.php'; ?>
<?php
if (!empty($_FILES) && isset($_FILES['fileToUpload'])) {
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
    mysql_query("UPDATE mprts_owner set owner_photo = '$file_name' where owner_id = '0004'");
    echo "Status: {$status}<br/>\n";
    echo $file_name;

}
?>