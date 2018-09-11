<?php
	session_start();
	if(isset($_SESSION["user_name"])){
		$user_name = $_SESSION["user_name"] ;
		$user_access_code = $_SESSION["user_access_code"];
		$user_email = $_SESSION["user_email"];
	}
	else {
		header('Location: login.php');
	}
	
?>

<body>
<title>MPRTS | Owners</title>
<?php include 'db_config.php'; ?>
<?php include'headers.php'; ?>
<?php include 'left_content.php'; ?>
<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
<script type="text/javascript">
	 $(document).ready(function() {
		$('select').material_select();
		$('.all_rows').css('display', 'none');
	});
</script>
<script type="text/javascript">
	$('.drilldown').on('click', (function(){
		  $('.resp_owners_table').css('display','none');
		  $('.record_details').css('display','block');
		})
	);
</script>
<style>
	.add_record{
		display:none !important;
	}
	.complaints_col{
		!box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3) !important;
		box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 1px 5px 0 rgba(0,0,0,0.12), 0 3px 1px -2px rgba(0,0,0,0.2) !important;
		min-height:100px !important;
		border: 1px solid #ddd;
	}
	
	.complaints_icon{
		border-radius: 50%;
		border: 1px solid #16a085;
		padding: 7px;
		margin: 0px 25px 10px 0px;
	}
	.complaints_count_head{
		margin:2% auto 4% 5%;
	}
	.complaint_title{
		font-size:17px;
	}
	.complaint_status{
		!border:1px solid red;
		!padding:20% !important;
		margin-top:30%;
		!text-align:center;
	}
	.status_td{
		width:4px !important;
		height:8px !important;
		padding-left:3% !important;
		margin-left:3% !important;
		background-color:#ddd;
	}
	/*.read{background-color:#fed330}
	.inprogress{background-color:#45aaf2}
	.completed{background-color:#26de81}
	*/
	
