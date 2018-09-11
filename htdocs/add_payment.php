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
<title>MPRTS | Add Payment</title>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
	<style type="text/css">
		.tabs .tab a.active{
			background-color: #3AAFE8 !important;
			color: #fff !important;
		}
	</style>
	<script type="text/javascript">
		 $(document).ready(function() {
	    $('select').material_select();

	    $('.modal').modal();
     	$('.modal-overlay').remove();
    	$('#tenant_list').load('tenant_list.php');
    	$('#owners_list').load('owner_list.php');
    	$('#asset_list').load('asset_list.php');
	  });
	</script>
	<script type="text/javascript">
		$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
	  	});
	</script>
	<style type="text/css">
	@media only screen and (min-device-width: 320px) and (max-device-width: 736px)
	{
		input:read-only{
			cursor:not-allowed;
		}
		.add_content_div{
			padding-top:15% !important;
		}
	}
	@media only screen and (min-device-width: 320px) and (max-device-width: 736px)
	{
		input:read-only{
			cursor:not-allowed;
		}
		.add_content_div{
			!padding-top:15% !important;
		}
	}
	</style>
	<?php 
		$get_latest_pmt = mysql_query("SELECT mprts_pmt_id from mprts_payments order by mprts_pmt_id desc limit 1");
		$rows = mysql_num_rows($get_latest_pmt);
		if($rows<1){
			$current_pmt_id_full = '0001';
		}
		$latest_pmt_id = mysql_fetch_array($get_latest_pmt)['mprts_pmt_id'];
		$current_pmt_id = (int)$latest_pmt_id+1;
		if($current_pmt_id<10){
			$current_pmt_id_full = '000'.$current_pmt_id;
		}
		else {
			$current_pmt_id_full = '00'.$current_pmt_id;
		}
	?>

