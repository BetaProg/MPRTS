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
	 	$('#asset_list').load('asset_list.php');
    $('select').material_select();
    $('.modal').modal();
     $('.modal-overlay').remove();
  });
</script>
<title>MPRTS | Add Tenant</title>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
<div class="add_content_div" style="margin-top: 1%;" title="Add Tenants">
<form action="add_tenant_backend.php" method="post"  enctype="multipart/form-data">
	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5>Add a new Tenant</h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
				<button class="btn waves-effect waves-light" title="Cancel" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="window.location.reload();">Cancel
    				<i class="material-icons right">cancel</i>
  				</button>
				<button class="btn waves-effect waves-light" title="Save record" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" name="tenantsubmit" type="submit" method="post">Save
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
			<h5 class="content_name" ><b>Add Tenant</b></h5>					
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light save_button save_building" name="tenantsubmit" title="Save" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" type="submit">
    			<i class="material-icons" style="font-size: 30px;">save</i>
  			</button>		
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light cancel_button cancel_edit_building" title="Cancel" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
    			<i class="material-icons" style="font-size: 30px;">cancel</i>
  			</button>		
		</div>
	</div>

	<div class="row add_tenant">
		<div class="col l4 m4 s12 z-depth-3 main_cat">
			<center><label style="font-weight: bolder;">Personal Details</label></center>
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


		    <div class="file-field input-field col l6 m6 s12">
		      <div class="btn" style="background-color: #006666;">
		        <span>Picture</span>
		        <input type="file" name="fileToUpload" id="fileToUpload">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" placeholder="Upload image(Optional)">
		      </div>
		    </div>

		    <!-- <div class="file-field input-field col l6 m6 s12">
		      <div class="btn" style="background-color: #006666;">
		        <span>Id</span>
		        <input type="file" name="IdToUpload" id="IdToUpload" required="true">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" placeholder="Upload image(Required)">
		      </div>
		    </div> -->


			<div class="row">
		        <div class="input-field col s12">
		    	    <input type="text" name="tenant_name" class="validate" id="tenant_name" required="true" maxlength="30">
		          	<label for="tenant_name">Name</label>
		        </div>
		    </div>

		    <div class="row">
		        <div class="input-field col s12">
		    	    <input type="email" name="tenant_email" class="validate" id="tenant_email" required="true">
		          	<label for="tenant_email">Email</label>
		        </div>
		    </div>

		    <div class="row">
		        <div class="input-field col s12">
		    	    <input type="number" name="tenant_mobile" class="validate" id="tenant_mobile" required="true" maxlength="10" pattern="(7|8|9)\d{9}">
		          	<label for="tenant_mobile">Mobile no.</label>
		        </div>
		    </div>
			

		</div>
		<div class="col l4 m4 s12 z-depth-3 main_cat">
			<center><label style="font-weight: bolder;">Address & Contacts</label></center>
			<hr style="border-color: #2BBBAD;">
			<div class="row">
				<!-- <div class="col s8" style="padding: 0px; ">
					<label>House No</label>
					<input type="text" name="tenant_propid" id="tenant_propid" placeholder="Ex. AST3" required="true">		
				</div>
				<div class="col s4" style="padding: 0px;">
					<button class="btn waves-effect waves-light" id="get_all_tenant_details" onclick="house_id_passed = document.getElementById('tenant_propid').value;get_all_tenant_details(house_id_passed);" style="margin-top: 25px;padding-left:0px;padding-right: 10px;"><i class="material-icons right">send</i>
  					</button>	
				</div> -->

			<label>Asset No</label>
			<div class="row">
				<div class="col s9">
					<input type="text" id="tenant_asset_id" name="tenant_asset_id" placeholder="Ex: AST1" required="true" readonly="true" title="Select from the search button">
				</div>
				<div class="col s3" style="padding: 0px;">
					<a class="waves-effect waves-light btn" href="#modal2" title="Search Asset No." style="padding-right: 10px;padding-left: 10px;"><i class="material-icons">search</i></a>
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
      	$('#asset_close').click(function(){
      		document.getElementById('tenant_asset_id').value = asset_id;
      	});

      </script>
      
    </div>
	<div class="modal-footer" style="position:unset;">
      <a href="#!" id="vendors_close" class="main_vendor_close modal-action modal-close waves-effect waves-green btn-flat">Close</a>
      <a href="#!" id="vendors_close" class="resp_vendor_close modal-action modal-close waves-effect waves-green btn-flat"><i class="material-icons left">close</i></a>
    </div>
  </div>

