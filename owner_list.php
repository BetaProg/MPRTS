<?php
	session_start();
	$user_name = $_SESSION["user_name"] ;
	$user_access_code = $_SESSION["user_access_code"];
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
	      	  <th>Owner ID</th>
	      	  <th>Owner Name</th>
	      </tr>
	    </thead>
<?php 
	$access_type = substr($user_access_code, 0, 2);
	$building_code = substr($user_access_code, 2, 4);
	//$building_code = substr($user_access_code, 2, 8);
	if($access_type == 'MM'){
		$owner_list_sql = mysql_query("SELECT * from mprts_owner");
	}
	else if($access_type == 'AA'){
		$owner_list_sql = mysql_query("SELECT * from mprts_owner where substr(access_code, 3, 4) = '$building_code' and substr(access_code, -1)!='D'");
		//$owner_list_sql = mysql_query("SELECT * from mprts_owner where substr(access_code, 3, 8) = '$building_code' and substr(access_code, -1)!='D'");
	}
	$owner_list_count = mysql_num_rows($owner_list_sql);
	$i=0;
	while ($i<$owner_list_count) {
		$owner_list_row  = mysql_fetch_array($owner_list_sql);

		$owner_id = $owner_list_row['owner_id'];
		$owner_name = $owner_list_row['owner_name'];
		$access_code = $owner_list_row['access_code'];

		$get_onr_id_sql = mysql_query("SELECT concat('ONR', owner_id) as owner_id  from mprts_owner where owner_id = $owner_id");
		$onr_id_row = mysql_fetch_array($get_onr_id_sql);
		$onr_id = $onr_id_row['owner_id'];

		$table_content = "
		        <tr>
		            <td><a class='drilldown id_field' id='$onr_id' onclick='select_element2(this.id);'>$onr_id</a></td>
		            <td><a class='drilldown' id='$owner_name'>$owner_name</a></td>
		            
	          	</tr>";
		echo $table_content;
		$i++;
	}
?>
	</table>
</body>
<script type="text/javascript">
	function select_element2(selected_id2){
		owner_id = selected_id2;
		Materialize.toast(selected_id2+' Selected', 2000);

		$.ajax({
      url: "get_owner_details.php",
      data: {
        id: selected_id2
      },
      type: 'post',
      cache: false,
      success: function(value){
             var data = value.split("|");
            $('#owner_id').val(data[0]);
            $('#pmt_owner_name').val(data[1]);
        }
    }); 


	}
</script>