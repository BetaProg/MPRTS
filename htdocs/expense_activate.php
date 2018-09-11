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

<center><h5>De-Activated Expenses</h5></center>
	<?php 
		if(substr($user_access_code, 0, 2)=='AA'){

			$get_deleted_expense_details = mysql_query("SELECT * from mprts_expenses where SUBSTR(expense_access_code, -1) = 'D'");
			$deleted_expense_count = mysql_num_rows($get_deleted_expense_details);
			if($deleted_expense_count==0){
				echo "<center><h5>No Deactivated Expenses</h5></center>";
			}
			else{
				
				echo "
					<table class='striped'>
					    <thead class=''>
					      <tr>
					          <th>Expense Id</th>
				          	  <th>Date</th>
				          	  <th>Amount</th>
				              <th>Cause</th>
					      </tr>
					    </thead>
					    <tbody>

				";
			
			while($deleted_expenses = mysql_fetch_array($get_deleted_expense_details)) {
				$expense_id = $deleted_expenses['expense_id'];
				$expense_date = $deleted_expenses['expense_date'];
				$expense_amount = $deleted_expenses['expense_amount'];
				$expense_cause = $deleted_expenses['expense_cause'];

			// }
			// echo $owner_id.'-'.$owner_name.'-'.$owner_mobile.'-'.$owner_email;

			echo "
				<tr class=''>
					<td>$expense_id</td>
		            <td>$expense_date</td>
		            <td>$expense_amount</td>
		            <td>$expense_cause</td>
		            
		            <td>
		            	 <div class='switch'>
						    <label>
						      De-Activate
						    <input type='checkbox' id='$expense_id' onchange='update_expense_status(this.id);'>
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
		function update_expense_status(expense_id){
			$.ajax({
			      url: "update_expense_status.php",
			      data: {
			        id: expense_id
			      },
			      type: 'post',
			      cache: false,
			      success: function(update_expense_status_html){
			          // $('.record_details').html(update_owner_status_html);
			          window.location = 'expense_content.php';
			      }
			    })
			
		}
	</script>