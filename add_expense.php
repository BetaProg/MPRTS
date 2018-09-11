<?php
	session_start();
	$user_name = $_SESSION["user_name"] ;
	$user_access_code = $_SESSION["user_access_code"];
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

<title>MPRTS | Add Owner</title>
	<?php include 'db_config.php'; ?>
	<?php //include 'headers.php'; ?>
<div class="add_content_div" style="margin-top: 1%;" title="Add Expense">
<form action="add_expense_backend.php" method="post">
	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5>Add new Expense</h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
				<button class="btn waves-effect waves-light" title="Cancel" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="window.location.reload();">Cancel
    			<i class="material-icons right">cancel</i>
  			</button>
				<button class="btn waves-effect waves-light" title="Save record" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" type="submit" name="expensesubmit">Save
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
			<h5 class="content_name" ><b>Add Expense</b></h5>					
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light save_button save_owner" title="Save" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;"  type="submit" name="expensesubmit"">
    			<i class="material-icons" style="font-size: 30px;">save</i>
  			</button>		
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light cancel_button cancel_edit_building" title="Cancel" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
    			<i class="material-icons" style="font-size: 30px;">cancel</i>
  			</button>		
		</div>
	</div>

	<div class="row">
	<div class="col s12 add_expense_form">
		<div class="col l12 m6 s12 z-depth-3" style="">
			<center><label style="font-weight: bolder;">Expense Details</label></center>
			<hr style="border-color: #2BBBAD;">

			<label>Amount Spent</label>
			<input type="number" name="expense_amount" placeholder="Amount" required="true" maxlength="8">

			<label>Expense Date</label>
			<input type="date" name="expense_date" id="expense_date" required="true" placeholder="Expense Date" required="true">

			<div class="input-field col s12">
				<select id="expense_cause" name="expense_cause">
					  <option value="" disabled selected>Choose Valid Cause:</option>
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
			
			<label>Expense Association</label>
			<div class="row">
				<div class="col s9">
					<input type="text" id="expense_assc_id" name="expense_assc_id" placeholder="Ex: AST0001" required="true" title="Select from the search button">
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
			
			<label>Description</label>
			<textarea name="expense_description" class="materialize-textarea" placeholder="Description" required="true" maxlength="100"></textarea>
		</div>
	</div>
	<div class="col s6 load_assets_list">
		
	</div>
	</div>
</form>
</div>
</body>
<script>
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