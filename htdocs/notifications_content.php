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
<title>MPRTS | Notifications</title>
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
	.notifications_col{
		!box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3) !important;
		box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 1px 5px 0 rgba(0,0,0,0.12), 0 3px 1px -2px rgba(0,0,0,0.2) !important;
	}
	
	.notifications_icon{
		border-radius: 50%;
		border: 1px solid #16a085;
		padding: 7px;
		margin: 0px 25px 10px 0px;
	}
	
</style>
<div class="right_content">
<?php $access_type = substr($user_access_code, 0, 2); ?>
<?php if($access_type=='OO'){
		echo "<style>
				.add_record {
					display:none !important;
				}
			</style>";
}
	?>

	<?php include'nav_thread.php'; ?>
	<div class="title_bar">
		<h5><a href="index.php">Admin Dashboard</a> - <b>Notifications List</b></h5>
	</div>
	<div class="owner_content">
		<div class="owner_content_actions">
			<div class="row">
				<div class="col s3 show_all" style="display:block !important;margin-left:5%;">
				    <p>
				      <input type="checkbox" id="show_all_notifications" onchange="show_all_notifications();"/>
				      <label for="show_all_notifications">Show All</label>
				    </p>
				</div>
				<div class="col s6 search_applet">
					<div class="input-field" style="margin-top: 0px;">
			          <input placeholder="Search Notifications" id="" type="text" class="validate">
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
						<i class="material-icons" title="Add Owner" id='<?php echo $user_access_code; ?>' onclick='add_new_notification(this.id);'>add_box</i>
					</div>
				</div>
				
			</div>
		</div>
		
		<div class="notifications_main_content">
			<div class="owners_table z-depth-3">
				<table class="striped">
		        <thead class="main_head">
		          <tr>
		              <th>Notification Id</th>
		              <th>Title</th>
		              <th>Content</th>
		              <th>Created Date</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 
						$access_type = substr($user_access_code, 0, 2);
					
					if($access_type == 'AA'){					
						$notifications_sql = mysql_query("SELECT * from mprts_notifications where substr(notification_access_code, 3, 4) = substr('$user_access_code', 3, 4) order by notification_id desc");
					}
					else if($access_type == 'OO'){
						$notifications_sql = mysql_query("SELECT * from mprts_notifications where substr(notification_access_code, 3, 4) = substr('$user_access_code', 3, 4) and substr(notification_association, 4, 4) = substr('$user_access_code', 3, 4) order by notification_id desc");
					}
			
						$notifications_count = mysql_num_rows($notifications_sql);

						while($row = mysql_fetch_array($notifications_sql)){
							$notification_id = $row['notification_id'];
							$notification_title = $row['notification_title'];
							$notification_text = $row['notification_text'];
							$notification_date = $row['notification_date'];
							$notification_association = $row['notification_association'];
							$notification_day = substr($notification_date, 4, 2);
							$notification_month = substr($notification_date, 2, 2);
							$notification_year = '20'.substr($notification_date, 0, 2);
							$final_notification_date = $notification_day."-".$notification_month."-".$notification_year;
							
							$trimmed_notification_text = substr($notification_text,0,40);
							
							echo "
								<tr class='table_content'>
									<td><a class='drilldown' id='$notification_id' onclick='show_notification_details(this.id);'>$notification_id</a></td>
									<td>$notification_title</td>
									<td>$trimmed_notification_text...</td>
									<td>$final_notification_date</td>
								</tr>
							";
						}
					?>
				</tbody>
				</table>
			</div>
			<div class="resp_owners_table z-depth-0" style='min-height:100px !important;'>
				<div class="notifications_cards_row row">
					<h6 class="notifications_count_head">Showing latest 5 notifications</h6>
					<?php
					$access_type = substr($user_access_code, 0, 2);
					
					if($access_type == 'AA'){					
						$notifications_sql = mysql_query("SELECT * from mprts_notifications where substr(notification_access_code, 3, 4) = substr('$user_access_code', 3, 4) order by notification_id desc limit 5");
						
						$notifications_sql_all = mysql_query("SELECT * from mprts_notifications where substr(notification_access_code, 3, 4) = substr('$user_access_code', 3, 4) order by notification_id desc");
					}
					/* else if($access_type == 'OO'){
						$notifications_sql = mysql_query("SELECT * from mprts_notifications where substr(notification_access_code, 0, 4) = substr('$user_access_code', 0, 4) and substr(notification_association, 4, 4) = substr('$user_access_code', 3, 4) order by notification_id desc");
					} */
					else if($access_type == 'OO'){
						$notifications_sql = mysql_query("SELECT * from mprts_notifications where substr(notification_access_code, 3, 4) = substr('$user_access_code', 3, 4) and (substr(notification_association, 4, 4) in (select prty_id from mprts_property where prty_owner in (select owner_id from mprts_owner where owner_email = '$user_email')) OR notification_association = 'ALL ASSETS') order by notification_id desc limit 5");
						
						$notifications_sql_all = mysql_query("SELECT * from mprts_notifications where substr(notification_access_code, 3, 4) = substr('$user_access_code', 3, 4) and (substr(notification_association, 4, 4) in (select prty_id from mprts_property where prty_owner in (select owner_id from mprts_owner where owner_email = '$user_email')) OR notification_association = 'ALL ASSETS') order by notification_id desc");
					}
					
			
						$notifications_count = mysql_num_rows($notifications_sql);
						if($notifications_count==0){
							//echo "<center><h5>No Notifications found..!</h5></center>";
							echo "<center class='no_records'><i class='fas fa-binoculars'></i><h6>No Records found..!</h6></center>";
							echo "<style>
								table, .record_details{
									display:none;
								}
							</style>";
							
						}
						else {
							
						
						while($row = mysql_fetch_array($notifications_sql)){
							$notification_id = $row['notification_id'];
							$notification_title = $row['notification_title'];
							$notification_text = $row['notification_text'];
							$notification_date = $row['notification_date'];
							$notification_association = $row['notification_association'];
							
							if($notification_association != "ALL ASSETS"){
								$get_asset_details = mysql_query("select * from mprts_property where prty_id = substr('$notification_association', 4, 4)");
								while($asset_row = mysql_fetch_array($get_asset_details)){
									$notification_asset_number = $asset_row['prty_no'];
									$notification_asset_owner = $asset_row['prty_owner'];
									
									$get_asset_owner = mysql_query("select * from mprts_owner where owner_id = '$notification_asset_owner'");
									while($owner_row = mysql_fetch_array($get_asset_owner)){
										$owner_name = $owner_row['owner_name'];
									}
								}
							}
							else {
								$notification_asset_number = "ALL";
								$owner_name = "All Owners";
							}
							
							$notification_day = substr($notification_date, 4, 2);
							$notification_month = substr($notification_date, 2, 2);
							$notification_year = '20'.substr($notification_date, 0, 2);
							$final_notification_date = $notification_day."-".$notification_month."-".$notification_year;
							
							$trimmed_notification_text = substr($notification_text,0,40);
							
							echo "
								<div class='notifications_col last_five col s12 z-depth-1' id='$notification_id' onclick='show_notification_details(this.id);'>
									<div class='row'>
										<div class='col s2'>
											<i class='material-icons notifications_icon'>notifications_none</i>
										</div>
										<div class='col s8' style='padding-right:0px;padding-left:0px;'>
											<div class='row'>
												<div class='col s12'>
											<a class='drilldown' id='$notification_id' onclick='show_notification_details(this.id);'>$notification_title</a>
												</div>
												<!--<div class='col s12'>
													<label>To: </label><b>$owner_name</b>
												</div>-->
												<div class='col s12'>
													$final_notification_date
												</div>
											</div>
										</div>
										<div class='col s2 not_asset_number'>
											$notification_asset_number
										</div>
										
									</div>
								</div>
							";
						}
						}
						
						
						while($row = mysql_fetch_array($notifications_sql_all)){
							$notification_id = $row['notification_id'];
							$notification_title = $row['notification_title'];
							$notification_text = $row['notification_text'];
							$notification_date = $row['notification_date'];
							
							$notification_association = $row['notification_association'];
							
							if($notification_association != "ALL ASSETS"){
								$get_asset_details = mysql_query("select * from mprts_property where prty_id = substr('$notification_association', 4, 4)");
								while($asset_row = mysql_fetch_array($get_asset_details)){
									$notification_asset_number = $asset_row['prty_no'];
									$notification_asset_owner = $asset_row['prty_owner'];
									
									$get_asset_owner = mysql_query("select * from mprts_owner where owner_id = '$notification_asset_owner'");
									while($owner_row = mysql_fetch_array($get_asset_owner)){
										$owner_name = $owner_row['owner_name'];
									}
								}
							}
							else {
								$notification_asset_number = "ALL";
								$owner_name = "All Owners";
							}
							
							$notification_day = substr($notification_date, 4, 2);
							$notification_month = substr($notification_date, 2, 2);
							$notification_year = '20'.substr($notification_date, 0, 2);
							$final_notification_date = $notification_day."-".$notification_month."-".$notification_year;
							
							$trimmed_notification_text = substr($notification_text,0,40);
							
							echo "
								<div class='notifications_col all_rows col s12 z-depth-1' id='$notification_id' onclick='show_notification_details(this.id);'>
									<div class='row'>
										<div class='col s2'>
											<i class='material-icons notifications_icon'>notifications_none</i>
										</div>
										<div class='col s8' style='padding-right:0px;padding-left:0px;'>
											<div class='row'>
												<div class='col s12'>
											<a class='drilldown' id='$notification_id' onclick='show_notification_details(this.id);'>$notification_title</a>
												</div>
												<!--<div class='col s12'>
													<label>To: </label><b>$owner_name</b>
												</div>-->
												<div class='col s12'>
													$final_notification_date
												</div>
											</div>
										</div>
										<div class='col s2 not_asset_number'>
											$notification_asset_number
										</div>
									</div>
								</div>
							";
						}
					?>
				</div>
			</div>
		</div>



		



		<div class="record_details notification_details" title="Owner Details">
			
		</div>
	</div>
