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
<body>
	<?php include 'db_config.php'; ?>
	<?php //include 'headers.php'; ?>
<script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
});
</script>
<style>
	.modal-overlay{
		display:none !important;
	}
</style>
	<?php 
		$vndr_id = $_POST['vndr_id_passed'];
		//$vndr_id = '00000001';
		//echo $vndr_id;
		//echo "<script>alert(".$vndr_id.");</script>";
		//$vndr_id = $_SESSION['Vndr_id'];
		$show_vndr_sql = mysql_query("select * from mprts_vendors where vndr_id='$vndr_id'");
		//$show_vndr_sql = mysql_query("select * from mprts_vendors where vndr_id='00000001'");
		while ($row_vndr = mysql_fetch_array($show_vndr_sql)) {
			$vndr_name = $row_vndr['vndr_name'];
			$vndr_profession = $row_vndr['vndr_profession'];
			$vndr_company = $row_vndr['vndr_company'];
			$vndr_website = $row_vndr['vndr_website'];
			$vndr_locality = $row_vndr['vndr_locality'];
			$vndr_city = $row_vndr['vndr_city'];
			$vndr_state = $row_vndr['vndr_state'];
			$vndr_pincode = $row_vndr['vndr_pincode'];
			$vndr_phone1 = $row_vndr['vndr_phone1'];
			$vndr_phone2 = $row_vndr['vndr_phone2'];
			$vndr_email = $row_vndr['vndr_email'];
			$vndr_access_code = $row_vndr['access_code'];

		}
		// echo $building_id.'-'.$building_locality.'-'.$building_type;
	//echo $vndr_id;
	?>

	

<div class="row resp_edit_tite" style="padding-top:0px;">
	<div class="col s2">
		<button class="btn waves-effect waves-light back_button" title="Back" style="float: left;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
		<i class="material-icons" style="font-size: 30px;">arrow_back</i>
		</button>		
	</div>
	<div class="col s6" style="margin-top: 0%;padding-left: 1%;">
		<h5 class="content_name" ><a href="vendors_content.php">Edit Vendor</a> - <b> <?php echo $vndr_profession ?></b></h5>					
	</div>
	<div class="col s2">
		<button class="btn waves-effect waves-light save_button save_building" title="Save" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="save_edit();">
			<i class="material-icons" style="font-size: 30px;">save</i>
		</button>		
	</div>
	<div class="col s2">
		<button class="btn waves-effect waves-light cancel_button cancel_edit_building" title="Cancel" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
			<i class="material-icons" style="font-size: 30px;">cancel</i>
		</button>		
	</div>
</div>
	
	<div class="edit_content">
		<div class="row">
		<center>
			<div class="col  l6 m6 s12 z-depth-3" style="height: 60%;">
				<table>
					<tr>
						<td>Name</td>
						<td><input type="text" name="vndr_name" value="<?php echo $vndr_name; ?>" required="true" maxlength="30"></td>
					</tr>
					
					<tr>
						<td>Mobile No.</td>
						<td><input type="number" name="vndr_phone1" value="<?php echo $vndr_phone1; ?>" required="true" maxlength="12"></td>
					</tr>
					<tr>
						<td>Email Id</td>
						<td><input type="email" name="vndr_email" value="<?php echo $vndr_email; ?>" required="true"></td>
					</tr>
					<tr>
						<td>Website</td>
						<td><input type="text" name="vndr_website" value="<?php echo $vndr_website; ?>" required="true"></td>
					</tr>
					<tr>
						<td>Locality</td>
						<td><input type="text" name="vndr_locality" value="<?php echo $vndr_locality; ?>" required="true"></td>
					</tr>
					<tr>
						<td>City</td>
						<td><input type="text" name="vndr_city" value="<?php echo $vndr_city; ?>" required="true"></td>
					</tr>
					<tr>
						<td>Category</td>
						<td>
							<div class="input-field col s12" style="box-shadow:none;border:none;">
								<select class="icons" id="vndr_profession" name="vndr_profession" required="true">
									<option value="" disabled selected><?php echo $vndr_profession; ?></option>
									<option value="Carpenter" data-icon="images/icons/saw.png" class="left circle">Carpenter</option>
									<option value="Carpet Cleaner" data-icon="images/icons/carpet.png" class="left circle">Carpet Cleaner</option>
									<option value="Current Line Man" data-icon="images/icons/electric_tower.png" class="left circle">Current Line Man</option>
									<option value="Driver Services" data-icon="images/icons/driver.png" class="left circle">Driver Services</option>
									<option value="Duplicate Key Makers" data-icon="images/icons/keys.png" class="left circle">Key Makers</option>
									<option value="Electricians" data-icon="images/icons/electrician.png" class="left circle">Electricians</option>
									<option value="Maid" data-icon="images/icons/maid.png" class="left circle">Maid</option>
									<option value="Masons" data-icon="images/icons/worker.png" class="left circle">Masons</option>
									<option value="Painter" data-icon="images/icons/painter.png" class="left circle">Painter</option>
									<option value="Pest Control" data-icon="images/icons/spray.png" class="left circle">Pest Control</option>
									<option value="Plumber" data-icon="images/icons/faucet.png" class="left circle">Plumber</option>
									<option value="Repairs" data-icon="images/icons/wrench.png" class="left circle">Repairs</option>
									<option value="Tyre - Punctures" data-icon="images/icons/tyre_expert.png" class="left circle">Tyre - Punctures</option>
									<option value="Others" data-icon="images/icons/wrench.png" class="left circle">Others</option>
									<option value="Watchman" data-icon="images/icons/policeman.png" class="left circle">Watchman</option>
									<option value="Water Tanker Services" data-icon="images/icons/tanker.png" class="left circle">Water Tanker Services</option>
								</select>
							</div>
						</td>
					</tr>
					
				</table>
			</div>
		</center>	
		</div>
	</div>
</body>
<script type="text/javascript">
	function save_edit(){
	 	new_vndr_name = $("[name='vndr_name']").val();
	 	new_vndr_phone1 = $("[name='vndr_phone1']").val();
	 	new_vndr_email = $("[name='vndr_email']").val();
		new_vndr_website = $("[name='vndr_website']").val();
		new_vndr_locality = $("[name='vndr_locality']").val();
		new_vndr_city = $("[name='vndr_city']").val();
		new_vndr_profession = $("[name='vndr_profession']").val();


	 	data_to_edit = new_vndr_name+'#$#'+new_vndr_phone1+'#$#'+new_vndr_email+'#$#'+new_vndr_website+'#$#'+new_vndr_locality+'#$#'+new_vndr_city+'#$#'+new_vndr_profession+'#$#'+'<?php echo $vndr_id; ?>';
	 	
	 	// console.log(data_to_edit);

	 	$.ajax({
	      url: "edit_vendor_backend.php",
	      data: {
	        data_passed: data_to_edit
	      },
	      type: 'post',
	      cache: false,
	      success: function(save_edit_vendor_html){
	          alert('Vendor Updation Successful');
	          window.location.reload();
	      }
	    })

	}
</script>
