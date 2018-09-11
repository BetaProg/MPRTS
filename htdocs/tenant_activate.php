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
<title>MPRTS | Home</title>
<?php include 'db_config.php'; ?>
<?php include 'headers.php'; ?>

<center><h5>De-Activated Tenants</h5></center>
	<?php 
		if(substr($user_access_code, 0, 2)=='AA'){

			$get_deleted_tenant_details = mysql_query("SELECT * from mprts_tenants where substr(access_code, -1) = 'D'");
			$deleted_tenants_count = mysql_num_rows($get_deleted_tenant_details);
			if($deleted_tenants_count==0){
				echo "<center><h5>No Deleted users</h5></center>";
			}
			else{
				
				echo "
					<table class='striped'>
					    <thead class=''>
					      <tr>
					          <th>Id</th>
				          	  <th>Name</th>
				          	  <th class='desk'>Owner</th>
				              <th>House</th>
				              <th class='desk'>Mobile</th>
				              
							  <th>Status</th>
					      </tr>
					    </thead>
					    <tbody>

				";
			
			while($deleted_tenants = mysql_fetch_array($get_deleted_tenant_details)) {
				$tenant_id = $deleted_tenants['tenant_id'];
				$tenant_name = $deleted_tenants['tenant_name'];
				$tenant_propid = $deleted_tenants['tenant_propid'];
				$tenant_mobile = $deleted_tenants['tenant_mobile'];
				$tenant_email = $deleted_tenants['tenant_email'];
				$tenant_owner_id = $deleted_tenants['tenant_owner_id'];

				$owner_name_sql = "SELECT * from mprts_owner where owner_id= '$tenant_owner_id'";
				$owner_name_execute = mysql_query($owner_name_sql);
				while($row2 = mysql_fetch_array($owner_name_execute)){
					$owner_name = $row2['owner_name'];
				}

				$tenant_prop_sql = mysql_query("SELECT * from mprts_property where prty_id= '$tenant_propid'");
				while($prop_row = mysql_fetch_array($tenant_prop_sql)){
					$prty_no = $prop_row['prty_no'];
				}
			// }
			// echo $owner_id.'-'.$owner_name.'-'.$owner_mobile.'-'.$owner_email;

			echo "
				<tr class=''>
					<td>$tenant_id</td>
		            <td>$tenant_name</td>
		            <td class='desk'>$owner_name</td>
		            <td>$prty_no</td>
		            <td class='desk'>$tenant_mobile</td>
		            
		            <td>
		            	 <div class='switch'>
						    <label>
						      De-Activate
						    <input type='checkbox' id='$tenant_id' onchange='update_tenant_status(this.id);'>
						    <span class='lever'></span>
						      Activate
						    </label>
						</div>
		            </td>
	          	</tr>
			";
			}
		}
		// else{
		// 	header('Location: property_content.php');	
		// }
	}	
	?>
	<script type="text/javascript">
		function update_tenant_status(tenant_id){
			$.ajax({
			      url: "update_tenant_status.php",
			      data: {
			        id: tenant_id
			      },
			      type: 'post',
			      cache: false,
			      success: function(update_tenant_status_html){
			          // $('.record_details').html(update_owner_status_html);
			          window.location = 'tenant_content.php';
			      }
			    })
			
		}
	</script>