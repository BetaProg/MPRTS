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
<?php include 'db_config.php'; ?>
<?php include 'headers.php'; ?>
<?php 
	$access_type = substr($user_access_code, 0, 2);
	if($access_type=='AA'){
		echo "<style>
				#masteradmin_panel,  #details_inventories, #details_deposits, #details_invoice, #details_reports, #details_classifieds,  #details_calender, .complaints_button {
					display:none !important;
				}
				.notes_button_icon{
					margin-top:4% !important;
				}
				.notes_div{
					width:50%;
				}
			</style>";
	}
	else if($access_type=='TT'){
		echo "<style>
				#masteradmin_panel, #details_owners, #details_tenants, #details_expenses, #details_inventories, #details_deposits, #details_invoice, #details_reports,  #details_complaints, #details_classifieds,  #details_calender {
					display:none !important;
				}
			</style>";
	}
	else if($access_type=='OO'){
		echo "<style>
				#masteradmin_panel, #details_owners, #details_inventories, #details_deposits, #details_invoice, #details_reports, #details_classifieds,  #details_calender, .notes_icon {
					display:none !important;
				}
			</style>";
	}
?>

<script type="text/javascript">
$(document).ready(function() {
    $(".button-collapse").sideNav();
  });
  $(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="se-pre-con"></div>
<style>
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(images/preloader_old.gif) center no-repeat #fff;
}
.float_row .col.s9{
	margin-top:0%;
	padding-left:0px !important;
}
.float_row .col.s9 a{
	margin-top:1%;
	padding-left:0px !important;
}
	.float_row .col{
		z-index:1;
		position:relative;
		background-color:transparent;
		color:#fff;
		margin-top:8%;
		padding-left:8% !important;
		text-align:left;
	}

</style>
<div class="nav_thread z-depth-4" style="overflow-x: hidden !important;">
	<div class="col s8 welcome_div" onclick="$('.button-collapse').click();">
		<!--<center><h5>Hi <?php echo $user_name ?>!</h5></center>-->
	</div>
	<div class="col s2 logout_button_div">
		<h5><a href="logout.php" style="font-weight: bolder !important;float: right;position: fixed;top:11;right:28;font-size: 15px;font-weight: bolder;/*color:#EE4D43;*/" title="Logout"><i class="material-icons">power_settings_new</i></a></h5>
	</div>
	
	<ul id="slide-out1" class="side-nav fixed" style=''>
		<div class="logo_div">
			<!--<img src="images/logo/maa_logo_dark.png">-->
			<!--<img src="images/rounded_logo.png">-->
			<!--<h5 class="brand_name"><a href="index.php">Maa Properties</a></h5>-->
		</div>
		  <li id='masteradmin_panel'><a href="masteradmin_panel.php"><i class="material-icons">settings</i>Master Admin Panel</a></li>
		  <li id='details_buildings'><a href="building_content.php"><i class="material-icons">business</i>Property Details</a></li>
		  <li id='details_owners'><a href="owner_content.php"><i class="material-icons">perm_identity</i>Owners Details</a></li>
		  <li id='details_property'><a href="property_content.php"><i class="material-icons">home</i>Asset Details</a></li>
		  <li id='details_tenants'><a href="tenant_content.php"><i class="material-icons">people</i>Tenants Details</a></li>
		  <li id='details_payments'><a href="payments_content.php"><i class="material-icons">attach_money</i>Payments Details</a></li>
		  <li id='details_expenses'><a href="expense_content.php"><i class="material-icons">credit_card</i>Expenses Details</a></li>
		  <li id='details_services'><a href="vendors_content.php"><i class="material-icons">build</i>Vendor Details</a></li>
		  <li id='details_inventories'><a href="#!"><i class="material-icons">store</i>Inventories Details</a></li>
		  <li id='details_deposits'><a href="#!"><i class="material-icons">monetization_on</i>Deposits Details</a></li>
		  <li id='details_invoice'><a href="#!"><i class="material-icons">assignment</i>Invoice</a></li>
		  <li id='details_reports'><a href="#!"><i class="material-icons">description</i>Reports</a></li>
		  <li id='details_notifications'><a href="notifications_content.php"><i class="material-icons">notifications_active</i>Notifications</a></li>
		  <li id='details_complaints'><a href="complaints_content.php"><i class="material-icons">call_to_action</i>Complaints</a></li>
		  <li id='details_classifieds'><a href="#!"><i class="material-icons">add_to_queue</i>Classifieds</a></li>
		  <li id='details_calender'><a href="#!"><i class="material-icons">date_range</i>Event Calender</a></li>
	</ul>
		    <a href="#" data-activates="slide-out1" class="button-collapse"><i class="material-icons">menu</i></a>

		    <a class="btn-floating btn-large waves-effect waves-light #006666 resp_float" style="position: fixed;top:85%;right:5%;bottom:0;width: 40px;height:40px;display:none;"><i class="material-icons">add</i></a>
