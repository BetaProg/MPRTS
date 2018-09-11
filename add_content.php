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
<title>MPRTS | Add Content</title>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
	<?php
		//insert_content_script_here
	?>
<?php 
	$get_aa_data_sql = mysql_query("SELECT * from mprts_users where user_access_code = '$user_access_code'");
	while ($aa_row = mysql_fetch_array($get_aa_data_sql)) {
		$aa_mobile = $aa_row['user_mobile'];
		$aa_email = $aa_row['user_email'];
		$user_name = $aa_row['user_name'];
		$user_usc_no = $aa_row['user_usc_no'];
	}
?>
<div class="add_content_div" style="margin-top: 5%;" title="Add Property">
<form action="add_content_backend.php" method="post">
	<div class="row add_content_main_div">
		<div class="col l8 m8 s12 title_bar">
			<h5>Please add your property details before proceeding</h5>
		</div>
		<div class="col l4 m4 s12" style="background-color: #25414E;height: 49px;">
				<button class="btn waves-effect waves-light" title="Cancel" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="window.location.reload();">Cancel
    			<i class="material-icons right">cancel</i>
  				</button>
				<button class="btn waves-effect waves-light" title="Save record" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" type="submit" name="contentsubmit">Save
    				<i class="material-icons right">save</i>
  				</button>
		</div>
	</div>

	<div class="row add_content_main_div">
		<div class="col l4 m4 s12 z-depth-3 main_cat">
		<center><label style="font-weight: bolder;">Building Details</label></center>
		<hr style="border-color: #2BBBAD;">
			<div class="input-field col s12">
				<input type="text" name="building_name" id="building_name" value="<?php echo $user_name; ?>" required="true" maxlength="20" readonly="true">
				<label for="building_name">Building Name</label>
			</div>

			<div class="input-field col s12">
				<input type="number" id="building_units" name="building_units"  required="true"  maxlength="4">
				<label for="building_units">No of Units</label>
			</div>

		    <input class="with-gap" name="building_type" type="radio" id="b_apt" value="Appartment" required="true"/>
		    <label for="b_apt">Appartment</label>
		    <input class="with-gap" name="building_type" type="radio" id="b_hse" value="House" required="true"/>
		    <label for="b_hse">House</label>
		    <input class="with-gap" name="building_type" type="radio" id="b_cml" value="Commercial" required="true"/>
		    <label for="b_cml">Commercial</label>

		</div>
		<div class="col l4 m4 s12 z-depth-3 main_cat">
			<center><label style="font-weight: bolder;">Address & Contacts</label></center>
			<hr style="border-color: #2BBBAD;">

			<div class="input-field col s12">
				<input type="text" id="building_locality" name="building_locality"  required="true" maxlength="30">
				<label for="building_locality">Building locality</label>
			</div>
			
			<div class="input-field col s12">
				<input type="text" id="building_city" name="building_city"  required="true" maxlength="30">
				<label for="building_city">City</label>
			</div>
			
			<div class="input-field col s12">
				<input type="text" id="building_state" name="building_state"  required="true" maxlength="30">
				<label for="building_state">State</label>
			</div>

			<div class="input-field col s12">
				<input type="number" id="building_pincode" name="building_pincode"  required="true"  maxlength="6">
				<label for="building_pincode">Pincode</label>
			</div>

		</div>
		<div class="col l4 m4 s12 z-depth-3 main_cat">
			<center><label style="font-weight: bolder;">Others</label></center>
			<hr style="border-color: #2BBBAD;">
			<label>Contact Number</label>
			<input type="number" name="building_phno" placeholder="Phone Number"  required="true" value=<?php echo $aa_mobile; ?>  maxlength="10" >
			<label>Alternate Number</label>
			<input type="number" name="building_phno2" placeholder="Alternate Number" required="true" value=<?php echo $aa_mobile; ?>  maxlength="10" >
			<label>Email</label>
			<input type="email" name="building_email" placeholder="Email Address" required="true" value=<?php echo $aa_email; ?>>

			<div class="input-field col s12">
				<input type="text" id="building_current_meter" name="building_current_meter" value="<?php echo $user_usc_no; ?>" readonly="true" required="true" maxlength="20">
				<label for="building_current_meter">Common Current Meter </label>
			</div>

			<div class="input-field col s12">
				<input type="text" id="building_water_meter" name="building_water_meter" required="true" maxlength="20">
				<label for="building_water_meter">Common Water Meter </label>
			</div>
			
			
		</div>
	</div>
</form>
</div>
</body>
<div class="col s4">
	<h5 style="position: fixed;top:6;right:120;">Hi <b style="text-transform: uppercase;"><?php echo $user_name ?></b> !</h5>
</div>
<div class="col s2">
	<h5><a href="logout.php" style="float: right;position: fixed;top:15;right:20;">Logout</a></h5>
</div>