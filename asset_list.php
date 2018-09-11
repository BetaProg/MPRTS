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
<?php //include 'headers.php'; ?>

<style type="text/css">
	#toast-container {
	  top: 10%;
	  right: auto !important;
	  left:50%;
	}
</style>
<body>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--<div class="all_property">
		<p>
		  <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
		  <label for="filled-in-box">Filled in</label>
		</p>
	</div>-->
	<table class="striped">
		<thead>
	      <tr>
	      	  <th>Asset ID</th>
	      	  <th>Owner Name</th>
			  <th>Asset No</th>
	      </tr>
	    </thead>
<?php 
	$access_type = substr($user_access_code, 0, 2);
	if($access_type == 'MM'){
		$asset_list_sql = mysql_query("select * from mprts_property");
	}
	else if($access_type == 'AA'){
		$asset_list_sql = mysql_query("select * from mprts_property where substr(access_code, 3, 4) = substr('$user_access_code', 3, 4)");
	}
	$asset_list_count = mysql_num_rows($asset_list_sql);
	$i=0;
	while ($i<$asset_list_count) {
		$asset_list_row  = mysql_fetch_array($asset_list_sql);

		$asset_id = $asset_list_row['prty_id'];
		$asset_no = $asset_list_row['prty_no'];
		$asset_owner = $asset_list_row['prty_owner'];

		$get_ast_id_sql = mysql_query("select concat('AST', prty_id) as prty_id, prty_building_id  from mprts_property where prty_id = $asset_id");
		$ast_id_row = mysql_fetch_array($get_ast_id_sql);
		$ast_id = $ast_id_row['prty_id'];
		$ast_prty_id = $ast_id_row['prty_building_id'];

		$get_owner_name = mysql_query("select * from mprts_owner where owner_id = '$asset_owner'");
		$owner_row = mysql_fetch_array($get_owner_name);
		$owner_name = $owner_row['owner_name'];

		$get_address_details = mysql_query("select * from mprts_buildings where building_id = $ast_prty_id");
		$address_row = mysql_fetch_array($get_address_details);
		$address_building_name = $address_row['building_name'];
		$address_building_locality = $address_row['building_locality'];
		$address_building_city = $address_row['building_city'];
		$address_building_type = $address_row['building_type'];

		$building_address = $address_building_name.' - '.$address_building_locality.' - '.$address_building_city;

		$table_content = "
		        <tr>
		            <td><a class='drilldown id_field' id='$ast_id' onclick='select_element2(this.id);'>$ast_id</a></td>
		            <td>$owner_name</td>
					<td>$asset_no</td>
	          	</tr>";
		echo $table_content;
		$i++;
	}
?>
	</table>
</body>
<script type="text/javascript">
	function select_element2(selected_id2){
		asset_id = selected_id2;
		Materialize.toast(selected_id2+' Selected', 2000);


		 $.ajax({
      url: "get_asset_details.php",
      data: {
        id: selected_id2
      },
      type: 'post',
      cache: false,
      success: function(value){
      		// console.log(value);
             var data = value.split("|");
            $('#tenant_owner_name').val(data[0]);
            $('#pmt_prty_no_owner').val(data[4]);
            $('#pmt_prty_address_owner').val(data[1]);
            $('#asset_id').val(data[3]);
            $('#pmt_owner_name').val(data[5]);
            $('#pmt_owner_id').val(data[0]);
            // $('#tenant_address').val(data[1]);
            $('#tenant_owner_id').val(data[2]);
        }
    }); 


	}
</script>