</style>
<div class="right_content">
	<?php include'nav_thread.php'; ?>
	<div class="title_bar">
		<h5><a href="index.php">Admin Dashboard</a> - <b>Complaints List</b></h5>
	</div>
	<div class="owner_content">
		<div class="owner_content_actions">
			<div class="row">
				<div class="col s3 show_all" style="display:block !important;margin-left:5%;">
				    <p>
				      <input type="checkbox" id="show_all_complaints" onchange="show_all_complaints();"/>
				      <label for="show_all_complaints">Show All</label>
				    </p>
				</div>
				<div class="col s6 search_applet">
					<div class="input-field" style="margin-top: 0px;">
			          <input placeholder="Search complaints" id="" type="text" class="validate">
			          <!-- <label for="first_name">First Name</label> -->
			        </div>
				</div>
				<div class="col s2">
					<div class="applet_sort">
						<div class="input-field col s12">
						    <select>
						      <option value="" disabled selected>Sort by</option>
						      <option value="1">Location</option>
						      <option value="2"># Tenants</option>
						      <option value="3"># Properties</option>
						      <option value="4">Date added</option>
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
				<div class="col s2">
					<div class="add_record">
						<i class="material-icons" title="Add Owner" id='<?php echo $user_access_code; ?>' onclick='add_new_complaint(this.id);'>add_box</i>
					</div>
				</div>
				
			</div>
		</div>
		
		<div class="complaints_main_content">
			<!--<div class="owners_table z-depth-3">
				<table class="striped">
		        <thead class="main_head">
		          <tr>
		              <th>complaint Id</th>
		              <th>Title</th>
		              <th>Content</th>
		              <th>Created Date</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 
						/*$access_type = substr($user_access_code, 0, 2);
					
					if($access_type == 'AA'){					
						$complaints_sql = mysql_query("SELECT * from mprts_complaints where substr(complaint_access_code, 0, 4) = substr('$user_access_code', 0, 4) order by complaint_id desc");
					}
					else if($access_type == 'OO'){
						$complaints_sql = mysql_query("SELECT * from mprts_complaints where substr(complaint_access_code, 0, 4) = substr('$user_access_code', 0, 4) and substr(complaint_association, 4, 4) = substr('$user_access_code', 3, 4) order by complaint_id desc");
					}
			
						$complaints_count = mysql_num_rows($complaints_sql);

						while($row = mysql_fetch_array($complaints_sql)){
							$complaint_id = $row['complaint_id'];
							$complaint_title = $row['complaint_title'];
							$complaint_text = $row['complaint_text'];
							$complaint_date = $row['complaint_date'];
							$complaint_association = $row['complaint_association'];
							$complaint_day = substr($complaint_date, 4, 2);
							$complaint_month = substr($complaint_date, 2, 2);
							$complaint_year = '20'.substr($complaint_date, 0, 2);
							$final_complaint_date = $complaint_day."-".$complaint_month."-".$complaint_year;
							
							$trimmed_complaint_text = substr($complaint_text,0,40);
							
							echo "
								<tr class='table_content'>
									<td><a class='drilldown' id='$complaint_id' onclick='show_complaint_details(this.id);'>$complaint_id</a></td>
									<td>$complaint_title</td>
									<td>$trimmed_complaint_text...</td>
									<td>$final_complaint_date</td>
								</tr>
							";
						}*/
					?>
				<!--</tbody>
				</table>
			</div>-->
			<div class="resp_owners_table z-depth-0">
				<div class="complaints_cards_row row">
					<h6 class="complaints_count_head">Showing latest 5 complaints</h6>
					<?php
					$access_type = substr($user_access_code, 0, 2);
					
					if($access_type == 'AA'){					
						$complaints_sql = mysql_query("SELECT * from mprts_complaints where substr(user_access_code, 3, 4) = substr('$user_access_code', 3, 4) order by complaint_id desc limit 5");
						
						$complaints_sql_all = mysql_query("SELECT * from mprts_complaints where substr(user_access_code, 3, 4) = substr('$user_access_code', 3, 4) order by complaint_id desc");
					}
					/* else if($access_type == 'OO'){
						$complaints_sql = mysql_query("SELECT * from mprts_complaints where substr(user_access_code, 0, 4) = substr('$user_access_code', 0, 4) and substr(complaint_association, 4, 4) = substr('$user_access_code', 3, 4) order by complaint_id desc");
					} */
					else if($access_type == 'OO'){
						//$complaints_sql = mysql_query("SELECT * from mprts_complaints where substr(user_access_code, 3, 4) = substr('$user_access_code', 3, 4) and (substr(complaint_association, 4, 4) in (select prty_id from mprts_property where prty_owner in (select owner_id from mprts_owner where owner_email = '$user_email'))) order by complaint_id desc limit 5");
						
						$complaints_sql = mysql_query("SELECT * from mprts_complaints where user_access_code = '$user_access_code' order by complaint_id desc limit 5");
						
						$complaints_sql_all = mysql_query("SELECT * from mprts_complaints where substr(user_access_code, 3, 4) = substr('$user_access_code', 3, 4) and (substr(complaint_association, 4, 4) in (select prty_id from mprts_property where prty_owner in (select owner_id from mprts_owner where owner_email = '$user_email'))) order by complaint_id desc");
					}
					
			
						$complaints_count = mysql_num_rows($complaints_sql);
						
						if($complaints_count==0){
							echo "<center class='no_records'><i class='fas fa-binoculars'></i><h6>No Records found..!</h6></center>";
							echo "<style>
								table, .record_details{
									display:none;
								}
							</style>";
						}
						else {
							
						

						while($row = mysql_fetch_array($complaints_sql)){
							$complaint_id = $row['complaint_id'];
							$complaint_title = $row['complaint_title'];
							$complaint_desc = $row['complaint_desc'];
							$complaint_date = $row['complaint_date'];
							$complaint_status = $row['complaint_status'];
							$complaint_association = $row['complaint_association'];
														
							$get_asset_details = mysql_query("select * from mprts_property where prty_id = '$complaint_association'");
							while($asset_row = mysql_fetch_array($get_asset_details)){
								$complaint_asset_number = $asset_row['prty_no'];
								$complaint_asset_owner = $asset_row['prty_owner'];
								
								$get_asset_owner = mysql_query("select * from mprts_owner where owner_id = '$complaint_asset_owner'");
								while($owner_row = mysql_fetch_array($get_asset_owner)){
									$owner_name = $owner_row['owner_name'];
								}
							}
							//$complaint_status = '111';
							if($complaint_status=='111'){
								echo "<style>#read$complaint_id {background-color:#fed330 !important;}</style>";
							}
							else if($complaint_status=='222'){
								echo "<style>#read$complaint_id {background-color:#fed330} #inprogress$complaint_id{background-color:#45aaf2}</style>";
							}
							else if($complaint_status=='333'){
								echo "<style>#read$complaint_id{background-color:#fed330} #inprogress$complaint_id{background-color:#45aaf2} #completed$complaint_id{background-color:#26de81}</style>";
							}
							
							
							
							$trimmed_complaint_desc = substr($complaint_desc,0,30);
							
							echo "
								<div class='complaints_col last_five col s12 z-depth-0' id='$complaint_id' onclick='update_complaint_status(this.id);show_complaint_details(this.id);'>
									<div class='row' style='margin-top:3%;'>
										<div class='col s2' style='margin-top:5%;color:#45aaf2;'>
											<i class='material-icons' class='complaints_icon'>format_quote</i>
										</div>
										<div class='col s8'>
											<div class='row'>
												<div class='col s12'>
											<a class='drilldown complaint_title' id='$complaint_id' onclick='show_complaint_details(this.id);'>$complaint_title</a>
												</div>
												<div class='col s12'>
													$complaint_date <label>By: </label>$owner_name
												</div>
												<div class='col s12' style='margin-top:4%;'>
													$trimmed_complaint_desc..
												</div>
											</div>
										</div>
										<div class='col s2' id='$complaint_id' style='padding-left:0px;padding-right:0px;'>
											<div class='row'  style='padding-left:0px;padding-right:0px;'>
												<div class='col s12 not_asset_number'  style='padding-left:0px;padding-right:0px;'>
													$complaint_asset_number
												</div>
												<div class='col s12 complaint_status'  style='padding-left:0px;padding-right:0px;'>
													
													<div class='row'>
														<div class='col s3 status_td unread'>
															
														</div>
														<div class='col s3 status_td read' id='read$complaint_id'>
														</div>
														<div class='col s3 status_td inprogress' id='inprogress$complaint_id'>
														</div>
														<div class='col s3 status_td completed' id='completed$complaint_id'>
														</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
								</div>
							";
						}
						
						
						while($row = mysql_fetch_array($complaints_sql_all)){
							$complaint_id = $row['complaint_id'];
							$complaint_title = $row['complaint_title'];
							$complaint_desc = $row['complaint_desc'];
							$complaint_date = $row['complaint_date'];
							
							$complaint_association = $row['complaint_association'];
							
							
								$get_asset_details = mysql_query("select * from mprts_property where prty_id = substr('$complaint_association', 4, 4)");
								while($asset_row = mysql_fetch_array($get_asset_details)){
									$complaint_asset_number = $asset_row['prty_no'];
									$complaint_asset_owner = $asset_row['prty_owner'];
									
									$get_asset_owner = mysql_query("select * from mprts_owner where owner_id = '$complaint_asset_owner'");
									while($owner_row = mysql_fetch_array($get_asset_owner)){
										$owner_name = $owner_row['owner_name'];
									}
								}
							
							if($complaint_status=='111'){
								echo "<style>#read$complaint_id {background-color:#fed330 !important;}</style>";
							}
							else if($complaint_status=='222'){
								echo "<style>#read$complaint_id {background-color:#fed330} #inprogress$complaint_id{background-color:#45aaf2}</style>";
							}
							else if($complaint_status=='333'){
								echo "<style>#read$complaint_id{background-color:#fed330} #inprogress$complaint_id{background-color:#45aaf2} #completed$complaint_id{background-color:#26de81}</style>";
							}
							
							
							
							$trimmed_complaint_desc = substr($complaint_desc,0,30);
							
							echo "
								<div class='complaints_col all_rows col s12 z-depth-0' id='$complaint_id' onclick='update_complaint_status(this.id);show_complaint_details(this.id);'>
									<div class='row' style='margin-top:3%;'>
										<div class='col s2' style='margin-top:5%;color:#45aaf2;'>
											<i class='material-icons' class='complaints_icon'>format_quote</i>
										</div>
										<div class='col s8'>
											<div class='row'>
												<div class='col s12'>
											<a class='drilldown complaint_title' id='$complaint_id' onclick='show_complaint_details(this.id);'>$complaint_title</a>
												</div>
												<div class='col s12'>
													$complaint_date <label>By: </label>$owner_name
												</div>
												<!--<div class='col s12'>
													$complaint_date
												</div>-->
												<div class='col s12' style='margin-top:4%;'>
													$trimmed_complaint_desc..
												</div>
											</div>
										</div>
										<div class='col s2' id='$complaint_id' style='padding-left:0px;padding-right:0px;'>
											<div class='row'  style='padding-left:0px;padding-right:0px;'>
												<div class='col s12 not_asset_number'  style='padding-left:0px;padding-right:0px;'>
													$complaint_asset_number
												</div>
												<div class='col s12 complaint_status'  style='padding-left:0px;padding-right:0px;'>
													
													<div class='row'>
														<div class='col s3 status_td unread'>
															
														</div>
														<div class='col s3 status_td read' id='read$complaint_id'>
														</div>
														<div class='col s3 status_td inprogress' id='inprogress$complaint_id'>
														</div>
														<div class='col s3 status_td completed' id='completed$complaint_id'>
														</div>
													</div>
												</div>
											</div>
										</div>
										
									</div>
								</div>
							";
						}
						}
					?>
				</div>
			</div>
		</div>



		



		<div class="record_details complaint_details" title="Owner Details">
			
		</div>
	</div>
