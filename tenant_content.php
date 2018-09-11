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

<body>
<title>MPRTS | Tenants</title>
<?php include 'db_config.php'; ?>
<?php include'headers.php'; ?>
<?php include 'left_content.php'; ?>
<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
<script type="text/javascript">
	 $(document).ready(function() {
    $('select').material_select();
  });
</script>
<div class="right_content">
	<?php include'nav_thread.php'; ?>
	<div class="title_bar">
		<h5><a href="index.php">Admin Dashboard</a> - <b>Tenants List</b></h5>
	</div>
	<div class="owner_content">
		<div class="owner_content_actions">
			<div class="row">
				<div class="col s2 show_all">
				    <p>
				      <input type="checkbox" id="show_all_tenants" />
				      <label for="show_all_tenants">Show All</label>
				    </p>
				</div>
				<div class="col s10 search_applet" style='min-width:80%;'>
					<div class="input-field" style="margin-top: 0px;">
			          <input placeholder="Search Tenants" id="search_tenants" type="text" class="validate">
			          <!-- <label for="first_name">First Name</label> -->
					  <i class="material-icons search_icon"  onclick="search_tenant_results($('#search_tenants').val());">search</i>
			        </div>
				</div>
				<div class="col s2">
					<div class="applet_sort">
						<div class="input-field col s12">
						    <select>
						      <option value="" disabled selected>Sort by</option>
						      <option value="1">Name</option>
						      <option value="2">Owner</option>
						      <option value="3">Location</option>
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
			  			</div>
					</div>
				</div>
				<div class="col s2">
					<div class="add_record">
						<i class="material-icons" title="Add Tenant" id='add_tenant' onclick='add_new_tenant(this.id);'>add_box</i>
					</div>
				</div>
			</div>
		</div>
		<div class="owners_table">
			<div class="row">
				<div class="col s12">
				</div>
			</div>
			<style type="text/css">
				td {
					width:20%;
					padding-left: 1%;
					!text-align: center;
				}
			</style>

<!-- ------------------------------------------------------------------------------------------------------------ -->


			<table class="striped">
		        <thead class="main_head">
		          <tr>
		          	  <th>Tenant Id</th>
		          	  <th>Tenant Name</th>
		          	  <th>Owner</th>
		              <th>House</th>
		              <th>Mobile</th>
		              <th>Email</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php
					$access_type = substr($user_access_code, 0, 2);
					if($access_type == 'MM'){
						$tenant_details_sql = "SELECT * from mprts_tenants order by tenant_id desc";
						}
						else if($access_type == 'AA'){
						// $tenant_details_sql = "SELECT * from mprts_tenants where tenant_id in (select tenant_id from mprts_tenants where tenant_propid in (select prty_id from mprts_property where prty_building_id in (select building_id from mprts_buildings where building_access_code = '$user_access_code' ))) order by tenant_id desc";
							$tenant_details_sql = "SELECT * from mprts_tenants where access_code = '$user_access_code'";
						}
						else if($access_type == 'OO'){
							$tenant_details_sql = "SELECT * from mprts_tenants where tenant_owner_id in (select owner_id from mprts_owner where access_code = '$user_access_code' ) ";
							echo "<style>
								#add_tenant {
								display:none !important;
								}
								</style>";
						}
						$tenant_details_execute = mysql_query($tenant_details_sql);
			
						$tenants_count = mysql_num_rows($tenant_details_execute);

						// while($row = mysql_fetch_array($owners_details_execute)){
						$i=0;
						while($i<$tenants_count){
							$row = mysql_fetch_array($tenant_details_execute);
							$tenant_id = $row['tenant_id'];
							$tenant_name = $row['tenant_name'];
							$tenant_propid = $row['tenant_propid'];
							$tenant_owner_id = $row['tenant_owner_id'];
							$tenant_mobile = $row['tenant_mobile'];
							$tenant_email = $row['tenant_email'];


							$get_tnt_id_sql = mysql_query("SELECT concat('TNT', tenant_id) as tenant_id, concat('AST', tenant_propid) as tenant_propid  from mprts_tenants where tenant_id = $tenant_id");
							$tnt_id_row = mysql_fetch_array($get_tnt_id_sql);
							$tnt_id = $tnt_id_row['tenant_id'];
							$ast_id = $tnt_id_row['tenant_propid'];


							$owner_name_sql = "SELECT * from mprts_owner where owner_id= $tenant_owner_id  and substr(access_code, -1) != 'D'";
							$owner_name_execute = mysql_query($owner_name_sql);
							while($row2 = mysql_fetch_array($owner_name_execute)){
								$owner_name = $row2['owner_name'];
							}

							$tenant_prop_sql = mysql_query("SELECT * from mprts_property where prty_id= $tenant_propid");
							while($prop_row = mysql_fetch_array($tenant_prop_sql)){
								$prty_no = $prop_row['prty_no'];
							}

							echo "
								<tr class='table_content'>
						            <td><a class='drilldown' id='$tenant_id' onclick='show_tenant_details(this.id);'>$tnt_id</a></td>
						            <td>$tenant_name</td>
						            <td><a class='drilldown' id='$owner_name' onclick='show_owner_details(this.id);'>$owner_name</a></td>
						            <td><a class='drilldown' id='$tenant_propid' onclick='show_property_details(this.id);'>$prty_no</a></td>
						            <td>$tenant_mobile</td>
						            <td>$tenant_email</td>
					          	</tr>
							";
							$i++;
						}
					?>
		        </tbody>
	      </table>


