<?php include 'headers.php'; ?>
<html>
	<head>
		<title>MPRTS | Login</title>
		<style type="text/css">
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
			.main_content {
				height: 90%;
				width: 100%;
			}
			.main_content .left_banner{
				width: 50%;
				height: 100%;
				float: left;
			}
			.left_banner img {
				opacity: 0.8;
				height: 100%;
			}
			.right_content {
				float: right;
				width: 50%;
			}
			.login_content {
				margin: 5% 5% auto 25%;
				text-align: center;
				border:1px solid #8D9697;
				border-radius: 10px;
				height: 80%;
			}
			.login_content h4{
				margin-top: 15%;
			}


		</style>
	</head>
	<body>
		<div class="top_ribbon">
			<h5>Mission Maa</h5>
		</div>
		<div class="main_content">
			<div class="left_banner">
				<img src="images/loginimages/house2.png">
			</div>
			<div class="right_content">
				<div class="login_content">
					
						<h4>LOGIN</h4>


					  <div class="row" >
					    <form class="col s12" action="login_backend.php" method="post">
					      <div class="row">
					        <div class="input-field col s12">
					          <input id="first_name" type="text" name="user_name" class="validate">
					          <label for="first_name">Username</label>
					        </div>
					      </div>
					      
					      <div class="row">
					        <div class="input-field col s12">
					          <input id="password" type="password" name="user_pass" class="validate">
					          <label for="password">Password</label>
					        </div>
					      </div>
					        <button class="btn waves-effect waves-light" type="submit" name="user_submit">Submit
							    <i class="material-icons right">send</i>
							  </button>
					    </form>
					  </div>





					</div>
				</div>
			</div>
		</div>
	</body>
</html>