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

<?php include 'db_config.php'; ?>
<?php include 'headers.php'; ?>

<style type="text/css">
	#toast-container {
	  top: 10%;
	  right: auto !important;
	  left:50%;
	}
</style>
<body>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<table class="striped">
		<thead>
	      <tr>
	      	  <th>Tenant ID</th>
	      	  <th>Tenant Name</th>
	          <th>Tenant House</th>
	          <th>Tenant Owner</th>
	      </tr>
	    </thead>
<?php 
	$access_type = substr($user_access_code, 0, 2);
	if($access_type == 'MM'){
		$tenant_list_sql = mysql_query("SELECT * from mprts_tenants");
	}
	else if($access_type == 'AA'){
		$tenant_list_sql = mysql_query("SELECT * from mprts_tenants where substr(access_code, 3, 4) = substr('$user_access_code', 3, 4) and substr(access_code, -1) != 'D'");
	}
	
	$tenant_list_count = mysql_num_rows($tenant_list_sql);
	$i=0;
	while ($i<$tenant_list_count) {
		$tenant_list_row  = mysql_fetch_array($tenant_list_sql);

		$tenant_id = $tenant_list_row['tenant_id'];
		$tenant_name = $tenant_list_row['tenant_name'];
		$tenant_propid = $tenant_list_row['tenant_propid'];
		$tenant_ownerid = $tenant_list_row['tenant_owner_id'];

		$get_asset_details = mysql_query("SELECT * from mprts_property where prty_id = '$tenant_propid'");
		$prty_row = mysql_fetch_array($get_asset_details);
		$prty_no = $prty_row['prty_no'];

		$get_owner_details = mysql_query("SELECT * from mprts_owner where owner_id = '$tenant_ownerid'");
		$owner_row = mysql_fetch_array($get_owner_details);
		$owner_name = $owner_row['owner_name'];

		$table_content = "
		        <tr>
		            <td><a class='drilldown id_field' id='$tenant_id' onclick='select_element(this.id);'>TNT$tenant_id</a></td>
		            <td>$tenant_name</td>
		            <td>$prty_no</td>
		            <td>$owner_name</td>
	          	</tr>";
		echo $table_content;
		$i++;
	}
?>
	</table>
</body>
<script type="text/javascript">
	function select_element(selected_id){
		// tenant_id = selected_id;
		Materialize.toast(selected_id+' Selected', 2000);


		 $.ajax({
      url: "get_tenant_details.php",
      data: {
        id: selected_id
      },
      type: 'post',
      cache: false,
      success: function(value){
      		 // console.log(value);
             var data = value.split("|");
            $('#tenant_id').val('TNT'+data[0]);
            $('#pmt_tenant_name').val(data[1]);
            $('#pmt_prty_owner').val(data[2]);
            $('#pmt_prty_address').val(data[3]);
            $('#pmt_prty_no').val(data[4]);
        }
    }); 


	}
</script>

