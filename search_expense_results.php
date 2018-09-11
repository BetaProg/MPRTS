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
		<div class="resp_owners_table resp_expense_details">
			<table class="striped">
		        <thead>
		          <tr>
		              <th>Expense ID</th>
		              <th>Date</th>
		              <th>Amount</th>
		              <th>Cause</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php
						$access_type = substr($user_access_code, 0, 2);
						if(isset($_POST["search_expense"])){
						$search_expense_cause = $_POST['search_expense'];
						if($access_type == 'MM'){
							$building_details_sql = "SELECT * from mprts_expenses where expense_cause like '%$search_expense_cause%' order by expense_id desc";
						}
						else if($access_type == 'AA'){
							$expense_details_sql = "SELECT * from mprts_expenses where expense_cause like '%$search_expense_cause%' and expense_access_code = '$user_access_code' order by expense_id desc";
						echo "<style>
								#add_building,  .delete_property {
									display:none !important;
								}
							</style>";
						} 

						else if($access_type == 'OO'){							
							echo "<style>
								.edit_building, #add_expense {
									display:none !important;
								}
								</style>";
						}
						
						$expense_details_execute = mysql_query($expense_details_sql);
						$expense_count = mysql_num_rows($expense_details_execute);
						
						if($expense_count==0){
							echo "<center><h5>No Records found..!</h5></center>";
						}
						
						$i=0;
						while($i<$expense_count){
							$row = mysql_fetch_array($expense_details_execute);
							$expense_id = $row['expense_id'];
							$expense_date = $row['expense_date'];
							$expense_amount = $row['expense_amount'];
							$expense_cause = $row['expense_cause'];
							$expense_description = $row['expense_description'];
							$expense_access_code = $row['expense_access_code'];
							
							echo "
								<tr class=''>
						            <td><a class='drilldown' id='$expense_id' onclick='show_expense_details(this.id);'>EXP$expense_id</a></td>
						            <td>$expense_date</td>
						            <td>$expense_amount</td>
						            <td>$expense_cause</td>
					          	</tr>
							";
							
							echo "
								<div class='resp_content resp_expense_content z-depth-1'></div>
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