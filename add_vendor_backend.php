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
	if(isset($_POST["data_passed"])){
		$data_passed = $_POST["data_passed"];
		//$data_passed = "TestVndr1#$@Carpenter#$@#$@Hyderabad#$@Madhapur#$@Telangana#$@500002#$@9898989898#$@9898989298#$@testvndr1@email.com";
		//$data_passed = "Test Vendor 2412 2355#$@Electricians#$@#$@Hyderabad#$@Uppal#$@Telangana#$@500088#$@91221122198#$@9019191998#$@testvendor2412@email.com#$@Self#$@Aadhar Card#$@AC1224";
		$data_passed_split = explode("#$@",$data_passed);
		$vndr_name = $data_passed_split[0];
		$vndr_profession = $data_passed_split[1];
		$vndr_website = $data_passed_split[2];
		$vndr_city = $data_passed_split[3];
		$vndr_locality = $data_passed_split[4];
		$vndr_state = $data_passed_split[5];
		$vndr_pincode = $data_passed_split[6];
		$vndr_phone1 = $data_passed_split[7];
		$vndr_phone2 = $data_passed_split[8];
		$vndr_email = $data_passed_split[9];
		$vndr_company = $data_passed_split[10];
		$vndr_id_type = $data_passed_split[11];
		$vndr_id_no = $data_passed_split[12];
		
		$insert_vndr_sql = mysql_query("INSERT INTO mprts_vendors (vndr_name, vndr_profession, vndr_company, vndr_website, vndr_city, vndr_locality, vndr_state, vndr_pincode, vndr_phone1, vndr_phone2, vndr_email, access_code, vndr_id_type, vndr_id_number)
		values ('$vndr_name', '$vndr_profession', '$vndr_company', '$vndr_website', '$vndr_city', '$vndr_locality', '$vndr_state', '$vndr_pincode', '$vndr_phone1', '$vndr_phone2', '$vndr_email', '$user_access_code', '$vndr_id_type', '$vndr_id_no')");
		
		if($insert_vndr_sql){
			echo "Vendor Added Successfully";
		}
		else{
			echo mysql_error();
		}
	}
?>