<?php
	session_start();
	$user_name = $_SESSION["user_name"] ;
	$user_access_code = $_SESSION["user_access_code"];
?>
<body>
<title>MPRTS | Add Owner</title>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
<div class="add_content_div" style="margin-top: 1%;" title="Add Owner">
<form action="add_owner_backend.php" method="post" enctype="multipart/form-data">
	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5>Add a new Owner</h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
				<button class="btn waves-effect waves-light" title="Cancel" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="window.location.reload();">Cancel
    			<i class="material-icons right">cancel</i>
  			</button>
				<button class="btn waves-effect waves-light" title="Save record" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" type="submit" name="ownersubmit">Save
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
			<h5 class="content_name" ><b>Add Owner</b></h5>					
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light save_button save_owner" title="Save" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;"  type="submit" name="ownersubmit"">
    			<i class="material-icons" style="font-size: 30px;">save</i>
  			</button>		
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light cancel_button cancel_edit_building" title="Cancel" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
    			<i class="material-icons" style="font-size: 30px;">cancel</i>
  			</button>		
		</div>
	</div>


	<div class="row add_owner_form">
		<div class="col l12 m6 s12 z-depth-3" style="">
			<center><label style="font-weight: bolder;">Personal Details</label></center>
			<hr style="border-color: #2BBBAD;">

			<div class="file-field input-field col l6 m6 s12">
		      <div class="btn" style="background-color: #006666;">
		        <span>Picture</span>
		        <input type="file" name="fileToUpload" id="fileToUpload">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" placeholder="Upload image(Optional)">
		      </div>
		    </div>

		    <div class="file-field input-field col l6 m6 s12">
		      <div class="btn" style="background-color: #006666;">
		        <span>Id</span>
		        <input type="file" name="IdToUpload" id="IdToUpload" required="true">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" placeholder="Upload image(Required)">
		      </div>
		    </div>


		    <div class="input-field col s12">
				<input type="text" name="owner_name" id="owner_name"  required="true" maxlength="30">
				<label for="owner_name">Name</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="owner_mobile" id="owner_mobile"  required="true" maxlength="10" pattern="(7|8|9)\d{9}">
				<label for="owner_mobile">Mobile Number</label>
			</div>
			<div class="input-field col s12">
				<input type="email" name="owner_email" id="owner_email"  required="true" class="validate" maxlength="30">
				<label for="owner_email">Email Id</label>
			</div>
			<div class="input-field col s12">
				<textarea name="owner_address" class="materialize-textarea" id="owner_address" required="true" maxlength="300"></textarea>
				<label for="owner_address">Address</label>
			</div>


			<!-- <label>Name</label>
			<input type="text" name="owner_name" placeholder="Name" required="true">
			<label>Mobile Number</label>
			<input type="text" name="owner_mobile" placeholder="Mobile Number" required="true">
			<label>Email Id</label>
			<input type="email" name="owner_email" placeholder="Email Id" required="true">
			<label>Address</label>
			<textarea name="owner_address" class="materialize-textarea" placeholder="Address" required="true"></textarea> -->
		</div>
	</div>
</form>
</div>
</body>