</div>


<script>
	if(sessionStorage.getItem('PageOpened')=='Buildings'){
		$('#details_buildings').css('background-color', '#ecf0f1');
	}
	if(sessionStorage.getItem('PageOpened')=='Owners'){
		$('#details_owners').css('background-color', '#ecf0f1');
	}
	if(sessionStorage.getItem('PageOpened')=='Assets'){
		$('#details_property').css('background-color', '#ecf0f1');
	}
	if(sessionStorage.getItem('PageOpened')=='Expenses'){
		$('#details_buildings').css('background-color', '#ecf0f1');
	}
	if(sessionStorage.getItem('PageOpened')=='Tenants'){
		$('#details_tenants').css('background-color', '#ecf0f1');
	}
	if(sessionStorage.getItem('PageOpened')=='Payments'){
		$('#details_payments').css('background-color', '#ecf0f1');
	}
	if(sessionStorage.getItem('PageOpened')=='Expenses'){
		$('#details_expenses').css('background-color', '#ecf0f1');
	}
	if(sessionStorage.getItem('PageOpened')=='Vendors'){
		$('#details_services').css('background-color', '#ecf0f1');
	}
	
	$('#details_buildings').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Buildings');
	});
	$('#details_owners').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Owners');
	});
	$('#details_property').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Assets');
	});
	$('#details_tenants').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Tenants');
	});
	$('#details_payments').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Payments');
	});
	$('#details_expenses').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Expenses');
	});
	$('#details_services').on('click', function(){
		sessionStorage.setItem('PageOpened', 'Vendors');
	});
	
	//sessionStorage.setItem('PageOpened', '');
</script>


   
<div class="fixed-action-btn toolbar">
    <a class="btn-floating btn-large green">
      <i class="large material-icons">mode_edit</i>
    </a>
    <ul>
      <li class="float_notes">
	  <!--<i class="material-icons" href="#modal11">note_add</i>
		<a class="btn modal-trigger" href="#modal11">Modal</a>-->
		<div class='row float_row'>
			<div class='col s3 notes_button_icon' style=''>
				<i class="material-icons">note_add</i>
				<!--<a style='float:left;' class="btn modal-trigger" href="#modal11">Notes</a>-->
			</div>
			<div class='col s9 notes_div'>
				<a class="btn modal-trigger" href="#modal11">Notes</a>
			</div>
		</div>
		
	  </li>
	  <li class="float_notes complaints_button">
	  <div class='row float_row'>
			<div class='col s3' style=''>
				<i class="material-icons">format_quote</i>
				<!--<a style='float:left;' class="btn modal-trigger" href="#modal11">Notes</a>-->
			</div>
			<div class='col s9'>
				<a class="btn modal-trigger" href="#modal12">Complaints</a>
			</div>
		</div>
	  </li>
    </ul>
</div>
<!--<a style='position:absolute;top:90;' class="waves-effect waves-light btn modal-trigger" href="#modal11">Modal</a>-->
<div id="modal11" class="modal bottom-sheet">
	<div class="modal-content">
		<h4>Notes</h4>
		<p>Add a notes here</p>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Save</a>
	</div>
</div>
<div id="modal12" class="modal bottom-sheet">
	<div class="modal-content" style='padding:0px;'>
		<h4>Complaints</h4>
		<div class='complaints_content'>
			<div class="row">
				<div class="input-field col s12" style='margin-top:0px;'>
					<input id="complaint_title" required="true" type="text" class="validate complaint_title">
					<label for="complaint_title">Enter Complaint Title</label>
				</div>
			</div>
			<div class="row">
				<form class="col s12" style='margin-bottom:0px;'>
				<div class="row">
					<div class="input-field col s12">
					<textarea id="complaint_desc" required="true" class="materialize-textarea complaint_desc"></textarea>
					<label for="complaint_desc">Textarea</label>
					</div>
				</div>
				</form>
			</div>
		</div>
		
		
	</div>
	<div class="modal-footer">
		<a href="#!" onclick="saveComplaint();" class="modal-action modal-close btn-flat">Save</a>
		<a href="#!" onclick="" class="modal-action modal-close btn-flat">Close</a>
	</div>
