<?php
	session_start();
	if(isset($_SESSION["user_name"])){
		$user_name = $_SESSION["user_name"] ;
		$user_access_code = $_SESSION["user_access_code"];
	}
	else {
		header('Location: login.php');
	}
?>
<!-- <script>alert('<?php echo $user_access_code; ?>')</script> -->
<body>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MPRTS | Properties</title>
<?php include 'db_config.php'; ?>
<?php include'headers.php'; ?>
<?php include 'left_content.php'; ?>
<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
<script type="text/javascript">
	 $(document).ready(function() {
    $('select').material_select();
  });
</script>
<script type="text/javascript">
	
$('.drilldown').on('click', (function(){
  $('.resp_owners_table').css('display','none !important');
  $('.record_details').css('display','block');
}));
$('.content_name').on('click', (function() {
  $('.record_details').css('display','none');
  $('.resp_owners_table ').css('display','block');
}));

</script>
<div class="right_content">
	<?php include'nav_thread.php'; ?>
	<div class="title_bar">
		<h5><a href="index.php">Admin Dashboard</a> - <b>Assets List</b></h5>
	</div>
	<div class="owner_content">
		<div class="owner_content_actions">
			<div class="row">
				<div class="col s2 show_all">
				    <p>
				      <input type="checkbox" id="show_all_assets" />
				      <label for="show_all_assets">Show All</label>
				    </p>
				</div>
				<div class="col s10 search_applet" style='min-width:80%;'>
					<div class="input-field" style="margin-top: 0px;">
			          <input placeholder="Search Assets" id="" type="text" class="validate">
			          <!-- <label for="first_name">First Name</label> -->
			        </div>
				</div>
				<div class="col s2">
					<div class="applet_sort">
						<div class="input-field col s12">
						    <select>
						      <option value="" disabled selected>Sort by</option>
						      <option value="1">Asset Id</option>
						      <option value="2">Building Id</option>
						      <option value="3">Asset Type</option>
						      <option value="4">Location</option>
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
						<i class="material-icons" title="Add Asset" id='add_property' onclick='add_new_property(this.id);'>add_box</i>
					</div>
				</div>
				
			</div>
		</div>
		
		<div class="owners_table z-depth-3 assets_spl_table" id='tableit1' title="Assets List">
			<table class="striped">
		        <thead class="main_head">
		          <tr>
		          	  <th>Asset ID</th>
		          	  <th>House No.</th>
		              <th>Type</th>
		              <th>Owner's Name</th>
		              <!-- <th>Property</th> -->
		              <!-- <th>Location</th> -->
		              <th>Rent</th>
		              <th>Current Meter</th>
					  <th>Gas Meter</th>
					  <th>Water Meter</th>
		              <!-- <th>Address</th> -->
		          </tr>
		        </thead>
		        <thead class="resp_head">
		          <tr>
		          	  <th>Asset ID</th>
		          	  <th>House No.</th>
		              <th>Type</th>
		              <th>Owner's Name</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 
						$access_type = substr($user_access_code, 0, 2);
						if($access_type == 'MM'){
							$prty_details_sql = "select * from mprts_property order by prty_id desc";
						}
						else if($access_type == 'AA'){
							$req1 = substr($user_access_code, 2, 4);
							// $prty_details_sql = "select * from mprts_property where prty_id in (select prty_id from mprts_property where prty_building_id in (select substr(building_access_code, 3, 4) from mprts_buildings where building_access_code = '$user_access_code')) order by prty_id desc";
							$prty_details_sql = "SELECT * from mprts_property where substr(access_code, 3, 4) = '$req1'";

							echo "<style>
							.delete_property {
							display:none !important;
							}
							</style>";

						}
						else if($access_type == 'TT'){
							$prty_details_sql = "select * from mprts_property where prty_id in (select tenant_propid from mprts_tenants where access_code = '$user_access_code') order by prty_id desc";
						}
						else if($access_type == 'OO'){
							$prty_details_sql = "select * from mprts_property where prty_id in (select prty_id from mprts_property where prty_owner in (select owner_id from mprts_owner where access_code = '$user_access_code')) order by prty_id desc";
							echo "<style>
							#add_property, .edit_asset, .delete_asset {
							display:none !important;
							}
							</style>";
						}
						
						$prty_details_execute = mysql_query($prty_details_sql);
			
						$prty_count = mysql_num_rows($prty_details_execute);
						
						if($prty_count==0){
							echo "<center class='no_records'><i class='fas fa-binoculars'></i><h6>No Records found..!</h6></center>";
							echo "<style>
								table, .record_details{
									display:none;
								}
							</style>";
						}
						else {
							
						
						
						// while($row = mysql_fetch_array($owners_details_execute)){
						$i=0;
						while($i<$prty_count){
							$row = mysql_fetch_array($prty_details_execute);
							$prty_id = $row['prty_id'];
							$prty_owner = $row['prty_owner'];
							$prty_no = $row['prty_no'];
							$prty_location = $row['prty_location'];
							$prty_image = $row['prty_image'];
							$prty_current_meter = $row['prty_current_meter'];
							$prty_gas_meter = $row['prty_gas_meter'];
							$prty_water_meter = $row['prty_water_meter'];
							$prty_type = $row['prty_type'];
							$prty_rent = $row['prty_rent'];
							$prty_address = $row['prty_address'];
							$prty_vendors = $row['prty_vendors'];
							$prty_building_id = $row['prty_building_id'];


							$get_ast_id_sql = mysql_query("select concat('AST', prty_id) as prty_id, concat('PTY', prty_building_id) as prty_building_id from mprts_property where prty_id = $prty_id");
							$ast_id_row = mysql_fetch_array($get_ast_id_sql);
							$ast_id = $ast_id_row['prty_id'];
							$pty_id = $ast_id_row['prty_building_id'];

							$owner_name_sql = "select * from mprts_owner where owner_id= '$prty_owner' and substr(access_code, -1) != 'D'";
							$owner_name_execute = mysql_query($owner_name_sql);
							while($row2 = mysql_fetch_array($owner_name_execute)){
								$owner_name = $row2['owner_name'];
							}

							echo "
								<tr>
						            <td><a class='drilldown table_asset_id' id='$prty_id' onclick='show_property_details(this.id);'>$ast_id</a></td>
						            <td class='table_asset_no'>$prty_no</td>
						            <td class='table_asset_type'>$prty_type</td>
						            <td class='table_asset_owner'><a class='drilldown' id='$owner_name' onclick='show_owner_details(this.id);'>$owner_name</a></td>
						            <!--<td class='table_asset_building'><a class='drilldown' id='$prty_building_id' onclick='show_building_details(this.id);'>$pty_id</a></td>-->
						            <td class='table_asset_location'>$prty_rent</td>
						            <td class='table_asset_address'>$prty_current_meter</td>
						            <td class='table_asset_address'>$prty_gas_meter</td>
									<td class='table_asset_address'>$prty_water_meter</td>
									
					          	</tr>
							";
							$i++;
						}
						}
					?>
		        </tbody>
	      </table>
		</div>
		<div class="record_details">
			
		</div>
		<div class="add_new_record" title="Add new record">
			
		</div>
	</div>
</div>
</body>
<script type="text/javascript" src='scripts/major_navigate.js'></script>
