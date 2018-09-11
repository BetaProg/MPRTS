<?php include 'db_config.php'; ?>


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
	      	  <th>Property ID</th>
	      	  <th>Property Name</th>
	          <th>Property Locality</th>
	      </tr>
	    </thead>
<?php 
	$property_list_sql = mysql_query("select * from mprts_buildings");
	$property_list_count = mysql_num_rows($property_list_sql);
	$i=0;
	while ($i<$property_list_count) {
		$property_list_row  = mysql_fetch_array($property_list_sql);

		$building_id = $property_list_row['building_id'];
		$building_name = $property_list_row['building_name'];
		$building_locality = $property_list_row['building_locality'];

		$get_pty_id_sql = mysql_query("select concat('PTY', building_id) as building_id  from mprts_buildings where building_id = $building_id");
		$pty_id_row = mysql_fetch_array($get_pty_id_sql);
		$pty_id = $pty_id_row['building_id'];

		$table_content = "
			        <tr>
			            <td><a class='drilldown id_field' id='$pty_id' onclick='select_element(this.id);'>$pty_id</a></td>
			            <td><a class='drilldown' id='$building_name'>$building_name</a></td>
			            <td><a class='drilldown' id='$building_locality'>$building_locality</a></td>
		          	</tr>
		          	";
		// $table_row = "
		// 	<div class='row property_model_inner'>
		// 		<div class='col s3'>$pty_id</div>
		// 		<div class='col s6'>$building_name</div>
		// 		<div class='col s3'>$building_locality</div>
		// 	</div>
		// ";
		echo $table_content;
		// echo "<tr><td>$pty_id - $building_name - $building_locality</td></tr>";
		// echo "
		//         <tr>
		//             <td><a class='drilldown id_field' id='$pty_id' onclick='select_element(this.id);'>$pty_id</a></td>
		//             <td><a class='drilldown' id='$building_name'>$building_name</a></td>
		//             <td><a class='drilldown' id='$building_locality'>$building_locality</a></td>
	 //          	</tr>"
	 //          	;

		$i++;
	}
?>
	</table>
</body>
<script type="text/javascript">
	function select_element(selected_id){
		property_id = selected_id;
		Materialize.toast(selected_id+' Selected', 2000);


		 $.ajax({
      url: "get_building_details.php",
      data: {
        id: selected_id
      },
      type: 'post',
      cache: false,
      success: function(value){
      		// console.log(value);
             var data = value.split(",");
            $('#building_name').val(data[0]);
            $('#building_address').val(data[1]);
        }
    }); 


	}
</script>

