<?php
	session_start();
	$user_name = $_SESSION["user_name"] ;
	$user_access_code = $_SESSION["user_access_code"];
	$user_email = $_SESSION["user_email"];
?>
<body>
<title>MPRTS | Properties</title>
<?php include 'db_config.php'; ?>
<?php include'headers.php'; ?>
<?php include 'left_content.php'; ?>
<script type="text/javascript">
	 $(document).ready(function() {
    $('select').material_select();
	$('.owner_content_actions').css('display', 'none');
  });
</script>
<style>
	.resp_building_content{
		background-color: #f2f2f2;
	}
	.activate_building{
		background-color:aliceblue !important;
		border: 1px solid #000;
	}
</style>
<?php
	echo "<style>
		#$user_access_code{
			background-color:#F8EFBA !important;
			border: 1px solid #F97F51;
		}
	</style>";
 ?>
<div class="right_content">
	<?php include'nav_thread.php'; ?>
	<div class="title_bar" style="display:none;">
		<h5><a href="index.php">Admin Dashboard</a> - <b>Properties List</b></h5>
	</div>
	<div class="row">
		<div class="col s12">
			<center><h5 style="color:#ddd;padding:1%;" class="page_name"></h5></center>
		</div>
	</div>
	<div class="owner_content">
		<div class="owner_content_actions">
			<div class="row">
				<div class="col s2 show_all">
				    <p>
				      <input type="checkbox" id="show_all_properties" />
				      <label for="show_all_properties">Show All</label>
				    </p>
				</div>
				<div class="col s3 search_applet">
					<div class="input-field" style="margin-top: 0px;">
			          <input placeholder="Search properties" id="" type="text" class="validate">
			          <!-- <label for="first_name">First Name</label> -->
			        </div>
				</div>
				<div class="col s2">
					<div class="applet_sort">
						<div class="input-field col s12">
						    <select>
						      <option value="" disabled selected>Sort by</option>
						      <option value="1">Name</option>
						      <option value="2">No. of Units</option>
						      <option value="3">Location</option>
						      <option value="4">Type</option>
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
				<div class="col s3 add_record_class">
					<div class="add_record">
						<i class="material-icons" title="Add Property" id='add_building' onclick='add_new_record(this.id);'>add_box</i>

			<!-- <button class="btn waves-effect waves-light" title="Add Record" id='add_building' 
			style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;">Add
    			<i class="material-icons" onclick='add_new_record(this.id);' >add_box</i>
    		</button> -->

					</div>
				</div>
				
			</div>
		</div>
		
		<div class="owners_table z-depth-3" title="Property List">
			<table class="striped">
		        <thead class="thead_main">
		          <tr>
		          	  <th>Property ID</th>
		              <th>Property Name</th>
		              <th>Type</th>
		              <th>Location</th>
		              <th>City</th>
		              <th>Phone No.</th>
		              <th>No of units</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php
						$access_type = substr($user_access_code, 0, 2);
						if($access_type == 'MM'){
							$building_details_sql = "SELECT * from mprts_buildings order by building_id desc";
						}
						else if($access_type == 'AA'){
							$building_details_sql = "SELECT * from mprts_buildings where building_access_code = '$user_access_code' order by building_id desc";

						echo "<style>
								#add_building,  .delete_property {
								display:none !important;
								}
							</style>";
						
						$building_details_execute = mysql_query($building_details_sql);
			
						$building_count = mysql_num_rows($building_details_execute);

						$i=0;
						while($i<$building_count){
							$row = mysql_fetch_array($building_details_execute);
							$building_image = $row['image_url'];
							$building_id = $row['building_id'];
							$building_name = $row['building_name'];
							$building_type = $row['building_type'];
							$building_units = $row['building_units'];
							$building_sqft = $row['building_sqft'];
							$building_locality = $row['building_locality'];
							$building_city = $row['building_city'];
							$building_state = $row['building_state'];
							$building_pincode = $row['building_pincode'];
							$building_phno = $row['building_phno'];
							$building_phno2 = $row['building_phno2'];
							$building_email = $row['building_email'];
							$building_current_meter = $row['building_current_meter'];
							$building_water_meter = $row['building_water_meter'];
							$building_note = $row['building_note'];
							$building_access_code = $row['building_access_code'];
							
					$get_pty_id_sql = mysql_query("SELECT concat('PTY', building_id) as building_id from mprts_buildings where building_id = $building_id");
							$pty_id_row = mysql_fetch_array($get_pty_id_sql);
							$pty_id = $pty_id_row['building_id'];


							echo "
								<tr class='table_content'>
						            <td><a class='drilldown' id='$building_id' onclick='show_building_details(this.id);'>$pty_id</a></td>
						            <td>$building_name</td>
						            <td>$building_type</td>
						            <td>$building_locality</td>
						            <td>$building_city</td>
						            <td>$building_phno</td>
						            <td>$building_units</td>
					          	</tr>
							";

							echo "
								<div class='resp_content resp_building_content z-depth-1 $building_id'>
									<div class='row building_list_row'>
										<div class='col s2 building_image_col'>
											<img src='images/property1.jpg'>
										</div>
										<div class='col s10 building_content_col'>
											<div class='row'>
												<div class='col s7 building_title'>
													$building_name
												</div>
												<div class='col s2 building_units_label'>
													<label>Units</label>
												</div>
												<div class='col s3 building_units'>
													 <div class='chip'>
													    $building_units
													  </div>
												</div>

											</div>
											<div class='row'>
												<div class='col s12 building_id'>
													<a class='drilldown' id='$building_id' onclick='show_building_details_resp(this.id);'>$pty_id</a>
												</div>
											</div>
											<div class='row'>
												<div class='col s12 building_locality'>
													<i class='material-icons location_icon'>location_on</i> $building_locality, $building_city
												</div>
											</div>
											<div class='row'>
												<div class='col s6 building_phno'>
													<i class='material-icons phone_icon'>phone_android</i> $building_phno
												</div>
											</div>

										</div>

									</div>
								</div>
							";
							$i++;
						}
						
						} 

						else if($access_type == 'OO'){
							//$building_details_sql = "SELECT * from mprts_buildings where SUBSTR(building_access_code, 3, 4) = substr('$user_access_code', 3, 4) order by building_id desc";
							$get_user_details = mysql_query("select * from mprts_users where user_email = '$user_email'");
							while($user_details_row = mysql_fetch_array($get_user_details)){
								$user_access_code = $user_details_row['user_access_code'];
								$building_details_sql = "select * from mprts_buildings where SUBSTR(building_access_code, 3, 4) = substr('$user_access_code', 3, 4) and SUBSTR(building_access_code, 3, 4) in (select substr(access_code, 3, 4) from mprts_owner where substr(access_code, -1) != 'D')";
							echo "<style>
								.edit_building, #add_building {
								display:none !important;
								}
								</style>";
								
							$building_details_execute = mysql_query($building_details_sql);
			
						$building_count = mysql_num_rows($building_details_execute);

						$i=0;
						while($i<$building_count){
							$row = mysql_fetch_array($building_details_execute);
							$building_image = $row['image_url'];
							$building_id = $row['building_id'];
							$building_name = $row['building_name'];
							$building_type = $row['building_type'];
							$building_units = $row['building_units'];
							$building_sqft = $row['building_sqft'];
							$building_locality = $row['building_locality'];
							$building_city = $row['building_city'];
							$building_state = $row['building_state'];
							$building_pincode = $row['building_pincode'];
							$building_phno = $row['building_phno'];
							$building_phno2 = $row['building_phno2'];
							$building_email = $row['building_email'];
							$building_current_meter = $row['building_current_meter'];
							$building_water_meter = $row['building_water_meter'];
							$building_note = $row['building_note'];
							$building_access_code = $row['building_access_code'];
							
					$get_pty_id_sql = mysql_query("SELECT concat('PTY', building_id) as building_id from mprts_buildings where building_id = $building_id");
							$pty_id_row = mysql_fetch_array($get_pty_id_sql);
							$pty_id = $pty_id_row['building_id'];


							echo "
								<tr class='table_content'>
						            <td><a class='drilldown' id='$building_id' onclick='show_building_details(this.id);'>$pty_id</a></td>
						            <td>$building_name</td>
						            <td>$building_type</td>
						            <td>$building_locality</td>
						            <td>$building_city</td>
						            <td>$building_phno</td>
						            <td>$building_units</td>
					          	</tr>
							";

							echo "
								<div class='resp_content resp_building_content z-depth-1 $building_id' id='$user_access_code'>
									<div class='row building_list_row'>
										<div class='col s2 building_image_col'>
											<img src='images/property1.jpg'>
										</div>
										<div class='col s10 building_content_col'>
											<div class='row'>
												<div class='col s7 building_title' onclick='activate_building(\"$building_id\", \"$user_access_code\");'>
													$building_name
												</div>
												<div class='col s2 building_units_label'>
													<label>Units</label>
												</div>
												<div class='col s3 building_units'>
													 <div class='chip'>
													    $building_units
													  </div>
												</div>

											</div>
											<div class='row'>
												<div class='col s12 building_id'>
													<a class='drilldown' id='$building_id' onclick='show_building_details_resp(this.id);'>$pty_id</a>
												</div>
											</div>
											<div class='row'>
												<div class='col s12 building_locality'>
													<i class='material-icons location_icon'>location_on</i> $building_locality, $building_city
												</div>
											</div>
											<div class='row'>
												<div class='col s6 building_phno'>
													<i class='material-icons phone_icon'>phone_android</i> $building_phno
												</div>
											</div>
											
											
										</div>

									</div>
								</div>
							";
							$i++;
						}
								
							}
							
						
							
						}
						
						
					?>
		        </tbody>
	      </table>




