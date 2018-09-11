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
	}
?>
<div class="add_content_div" title="Add Property">
<form action="add_content_backend.php" method="post">
	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5>Add property</h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
		<button class="btn waves-effect waves-light" title="Cancel" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="window.location.reload();">Cancel
    			<i class="material-icons right">cancel</i>
  		</button>
				<button class="btn waves-effect waves-light" title="Save record" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" type="submit" name="contentsubmit">Save
    				<i class="material-icons right">save</i>
  				</button>
		</div>
	</div>

	<div class="row resp_edit_tite">
		<div class="col s2">
			<button class="btn waves-effect waves-light back_button" title="Back" style="float: left;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
			<i class="material-icons" style="font-size: 30px;">arrow_back</i>
			</button>		
		</div>
		<div class="col s6" style="margin-top: 0%;padding-left: 10%;">
			<h5 class="content_name" ><b>Add Property</b></h5>					
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light save_button save_building" type="submit" name="contentsubmit" title="Save record" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;">
    			<i class="material-icons" style="font-size: 30px;">save</i>
  			</button>		
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light cancel_button cancel_edit_building" title="Cancel" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
    			<i class="material-icons" style="font-size: 30px;">cancel</i>
  			</button>		
		</div>
	</div>

	<div class="row add_building_row">
		<div class="col l4 m4 s12 z-depth-3 main_cat">
		<center><label style="font-weight: bolder;">Building Details</label></center>
		<hr style="border-color: #2BBBAD;">
			<!-- <div class="file-field input-field">
		      <div class="btn" style="background-color: #006666;">
		        <span>Image(s)</span>
		        <input type="file" multiple>
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" placeholder="Upload image(s)">
		      </div>
		    </div> -->

			<div class="input-field col s12">
				<input type="text" name="building_name" id="building_name"  required="true" maxlength="30">
				<label for="building_name">Building Name</label>
			</div>

			<div class="input-field col s12">
				<input type="number" id="building_units" name="building_units"  required="true" maxlength="4">
				<label for="building_units">No of Units</label>
			</div>
			
			<!-- <div class="input-field col s12">
				<input type="text" id="building_sqft" name="building_sqft"  required="true">
				<label for="building_sqft">Building Area in Sq"Ft</label>
			</div> -->

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
				<input type="text" id="building_locality" name="building_locality"  required="true" maxlength="50">
				<label for="building_locality">Building locality</label>
			</div>
			
			<div class="input-field col s12">
				<input type="text" id="building_city" name="building_city"  required="true" maxlength="50">
				<label for="building_city">City</label>
			</div>
			
			<div class="input-field col s12">
				<input type="text" id="building_state" name="building_state"  required="true" maxlength="50">
				<label for="building_state">State</label>
			</div>

			<div class="input-field col s12">
				<input type="text" id="building_pincode" name="building_pincode"  required="true"  maxlength="6" pattern="d{6}">
				<label for="building_pincode">Pincode</label>
			</div>

		</div>
		<div class="col l4 m4 s12 z-depth-3 main_cat">
			<center><label style="font-weight: bolder;">Others</label></center>
			<hr style="border-color: #2BBBAD;">
			<label>Contact Number</label>
			<input type="text" name="building_phno" placeholder="Phone Number"  required="true"  maxlength="10" pattern="(7|8|9)\d{9}">
			<label>Alternate Number</label>
			<input type="text" name="building_phno2" placeholder="Alternate Number" required="true"  maxlength="10" pattern="(7|8|9)\d{9}">
			<label>Email</label>
			<input type="email" name="building_email" placeholder="Email Address" required="true">

			<div class="input-field col s12">
				<input type="text" id="building_current_meter" name="building_current_meter" required="true" maxlength="10">
				<label for="building_current_meter">Common Current Meter </label>
			</div>

			<div class="input-field col s12">
				<input type="text" id="building_water_meter" name="building_water_meter" required="true"  maxlength="10">
				<label for="building_water_meter">Common Water Meter </label>
			</div>
			
			
		</div>
	</div>
</form>
</div>
</body>
<!-- <div class="col s4">
	<h5 style="position: fixed;top:6;right:120;">Hi <b style="text-transform: uppercase;"><?php echo $user_name ?></b> !</h5>
</div>
<div class="col s2">
	<h5><a href="logout.php" style="float: right;position: fixed;top:15;right:20;">Logout</a></h5>
</div> -->