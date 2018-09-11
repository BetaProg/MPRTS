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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
	
	<?php 
		$building_id = $_POST['id'];
		// $building_id = '0001';
		$show_building_sql = "select * from mprts_buildings where building_id='$building_id'";
		$show_building_execute = mysql_query($show_building_sql);
		while ($row = mysql_fetch_array($show_building_execute)) {
			$building_id = $row['building_id'];
			$building_locality = $row['building_locality'];
			$building_type = $row['building_type'];
			$prty_image = $row['image_url'];
			$building_name = $row['building_name'];
			$building_units = $row['building_units'];
			$building_city = $row['building_city'];
			$building_state = $row['building_state'];
			$building_pincode = $row['building_pincode'];
			$building_phno = $row['building_phno'];
			$building_sqft = $row['building_sqft'];
			$building_email = $row['building_email'];
			$building_current_meter = $row['building_current_meter'];
			$building_water_meter = $row['building_water_meter'];
			$building_note = $row['building_note'];


			$get_pty_id_sql = mysql_query("select concat('PTY', building_id) as building_id from mprts_buildings where building_id = $building_id");
							$pty_id_row = mysql_fetch_array($get_pty_id_sql);
							$pty_id = $pty_id_row['building_id'];
		}
		// echo $building_id.'-'.$building_locality.'-'.$building_type;

	?>
	<!-- <button style="float: right;margin-right: 5%;" onclick="window.location.reload();">Cancel</button> -->

	<!-- <div class="sub_title_bar">
		<h5><a href='index.php'>Dashboard</a> - <a href="building_content.php">Edit Property Details</a> - <b><?php echo $pty_id; ?></b><button class="btn waves-effect waves-light" title="Save" style="float: right;background-color: #f2f2f2;color:#000;" onclick="window.location.reload();">Cancel<i class="material-icons right">cancel</i></button><button class="btn waves-effect waves-light" title="Save" style="float: right;background-color: #f2f2f2;color:#000;" onclick="save_edit();">Save<i class="material-icons right">save</i></button></h5>
	</div> -->

	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Dashboard</a> - <a href="building_content.php">Edit Property Details</a> - <b><?php echo $pty_id; ?></b></h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
			<button class="btn waves-effect waves-light" title="Cancel" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="window.location.reload();">Cancel
    			<i class="material-icons right">cancel</i>
  			</button>
  			<button class="btn waves-effect waves-light" title="Save" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" onclick="save_edit();">Save
    			<i class="material-icons right">save</i>
  			</button>
		</div>
	</div>
	<div class="row edit_building_title resp_edit_tite">
		<div class="col s2">
			<button class="btn waves-effect waves-light back_button" title="Back" style="float: left;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
			<i class="material-icons" style="font-size: 30px;">arrow_back</i>
			</button>		
		</div>
		<div class="col s6" style="margin-top: 0%;padding-left: 10%;">
			<h5 class="content_name" ><b><?php echo $building_name ?></b></h5>					
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
			<div class="col m4 s12 z-depth-3">
				<table>
					<tr>
						<td>Name</td>
						<td><input type="text" name="building_name" value="<?php echo $building_name; ?>"></td>
					</tr>
					<tr style="cursor: not-allowed;">
						<td>Type</td>
						<!-- <td><input type="text" name="building_type" value="<?php echo $building_type; ?>"></td> -->

						<td  style="cursor: not-allowed;">
							<input class="with-gap" name="building_type" type="radio" id="b_apt" value="Appartment" required="true" readonly="true" disabled="true" />
						    <label for="b_apt">Appartment</label>
						    <input class="with-gap" name="building_type" type="radio" id="b_hse" value="House" required="true" readonly="true" disabled="true" />
						    <label for="b_hse">House</label>
						</td>


					</tr>
					<tr>
						<td>Units</td>
						<td><input type="number" name="building_units" maxlength="4" value="<?php echo $building_units; ?>"></td>
					</tr>
				</table>
			</div>

			<div class="col m4 s12 z-depth-3">
				<table>
					<tr>
						<td>Locality</td>
						<td><input type="text" name="building_locality" value="<?php echo $building_locality; ?>" maxlength="30"></td>
					</tr>
					<tr>
						<td>City</td>
						<td><input type="text" name="building_city" value="<?php echo $building_city; ?>" maxlength="30"></td>
					</tr>
					<tr>
						<td>State</td>
						<td><input type="text" name="building_state" value="<?php echo $building_state; ?>" maxlength="30"></td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td><input type="text" name="building_pincode" value="<?php echo $building_pincode; ?>" maxlength="6" pattern="d{6}"></td>
					</tr>
				</table>
			</div>
			<div class="col m4 s12 z-depth-3">
				<table>
					<tr>
						<td>Current Meter</td>
						<td><input type="text" name="building_current_meter" value="<?php echo $building_current_meter; ?>" maxlength="10"></td>
					</tr>
					<tr>
						<td>Water Meter</td>
						<td><input type="text" name="building_water_meter" value="<?php echo $building_water_meter; ?>" maxlength="30"></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td><input type="text" readonly="true" style="background-color: #f2f2f2;" title="Can't Update this here" name="building_phno" value="<?php echo $building_phno; ?>" maxlength="10" pattern="(7|8|9)\d{9}"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" readonly="true" style="background-color: #f2f2f2;" title="Can't Update this here" name="building_email" value="<?php echo $building_email; ?>"></td>
					</tr>
				</table>
			</div>

		</div>
	</div>
</body>
<script type="text/javascript">
	function save_edit(){
	 	new_building_name = $("[name='building_name']").val();
	 	new_building_type = $("[name='building_type']").val();
	 	new_building_units = $("[name='building_units']").val();
	 	new_building_locality = $("[name='building_locality']").val();

	 	new_building_city = $("[name='building_city']").val();
	 	new_building_state = $("[name='building_state']").val();
	 	new_building_pincode = $("[name='building_pincode']").val();
	 	new_building_current_meter = $("[name='building_current_meter']").val();
	 	new_building_water_meter = $("[name='building_water_meter']").val();

	 	data_to_edit = new_building_name+'-'+new_building_type+'-'+new_building_units+'-'+new_building_locality+'-'+new_building_city+'-'+new_building_state+'-'+new_building_pincode+'-'+new_building_current_meter+'-'+new_building_water_meter+'-'+'<?php echo $building_id; ?>';
	 	
	 	// console.log(data_to_edit);

	 	$.ajax({
	      url: "edit_building_backend.php",
	      data: {
	        data_passed: data_to_edit
	      },
	      type: 'post',
	      cache: false,
	      success: function(save_edit_building_html){
	          // $('.record_details').html(save_edit_building_html);
	          alert('Updation Successful');
	          window.location.reload();
	      }
	    })

	}
</script>
<script type="text/javascript">
	if('<?php echo $building_type ?>'=='Appartment'){
		$('#b_apt').prop("checked", true);
	}
	else {
		$('#b_hse').prop("checked", true);
	}
</script>