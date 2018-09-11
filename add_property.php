<?php
	session_start();
	$user_name = $_SESSION["user_name"] ;
	$user_access_code = $_SESSION["user_access_code"];
?>
<body>
<title>MPRTS | Add Asset</title>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){
    	$('.modal').modal();
     	$('.modal-overlay').remove();
	});

    $('#property_list').load('property_list.php');
    $('#owner_list').load('owner_list.php');
    // $('#modal3').load('owner_list.php');
</script>

<?php 
	if(substr($user_access_code, 0, 2)=='AA'){

		echo "<style>.search_property{
			display:none !important;
		}
		.add_content_div input:read-only,.add_content_div textarea:read-only{
			background-color:#f2f2f2 !important;
		}
		</style>";

		$get_prty_details_sql = mysql_query("SELECT * from mprts_buildings where building_access_code = '$user_access_code'");

		$rows_count = mysql_num_rows($get_prty_details_sql);

		$i=0;
		while($i<$rows_count){
		$row = mysql_fetch_array($get_prty_details_sql);
			$building_id = $row['building_id'];
			$building_name = $row['building_name'];
			$building_type = $row['building_type'];
			$building_locality = $row['building_locality'];
			$building_city = $row['building_city'];
			$building_state = $row['building_state'];
			$building_pincode = $row['building_pincode'];

			$building_address =  $building_name.', '.$building_locality.', '.$building_city.', '.$building_state.', '.$building_pincode;
			$i++;

			$building_id_ext = 'PTY'.$building_id;
		}
		echo "<script>
			$('#prty_building_id').val('$building_id_ext');
			$('#building_address').val('$building_address');
		</script>";
		if($building_type = 'Appartment'){
			echo "<script>
			$('#flat').prop('checked', true);
		</script>";
		}
		else if($building_type = 'House'){
			echo "<script>
			$('#portion').prop('checked', true);
		</script>";
		}
	}
?>
	


<div class="add_content_div" style="margin-top: 1%;" title="Add Assets">
<form action="add_property_backend.php" method="post">
	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5>Add a new Flat/Portion</h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
			<button class="btn waves-effect waves-light" title="Cancel" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="window.location.reload();">Cancel
    			<i class="material-icons right">cancel</i>
  			</button>
			<button class="btn waves-effect waves-light" title="Save record" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" type="submit" name="propertysubmit">Save
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
			<h5 class="content_name" ><b>Add New Asset</b></h5>					
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light save_button save_building" title="Save record" name="propertysubmit" type="submit" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="save_edit();">
    			<i class="material-icons" style="font-size: 30px;">save</i>
  			</button>		
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light cancel_button cancel_edit_building" title="Cancel" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
    			<i class="material-icons" style="font-size: 30px;">cancel</i>
  			</button>		
		</div>
	</div>

	<div class="row add_asset">
		<div class="col l4 m4 s12 z-depth-3">
			<center>
				<label style="font-weight: bolder;">Asset Details</label>
			</center>
		
			<hr style="border-color: #2BBBAD;">

			<label>House No.</label>
			<input type="text" name="prty_no" placeholder="House no." required="true" maxlength="10">

			<label>Asset Type: </label><br>
			<input class="with-gap" name="prty_type" type="radio" id="flat" value="Flat" required="true"/>
		    <label for="flat">Flat</label>
		    <input class="with-gap" name="prty_type" type="radio" id="portion" value="Portion" required="true"/>
		    <label for="portion">Portion</label>
		    <br><br>
		    <label>No. of Rooms</label>
			<input type="number" name="prty_rooms" placeholder="Ex. 2(BHK)" required="true" min="1" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" title="Maximum value is 9999">

		</div>
		<div class="col l4 m4 s12 z-depth-3">
			<center><label style="font-weight: bolder;">Address & Contacts</label></center>
			<hr style="border-color: #2BBBAD;">
			<label>Property No</label>
			<div class="row">
				<div class="col s9">
					<input type="text" id="prty_building_id" name="prty_building_id" placeholder="Ex: PTY1" required="true" readonly="true" title="Select from the search button">
				</div>
				<div class="col s3" style="padding: 0px;">
					<a class="waves-effect waves-light btn search_property" href="#modal2" title="Search Property No." style="padding-right: 10px;padding-left: 10px;"><i class="material-icons">search</i></a>
				</div>
			</div>


<!------------------------------------------------------------------------------------------------------------------------------------------ -->

  <!-- Modal Structure -->
  <div id="modal2" class="modal modal-fixed-footer">
    <div class="modal-content" title="Properties List">
      <h4>Properties List</h4>
      <div id="property_list"></div>
    </div>
    <div class="modal-footer">
      <a href="#!" id="building_close" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
      <script type="text/javascript">
      	$('#building_close').click(function(){
      		document.getElementById('prty_building_id').value = property_id;
      	});

      </script>
      
    </div>
	<div class="modal-footer" style="position:unset;">
      <a href="#!" id="vendors_close" class="main_vendor_close modal-action modal-close waves-effect waves-green btn-flat">Close</a>
      <a href="#!" id="vendors_close" class="resp_vendor_close modal-action modal-close waves-effect waves-green btn-flat"><i class="material-icons left">close</i></a>
    </div>
  </div>

<!------------------------------------------------------------------------------------------------------------------------------------------ -->


<label>Property Address</label>
<textarea name="building_address" id="building_address" class="materialize-textarea" placeholder="Address" required="true" readonly="true" title="Please fill the Property No. before this"></textarea>


			<label>Owner Id</label>
			<div class="row">
				<div class="col s9">
					<input type="text" id="prty_owner_id" name="prty_owner_id" placeholder="Ex: ONR1" required="true" readonly="true" title="Select from the search button">
				</div>
				<div class="col s3" style="padding: 0px;">
				<a class="waves-effect waves-light btn" href="#modal3"  style="padding-right: 10px;padding-left: 10px;" title="Search Owners"><i class="material-icons">search</i></a>
				</div>
			</div>
<!------------------------------------------------------------------------------------------------------------------------------------------ -->


  <!-- Modal Structure -->
  <div id="modal3" class="modal modal-fixed-footer">
    <div class="modal-content" title="Owners List">
      <h4>Owner List</h4>
      <p id="owner_list"></p>
    </div>
    <div class="modal-footer">
      <a href="#!" id="owner_close" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
      <script type="text/javascript">
      	$('#owner_close').click(function(){
      		document.getElementById('prty_owner_id').value = owner_id;
      	});

      </script>
    </div>
  </div>
<br><br>

<!------------------------------------------------------------------------------------------------------------------------------------------ -->

		</div>
		<div class="col l4 m4 s12 z-depth-3">
			<center><label style="font-weight: bolder;">Others</label></center>
			<hr style="border-color: #2BBBAD;">
			<label>Rent</label>
			<input type="number" name="prty_rent" placeholder="Asset Rent" required="true" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" title="Maximum value is 9999999">
			<label>Gas Meter </label>
			<input type="text" name="prty_gas_meter" placeholder="Gas meter" required="true"  required="true" maxlength="20">
			<label>Current Meter </label>
			<input type="text" name="prty_current_meter" placeholder="Current meter" required="true" maxlength="20">
			<label>Water Meter </label>
			<input type="text" name="prty_water_meter" placeholder="Water meter" required="true" maxlength="20">
			<!-- <label>Intercomm Meter </label>
			<input type="text" name="prty_intercomm_meter" placeholder="Intercomm meter" required="true"> -->
		</div>
	</div>
</form>
</div>
</body>

