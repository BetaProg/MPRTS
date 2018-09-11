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
	$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
      
</script>
<script type="text/javascript">
	 $(document).ready(function() {
    $('select').material_select();
    $('.modal').modal();
     $('.modal-overlay').remove();
    $('#asset_list').load('asset_list.php');
  });
</script>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
	
	<?php 
		$tenant_id = $_POST['id'];
		$show_tenant_sql = "select * from mprts_tenants where tenant_id='$tenant_id'";
		$show_tenant_execute = mysql_query($show_tenant_sql);
		while ($row = mysql_fetch_array($show_tenant_execute)) {
			$tenant_id = $row['tenant_id'];
			$tenant_name = $row['tenant_name'];
			$tenant_propid = $row['tenant_propid'];

			$tenant_owner_id = $row['tenant_owner_id'];
			$tenant_mobile = $row['tenant_mobile'];
			$tenant_address = $row['tenant_address'];
			$tenant_email = $row['tenant_email'];
			$tenant_id_type = $row['tenant_id_type'];
			$tenant_id_no = $row['tenant_id_no'];
			$tenant_joining_date = $row['tenant_joining_date'];
			$tenant_vacating_date = $row['tenant_vacating_date'];
			$tenant_advance = $row['tenant_advance'];
			$access_code = $row['access_code'];

		}
		// echo $building_id.'-'.$building_locality.'-'.$building_type;

	?>

	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Dashboard</a> - <a href="tenant_content.php">Edit Tenant Details</a> - <b><?php echo $tenant_id; ?></b></h5>
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

	<div class="row resp_edit_tite">
		<div class="col s2">
			<button class="btn waves-effect waves-light back_button" title="Back" style="float: left;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
			<i class="material-icons" style="font-size: 30px;">arrow_back</i>
			</button>		
		</div>
		<div class="col s6" style="margin-top: 2%;padding-left: 15%;">
			<h5 class="content_name" ><b><?php echo $tenant_name ?></b></h5>					
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
			<div class="col l6 m6 s12 z-depth-3" style="height: 80%;">
				<table>
					<tr>
						<td>Name</td>
						<td><input type="text" name="tenant_name" value="<?php echo $tenant_name; ?>"></td>
					</tr>
					
					<tr>
						<!-- <td>Asset No.</td>
						<td><input type="text" name="tenant_propid" value="<?php echo $tenant_propid; ?>"></td> -->


			<!-- <label>Asset No</label> -->
			<td>Asset No.</td>
			<td>
			<div class="row">
				<div class="col s9">
					<input type="text" value="AST<?php echo $tenant_propid; ?>" id="tenant_asset_id" name="tenant_propid" placeholder="Ex: AST1" required="true" readonly="true" title="Select from the search button">
				</div>
				<div class="col s3" style="padding: 0px;">
					<a class="waves-effect waves-light btn" href="#modal2" title="Search Asset No." style="padding-right: 10px;padding-left: 10px;"><i class="material-icons">search</i></a>
				</div>
			</div>
			</td>

			<!------------------------------------------------------------------------------------------------------------------------------------------

				<!-- Modal Structure -->
				<div id="modal2" class="modal modal-fixed-footer">
				<div class="modal-content" title="Assets List">
					<h4>Assets List</h4>
					<p id="asset_list"></p>
				</div>
				<div class="modal-footer">
				  	<a href="#!" id="asset_close" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
					<script type="text/javascript">
						$('#asset_close').click(function(){
							document.getElementById('tenant_asset_id').value = asset_id;
						});
					</script>
				</div>
				</div>

			<!------------------------------------------------------------------------------------------------------------------------------------------ -->







					</tr>
					<tr>
						<td>Mobile</td>
						<td><input type="text" name="tenant_mobile" value="<?php echo $tenant_mobile; ?>" maxlength="10" pattern="(7|8|9)\d{9}"></td>
					</tr>
					<script type="text/javascript">
						$('[name="tenant_address"]').html('<?php echo $tenant_address; ?>');
					</script>
					<tr>
						<td>Address</td>
						<td><textarea class="materialize-textarea" name="tenant_address" maxlength="300" required="true"></textarea></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="email" name="tenant_email" value="<?php echo $tenant_email; ?>" required="true"></td>
					</tr>
				</table>
			</div>

			<div class="col l6 m6 s12 z-depth-3" style="height: 80%;">
				<table>
					<!-- <tr>
						<!-- <td>Id Proof</td>
						<td><input type="text" name="tenant_id_type" value="<?php echo $tenant_id_type; ?>"></td> -->
						<!-- <td>Valid Id Proof</td>
						<td>
							<select id="tenant_id_type" name="tenant_id_type" required="true">
							  <option value="" disabled selected><?php echo $tenant_id_type; ?></option>
							  <option value="Passport">Passport</option>
							  <option value="Aadhar Card">Aadhar Card</option>
							  <option value="PAN Card">PAN Card</option>
							  <option value="Driving Licence">Driving Licence</option>
							</select>
						</td> -->
					<!-- </tr> -->






					<!-- <tr>
						<td>Id No.</td>
						<td><input type="text" name="tenant_id_no" value="<?php echo $tenant_id_no; ?>" required="true"></td>
					</tr> -->
					<tr>
						<td>Joining Date</td>
						<td><input type="text" name="tenant_joining_date" class="datepicker" value="<?php echo $tenant_joining_date; ?>" required="true"></td>
						<!-- <input type="date" name="tenant_joining_date" id="tenant_joining_date" required="true" class="datepicker" placeholder="Joining time"> -->
						<!-- <label>Joining Date</label> -->
			<!-- <td><input type="date" name="tenant_joining_date" id="tenant_joining_date" required="true" class="datepicker" placeholder="Joining time"></td> -->
					</tr>
					<tr>
						<td>Vacating Date</td>
						<!-- <td><input type="text" name="tenant_vacating_date" value="<?php echo $tenant_vacating_date; ?>"></td> -->
						<td><input type="text" name="tenant_vacating_date" class="datepicker" value="<?php echo $tenant_vacating_date; ?>" required="true"></td>
					</tr>
					<tr>
						<td>Advance Paid</td>
						<td><input type="number" name="tenant_advance" value="<?php echo $tenant_advance; ?>" required="true" maxlength="10"></td>
					</tr>
				</table>
			</div>

		</center>	
		</div>
	</div>
