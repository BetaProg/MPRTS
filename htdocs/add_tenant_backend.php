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
<?php

if(isset($_POST["id"])){
	$tenant_id = $_POST['tenant_id'];
	$get_prop_id = $_POST['id'];

	$get_prop_id = substr($get_prop_id, 3);

	$get_property_details_sql = mysql_query("SELECT * FROM mprts_property WHERE prty_id = '$get_prop_id'"); 
	$prop_row = mysql_fetch_array($get_property_details_sql);
	$prty_location = $prop_row['prty_location'];
	$prty_owner = $prop_row['prty_owner'];
	$prty_building_id = $prop_row['prty_building_id'];

	$get_owner_details_sql = mysql_query("SELECT * FROM mprts_owner WHERE owner_id = '$prty_owner'"); 
	$owner_row = mysql_fetch_array($get_owner_details_sql);
	$owner_name = $owner_row['owner_name'];
	$owner_id = $owner_row['owner_id'];

	$get_building_details_sql = mysql_query("SELECT * FROM mprts_buildings WHERE building_id = '$prty_building_id'"); 
	$building_row = mysql_fetch_array($get_building_details_sql);
	$building_name = $building_row['building_name'];
	$building_locality = $building_row['building_locality'];
	$building_city = $building_row['building_city'];
	$building_state = $building_row['building_state'];

	$building_address = $building_name.' - '.$building_locality.' - '.$building_city.' - '.$building_state;
	echo $building_address."|".$owner_name."|".$owner_id;
}

	
?>

<?php
	// $tenant_details = $_POST['tenant_details'];
	
	// $tenant_details = "TestTenant1,testtenant1@email.com,9012091298,AST0003,0001,Maa Building 1 - Madhapur - Hyderabad,Aadhar Card,AC1234,4500,12 August, 2017,12 August, 2018";

	if(isset($_POST["tenantsubmit"]))
	{
		//echo 'hihihihihihi';
				$tenant_details = $_POST['tenant_data_to_pass'];


	switch ($_FILES['fileToUpload']["error"]) {
        case UPLOAD_ERR_OK:
            $target = "uploads/TenantIDs/";
            $target = $target . basename($_FILES['fileToUpload']['name']);

            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target)) {
                $status = "The file " . basename($_FILES['fileToUpload']['name']) . " has been uploaded";
                $file_name = 'uploads/TenantIDs/'.basename($_FILES['fileToUpload']['name']);
                $imageFileType = pathinfo($target, PATHINFO_EXTENSION);
                $check = getimagesize($target);

                if ($check !== false) {
                    // echo "File is an image - " . $check["mime"] . ".<br>";
                    // echo "<script>location.reload();</script>";
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
            $target = "uploads/TenantIDs/";
            $target = $target . basename($_FILES['IdToUpload']['name']);

            if (move_uploaded_file($_FILES['IdToUpload']['tmp_name'], $target)) {
                $status = "The file " . basename($_FILES['IdToUpload']['name']) . " has been uploaded";
                $id_file_name = 'uploads/TenantIDs/'.basename($_FILES['IdToUpload']['name']);
                $imageFileType = pathinfo($target, PATHINFO_EXTENSION);
                $check = getimagesize($target);

                if ($check !== false) {
                    // echo "File is an image - " . $check["mime"] . ".<br>";
                    // echo "<script>location.reload();</script>";
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







	// $tenant_details_split = explode("|",$tenant_details);
	// $tenant_name = $tenant_details_split[0];
	// $tenant_email = $tenant_details_split[1];
	// $tenant_mobile = $tenant_details_split[2];
	// $tenant_propid = $tenant_details_split[3];
	// $tenant_owner_id = $tenant_details_split[4];
	// $tenant_address = $tenant_details_split[5];
	// // $tenant_id_type = $tenant_details_split[6];
	// // $tenant_id_no = $tenant_details_split[7];
	// $tenant_advance = $tenant_details_split[6];
	// $tenant_joining_date = $tenant_details_split[7];
	// $tenant_vacating_date = $tenant_details_split[8];
	// $tenant_img_src = $tenant_details_split[9];
	// $tenant_img_id = $tenant_details_split[10];

	// $tenant_propid = substr($tenant_propid, 3);	
	// $tenant_owner_id = substr($tenant_owner_id, 3);	

	$tenant_name = $_POST['tenant_name'];
	$tenant_email = $_POST['tenant_email'];
	$tenant_mobile = $_POST['tenant_mobile'];
	$tenant_propid = $_POST['tenant_asset_id'];
	$tenant_owner_id = $_POST['tenant_owner_id'];
	$tenant_address = $_POST['tenant_address'];
	$tenant_advance = $_POST['tenant_advance'];
	$tenant_joining_date = $_POST['tenant_joining_date'];
	$tenant_vacating_date = $_POST['tenant_vacating_date'];
	$tenant_img_src = $_POST['tenant_img_src'];
	$tenant_img_id = $_POST['tenant_img_id'];

	// $tenant_propid = $_POST['tenant_propid'];
	$tenant_propid = substr($tenant_propid, 3);
	$tenant_owner_id = $_POST['tenant_owner_id'];


	// echo("<script>alert('$tenant_name'+'$tenant_email'+'$tenant_mobile'+'$tenant_propid'+'$tenant_owner_id'+'$tenant_address'+'$tenant_id_type'+'$tenant_id_no'+'$tenant_advance'+'$tenant_joining_date'+'$tenant_vacating_date')</script>");

	$insert_tenant_sql = mysql_query("INSERT into mprts_tenants(tenant_name, tenant_image, tenant_email, tenant_mobile, tenant_propid, tenant_owner_id, tenant_address, tenant_id_no, tenant_advance, tenant_joining_date, tenant_vacating_date, access_code) values('$tenant_name', '$file_name', '$tenant_email', '$tenant_mobile', '$tenant_propid', '$tenant_owner_id', '$tenant_address', '$id_file_name', '$tenant_advance', '$tenant_joining_date', '$tenant_vacating_date', '$user_access_code')");
	if($insert_tenant_sql) {
		echo "<script>alert('Tenant Successfully added');</script>";
		header('Location: tenant_content.php');
	}
	else {
		echo "<script>alert(mysql_error());</script>";
	}

	}

	
?>