</div>
</body>
<script type="text/javascript">
	function show_complaint_details(complaint_id) {
		$('.record_details').html("<img src='images/preloader.gif'/>");
		$('.right_content').html("<img src='images/preloader.gif'/>");
		 $.ajax({
		  url: "complaint_details.php",
		  data: {
			complaint_id: complaint_id
		  },
		  type: 'post',
		  cache: false,
		  success: function(html){
			  if(screen.availWidth<=414){
				$('.right_content').html(html);  
			  }
			  else{
				$('.record_details').html(html);  
			  }
		  }
    })
	}


     
	function add_new_complaint(access_code) {
		$('.record_details').html("<img src='images/preloader.gif'/>");
		$('.right_content').html("<img src='images/preloader.gif'/>");
		$.ajax({
		  url: "add_complaint.php",
		  data: {
			id: access_code
		  },
		  type: 'post',
		  cache: false,
		  success: function(add_complaint_html){
			  if(screen.availWidth<=414){
				$('.right_content').html(add_complaint_html);
			  }
			  else{
				$('.record_details').html(add_complaint_html);
			  }
		  }
		})
	}
	
	function update_complaint_status(complaint_id) {
		$.ajax({
		  url: "update_complaint_status.php",
		  data: {
			id: complaint_id
		  },
		  type: 'post',
		  cache: false,
		  success: function(update_complaint_html){
			  
		  }
		})
	}
	
	function show_all_complaints(){
		if($('#show_all_complaints').is(':checked')){
			$('.all_rows').css('display', 'block');
			$('.last_five').css('display', 'none');
			$('.complaints_count_head').text('Showing all complaints');
		}
		else{
			$('.all_rows').css('display', 'none');
			$('.last_five').css('display', 'block');
			$('.complaints_count_head').text('Showing last 5 complaints');
		}
	}

</script>
