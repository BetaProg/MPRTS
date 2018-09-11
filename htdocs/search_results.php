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
		              <th>Owner Id</th>
		              <th>Name</th>
		              <th>Mobile</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 
					$access_type = substr($user_access_code, 0, 2);
					if(isset($_POST["search_owner"])){
						$owner_name = $_POST['search_owner'];
						//$owner_name = "Kishore";

						if($access_type == 'MM'){

							$owners_details_sql = "select * from mprts_owner where owner_name like '%$owner_name%' order by owner_id desc";
						}
						else if($access_type == 'AA'){
							$owners_details_sql = "SELECT * from mprts_owner where substr(access_code, 3, 4) = substr('$user_access_code', 3, 4) and  substr(access_code, -1)!='D' and owner_name like '%$owner_name%'";
						}

						$owners_details_execute = mysql_query($owners_details_sql);
			
						$owners_count = mysql_num_rows($owners_details_execute);
						
						if($owners_count==0){
							echo "<center><h5>No Records found..!</h5></center>";
						}

							while($row = mysql_fetch_array($owners_details_execute)){
							$owner_id = $row['owner_id'];
							$owner_name = $row['owner_name'];
							$owner_mobile = $row['owner_mobile'];
							$owner_address = $row['owner_address'];
							$owner_email = $row['owner_email'];
						
							$get_onr_id_sql = mysql_query("select concat('ONR', owner_id) as owner_id  from mprts_owner where owner_id = $owner_id");
							$onr_id_row = mysql_fetch_array($get_onr_id_sql);
							$onr_id = $onr_id_row['owner_id'];
							
							echo "
								<tr class=''>
									<td><a class='drilldown' id='$owner_id' onclick='show_details(this.id);'>$onr_id</a></td>
						            <td>$owner_name</td>
						            <td>$owner_mobile</td>
					          	</tr>
							";
							
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