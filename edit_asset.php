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
<script type="text/javascript">
	$(document).ready(function(){
    	$('.modal').modal();
     	$('.modal-overlay').remove();
	});

    $('#owner_list').load('owner_list.php');
</script>

	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>

	<?php 
		$asset_id = $_POST['id'];
		$show_asset_sql = "select * from mprts_property where prty_id='$asset_id'";
		$show_asset_execute = mysql_query($show_asset_sql);
		while ($row = mysql_fetch_array($show_asset_execute)) {
			$prty_id = $row['prty_id'];
			$prty_location = $row['prty_location'];
			$prty_owner = $row['prty_owner'];
			$prty_address = $row['prty_address'];
			$prty_no = $row['prty_no'];
			$prty_type = $row['prty_type'];
			$prty_current_meter = $row['prty_current_meter'];
			// $prty_intercomm_meter = $row['prty_intercomm_meter'];
			$prty_gas_meter = $row['prty_gas_meter'];
			$prty_water_meter = $row['prty_water_meter'];
			$prty_building_id = $row['prty_building_id'];
			$prty_rent = $row['prty_rent'];
			$prty_rooms = $row['prty_rooms'];
			$access_code = $row['access_code'];

		}
		// echo $building_id.'-'.$building_locality.'-'.$building_type;

	?>

<script type="text/javascript">
	$('[name="prty_address"]').html('<?php echo $prty_address; ?>');
</script>

	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Dashboard</a> - <a href="property_content.php">Edit Asset Details</a> - <b><?php echo $prty_id; ?></b></h5>
		</div>
		<div class="col s4 sub_title_bar" style="background-color: #25414E;height: 49px;">
			<button class="btn waves-effect waves-light" title="Cancel" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="window.location.reload();">Cancel
    			<i class="material-icons right">cancel</i>
  			</button>
  			<button class="btn waves-effect waves-light" title="Save" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" onclick="save_edit();">Save
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
			<h5 class="content_name" ><a href="property_content.php">Edit Asset </a><b><?php echo $prty_no ?></b></h5>					
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
			<div class="col l4 m4 s12 z-depth-3" style="height: 60%;">
				<table>
					<tr>
						<td>Location</td>
						<td><input type="text" name="prty_location" value="<?php echo $prty_location; ?>" required="true" maxlength="30" readonly="true"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><textarea class="materialize-textarea"  name="prty_address" value="<?php echo $prty_address; ?>" required="true" readonly="true" maxlength="300"></textarea></td>
					</tr>
					<tr>
						<td>Prty No</td>
						<td><input type="text" name="prty_no" value="<?php echo $prty_no; ?>" required="true"></td>
					</tr>
				</table>
			</div>

			<div class="col l4 m4 s12 z-depth-3" style="height: 60%;">
				<table>
					<tr>
						<td>Current Meter</td>
						<td><input type="text" name="prty_current_meter" value="<?php echo $prty_current_meter; ?>" required="true" maxlength="10"></td>
					</tr>
					<tr>
						<td>Gas Meter</td>
						<td><input type="text" name="prty_gas_meter" value="<?php echo $prty_gas_meter; ?>" required="true" maxlength="10"></td>
					</tr>
					<tr>
						<td>Water Meter</td>
						<td><input type="text" name="prty_water_meter" value="<?php echo $prty_water_meter; ?>" required="true" maxlength="10"></td>
					</tr>
					<!--<tr>
						<td>InterComm Meter</td>
						<td><input type="text" name="prty_intercomm_meter" value="<?php echo $prty_intercomm_meter; ?>"></td>
					</tr> -->
				</table>
			</div>
			<div class="col l4 m4 s12 z-depth-3" style="height: 60%;">
				<table>
					<tr>
						<td>Rent</td>
						<td><input type="number" name="prty_rent" value="<?php echo $prty_rent; ?>" maxlength="10"></td>
					</tr>
					<tr>
						<td>Rooms</td>
						<td><input type="number" name="prty_rooms" value="<?php echo $prty_rooms; ?>" maxlength="4"></td>
					</tr>


					<tr>
						<td>Owner Id</td>
						<td>
							<!-- <label>Owner Id</label> -->
							<div class="row">
								<div class="col s9">
									<input type="text" value="<?php echo $prty_owner; ?>" id="prty_owner_id" name="prty_owner_id" placeholder="Ex: ONR1" required="true" readonly="true" title="Select from the search button">
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
							      <a href="#!" id="owner_close_resp" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
							      <script type="text/javascript">
							      	$('#owner_close').click(function(){
							      		document.getElementById('prty_owner_id').value = owner_id;
							      	});
							      	$('#owner_close_resp').click(function(){
							      		document.getElementById('prty_owner_id').value = owner_id;
							      	});

							      </script>
							    </div>
							  </div>
						</td>
					</tr>
				</table>
			</div>

		</div>
	</div>
</body>
<script type="text/javascript">
	function save_edit(){
	 	new_prty_location = $("[name='prty_location']").val();
	 	new_prty_address = $("[name='prty_address']").val();
	 	new_prty_no = $("[name='prty_no']").val();

	 	new_prty_current_meter = $("[name='prty_current_meter']").val();
	 	new_prty_gas_meter = $("[name='prty_gas_meter']").val();
	 	new_prty_water_meter = $("[name='prty_water_meter']").val();
	 	// new_prty_intercomm_meter = $("[name='prty_intercomm_meter']").val();

	 	new_prty_rent = $("[name='prty_rent']").val();
	 	new_prty_rooms = $("[name='prty_rooms']").val();
	 	//new_prty_owner_id = $("[name='prty_owner_id']").val();
		new_prty_owner_id = ($("[name='prty_owner_id']").val()).substring(3, 7);
		console.log(new_prty_owner_id);


	 	data_to_edit = new_prty_location+'#|#'+new_prty_address+'#|#'+new_prty_no+'#|#'+new_prty_current_meter+'#|#'+new_prty_gas_meter+'#|#'+new_prty_water_meter+'#|#'+new_prty_rent+'#|#'+new_prty_rooms+'#|#'+new_prty_owner_id+'#|#'+'<?php echo $prty_id; ?>';
	 	
	 	//console.log(data_to_edit);

	 	$.ajax({
	      url: "edit_asset_backend.php",
	      data: {
	        data_passed: data_to_edit
	      },
	      type: 'post',
	      cache: false,
	      success: function(save_edit_asset_html){
	          alert('Updation Successful');
	          window.location.reload();
	      }
	    })
		

	}
</script>