</div>











<!-- 8888888888888888888888888888888888888888888888888888 Modal Starts Here 888888888888888888888888888888888888888888888888888888 -->
	 <!-- Modal Trigger -->
  <!--<a href="#modal1" class="notes_icon" onclick="$('#show_notes').load('show_notes.php');" title="Add Notes" style="display:none;position: absolute;bottom:50;right:20;color: #006666;"><i style="font-size: 40px;" class="material-icons">note_add</i></a>

  <!-- Modal Structure -->
  <!--<div id="modal1" class="modal">
    <div class="modal-content">





<div class="row notes_content">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a href="#add_notes">Add Notes</a></li>
        <li class="tab col s3"><a class="active" href="#show_notes">Show Notes</a></li>
      </ul>
    </div>
    <div id="add_notes" class="col s12">-->
    <!-- -------------------------------------------- Add Notes Starts --------------------------------------------------- -->


     <!-- <h5>Add Notes</h5>
	  <div class="row" title="Notes">
	    <form class="col s12">
	      <div class="row">
	        <div class="input-field col s12">
			    <select name="notes_category" id="notes_category" required="true">
			      <option value="" disabled selected>Choose your option</option>
			      <option value="Owners">Owner Details</option>
			      <option value="Assets">Asset Details</option>
			      <option value="Tenants">Tenants</option>
			      <option value="Payments">Payments</option>
			      <option value="Expenses">Expenses</option>
			      <option value="Others">Others</option>
			    </select>
			    <!-- <label>Materialize Select</label> -->
		  <!--	</div>
		  	<div class="input-field col s12">
	          <!-- <i class="material-icons prefix">mode_edit</i> -->
	    <!--      <textarea id="notes_description" class="materialize-textarea" required="true"></textarea>
	          <label for="notes_description">Text here</label>
	        </div>
	      </div>
	    </form>
	  </div>-->
	  <!--<div class="modal-footer main_footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" title="Delete"><i class="material-icons left">close</i>Close</a>	
		
			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" title="Save record" onclick="save_notes();"><i class="material-icons left">save</i>Save</a>	
	   </div>
	   <div class="modal-footer resp_footer">
	   	<div class="row">
	   		<div class="col s6">
	   			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" style="color:red;font-size: 30px;padding-left: 0px;padding-right: 0px;" title="Delete"><i class="material-icons left">close</i>Close</a>		
	   		</div>
	   		<div class="col s6">
	   			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" style="color:green;font-size: 30px;padding-left: 0px;padding-right: 0px;" title="Save record" onclick="save_notes();"><i class="material-icons left">save</i>Save</a>
	   		</div>
	   	</div>
	   </div>-->


    <!-- -------------------------------------------- Add Notes Ends --------------------------------------------------- -->

   <!-- </div>
    <div id="show_notes" class="col s12">
    	
    <!-- -------------------------------------------- Show Notes Starts --------------------------------------------------- -->








    <!-- -------------------------------------------- Show Notes Ends --------------------------------------------------- -->



    <!--</div>-->
  <!--</div>


    </div>
    
  </div>
<!-- 8888888888888888888888888888888888888888888888888888 Modal Ends Here 888888888888888888888888888888888888888888888888888888 -->
<script type="text/javascript">
	var d = Date();
	d1 = d.substr(4, 12);
	function save_notes(){
		var data_to_pass = $('#notes_category').val()+'|'+d1+'|'+$('#notes_description').val();
		// alert($('#asset_id').val());
		// alert(data_to_pass);
		$.ajax({
		      url: "add_notes_backend.php",
		      data: {
		        notes_details: data_to_pass
		      },
		      type: 'post',
		      cache: false,
		      success: function(value){
		             alert("Notes Added Successfully");
		             // location.reload();
		        	}
			});
	}
</script>
<script>
	var d2 = Date();
	var d12 = d2.substr(4, 12);
	function saveComplaint(){
		var complaint_title = $('#complaint_title').val();
		var complaint_desc = $('#complaint_desc').val();
		if(complaint_title==""){
			$('#complaint_title').focus();
			alert('Please add a title to complaint');
		}
		if(complaint_title!="" && complaint_desc!= ""){
			var complaint_data_to_pass = complaint_title+'#|#'+complaint_desc+"#|#"+d12;
			$.ajax({
				url: "add_complaint_backend.php",
				data: {
					complaint_details: complaint_data_to_pass
				},
				type: 'post',
				cache: false,
				success: function(value){
					alert("Complaint Added Successfully");
				}
			});
		}
		
	}
</script>