<?php
	session_start();
	$user_name = $_SESSION["user_name"] ;
	$user_access_code = $_SESSION["user_access_code"];
	$user_email = $_SESSION["user_email"];
?>

<body>
<title>MPRTS | Expenses</title>
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
<style>
	.notifications_icon{
		border-radius: 50%;
		border: 1px solid #16a085;
		padding: 7px;
		margin: 0px 25px 10px 0px;
	}
	.resp_owners_table{
		min-height:200px;
	}
</style>

<div class="right_content">
	<?php include'nav_thread.php'; ?>
	<?php if($access_type=='OO'){
		echo "<style>
				.add_record {
					display:none !important;
				}
			</style>";
}
	?>
	<div class="title_bar">
		<h5><a href="index.php">Admin Dashboard</a> - <b>Expenses List</b></h5>
	</div>
	<div class="owner_content">
		<div class="owner_content_actions">
			<div class="row">
				<div class="col s3 show_all" style="display:block !important;margin-left:5%;">
				    <p>
				      <input type="checkbox" id="show_all_expenses" onchange="show_all_expenses();"/>
				      <label for="show_all_expenses">Show All</label>
				    </p>
				</div>
				<div class="col s6 search_applet">
					<div class="input-field" style="margin-top: 0px;">
			          <input placeholder="Search Expenses" id="" type="text" class="validate">
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
						<i class="material-icons" title="Add Owner" id='<?php echo $user_access_code; ?>' onclick='add_new_expense(this.id);'>add_box</i>
					</div>
				</div>
				
			</div>
		</div>
		<div class="owners_table z-depth-3" title="Expenses List">
			<table class="striped">
		        <thead class="thead_main">
		          <tr>
		          	  <th>Expense ID</th>
		              <th>Date</th>
		              <th>Amount</th>
		              <th>Cause</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php
						/* $access_type = substr($user_access_code, 0, 2);
						if($access_type == 'MM'){
							$expense_details_sql = "SELECT * from mprts_expenses order by expense_id desc";
						}
						else if($access_type == 'AA'){
							$expense_details_sql = "SELECT * from mprts_expenses where expense_access_code = '$user_access_code' and substr(expense_access_code, -1) != 'D' order by expense_id desc";
						echo "<style>
								#add_building,  .delete_property {
								display:none !important;
								}
							</style>";
						} 
						else if($access_type == 'OO'){
							$sub_access_code = substr($user_access_code, 2, 4);
				$expense_details_sql = "SELECT * from mprts_expenses where substr(expense_access_code, 3, 4) = '$sub_access_code' and substr(expense_access_code, -1) != 'D' and (substr(expense_association, 4, 4) in (select prty_id from mprts_property where prty_owner in (select owner_id from mprts_owner where owner_email = '$user_email')) OR expense_association = 'ALL ASSETS')  order by expense_id desc";
							echo "<style>
								.edit_building, #add_expense {
									display:none !important;
								}
								</style>";
						} */
						
						
						//$expense_details_execute = mysql_query($expense_details_sql);
						
						
						
						$access_type = substr($user_access_code, 0, 2);
					
					if($access_type == 'AA'){					
						$expense_details_execute = mysql_query("SELECT * from mprts_expenses where substr(expense_access_code, 0, 4) = substr('$user_access_code', 0, 4) order by expense_id desc limit 5");
						
						$expense_details_execute_all = mysql_query("SELECT * from mprts_expenses where substr(expense_access_code, 0, 4) = substr('$user_access_code', 0, 4) order by expense_id desc");
					}
					/* else if($access_type == 'OO'){
						$notifications_sql = mysql_query("SELECT * from mprts_notifications where substr(notification_access_code, 0, 4) = substr('$user_access_code', 0, 4) and substr(notification_association, 4, 4) = substr('$user_access_code', 3, 4) order by notification_id desc");
					} */
					else if($access_type == 'OO'){
						$expense_details_execute = mysql_query("SELECT * from mprts_expenses where substr(expense_access_code, 2, 4) = substr('$user_access_code', 2, 4) and (substr(expense_association, 4, 4) in (select prty_id from mprts_property where prty_owner in (select owner_id from mprts_owner where owner_email = '$user_email')) OR expense_association = 'ALL ASSETS') order by expense_id desc limit 5");
						
						$expense_details_execute_all = mysql_query("SELECT * from mprts_notifications where substr(expense_access_code, 2, 4) = substr('$user_access_code', 2, 4) and (substr(expense_association, 4, 4) in (select prty_id from mprts_property where prty_owner in (select owner_id from mprts_owner where owner_email = '$user_email')) OR expense_association = 'ALL ASSETS') order by expense_id desc");
					}
						
						
						
						
						
						
						
						
						$expense_count = mysql_num_rows($expense_details_execute);

						$i=0;
						while($i<$expense_count){
							$row = mysql_fetch_array($expense_details_execute);
							$expense_id = $row['expense_id'];
							$expense_date = $row['expense_date'];
							$expense_amount = $row['expense_amount'];
							$expense_cause = $row['expense_cause'];
							$expense_description = $row['expense_description'];
							$expense_access_code = $row['expense_access_code'];
							echo "
								<tr class='table_content'>
						            <td><a class='drilldown' id='$expense_id' onclick='show_expense_details(this.id);'>EXP$expense_id</a></td>
						            <td>$expense_date</td>
						            <td>$expense_amount</td>
						            <td>$expense_cause</td>
						            <td>$expense_cause</td>
					          	</tr>
							";
							echo "
								<div class='resp_content resp_expense_content z-depth-1'></div>
							";
							$i++;
						}
					?>
		        </tbody>
	      </table>
		</div>

		<div class="resp_owners_table z-depth-2">
				<div class="notifications_cards_row row">
		<h6 class="expenses_count_head">Showing latest 5 expenses</h6>
			
				<?php
					$access_type = substr($user_access_code, 0, 2);
					
					if($access_type == 'MM'){
						$building_details_sql = "SELECT * from mprts_expenses order by expense_id desc";
					}
					
					if($access_type == 'AA'){					
						$expense_details_execute = mysql_query("SELECT * from mprts_expenses where substr(expense_access_code, 0, 4) = substr('$user_access_code', 0, 4) order by expense_id desc limit 5");
						
						$expense_details_execute_all = mysql_query("SELECT * from mprts_expenses where substr(expense_access_code, 0, 4) = substr('$user_access_code', 0, 4) order by expense_id desc");
					}
					
					else if($access_type == 'OO'){
						$expense_details_execute = mysql_query("SELECT * from mprts_expenses where substr(expense_access_code, 3, 4) = substr('$user_access_code', 3, 4) and (substr(expense_association, 4, 4) in (select prty_id from mprts_property where prty_owner in (select owner_id from mprts_owner where owner_email = '$user_email')) OR expense_association = 'ALL ASSETS') order by expense_id desc limit 5");
						
						$expense_details_execute_all = mysql_query("SELECT * from mprts_expenses where substr(expense_access_code, 3, 4) = substr('$user_access_code', 3, 4) and (substr(expense_association, 4, 4) in (select prty_id from mprts_property where prty_owner in (select owner_id from mprts_owner where owner_email = '$user_email')) OR expense_association = 'ALL ASSETS') order by expense_id desc");
					}
					
					
						$expense_count = mysql_num_rows($expense_details_execute);
						
						if($expense_count==0){
							//echo "<center><h5>No Records found..!</h5></center>";
							echo "<center class='no_records'><i class='fas fa-binoculars'></i><h6>No Records found..!</h6></center>";
							echo "<style>
								table, .record_details{
									display:none;
								}
							</style>";
						}
						
						$i=0;
						while($row = mysql_fetch_array($expense_details_execute)){
							$expense_id = $row['expense_id'];
							$expense_date = $row['expense_date'];
							$expense_amount = $row['expense_amount'];
							$expense_cause = $row['expense_cause'];
							$expense_description = $row['expense_description'];
							$expense_access_code = $row['expense_access_code'];
							$expense_association = $row['expense_association'];
							
							if($expense_association != "ALL ASSETS"){
								$get_asset_details = mysql_query("select * from mprts_property where prty_id = substr('$expense_association', 4, 4)");
								while($asset_row = mysql_fetch_array($get_asset_details)){
									$expense_asset_number = $asset_row['prty_no'];
									$expense_asset_owner = $asset_row['prty_owner'];
									
									$get_asset_owner = mysql_query("select * from mprts_owner where owner_id = '$expense_asset_owner'");
									while($owner_row = mysql_fetch_array($get_asset_owner)){
										$owner_name = $owner_row['owner_name'];
									}
								}
							}
							else {
								$expense_asset_number = "ALL";
								$owner_name = "All Owners";
							}
							
							
							echo "
								<div class='notifications_col last_five col s12 z-depth-1' id='$expense_id' onclick='show_expense_details(this.id);'>
									<div class='row'>
										<div class='col s2'>
											<i class='material-icons notifications_icon'>credit_card</i>
										</div>
										<div class='col s8' style='padding-right:0px;padding-left:0px;'>
											<div class='row'>
												<div class='col s12'>
											<a class='drilldown' id='$expense_id' onclick='show_expense_details(this.id);'>$expense_cause</a>
												</div>
												<!--<div class='col s12'>
													<label>To: </label><b>$owner_name</b>
												</div>-->
												<div class='col s12'>
													$expense_date
												</div>
											</div>
										</div>
										<div class='col s2 not_asset_number'>
											$expense_asset_number
										</div>
										
									</div>
								</div>
							";
							
							echo "
								<div class='resp_content resp_expense_content z-depth-1'></div>
							";
							//$i++;
						}
						
						while($row = mysql_fetch_array($expense_details_execute_all)){
							$expense_id = $row['expense_id'];
							$expense_date = $row['expense_date'];
							$expense_amount = $row['expense_amount'];
							$expense_cause = $row['expense_cause'];
							$expense_description = $row['expense_description'];
							$expense_access_code = $row['expense_access_code'];
							$expense_association = $row['expense_association'];
							
							if($expense_association != "ALL ASSETS"){
								$get_asset_details = mysql_query("select * from mprts_property where prty_id = substr('$expense_association', 4, 4)");
								while($asset_row = mysql_fetch_array($get_asset_details)){
									$expense_asset_number = $asset_row['prty_no'];
									$expense_asset_owner = $asset_row['prty_owner'];
									
									$get_asset_owner = mysql_query("select * from mprts_owner where owner_id = '$expense_asset_owner'");
									while($owner_row = mysql_fetch_array($get_asset_owner)){
										$owner_name = $owner_row['owner_name'];
									}
								}
							}
							else {
								$expense_asset_number = "ALL";
								$owner_name = "All Owners";
							}
							
							
							echo "
								<div class='notifications_col all_rows col s12 z-depth-1' id='$expense_id' onclick='show_expense_details(this.id);'>
									<div class='row'>
										<div class='col s2'>
											<i class='material-icons notifications_icon'>credit_card</i>
										</div>
										<div class='col s8' style='padding-right:0px;padding-left:0px;'>
											<div class='row'>
												<div class='col s12'>
											<a class='drilldown' id='$expense_id' onclick='show_expense_details(this.id);'>$expense_cause</a>
												</div>
												<!--<div class='col s12'>
													<label>To: </label><b>$owner_name</b>
												</div>-->
												<div class='col s12'>
													$expense_date
												</div>
											</div>
										</div>
										<div class='col s2 not_asset_number'>
											$expense_asset_number
										</div>
										
									</div>
								</div>
							";
							
							echo "
								<div class='resp_content resp_expense_content z-depth-1'></div>
							";
							$i++;
						}
					?>
		        <!--</tbody>
	      </table>-->
		</div>

		<div class="record_details" id="record_details"></div>

		<div class="add_new_record" title="Add new record"></div>

	</div>

</div>

</body>
<script type="text/javascript" src='scripts/major_navigate.js'></script>

<script type="text/javascript">
  function search_expense_results(search_expense){
		$('.resp_owners_table').html("<img src='images/preloader.gif'/>");
			$.ajax({
			  url: "search_expense_results.php",
			  data: {
				search_expense: search_expense
			  },
			  type: 'post',
			  cache: false,
			  success: function(search_expense_html){
				  //if(screen.availWidth<=414){
					$('.resp_owners_table').html(search_expense_html);
					//document.write(search_owner_html);
				  //}
				  //else{
					//$('.resp_owners_table').load('search_results.php');
				  //}
			  }
			});
	}
	
	function show_all_expenses(){
		if($('#show_all_expenses').is(':checked')){
			$('.all_rows').css('display', 'block');
			$('.last_five').css('display', 'none');
			$('.expenses_count_head').text('Showing all expenses');
		}
		else{
			$('.all_rows').css('display', 'none');
			$('.last_five').css('display', 'block');
			$('.expenses_count_head').text('Showing last 5 expenses');
		}
	}
 </script>