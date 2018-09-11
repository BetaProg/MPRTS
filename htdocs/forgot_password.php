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
	<div class="forgot_password">
		<div class="register_form">
			<div class="row">
				<!-- <div class="col s4 z-depth-3" style="height: 90%;margin-left: 33%;margin-right:33%;"> -->
				<div class="col s4 z-depth-3" style="width: auto;height: 100%;">

				  	<center><h5 class="register_title">Forgot Password</h5></center>

					<div class="row form_content">
						<p style="font-size: 15px;text-align: center;">We will send you the password to your registered email address(Apartment Authority(AA) only. Owners Please contact your AA).</p>
						<p style="font-size: 15px;text-align: center;"><b>Password reset</b> feature is on the way</p>
						<form action="forgot_password_backend.php" method="post">
						    <div class="input-field col s12">
					        	<input id="user_email" type="email" name="email" class="validate" required="true">
					        	<label for="user_email">Email id</label>
					        </div>
					        <div class="input-field col s12">
					        	<div class="row">
					        		<div class="col s6">
					        			<a href="login.php"><h5 style="font-size: 15px;" title="Login">Back to Login</h5></a>
					        		</div>
					        		<div class="col s6">
					        			<button class="btn waves-effect waves-light" id="email_entered" name="email_entered" type="submit" style="float: right;margin-right: 11%;">Proceed
								    	<i class="material-icons right">send</i>
								  	</button>
					        		</div>
					        	</div>
					        </div>
						</form>
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