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
<?php include'db_config.php'; ?>
<?php include'headers.php'; ?>
<div class="owner_content">
		<div class="owner_content_actions">
			<div class="row">
				<div class="col s3">
				</div>
				
			</div>
		</div>
		
		<div class="owners_table z-depth-3">
			<table class="striped">
		        <thead class="main_head">
		          <tr>
		              <th>Notes Id</th>
		              <th>Date</th>
		              <th>Category</th>
		              <th>Description</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 
					$access_type = substr($user_access_code, 0, 2);
					if($access_type == 'MM'){

						$notes_details_sql = "SELECT * from mprts_notes order by notes_id desc";
					}
					else if($access_type == 'AA'){

						$notes_details_sql = "SELECT * from mprts_notes where notes_access_code = '$user_access_code'";

					}

						$notes_details_execute = mysql_query($notes_details_sql);
			
						$notes_count = mysql_num_rows($notes_details_execute);

							while($row = mysql_fetch_array($notes_details_execute)){
								$notes_id = $row['notes_id'];
								$notes_date = $row['notes_date'];
								$notes_category = $row['notes_category'];
								$notes_description = $row['notes_description'];
								
								echo "
									<tr class=''>
										<td><a class='drilldown' id='$notes' onclick='show_notes_details(this.id);'>$notes_id</a></td>
							            <td>$notes_date</td>
							            <td>$notes_category</td>
							            <td>$notes_description</td>
						          	</tr>
								";
							
						}

						
					?>
		        </tbody>
	      </table>
		</div>


		<div class="record_details" title="Owner Details">
			
		</div>
	</div>