<!------------------------------------------------------------------------------------------------------------------------------------------ -->



			<input type="hidden" id="tenant_owner_id" name="tenant_owner_id">
			</div>
			<label>Owner Name</label>
			<input type="text" name="tenant_owner_name" id="tenant_owner_name" placeholder="Owner Name" required="true" readonly="true">


			<!-- <div class="row">
		        <div class="input-field col s12">
		    	    <textarea name="tenant_address" class="validate" id="tenant_address" class="materialize-textarea" required="true" ></textarea>
		          	<label for="tenant_address">Tenant's Permanent Address</label>
		        </div>
		    </div> -->

		    <div class="row">
		      	<div class="row">
		        	<div class="input-field col s12">
		          		<textarea name="tenant_address" id="tenant_address" class="materialize-textarea" required="true" maxlength="300"></textarea>
		          		<label for="tenant_address">Tenant's Permanent Address</label>
		        	</div>
		      	</div>
		  	</div>



			

			<div class="row">
		        <div class="input-field col s12">
		    	    <input type="number" name="tenant_advance" id="tenant_advance" class="validate" required="true" maxlength="10">
		          	<label for="tenant_advance">Advance Amount Paid</label>
		        </div>
		    </div>

		</div>
		<div class="col l4 m4 s12 z-depth-3 main_cat">
			<center><label style="font-weight: bolder;">Others</label></center>
			<hr style="border-color: #2BBBAD;">
			

			<!-- <div class="input-field col s12">
				<select id="tenant_id_type">
				  <option value="" disabled selected>Choose Valid Id:</option>
				  <option value="Passport">Passport</option>
				  <option value="Aadhar Card">Aadhar Card</option>
				  <option value="PAN Card">PAN Card</option>
				  <option value="Driving Licence">Driving Licence</option>
				</select>
				<label>Valid Id Proof</label>
			</div> -->

			<div class="file-field input-field col l6 m6 s12">
		      <div class="btn" style="background-color: #006666;">
		        <span>Id</span>
		        <input type="file" name="IdToUpload" id="IdToUpload" required="true">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" placeholder="Upload image(Required)">
		      </div>
		    </div>


			<div class="row">
		        <div class="input-field col s12">
		    	    <input type="text" name="tenant_id_no" class="validate" id="tenant_id_no" required="true">
		          	<label for="tenant_id_no">Id No.</label>
		        </div>
		    </div>



			


			<div class="row">
		        <div class="input-field col s12">
		    	    <!--<input type="date" name="tenant_joining_date" id="tenant_joining_date" class="datepicker" required="true">-->
					<input type="date" name="tenant_joining_date" id="tenant_joining_date" placeholder="Joining Date" class="" required="true">
		          	<!--<label for="tenant_joining_date">Joining Date</label>-->
		        </div>
		    </div>

		    <div class="row">
		        <div class="input-field col s12">
		    	    <!--<input type="date" name="tenant_vacating_date" id="tenant_vacating_date" class="datepicker" required="true">-->
					<input type="date" name="tenant_vacating_date" id="tenant_vacating_date" placeholder="Vacating Date" class="" required="true">
		          	<!--<label for="tenant_vacating_date">Vacating Date</label>-->
		        </div>
		    </div>


		</div>
	</div>
	<script type="text/javascript">
		// function add_tenant_submit(){
		// var tenant_data_to_pass = $('#tenant_name').val()+'|'+$('#tenant_email').val()+'|'+$('#tenant_mobile').val()+'|'+$('#tenant_asset_id').val()+'|'+$('#tenant_owner_id').val()+'|'+$('#tenant_address').val()+'|'+$('#tenant_id_type').val()+'|'+$('#tenant_id_no').val()+'|'+$('#tenant_advance').val()+'|'+$('#tenant_joining_date').val()+'|'+$('#tenant_vacating_date').val();
		tenant_data_to_pass = $('#tenant_name').val()+'|'+$('#tenant_email').val()+'|'+$('#tenant_mobile').val()+'|'+$('#tenant_asset_id').val()+'|'+$('#tenant_owner_id').val()+'|'+$('#tenant_address').val()+'|'+$('#tenant_advance').val()+'|'+$('#tenant_joining_date').val()+'|'+$('#tenant_vacating_date').val();
		// alert(tenant_data_to_pass);
		// $.ajax({
		//       url: "add_tenant_backend.php",
		//       data: {
		//         tenant_details: tenant_data_to_pass
		//       },
		//       type: 'post',
		//       cache: false,
		//       success: function(tenant_value){
		//              alert('Tenant Added Successfully');
		//              window.location.reload();
		//              // alert(tenant_value);
		//         }
		//     });
	// }
	</script>
	<input type="hidden" name="tenant_data_to_pass" value=tenant_data_to_pass>
</form>
</div>
</body>
<script type="text/javascript">
	function get_all_tenant_details(house_id) {
     $.ajax({
      url: "add_tenant_backend.php",
      data: {
        id: house_id
      },
      type: 'post',
      cache: false,
      success: function(value){
             var data = value.split("|");
            // $('#tenant_address').val(data[0]);
            $('#tenant_owner_name').val(data[1]);
            $('#tenant_owner_id').val(data[2]);
        }
    }); 
  }; 
</script>