<?php
	session_start();
?>
<?php 
	include 'db_config.php';
	include 'headers.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>MPRTS | Register</title>
	<link rel="stylesheet" href="styles/register.css">
	<script type="text/javascript">
		$(document).ready(function() {
    		$('ul.tabs').tabs();
  		});
	</script>


</head>

<body>
	<!-- <div class="top_ribbon">
		<div class="row">
			<div class="col s1" style="padding-left: 0px;padding-right: 0px;">
				<img src="images/logo/maa_logo_light.jpg" style="width: 100px;position: absolute;">
			</div>
			<div class="col s10" style="padding-left: 0px;">
				<h5 style="float: left;margin-left: 0px;">Mission Maa</h5>
			</div>
		</div>
	</div> -->
	<div class="register_content">
		<div class="register_form">
			<div class="row">
				<!-- <div class="col s4 z-depth-3" style="height: 90%;margin-left: 33%;margin-right:33%;"> -->
				<div class="col s4 z-depth-3" style="width: auto;height: 100%;">

					<!-- <div class="input-field col s12" style="float: left;margin-top: 10%;">
					    <select onclick="$('select').material_select();" id="user_type" name="user_type">
					      <option value="" disabled selected>Choose your option</option>
					      <option value="AA">Apartment Authority</option>
					      <option value="OO">Property Owner</option>
					      <option value="TT">Tenant</option>
					    </select>
				    	<label>Register yourself as </label>
				  	</div> -->
				  	<center><h5 class="register_title">Register</h5></center>

				  	<label>Register yourself as </label><br class="resp_br">
				  	<input class="with-gap" name="user_type" id="aa" type="radio" value="AA" required="true" checked="true" title="Apartment Authority" />
				    <label for="aa">Apartment Authority</label>
				    <!-- <input class="with-gap" name="user_type" id="oo" type="radio" value="OO" required="true" disabled="true" title="Diabled Temporarily" />
				    <label for="owner">Owner</label> -->

					<div class="row form_content">
				        <div class="input-field col s12">
				        	<input id="user_name" name="user_name" type="text" class="validate" required="true">
				        	<label for="user_name">Building Name</label>
				        </div>
				        <div class="input-field col s12">
				        	<input id="user_email" type="email" class="validate" required="true">
				        	<label for="user_email">Email id</label>
				        </div>
				        <div class="input-field col s12">
				        	<input id="user_mobile" type="number" class="validate" required="true">
				        	<label for="user_mobile">Mobile</label>
				        </div>
				        <div class="input-field col l6 m6 s5">
				        	<input id="user_pass" type="password" class="validate" required="true">
				        	<label for="user_pass">Password</label>
				        </div>
				        <div class="input-field col l6 m6 s7">
				        	<input id="user_conf_pass" type="password" class="validate" required="true">
				        	<label for="user_conf_pass">Confirm Password</label>
				        </div>
				        <div class="input-field col l6 m6 s6">
				        	<input id="user_usc_no" type="text" class="validate" required="true">
				        	<label for="user_usc_no">USC No</label>
				        </div>
						<div class="input-field col l6 m6 s6">
				        	<input id="user_pincode" type="number" class="validate" required="true">
				        	<label for="user_pincode">PIN CODE</label>
				        </div>
						

				        <div class="input-field col s12">
				        	<div class="row">
				        		<div class="col s6">
				        			<a href="login.php"><h5 style="font-size: 15px;" title="Login">Existing User? Login</h5></a>
				        		</div>
				        		<div class="col s6">
				        			<button class="btn waves-effect waves-light" id="aa_register" type="submit" onclick="aa_register();" name="aa_register" style="float: right;margin-right: 11%;">Register
							    	<i class="material-icons right">send</i>
							  	</button>
				        		</div>
				        	</div>
				        </div>
					</div>
					<div class="row">
						<div class="col s12" id="register_success_message">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<!-- <script type="text/javascript">
	
	function aa_register(){
		if($('aa_prop_pass').val()==$('aa_prop_conf_pass').val()){
		var data_to_pass = $('[name="user_type"]').val()+','+$('#user_name').val()+','+$('#user_email').val()+','+$('#user_mobile').val()+','+$('#user_pass').val();
		//alert(data_to_pass);
		$.ajax({
		      url: "register_backend.php",
		      data: {
		        register_data: data_to_pass
		      },
		      type: 'post',
		      cache: false,
		      success: function(value){
		             alert('Apartment Authority Added successfully');
		             window.location = 'login.php';
		        }
		    });
		}
		else {
			alert("Please ensure proper inputs");
		}
	}
	
</script> -->