<div class="add_content_div">
<!-- <form> -->
	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5>Add a new payment</h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
				<button class="btn waves-effect waves-light" title="Cancel" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="window.location.reload();">Cancel
    			<i class="material-icons right">cancel</i>
  			</button>
				<button class="btn waves-effect waves-light" id="add_payment_submit" onclick="add_payment_submit();" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" name="paymentsubmit" title="Save record">Save
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
			<h5 class="content_name" ><b>Add Payment</b></h5>					
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light save_button save_building" title="Save" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="add_payment_submit();">
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
	    <div class="col s12">
			<ul class="tabs">
				<li class="tab col s6"><a href="#by_tenant" onclick="set_asset_id_null();" style="color: #25414E;font-weight: bolder;">For Tenant</a></li>
				<li class="tab col s6"><a class="active" href="#by_owner" onclick="set_tenant_id_null();" style="color: #25414E;font-weight: bolder;">For Owner</a></li>
			</ul>
	    </div>
	    <div id="by_tenant" class="col s12">
	    			




		<div class="row add_payments" style="border:2px solid #25414E;">
			<div class="col l4 m4 s12 z-depth-3 main_cat">
			<center><label style="font-weight: bolder;">Tenant Details</label></center>
			<hr style="border-color: #2BBBAD;">
				<label>Tenant Id.</label>
	  			<div class="row">
					<div class="col s9">
						<input type="text" id="tenant_id" name="tenant_id" placeholder="Ex: TNT0001" required="true" readonly="true" title="Select from the search button">
					</div>
					<div class="col s3" style="padding: 0px;">
						<a class="waves-effect waves-light btn" href="#modal2" title="Search Asset No." style="padding-right: 10px;padding-left: 10px;"><i class="material-icons">search</i></a>
					</div>
				</div>

				<!------------------------------------------------------------------------------------------------------------------------------------------ -->

					<!-- Modal Structure -->
					<div id="modal2" class="modal modal-fixed-footer">
					<div class="modal-content" title="Tenants List">
						<h4>Tenants List</h4>
						<p id="tenant_list"></p>
					</div>
					<div class="modal-footer">
					  	<a href="#!" id="tenant_close" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
						<script type="text/javascript">
							$('#tenant_close').click(function(){
								// document.getElementById('tenant_id').value = tenant_id;
								var tenant_id = document.getElementById('tenant_id').value;
								d = new Date();

								month = d.getMonth()+1;
								if(month<10){
									month='0'+month;
								}
								day = d.getDate();
								if(day<10){
									day='0'+day;
								}
								year = d.getFullYear().toString().substr(-2);

								var tenant_id_receipt = tenant_id.substr(3, 4);

								date = year.toString()+month.toString()+day.toString();
								receiptNo = date+tenant_id_receipt+'<?php echo $current_pmt_id_full; ?>'+1;
								// receiptNo = date+tenant_id;
								$('#pmt_reciept_no').val(receiptNo);
								// alert(month);
							});
							
						</script>
					</div>
					<div class="modal-footer" style="position:unset;">
      <a href="#!" id="vendors_close" class="main_vendor_close modal-action modal-close waves-effect waves-green btn-flat">Close</a>
      <a href="#!" id="vendors_close" class="resp_vendor_close modal-action modal-close waves-effect waves-green btn-flat"><i class="material-icons left">close</i></a>
    </div>
					</div>

				<!------------------------------------------------------------------------------------------------------------------------------------------ -->


			    <label>Tenant Name</label>
				<input type="text" name="pmt_tenant_name" id="pmt_tenant_name" placeholder="Tenant Name" readonly="true" required="true" maxlength="30">

				<label>From Date</label>
				<input type="date" name="pmt_from_date" id="pmt_from_date" required="true" class="" placeholder="From Date" required="true">
				<label>To Date</label>
				<input type="date" name="pmt_to_date" id="pmt_to_date" required="true" class="" placeholder="To Date" required="true">


			</div>

			<div class="col l4 m4 s12 z-depth-3 main_cat">
				<center><label style="font-weight: bolder;">Address & Contacts</label></center>
				<hr style="border-color: #2BBBAD;">
				<label>House/Flat No</label>
				<input type="text" name="pmt_prty_no" id="pmt_prty_no" placeholder="House Number" readonly="true" required="true">
				<label>Address</label>
				<input type="text" name="pmt_prty_address" id="pmt_prty_address" placeholder="Address" readonly="true" required="true">
				<label>Owner</label>
				<input type="text" name="pmt_prty_owner" id="pmt_prty_owner" placeholder="Owner Name" readonly="true" required="true">
			</div>

			<div class="col l4 m4 s12 z-depth-3 main_cat">
				<center><label style="font-weight: bolder;">Payment Details</label></center>
				<hr style="border-color: #2BBBAD;">
				<label>Receipt Number</label>
				<input type="text" name="pmt_reciept_no" id="pmt_reciept_no" placeholder="Reciept Number" required="true" readonly="true">

				<div class="row">
			        <div class="input-field col s12">
			    	    <input type="text" name="pmt_cause" id="pmt_cause" required="true" maxlength="100">
			          	<label for="pmt_cause">Cause of Payment</label>
			        </div>
			    </div>

			    <div class="row">
			        <div class="input-field col s12">
			    	    <input type="number" name="pmt_amt_paid" id="pmt_amt_paid" onchange="get_due();" required="true" maxlength="8">
			          	<label for="pmt_amt_paid">Amount Paid</label>
			        </div>
			    </div>

			    <div class="row">
			        <div class="input-field col s12">
			    	    <input type="number" name="pmt_amt_actual" id="pmt_amt_actual" onchange="get_due();" required="true" maxlength="8">
			          	<label for="pmt_amt_actual">Amount Payable</label>
			        </div>
			    </div>


				<div class="row">
			        <div class="input-field col s12">
			    	    <input type="text" placeholder="Due Amount" name="pmt_amt_due" id="pmt_amt_due" required="true" readonly="true" maxlength="8">
			          	<label for="pmt_amt_due">Due Amount</label>
			        </div>
			    </div>

			</div>
		</div>




	    </div>
	    <div id="by_owner" class="col s12">
	    <!---------------------------------------- By Owner starts here------------------------------------ -->


	    	<div class="row add_payments" style="border:2px solid #25414E;">
			<div class="col l4 m4 s12 z-depth-3 main_cat">
			<center><label style="font-weight: bolder;">Owner Details</label></center>
			<hr style="border-color: #2BBBAD;">
				<label>Asset Id.</label>
	  			<div class="row">
					<div class="col s9">
						<input type="text" id="asset_id" name="asset_id" placeholder="Ex: AST0001" required="true" readonly="true" title="Select from the search button">
					</div>
					<div class="col s3" style="padding: 0px;">
						<a class="waves-effect waves-light btn" href="#modal3" title="Search Asset No." style="padding-right: 10px;padding-left: 10px;"><i class="material-icons">search</i></a>
					</div>
				</div>

				<!------------------------------------------------------------------------------------------------------------------------------------------ -->

					<!-- Modal Structure -->
					<div id="modal3" class="modal modal-fixed-footer">
					<div class="modal-content" title="Asset List">
						<h4>Assets List</h4>
						<p id="asset_list"></p>
					</div>
					<div class="modal-footer">
					  	<a href="#!" id="asset_close" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
						<script type="text/javascript">
							$('#asset_close').click(function(){
								document.getElementById('asset_list').value = asset_id;
								d = new Date();

							month = d.getMonth()+1;
							if(month<10){
								month='0'+month;
							}
							day = d.getDate();
							if(day<10){
								day='0'+day;
							}
							year = d.getFullYear().toString().substr(-2);

							asset_id_substr = asset_id.substr(3, 4);

							date = year.toString()+month.toString()+day.toString();
							receiptNoOwner = date+asset_id_substr+'<?php echo $current_pmt_id_full; ?>'+0;
							// receiptNo = date+asset_id;
							$('#pmt_reciept_no_owner').val(receiptNoOwner);
							// alert(receiptNoOwner);
							});
							
						</script>
					</div>
					<div class="modal-footer" style="position:unset;">
      <a href="#!" id="vendors_close" class="main_vendor_close modal-action modal-close waves-effect waves-green btn-flat">Close</a>
      <a href="#!" id="vendors_close" class="resp_vendor_close modal-action modal-close waves-effect waves-green btn-flat"><i class="material-icons left">close</i></a>
    </div>
					</div>

				<!------------------------------------------------------------------------------------------------------------------------------------------ -->


			    <label>Owner Name</label>
				<input type="text" name="pmt_owner_name" id="pmt_owner_name" placeholder="Owner Name" readonly="true" required="true">
				<input type="hidden" name="pmt_owner_id" id="pmt_owner_id">
				


			</div>

			<div class="col l4 m4 s12 z-depth-3 main_cat">
				<center><label style="font-weight: bolder;">Asset Details</label></center>
				<hr style="border-color: #2BBBAD;">
				<label>House/Flat No</label>
				<input type="text" name="pmt_prty_no_owner" id="pmt_prty_no_owner" placeholder="House Number" readonly="true" required="true">
				<label>Address</label>
				<input type="text" name="pmt_prty_address_owner" id="pmt_prty_address_owner" placeholder="Address" readonly="true" required="true">
				<label>From Date</label>
				<input type="date" name="pmt_from_date_owner" id="pmt_from_date_owner" required="true" class="" placeholder="From Date">
				<label>To Date</label>
				<input type="date" name="pmt_to_date_owner" id="pmt_to_date_owner" required="true" class="" placeholder="To Date">
			</div>

			<div class="col l4 m4 s12 z-depth-3 main_cat">
				<center><label style="font-weight: bolder;">Payment Details</label></center>
				<hr style="border-color: #2BBBAD;">
				<label>Reciept Number</label>
				<input type="text" name="pmt_reciept_no_owner" id="pmt_reciept_no_owner" placeholder="Reciept Number" required="true" readonly="true">

				<div class="row">
			        <div class="input-field col s12">
			    	    <input type="text" name="pmt_cause_owner" id="pmt_cause_owner" required="true">
			          	<label for="pmt_cause_owner">Cause of Payment</label>
			        </div>
			    </div>

			    <div class="row">
			        <div class="input-field col s12">
			    	    <input type="number" name="pmt_amt_paid_owner" id="pmt_amt_paid_owner" onchange="get_due_owner();" required="true" maxlength="8">
			          	<label for="pmt_amt_paid_owner">Amount Paid</label>
			        </div>
			    </div>

			    <div class="row">
			        <div class="input-field col s12">
			    	    <input type="number" name="pmt_amt_actual_owner" id="pmt_amt_actual_owner" onchange="get_due_owner();" required="true" maxlength="8">
			          	<label for="pmt_amt_actual_owner">Amount Payable</label>
			        </div>
			    </div>


				<div class="row">
			        <div class="input-field col s12">
			    	    <input type="text" placeholder="Due Amount" name="pmt_amt_due_owner" id="pmt_amt_due_owner" required="true" readonly="true">
			          	<label for="pmt_amt_due_owner">Due Amount</label>
			        </div>
			    </div>

			</div>
		</div>








	    <!----------------------------------------- By Owner ends here ----------------------------- -->


	    </div>
	</div>








