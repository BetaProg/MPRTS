<?php
	session_start();
	$user_name = $_SESSION["user_name"] ;
	$user_access_code = $_SESSION["user_access_code"];
?>
<head>
	<title>MPRTS | Add Vendor</title>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
</head>
<script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
    $('.modal').modal();
    $('.modal-overlay').remove();
	$('#self_vndr_content').css('display', 'none');
});
</script>
<body>
<script>
	jQuery.get('Locations/Andhra_cities.txt', function(data_city) {
		//alert('Cities Called');
		andhra_cities = data_city.split('\n');
		cities_drop_down_options = "<option value='' class='city_dropdown_dom' disabled selected>Choose City</option>";
		for(i=0;i<=andhra_cities.length-1;i++){
			cities_drop_down_options += "<option value='"+andhra_cities[i]+"'>"+andhra_cities[i]+"</option>";
		}
		$('#vndr_city').append(cities_drop_down_options);
		
	});
	
	jQuery.get('Locations/Hyd_areas/hyd_areas.txt', function(data_locality) {
		//alert('Areas Called');
		single_areas = data_locality.split('\n');
		area_drop_down_options = "<option value='' class='area_dropdown_dom' disabled selected>Choose Vendor Locality</option>";
		for(j=0;j<=single_areas.length-1;j++){
			area_drop_down_options += "<option value='"+single_areas[j]+"'>"+single_areas[j]+"</option>";
		}
		$('#vndr_locality').append(area_drop_down_options);
	});
	
$('input[type=radio][name="company"]').change(function() {
	if (this.id == 'self_emp') {
		$('#self_vndr_content').css('display', 'block');
		$('.vndr_website').css('display', 'none');
		company = 'Self';
	}
	else{
		$('#self_vndr_content').css('display', 'block');
		$('.vndr_website').css('display', 'block');
		company = 'Company';
	}
});
	
</script>
	<div class="row">
		<form class="col s12">
			<div class="row">
				<div class="">
					<input class="with-gap" name="company" type="radio" id="self_emp" required="true" />
					<label for="self_emp">Self</label>
					<input class="with-gap" name="company" type="radio" id="comp_emp" required="true" />
					<label for="comp_emp">Company</label>
				</div>
				<div id="self_vndr_content">
					<div class="input-field col s6">
						<input id="vndr_name" type="text" name="vndr_name" class="validate" required="true" maxlength="80">
						<label for="vndr_name">Name</label>
					</div>
					<div class="input-field col s6">
						<select class="icons" id="vndr_profession" name="vndr_profession" required="true">
							<option value="" disabled selected>Choose your option</option>
							<option value="Carpenter" data-icon="images/icons/saw.png" class="left circle">Carpenter</option>
							<option value="Carpet Cleaner" data-icon="images/icons/carpet.png" class="left circle">Carpet Cleaner</option>
							<option value="Current Line Man" data-icon="images/icons/electric_tower.png" class="left circle">Current Line Man</option>
							<option value="Driver Services" data-icon="images/icons/driver.png" class="left circle">Driver Services</option>
							<option value="Duplicate Key Makers" data-icon="images/icons/keys.png" class="left circle">Key Makers</option>
							<option value="Electricians" data-icon="images/icons/electrician.png" class="left circle">Electricians</option>
							<option value="Maid" data-icon="images/icons/maid.png" class="left circle">Maid</option>
							<option value="Masons" data-icon="images/icons/worker.png" class="left circle">Masons</option>
							<option value="Painter" data-icon="images/icons/painter.png" class="left circle">Painter</option>
							<option value="Pest Control" data-icon="images/icons/spray.png" class="left circle">Pest Control</option>
							<option value="Plumber" data-icon="images/icons/faucet.png" class="left circle">Plumber</option>
							<option value="Repairs" data-icon="images/icons/wrench.png" class="left circle">Repairs</option>
							<option value="Tyre - Punctures" data-icon="images/icons/tyre_expert.png" class="left circle">Tyre - Punctures</option>
							<option value="Others" data-icon="images/icons/wrench.png" class="left circle">Others</option>
							<option value="Watchman" data-icon="images/icons/policeman.png" class="left circle">Watchman</option>
							<option value="Water Tanker Services" data-icon="images/icons/tanker.png" class="left circle">Water Tanker Services</option>
						</select>
						<label>Vendor Category</label>
					</div>
		
					<div class="row">
						<div class="input-field col s6">
							<select name="vndr_city" id="vndr_city" required="true"></select>
							<label>City</label>
						</div>
						
						<div class="input-field col s6">
							<select name="vndr_locality" id="vndr_locality" required="true"></select>
							<label>Locality</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<select name="vndr_state" id="vndr_state" required="true">
								<option value="Andhra Pradesh">Andhra Pradesh</option>
								<option value="Karnataka">Karnataka</option>
								<option value="Telangana">Telangana</option>
							</select>
							<label>State</label>
						</div>
						<div class="input-field col s6">
						  <input id="vndr_pincode" name="vndr_pincode" type="number" class="validate" maxlength="6" required="true">
						  <label for="vndr_pincode">Pincode</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
						  <input id="vndr_phone1" name="vndr_phone1" type="number" class="validate" maxlength="16" required="true">
						  <label for="vndr_phone1">Mobile Number</label>
						</div>
						<div class="input-field col s6">
						  <input id="vndr_phone2" name="vndr_phone2" type="number" class="validate" maxlength="16" required="true">
						  <label for="vndr_phone2">Alternate Number</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col l6 m6 s12">
							<select id="vendor_id_type">
							  <option value="" disabled selected>Choose Valid Id:</option>
							  <option value="Passport">Passport</option>
							  <option value="Aadhar Card">Aadhar Card</option>
							  <option value="PAN Card">PAN Card</option>
							  <option value="Driving Licence">Driving Licence</option>
							</select>
							<label>Valid Id Proof</label>
						</div>
						<div class="input-field col s6">
							<input type="text" name="expense_id_no" class="validate" id="vendor_id_no" required="true">
							<label for="vendor_id_no">Id No.</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
						  <input id="vndr_email" name="vndr_email" type="email" class="validate" maxlength="80" required="true">
						  <label for="vndr_email">Email Address</label>
						</div>
						<div class="input-field col s6 vndr_website">
							<input id="vndr_website" name="vndr_website" type="text" class="validate" maxlength="160">
							<label for="vndr_website">Website</label>
						</div>
					</div>
					
					
					
					<div class="row">
						<button class="btn waves" type="button" id="save_vndr" name="save_vndr">Save Vendor
							<i class="material-icons right">send</i>
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
  