</body>
<script type="text/javascript">
	function save_edit(){
	 	new_tenant_name = $("[name='tenant_name']").val();
	 	new_tenant_propid = $("[name='tenant_propid']").val();
	 	new_tenant_mobile = $("[name='tenant_mobile']").val();
	 	new_tenant_address = $("[name='tenant_address']").val();

	 	new_tenant_email = $("[name='tenant_email']").val();
	 	// new_tenant_id_type = $("[name='tenant_id_type']").val();
	 	// new_tenant_id_no = $("[name='tenant_id_no']").val();
	 	new_tenant_joining_date = $("[name='tenant_joining_date']").val();
	 	new_tenant_vacating_date = $("[name='tenant_vacating_date']").val();
	 	new_tenant_advance = $("[name='tenant_advance']").val();


	 	// data_to_edit = new_tenant_name+'|'+new_tenant_propid+'|'+new_tenant_mobile+'|'+new_tenant_address+'|'+new_tenant_email+'|'+new_tenant_id_type+'|'+new_tenant_id_no+'|'+new_tenant_joining_date+'|'+new_tenant_vacating_date+'|'+new_tenant_advance+'|'+'<?php echo $tenant_id; ?>';

	 	data_to_edit = new_tenant_name+'#|#'+new_tenant_propid+'#|#'+new_tenant_mobile+'#|#'+new_tenant_address+'#|#'+new_tenant_email+'#|#'+new_tenant_joining_date+'#|#'+new_tenant_vacating_date+'#|#'+new_tenant_advance+'#|#'+'<?php echo $tenant_id; ?>';
	 	
	 	// console.log(data_to_edit);

	 	$.ajax({
	      url: "edit_tenant_backend.php",
	      data: {
	        data_passed: data_to_edit
	      },
	      type: 'post',
	      cache: false,
	      success: function(save_edit_tenant_html){
	          // $('.record_details').html(save_edit_building_html);
	          alert('Updation Successful');
	          window.location.reload();
	      }
	    })

	}
</script>