</div>
</body>
<script type="text/javascript">

	function set_asset_id_null(){
		$('#asset_id').val("");
	}

	function set_tenant_id_null(){
		$('#tenant_id').val("");
	}
	
	function get_due_amount(value){
		// var due_amount = parseInt($('#pmt_tenant_rent').val())-parseInt($('#pmt_amount_paid').val());
		var due_amount = $('#pmt_amt_actual').val() - $('#pmt_amt_paid').val();
		$('#pmt_amt_due').val(due_amount);
	}

	function get_due_amount_owner(value_owner){
		// var due_amount = parseInt($('#pmt_tenant_rent').val())-parseInt($('#pmt_amount_paid').val());
		var due_amount2 = $('#pmt_amt_actual_owner').val() - $('#pmt_amt_paid_owner').val();
		$('#pmt_amt_due_owner').val(due_amount2);
	}

	function add_payment_submit(){
		//if($('#pmt_owner_id').val() != "" && $('#pmt_reciept_no_owner').val() != "" && $('#pmt_amt_actual_owner').val() != "" && $('#pmt_amt_paid_owner').val() != "" && $('#pmt_cause_owner').val() != "" && $('#pmt_amt_due_owner').val() != ""){
						
		if($('#tenant_id').val()==""){
			add_payment_submit_owner();
		}
		else{
			if($('#tenant_id').val() != "" && $('#pmt_reciept_no').val() != "" && $('#pmt_amt_actual').val() != "" && $('#pmt_amt_paid').val() != "" && $('#pmt_cause').val() != "" && $('#pmt_amt_due').val() != ""){
		var data_to_pass = $('#tenant_id').val()+'#|#'+$('#pmt_from_date').val()+'#|#'+$('#pmt_to_date').val()+'#|#'+$('#pmt_reciept_no').val()+'#|#'+$('#pmt_amt_actual').val()+'#|#'+$('#pmt_amt_paid').val()+'#|#'+$('#pmt_cause').val()+'#|#'+$('#pmt_amt_due').val();
		// alert($('#asset_id').val());
		$.ajax({
		      url: "add_payment_backend.php",
		      data: {
		        payment_details: data_to_pass
		      },
		      type: 'post',
		      cache: false,
		      success: function(value){
		             alert('Payment Added Successfully');
		             location.reload();
		        }
		    });
		}
		else {
			alert('Please fill all the mandatory data');
		}
		}
		
	}
	
	function add_payment_submit_owner(){
		if($('#pmt_owner_id').val() != "" && $('#pmt_reciept_no_owner').val() != "" && $('#pmt_amt_actual_owner').val() != "" && $('#pmt_amt_paid_owner').val() != "" && $('#pmt_cause_owner').val() != "" && $('#pmt_amt_due_owner').val() != ""){
			var data_to_pass = $('#pmt_owner_id').val()+'#|#'+$('#pmt_from_date_owner').val()+'#|#'+$('#pmt_to_date_owner').val()+'#|#'+$('#pmt_reciept_no_owner').val()+'#|#'+$('#pmt_amt_actual_owner').val()+'#|#'+$('#pmt_amt_paid_owner').val()+'#|#'+$('#pmt_cause_owner').val()+'#|#'+$('#pmt_amt_due_owner').val();
		// alert($('#tenant_id').val());
		//alert(data_to_pass);
		$.ajax({
		      url: "add_payment_backend.php",
		      data: {
		        payment_details_owner: data_to_pass
		      },
		      type: 'post',
		      cache: false,
		      success: function(value){
		             alert('Payment Added Successfully');
		             location.reload();
		        }
		    });
		}
		else {
			alert('Please fill all the mandatory data');
		}
		
	}

	function get_due(){
		act_amt = $('#pmt_amt_actual').val();
		paid_amt = $('#pmt_amt_paid').val();
		due_amt  = parseInt(act_amt) - parseInt(paid_amt);
		// console.log(parseInt(act_amt));
		$('#pmt_amt_due').val(due_amt);
	}

	function get_due_owner(){
		act_amt_owner = $('#pmt_amt_actual_owner').val();
		paid_amt_owner = $('#pmt_amt_paid_owner').val();
		due_amt_owner  = parseInt(act_amt_owner) - parseInt(paid_amt_owner);
		// console.log(parseInt(act_amt));
		$('#pmt_amt_due_owner').val(due_amt_owner);
	}
</script>