</body>

<script>
	$('#save_vndr').click(function(){
		if($('#vndr_name').val()==""){
			alert('Vendor Name Cannot be empty');
		}
		else if($('#vndr_profession').val()==""){
			alert('Vendor Profession Cannot be empty');
		}
		else if($('#vndr_city').val()==""){
			alert('Vendor City Cannot be empty');
		}
		else if($('#vndr_locality').val()==""){
			alert('Vendor Locality Cannot be empty');
		}
		else if($('#vndr_state').val()==""){
			alert('Vendor State Cannot be empty');
		}
		else if($('#vndr_pincode').val()==""){
			alert('Vendor Pincode Cannot be empty');
		}
		else if($('#vndr_phone1').val()==""){
			alert('Vendor Phone number Cannot be empty');
		}
		else if($('#vndr_phone2').val()==""){
			alert('Vendor Alternate Number Cannot be empty');
		}
		else if($('#vndr_email').val()==""){
			alert('Vendor Email Cannot be empty');
		}
		else if($('#vendor_id_type').val()==""){
			alert('Vendor Id Type Cannot be empty');
		}
		else if($('#vendor_id_no').val()==""){
			alert('Vendor Id No. Cannot be empty');
		}
		else {
			if($('.vndr_website').css('display')=='none'){
				$('#vndr_website').value="";
			}
			vndr_data = $('#vndr_name').val()+'#$@'+$('#vndr_profession').val()+'#$@'+$('#vndr_website').val()+'#$@'+$('#vndr_city').val()+'#$@'+$('#vndr_locality').val()+'#$@'+$('#vndr_state').val()+'#$@'+$('#vndr_pincode').val()+'#$@'+$('#vndr_phone1').val()+'#$@'+$('#vndr_phone2').val()+'#$@'+$('#vndr_email').val()+'#$@'+company+'#$@'+$('#vendor_id_type').val()+'#$@'+$('#vendor_id_no').val();
			console.log(vndr_data);
			add_vndr_details(vndr_data);
		}
	});
	function add_vndr_details(vndr_data) {
		console.log(vndr_data);
		$.ajax({
			url: "add_vendor_backend.php",
			data: {
				data_passed: vndr_data
			},
			type: 'post',
			cache: false,
			success: function(response){
				if(response == "Vendor Added Successfully"){
					window.location = 'vendors_content.php';
				}
				else {
					alert("Seems a duplicate record exists, Please check for any existing EmailId or Mobile number");
				}
			}
		}); 
	  }
</script>










