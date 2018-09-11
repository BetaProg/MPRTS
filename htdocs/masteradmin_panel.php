<?php
	session_start();
	if(isset($_SESSION["user_name"]) && (substr($_SESSION["user_access_code"], 0, 2))=='MM'){
		$user_name = $_SESSION["user_name"] ;
		$user_access_code = $_SESSION["user_access_code"];
	}
	else {
		header('Location: login.php');
	}
?>

<head>
	<title>MPRTS | Master Admin Panel</title>
	<?php include 'db_config.php'; ?>
	<?php include'headers.php'; ?>
	<?php include 'left_content.php'; ?>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.users_grid').load('all_users.php #inactive_users');	
	    $('select').material_select();
	});
	</script>	
</head>

<body>
<div class="right_content">
	<?php include'nav_thread.php'; ?>
	<div class="title_bar">
		<h5><a href="index.php">Admin Dashboard</a> - <b>Users List</b></h5>
	</div>
	<div class="owner_content">
		<div class="owner_content_actions">
			<div class="row">
				<div class="col l2 m2 s6">
				    <p>
				      <input type="checkbox" id="users_visible" onchange='visible_users()';/>
				      <label for="users_visible">Show All</label>
				    </p>
				</div>
				<div class="col l3 m3 s6">
					<div class="input-field" style="margin-top: 0px;">
			          <input placeholder="Search Users" id="first_name" type="text" class="validate">
			          <!-- <label for="first_name">First Name</label> -->
			        </div>
				</div>
				<div class="col s2">
					<div class="applet_sort">
						<div class="input-field col s12">
						    <select>
						      <option value="" disabled selected>Sort by</option>
						      <option value="1">Date Added</option>
						      <option value="2">Name</option>
						    </select>
			    			<!-- <label>Sort By</label> -->
			  			</div>
					</div>
				</div>
				<div class="col s2">
					<div class="record_count">
						<div class="input-field col s12">
						    <select>
						      <option value="" disabled selected>Rows per page</option>
						      <option value="1">10</option>
						      <option value="2">20</option>
						      <option value="3">35</option>
						      <option value="4">50</option>
						    </select>
			    			<!-- <label>Sort By</label> -->
			  			</div>
					</div>
				</div>
				
			</div>
		</div>
		
		<div class="users_grid" id='tableit1' style="margin-top:2%;">
		        
					<script type="text/javascript">
						function activate_backend(id_passed, action_element){
							if(action_element=='2'){
								action = 'Activated';
							}
							else if(action_element=='1'){
								action = 'Initial';
							}

							$.ajax({
							      url: "activate_user.php",
							      data: {
							        id: id_passed,
							        actions : action
							      },
							      type: 'post',
							      cache: false,
							      success: function(activate_html){
							          alert(activate_html);
							          window.location.reload();
							      }
							    });
						}
						function visible_users(){

							if($('#users_visible').is(':checked')){
								$('.users_grid').load('all_users.php #all_users');	
							}
							else{
								$('.users_grid').load('all_users.php #inactive_users');	
							}
							
						}
						function get_user_details(user_id){
							$.ajax({
							      url: "user_details.php",
							      data: {
							        id: user_id
							      },
							      type: 'post',
							      cache: false,
							      success: function(user_details_response){
							          $('.record_details').html(user_details_response);
							          // console.log(user_details_response);
							      }
							    });
						}
					</script>
		</div>




		<div class="record_details" style="padding:2%;">
			
		</div>
		<div class="add_new_record" title="Add new record">
			<div>
				
			</div>
		</div>
	</div>
</div>
</body>
	