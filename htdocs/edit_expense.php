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
		$('#asset_list').load('asset_list.php');
		$('.modal').modal();
		$('.modal-overlay').remove();
  	});
</script>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
	
	<?php 
		$expense_id = $_POST['id'];
		$show_expense_sql = mysql_query("SELECT * from mprts_expenses where expense_id='$expense_id'");
		while ($row = mysql_fetch_array($show_expense_sql)) {
			$expense_id = $row['expense_id'];
			$expense_amount = $row['expense_amount'];
			$expense_date = $row['expense_date'];
			$expense_cause = $row['expense_cause'];
			$expense_description = $row['expense_description'];
			$expense_association = $row['expense_association'];

		}
		// echo $building_id.'-'.$building_locality.'-'.$building_type;

	?>

	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Dashboard</a> - <a href="owner_content.php">Edit Expense Details</a> - <b><?php echo $expense_id; ?></b></h5>
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
			<h5 class="content_name" ><b><?php echo $owner_name ?></b></h5>					
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
			<div class="col  l6 m6 s12 z-depth-3 add_expense_form" style="height: 60%;">
				<table>
					<tr>
						<!-- <td>Date</td>
						<td><input type="text" name="expense_date" value="<?php echo $expense_date; ?>"></td> -->
						<td>Expense Date</td>
						<td>
							<input type="text" name="expense_date" value="<?php echo $expense_date; ?>" id="expense_date" required="true">
						</td>

					</tr>
					
					<tr>
						<td>Expense Amount</td>
						<td><input type="number" name="expense_amount" value="<?php echo $expense_amount; ?>" required="true" maxlength="8"></td>
					</tr>
					<tr>
						
						<td>
						<!--<label>Expense Cause</label>-->
						Expense Cause
						</td>
						<td>
							<div class="input-field col s12 select_cause">
								<select id="expense_cause" name="expense_cause">
									  <option value="<?php echo $expense_cause; ?>" selected><?php echo $expense_cause; ?></option>
								<?php
									$get_vendor_record_sql = mysql_query("SELECT * FROM mprts_vendors where access_code = '$user_access_code'");
									while($vendors_array = mysql_fetch_array($get_vendor_record_sql)){
										$vndr_id = $vendors_array['vndr_id'];
										$vndr_name = $vendors_array['vndr_name'];
										$vndr_profession = $vendors_array['vndr_profession'];
										
										echo "<option value='$vndr_profession - $vndr_name'><b>$vndr_profession</b> - $vndr_name</option>";
									}
								?>
								</select>
								<label>Expense Cause</label>
							</div>
						</td>
					</tr>
					
					
					<div class="row">
						<div class="col s9">
							<input type="text" id="expense_assc_id" name="expense_assc_id" value="<?php echo $expense_association; ?>" required="true" title="Select from the search button">
						</div>
						<div class="col s3" style="padding: 0px;">
							<a class="btn" id='add_expense_btn' onclick="$('.load_assets_list').load('multiple_asset_list.php');" title="Search Asset No." style="padding-right: 10px;padding-left: 10px;"><i class="material-icons">search</i></a>
						</div>
					</div>
					
<!------------------------------------------------------------------------------------------------------------------------------------------ -->

  <!-- Modal Structure -->
  <div id="modal2" class="modal modal-fixed-footer">
    <div class="modal-content" onclick="$('#asset_list').load('asset_list.php');" title="Assets List">
      <h4>Assets List</h4>
      <p id="asset_list"></p>
    </div>
    <div class="modal-footer">
      <a href="#!" id="asset_close" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
      <script type="text/javascript">
      	$('.drilldown').click(function(){
      		document.getElementById('expense_assc_id').value = asset_id;
      	});

      </script>
      
    </div>
  </div>

<!------------------------------------------------------------------------------------------------------------------------------------------ -->
					
					<tr>
						<td>Description</td>
						<td><input type="text" name="expense_description" value="<?php echo $expense_description; ?>" required="true" maxlength="100"></td>
					</tr>
				</table>
			</div>
			<div class="col s6 load_assets_list">
		
			</div>
		</center>	
		</div>
	</div>
</body>
<script type="text/javascript">
	function save_edit(){
	 	new_expense_date = $("[name='expense_date']").val();
	 	new_expense_amount = $("[name='expense_amount']").val();
	 	new_expense_cause = $("[name='expense_cause']").val();
	 	new_expense_description = $("[name='expense_description']").val();
	 	new_expense_assc_id = $("[name='expense_assc_id']").val();


	 	data_to_edit = new_expense_date+'|'+new_expense_amount+'|'+new_expense_cause+'|'+new_expense_description+'|'+new_expense_assc_id+'|'+'<?php echo $expense_id; ?>';
	 	
	 	// console.log(data_to_edit);

	 	$.ajax({
	      url: "edit_expense_backend.php",
	      data: {
	        data_passed: data_to_edit
	      },
	      type: 'post',
	      cache: false,
	      success: function(save_edit_expense_html){
	          // $('.record_details').html(save_edit_building_html);
	          alert('Updation Successful');
	          window.location.reload();
	      }
	    })

	}
</script>
<script type="text/javascript">
	// if('<?php echo $building_type ?>'=='Appartment'){
	// 	$('#b_apt').prop("checked", true);
	// }
	// else {
	// 	$('#b_hse').prop("checked", true);
	// }
	$('#add_expense_btn').click(function(){
		$('.load_assets_list').html("<img src='images/preloader.gif'/>");
		$('.load_assets_list').css('display', 'block');
		$('.add_expense_form').css('width', '50%');
	});
	$('.add_expense_form').click(function(){
		if($('.id_field').is(":visible")){
			$('.add_expense_form').css('width', '100%');
			$('.load_assets_list').css('display', 'none');
		}
		
	});
</script>