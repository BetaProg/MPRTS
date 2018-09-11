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
<?php include 'db_config.php'; ?>
<?php include 'headers.php'; ?>
<div class="right_content">
	<div class="owner_content">
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
					if(isset($_POST["search_tenant"])){
						$tenant_name = $_POST['search_tenant'];
						//$owner_name = "Kishore";

						if($access_type == 'MM'){
							$tenant_details_sql = "SELECT * from mprts_tenants where tenant_name like '%$tenant_name%' order by tenant_id desc";
						}
						else if($access_type == 'AA'){
							$tenant_details_sql = "SELECT * from mprts_tenants where tenant_id in (select tenant_id from mprts_tenants where tenant_propid in (select prty_id from mprts_property where prty_building_id in (select building_id from mprts_buildings where building_access_code = '$user_access_code' ))) and  tenant_name like '%$tenant_name%' and access_code = '$user_access_code' order by tenant_id desc";
						}

						else if($access_type == 'OO'){
							$tenant_details_sql = "SELECT * from mprts_tenants where tenant_owner_id in (select owner_id from mprts_owner where access_code = '$user_access_code' ) ";
						}
						$tenant_details_execute = mysql_query($tenant_details_sql);
			
						$tenants_count = mysql_num_rows($tenant_details_execute);
						if($tenants_count==0){
							echo "<center><h5>No Records found..!</h5></center>";
						}
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



		<div class="record_details" title="Owner Details">
			
		</div>
	</div>
</div>