</div>
</body>
<script type="text/javascript">
	function show_notification_details(notification_id) {
		$('.record_details').html("<img src='images/preloader.gif'/>");
		$('.right_content').html("<img src='images/preloader.gif'/>");
		 $.ajax({
		  url: "notification_details.php",
		  data: {
			notification_id: notification_id
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


     
	function add_new_notification(access_code) {
		$('.record_details').html("<img src='images/preloader.gif'/>");
		$('.right_content').html("<img src='images/preloader.gif'/>");
		$.ajax({
		  url: "add_notification.php",
		  data: {
			id: access_code
		  },
		  type: 'post',
		  cache: false,
		  success: function(add_notification_html){
			  if(screen.availWidth<=414){
				$('.right_content').html(add_notification_html);
			  }
			  else{
				$('.record_details').html(add_notification_html);
			  }
		  }
		})
	}
	
	function show_all_notifications(){
		if($('#show_all_notifications').is(':checked')){
			$('.all_rows').css('display', 'block');
			$('.last_five').css('display', 'none');
			$('.notifications_count_head').text('Showing all notifications');
		}
		else{
			$('.all_rows').css('display', 'none');
			$('.last_five').css('display', 'block');
			$('.notifications_count_head').text('Showing last 5 notifications');
		}
	}

</script>
