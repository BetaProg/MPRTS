<?php
session_start();
	if(isset($_SESSION["user_name"])){
		// header('Location: index.php');
		header('Location: index.php');
	}
	// session_unset();
	// unset($session['error_message']);
	else if(isset($_SESSION["error_message"])){
		unset($session['error_message']);
		echo "<script>alert('Invalid Username or Password..!');</script>";
		session_unset();
	}
	echo "<script>sessionStorage.setItem('PageOpened', '');</script>";
?>

<?php include 'db_config.php'; ?>
<?php include 'headers.php'; ?>
<script type="text/javascript">
  	$(document).ready(function() {
    		$('ul.tabs').tabs();
  		});
</script>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MPRTS | Login</title>
		<link rel="stylesheet" type="text/css" href="styles/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="styles/register.css">
		<link rel="stylesheet" href="styles/login.css">
		
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

		<div class="main_content  z-depth-5">
			<div class="resp_logo_content">
				<div class="title_div">
					<center><h>Maa Properties  <span style='color: #ddd;'> |  Property Gaurdian</span></h></center>
				</div>
			</div>
			<div class="left_banner  z-depth-5">
				<!-- <img src="images/loginimages/house4.jpg"> -->
				<div class="title_div">
					<center><h5 style="color: fff;font-size: 30px;">Maa Properties  <span style='color: #ddd;'> |  Property Gaurdian</span></h5></center>
				</div>
				
				<center>
					<h5 style='font-size: 20px;color: #ddd;margin-top: 10%;font-style: italic;'><i style="margin-right: 2%;" class="fa fa-leaf" aria-hidden="true"></i>Your property - Now just a click away</h5>
				</center>
				<div class="content_div" style="display: block;margin-left: 10%;">
					<div class="row">
						<div class="col s6">
							<ul>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Property Management</li>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Mobile Compatible</li>
							</ul>		
						</div>
						<div class="col s6">
							<ul>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Tenancy Management</li>
								<li><i class="fa fa-check-circle" aria-hidden="true"></i>Easy, Fast & Secure</li>
							</ul>
						</div>
					</div>

					<!-- </ul> -->
				</div>
			</div>
			<div class="login_right_content z-depth-5">
				<div class="login_content">
					
						<center><h5 class="sign_in_title">Existing User - Sign In</h5></center>

						<center><h5 style="color: red;font-size: 10px;" id="error_message"></h5></center>

					  <div class="row" >
					    <form class="col s12" action="login_backend.php" method="post">
					      <div class="row">
					        <div class="input-field col s12">
					          <input id="user_email" type="email" name="user_email" class="validate" required="true">
					          <label for="user_email">Email Id</label>
					        </div>
					      </div>
					      
					      <div class="row">
					        <div class="input-field col s12">
					          <input id="password" type="password" name="user_pass" class="validate" required="true">
					          <label for="password">Password</label>
					        </div>
					      </div>
					      	<center>
						        <button class="btn waves-effect waves-light" title="Login" type="submit" name="user_submit">Login
								    <i class="material-icons right">send</i>
								</button>
							</center>
					    </form>
					    <!-- <a class="register_div" href="register.php"><h5 style="font-size: 15px;" title="Register">New User? Register</h5></a> -->
					   <a class="register_div" style="cursor: pointer;text-align: center;" onclick="load_register();"><h5 style="font-size: 15px;" title="Register">New User? Register</h5></a>
					   <a class="register_div" style="cursor: pointer;text-align: center;" onclick="load_forgot_password();"><h5 style="font-size: 15px;margin-top:5%;" title="Forgot Password">Forgot Password?</h5></a>
					  </div>


					</div>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		function load_register(){
			$('.load_assets_list').html("<img src='images/preloader.gif'/>");
			$('ul.tabs').tabs();
			$('.login_right_content').load('register.php .register_content');
		}
	</script>
	<script type="text/javascript">
		function load_forgot_password(){
			$('.load_assets_list').html("<img src='images/preloader.gif'/>");
			$('ul.tabs').tabs();
			$('.login_right_content').load('forgot_password.php .forgot_password');
		}
	</script>
</html>