<!-- --------------------------------------------------- Float Content Starts -------------------------------------------------------------- -->

<style type="text/css">
	@keyframes float {
	0% {
		box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
		transform: translatey(0px);
	}
	50% {
		box-shadow: 0 25px 15px 0px rgba(0,0,0,0.2);
		transform: translatey(-20px);
	}
	100% {
		box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
		transform: translatey(0px);
	}
}

.instructions_container {
	margin-top: 2%;
	width: 100%;
	height: 52%;
	!display: flex;
	display:none;
	flex-direction: column;
	justify-content: center;
	align-items: center;
}

.avatar {
	width: 60%;
	height: 100%;
	text-align: center;
	box-sizing: border-box;
	border: 2px white solid;
	border-radius: 4%;
	overflow: hidden;
	box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
	transform: translatey(0px);
	animation: float 6s ease-in-out infinite;
	img { width: 100%; height: auto; }
}


</style>
<div class="instructions_container">
	<div class="avatar">
		
			<!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/751678/skytsunami.png" alt="Skytsunami" /> -->
			<h5 style="font-size: 20px;color: #2A7FB8;margin-top: 2px !important;margin-bottom: 5px !important;font-family: calibri;">Please follow this order while adding</h5>
			<center>
			<table style="width: 90%;padding-top: 0% !important;">
				<tr style="text-align: center; width: 50%;">
					<td style="text-align: center;border:1px solid #2A7FB8;text-transform: uppercase;background-color: #f2f2f2;">
						<p style="margin:0px auto 2px auto;">1</p>
						<a href="owner_content.php"><i style="font-size: 30px;" class="material-icons">perm_identity</i></a><br>
						<h style='font-size: 10px;'>Owner</h>			
					</td>
					<td style="text-align: center;border:1px solid #2A7FB8;text-transform: uppercase;">
						<p style="margin:0px auto 2px auto;">2</p>
						<a href="property_content.php"><i style="font-size: 30px;" class="material-icons">home</i></a><br>
						<h style='font-size: 10px;'>Assets</h>
					</td>
					<td style="text-align: center;border:1px solid #2A7FB8;text-transform: uppercase;background-color: #f2f2f2;">
						<p style="margin:0px auto 2px auto;">3</p>
						<a href="tenant_content.php"><i style="font-size: 30px;" class="material-icons">people_outline</i></a><br>
						<h style='font-size: 10px;'>Tenants</h>			
					</td>
					<td style="text-align: center;border:1px solid #2A7FB8;text-transform: uppercase;">
						<p style="margin:0px auto 2px auto;">4</p>
						<a href="payments_content.php"><i style="font-size: 30px;" class="material-icons">monetization_on</i></a><br>
						<h style='font-size: 10px;'>Payments</h>
					</td>
				</tr>
			</table>
			</center>
			
		
		
	</div>
</div>


<!-- -------------------------------------------------  Float Content Ends --------------------------------------------------------------- -->






		</div>



		




		<div class="resp_details resp_building_details">
			
		</div>

		<div class="record_details" id="record_details">
			
		</div>

		<div class="add_new_record" title="Add new record">
			
		</div>
	</div>
</div>
</body>
<script type="text/javascript" src='scripts/major_navigate.js'></script>
<script>
	function login_session(access_code){
		var complaint_data = access_code;
		$.ajax({
		  url: "start_login_session.php",
		  data: {
			session_details: access_code+"|#|"+'<?php echo $user_name ?>'
		  },
		  type: 'post',
		  cache: false,
		  success: function(login_status){
			  //alert("Complaint updated Successfully");
			  window.location = 'index.php';
		  }
		});
	}
	function activate_building(building_id, user_access_code){
		$('.activate_building').removeClass('activate_building');
		$('.'+building_id).addClass('activate_building');
		login_session(user_access_code);
	}
</script>
