<?php 
	session_start();
	include 'db_config.php';
	include 'headers.php'; 
?>
<script type="text/javascript">
	 $(document).ready(function() {
    $('select').material_select();
  });
</script>
<style type="text/css">
	.row input, .row .input-field .select-wrapper, .file-field{
		width:90%;
	}
	.top_ribbon {
		height: 10%;
		background-color: #f2f2f2;
		width: 100%;
	}
	.top_ribbon h5{
		margin: 0% 4%;
		padding-top: 15px;
		text-align: left;
		font-weight: bolder;
		font-size: 30px;
	}
</style>
<!DOCTYPE html>
<html>
<head>
	<title>MPRTS | Register</title>
</head>
<body>
<div class="top_ribbon">
			<div class="row">
				<div class="col s1" style="padding-left: 0px;padding-right: 0px;">
					<img src="images/logo/maa_logo_light.jpg" style="width: 100px;position: absolute;">
				</div>
				<div class="col s10" style="padding-left: 0px;">
					<h5 style="float: left;margin-left: 0px;">Mission Maa</h5>
				</div>
			</div>
			
</div>
<div class="register_content">
		<div class="register_form">
			<div class="row">
			    <div class="col s12">
			      <ul class="tabs">
			        <li class="tab col s3"><a href="#test1">Test 1</a></li>
			        <li class="tab col s3"><a class="active" href="#test2">Test 2</a></li>
			        <li class="tab col s3"><a href="#test3">Test 3</a></li>
			        <li class="tab col s3"><a href="#test4">Test 4</a></li>
			      </ul>
			    </div>
			    <div id="test1" class="col s12">
			    	<div class="row">
				<div class="col s4 z-depth-3" style="height: auto;margin-left: 33%;margin-right:33%;">
						<center><h5 style="font-size: 15px;margin-top: 10%;margin-bottom: 0%;text-transform: uppercase;">Register yourself as Apartment Authority</h5>
						<a href="login.php"><h5 style="font-size: 20px;" title="Login">Existing User? Login</h5></a>
						</center>
					<div class="row">
				        <!-- <div class="input-field col s12">
				        	<input id="aa_prop_name" type="text" class="validate">
				        	<label for="aa_prop_name">Property Name</label>
				        </div> -->
				        <div class="input-field col s12">
				        	<input id="aa_username" name="aa_username" type="text" class="validate" required="true">
				        	<label for="aa_username">User Name</label>
				        </div>
				        <div class="input-field col s12">
				        	<input id="aa_prop_email" type="email" class="validate" required="true">
				        	<label for="aa_prop_email">Email id</label>
				        </div>
				        <div class="input-field col s12">
				        	<input id="aa_prop_mobile" type="text" class="validate" required="true">
				        	<label for="aa_prop_mobile">Mobile</label>
				        </div>
				        <div class="input-field col s12">
				        	<input aa_prop_pass" type="password" class="validate" required="true">
				        	<label for="aa_prop_pass">Password</label>
				        </div>
				        <div class="input-field col s12">
				        	<input id="aa_prop_conf_pass" type="password" class="validate" required="true">
				        	<label for="aa_prop_conf_pass">Confirm Password</label>
				        </div>
				        <button class="btn waves-effect waves-light" id="aa_register" type="submit" onclick="aa_register();" name="aa_register" style="float: right;margin-right: 11%;">Register
					    	<i class="material-icons right">send</i>
					  	</button>
					</div>
					<div class="row">
						<div class="col s12" id="register_success_message">
							
						</div>
					</div>
				</div>
			</div>
			    </div>
			    <div id="test2" class="col s12">Test 2</div>
			    <div id="test3" class="col s12">Test 3</div>
			    <div id="test4" class="col s12">Test 4</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	
	function aa_register(){
		// if($('#aa_username').val() != "" && $('#aa_prop_email').val() != "" && $('#aa_prop_mobile').val() != "" && $('#aa_prop_pass').val() != "" && $('#aa_prop_conf_pass').val() != "" && $('#aa_prop_pass').val()==$('#aa_prop_conf_pass').val()){
		if($('aa_prop_pass').val()==$('aa_prop_conf_pass').val()){
		var data_to_pass = $('#aa_username').val()+','+$('#aa_prop_email').val()+','+$('#aa_prop_mobile').val()+','+'11';
		// alert(data_to_pass);
		$.ajax({
		      url: "register_backend.php",
		      data: {
		        register_data: data_to_pass
		      },
		      type: 'post',
		      cache: false,
		      success: function(value){
		             alert('Apartment Authority Added successfully');
		             // document.write(value);
		             window.location = 'login.php';
		        }
		    });
	}
	else {
		alert("Please ensure proper inputs");
	}
}

</script>