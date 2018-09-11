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

<center><h5>De-Activated Owners</h5></center>
	<?php 
		if(substr($user_access_code, 0, 2)=='AA'){

			$get_deleted_owner_details = mysql_query("SELECT * from mprts_owner where substr(access_code, -1) = 'D'");
			$deleted_owners_count = mysql_num_rows($get_deleted_owner_details);
			if($deleted_owners_count==0){
				echo "<center><h5>No Deleted users</h5></center>";
			}
			else{
				echo "
					<table class='striped'>
					    <thead class=''>
					      <tr>
					          <th>Owner Id</th>
					          <th>Name</th>
					          <th>Mobile</th>
					          <th class='desk'>Email</th>
					          <th>Status</th>
					      </tr>
					    </thead>
					    <tbody>

				";
				
			
			while($deleted_owners = mysql_fetch_array($get_deleted_owner_details)) {
				$owner_id = $deleted_owners['owner_id'];
				$owner_name = $deleted_owners['owner_name'];
				$owner_mobile = $deleted_owners['owner_mobile'];
				$owner_email = $deleted_owners['owner_email'];
			// }
			// echo $owner_id.'-'.$owner_name.'-'.$owner_mobile.'-'.$owner_email;

			echo "
				<tr class=''>
					<td><a class='drilldown' id='$owner_id'>$owner_id</a></td>
		            <td>$owner_name</td>
		            <td>$owner_mobile</td>
		            <td class='desk'>$owner_email</td>
		            <td>
		            	 <div class='switch'>
						    <label>
						      De-Activate
						    <input type='checkbox' id='$owner_id' onchange='update_owner_status(this.id);'>
						    <span class='lever'></span>
						      Activate
						    </label>
						</div>
		            </td>
	          	</tr>

	          	
			";
			}
		}
		
	}	
	?>
	<script type="text/javascript">
		function update_owner_status(owner_id){
			$.ajax({
			      url: "update_owner_status.php",
			      data: {
			        id: owner_id
			      },
			      type: 'post',
			      cache: false,
			      success: function(update_owner_status_html){
			          // $('.record_details').html(update_owner_status_html);
			          window.location = 'owner_content.php';
			      }
			    })
			
		}
	</script>