<!-- ---------------------------------------------------------------------------------------------------------- -->

		</div>

		<div class="resp_owners_table z-depth-3">
			<table class="striped">
		        <thead>
		          <tr>
		              <th>Tenant Id</th>
		          	  <th>Tenant Name</th>
		          	  <th>Owner</th>
		              <th>House</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php
					$access_type = substr($user_access_code, 0, 2);
					if($access_type == 'MM'){
						$tenant_details_sql = "SELECT * from mprts_tenants order by tenant_id desc";
						}
						else if($access_type == 'AA'){
						$tenant_details_sql = "SELECT * from mprts_tenants where tenant_id in (select tenant_id from mprts_tenants where tenant_propid in (select prty_id from mprts_property where prty_building_id in (select building_id from mprts_buildings where building_access_code = '$user_access_code' ))) and access_code = '$user_access_code' order by tenant_id desc";
						}
						else if($access_type == 'OO'){
							$tenant_details_sql = "SELECT * from mprts_tenants where tenant_owner_id in (select owner_id from mprts_owner where access_code = '$user_access_code' ) ";
						}
						$tenant_details_execute = mysql_query($tenant_details_sql);
			
						$tenants_count = mysql_num_rows($tenant_details_execute);
						
						if($tenants_count==0){
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
						while($i<$tenants_count){
							$row = mysql_fetch_array($tenant_details_execute);
							$tenant_id = $row['tenant_id'];
							$tenant_name = $row['tenant_name'];
							$tenant_propid = $row['tenant_propid'];
							$tenant_owner_id = $row['tenant_owner_id'];
							$tenant_mobile = $row['tenant_mobile'];
							$tenant_email = $row['tenant_email'];


							$get_tnt_id_sql = mysql_query("SELECT concat('TNT', tenant_id) as tenant_id, concat('AST', tenant_propid) as tenant_propid  from mprts_tenants where tenant_id = $tenant_id");
							$tnt_id_row = mysql_fetch_array($get_tnt_id_sql);
							$tnt_id = $tnt_id_row['tenant_id'];
							$ast_id = $tnt_id_row['tenant_propid'];


							$owner_name_sql = "SELECT * from mprts_owner where owner_id= $tenant_owner_id";
							$owner_name_execute = mysql_query($owner_name_sql);
							while($row2 = mysql_fetch_array($owner_name_execute)){
								$owner_name = $row2['owner_name'];
							}

							$tenant_prop_sql = mysql_query("SELECT * from mprts_property where prty_id= $tenant_propid");
							while($prop_row = mysql_fetch_array($tenant_prop_sql)){
								$prty_no = $prop_row['prty_no'];
							}

							echo "
								<tr>
						            <td><a class='drilldown' id='$tenant_id' onclick='show_tenant_details(this.id);'>$tnt_id</a></td>
						            <td>$tenant_name</td>
						            <td><a class='drilldown' id='$owner_name' onclick='show_owner_details(this.id);'>$owner_name</a></td>
						            <td><a class='drilldown' id='$tenant_propid' onclick='show_property_details(this.id);'>$prty_no</a></td>
					          	</tr>
							";
							$i++;
						}
						}
					?>
		        </tbody>
	      </table>
		</div>

		<div class="record_details" title="Tenant Details"></div>
	</div>
</div>
</body>

<script type="text/javascript">
	function add_new_tenant(tenant_id) {
     $.ajax({
      url: "add_tenant.php",
      data: {
        id: tenant_id
      },
      type: 'post',
      cache: false,
      success: function(add_tenant_html){
		  if(screen.availWidth<=414){
			$('.right_content').html(add_tenant_html);
		  }
		  else{
			$('.record_details').html(add_tenant_html);
		  }
      }
    })
  }
  
  function search_tenant_results(search_tenant){
		$('.resp_owners_table').html("<img src='images/preloader.gif'/>");
			$.ajax({
			  url: "search_tenant_results.php",
			  data: {
				search_tenant: search_tenant
			  },
			  type: 'post',
			  cache: false,
			  success: function(search_tenant_html){
				  //if(screen.availWidth<=414){
					$('.resp_owners_table').html(search_tenant_html);
					//document.write(search_owner_html);
				  //}
				  //else{
					//$('.resp_owners_table').load('search_results.php');
				  //}
			  }
			});
	}
  
</script>