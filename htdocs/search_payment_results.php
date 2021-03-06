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
<title>MPRTS | Payments</title>
<?php include 'db_config.php'; ?>
<?php include'headers.php'; ?>

</body>
<div class="right_content">
	<div class="owner_content">
		<div class="resp_owners_table z-depth-3">
			<table class="striped">
		        <thead>
		           <tr>
		          	  <th>Payment ID</th>
		          	  <!--<th>Occupant Name</th>-->
					  <th>Payee Name</th>
		              <th>Asset No.</th>
		              <th>Amount Paid</th>
		              <th>Payment Date</th>
		          </tr>
		        </thead>
		        <tbody>
		        	<?php 
					$access_type = substr($user_access_code, 0, 2);
					if(isset($_POST["search_payment"])){
						$search_payment_id = $_POST['search_payment'];
					if($access_type == 'MM'){
						$payments_details_sql = "select * from mprts_payments where mprts_receipt_no ='$search_payment_id'  order by mprts_pmt_id desc";
					}
					else if($access_type == 'AA'){

						//$payments_details_sql = "SELECT * from mprts_payments where mprts_pmt_asset in (select prty_id from mprts_property where prty_building_id = substr('$user_access_code', 3, 4)) order by mprts_pmt_id desc";

						$payments_details_sql = "SELECT * from mprts_payments where (mprts_receipt_no ='$search_payment_id') and mprts_pmt_asset in (select prty_id from mprts_property where prty_building_id = (select building_id from mprts_buildings where building_access_code = '$user_access_code')) order by mprts_pmt_id desc";



					}
					else if($access_type == 'TT'){
						$payments_details_sql = "SELECT * from mprts_payments where  mprts_receipt_no ='$search_payment_id' and mprts_pmt_tnt in (select tenant_id from mprts_tenants where access_code = '$user_access_code' ) order by mprts_pmt_id desc";
					}
					else if($access_type == 'OO'){
						$payments_details_sql = "SELECT * from mprts_payments where mprts_receipt_no ='$search_payment_id' and mprts_pmt_tnt in (select tenant_id from mprts_tenants where tenant_owner_id in (select owner_id from mprts_owner where access_code = '$user_access_code')) order by mprts_pmt_id desc";

						echo "<style>
							#add_payment {
							display:none !important;
							}
							</style>";
					}
						$payments_details_execute = mysql_query($payments_details_sql);
						$payments_count = mysql_num_rows($payments_details_execute);
						
						if($payments_count==0){
							echo "<center><h5>No Records found..!</h5></center>";
						}
						
						$j=0;
						while($j<$payments_count){
							$row = mysql_fetch_array($payments_details_execute);
							$mprts_pmt_id = $row['mprts_pmt_id'];
							$mprts_pmt_tnt = $row['mprts_pmt_tnt'];
							$mprts_pmt_act_amt = $row['mprts_pmt_act_amt'];
							$mprts_pmt_asset = $row['mprts_pmt_asset'];
							$mprts_pmt_paid_amt = $row['mprts_pmt_paid_amt'];
							$mprts_receipt_no = $row['mprts_receipt_no'];

							$pmt_date = substr($mprts_receipt_no, 4, 2).'-'.substr($mprts_receipt_no, 2, 2).'-'.'20'.substr($mprts_receipt_no, 0, 2);
							$pmt_month = substr($mprts_receipt_no, 2, 2);

							$get_pmt_id_sql = mysql_query("SELECT concat('PMT', mprts_pmt_id) as mprts_pmt_id  from mprts_payments where mprts_pmt_id = $mprts_pmt_id");
							$pmt_id_row = mysql_fetch_array($get_pmt_id_sql);
							$pmt_id = $pmt_id_row['mprts_pmt_id'];

							$j++;

						if(substr($mprts_receipt_no, -1) == 1){

							$get_tenant_sql = "select * from mprts_tenants where tenant_id = $mprts_pmt_tnt";
							$get_tenant_execute = mysql_query($get_tenant_sql);
							$get_tenant_count = mysql_num_rows($get_tenant_execute);
							$i=0;
							while($i<$get_tenant_count){
								$row_tenant = mysql_fetch_array($get_tenant_execute);
								$tenant_id1 = $row_tenant['tenant_id'];
								$tenant_propid = $row_tenant['tenant_propid'];
								$tenant_owner_id = $row_tenant['tenant_owner_id'];
								$tenant_name = $row_tenant['tenant_name'];

								$get_tnt_id_sql = mysql_query("select concat('TNT', tenant_id) as tenant_id, concat('AST', tenant_propid) as tenant_propid  from mprts_tenants where tenant_id = $tenant_id1");
								$tnt_id_row = mysql_fetch_array($get_tnt_id_sql);
								$tenant_id = $tnt_id_row['tenant_id'];
								$ast_id = $tnt_id_row['tenant_propid'];

								$i++;
							}



							$get_rent_details = "select * from mprts_property where prty_id = $mprts_pmt_asset";
							$get_rent_execute = mysql_query($get_rent_details);
							$get_rent_count = mysql_num_rows($get_rent_execute);
							$l=0;
							while($l<$get_rent_count){
								$row_rent = mysql_fetch_array($get_rent_execute);
								$prty_rent = $row_rent['prty_rent'];
								$prty_no = $row_rent['prty_no'];
								$l++;
							}
						}
						else if(substr($mprts_receipt_no, -1) == 0){

							$get_owner_sql = mysql_query("SELECT * from mprts_owner where owner_id = $mprts_pmt_tnt");
							$get_owner_count = mysql_num_rows($get_owner_sql);
							$m=0;
							while($m<$get_owner_count){
								$row_owner = mysql_fetch_array($get_owner_sql);
								$tenant_id1 = 'ONR'.$row_owner['owner_id'];
								$tenant_owner_id = $row_owner['owner_id'];
								$tenant_name = $row_owner['owner_name'];

								// $get_tnt_id_sql2 = mysql_query("SELECT concat('ONR', owner_id) as owner_id from mprts_owner where owner_id = $tenant_id");
								// $tnt_id_row2 = mysql_fetch_array($get_tnt_id_sql2);
								// $tnt_id = $tnt_id_row2['owner_id'];
								// $ast_id = $tnt_id_row['tenant_propid'];

								$m++;
							}



							$get_rent_details = "select * from mprts_property where prty_id = '$mprts_pmt_asset'";
							$get_rent_execute = mysql_query($get_rent_details);
							$get_rent_count = mysql_num_rows($get_rent_execute);
							$l=0;
							while($l<$get_rent_count){
								$row_rent = mysql_fetch_array($get_rent_execute);
								$prty_rent = $row_rent['prty_rent'];
								$ast_id = 'AST'.$row_rent['prty_id'];
								$l++;
							}
						}
						
						$due_amount = $mprts_pmt_act_amt - $mprts_pmt_paid_amt;
						$pmt_date = substr($mprts_receipt_no, 4, 2).'-'.substr($mprts_receipt_no, 2, 2).'-'.'20'.substr($mprts_receipt_no, 0, 2);

						echo "
								<tr class=''>
						            <td><a class='drilldown' id='$mprts_pmt_id' onclick='show_payment_details(this.id);'>$mprts_receipt_no</a></td>
						            <td><a class='drilldown' id='$mprts_pmt_tnt' title='$tenant_id1' onclick='if(((this.title).substr(0,3)==\"ONR\")){show_owner_details(this.id);}else{show_tenant_details(this.id);}'>$tenant_name</a></td>
						            <td><a class='drilldown' id='$mprts_pmt_asset' onclick='show_property_details(this.id);'>$ast_id</a></td>
						            <td>$mprts_pmt_paid_amt</td>
						            <td>$pmt_date</td>
					          	</tr>
							";
						}
					}
					?>
		        </tbody>
		    </table>
		</div>

		
	</div>
	<script>
		function search_payment_results(search_payment){
			$('.resp_owners_table').html("<img src='images/preloader.gif'/>");
				$.ajax({
				  url: "search_payment_results.php",
				  data: {
					search_payment: search_payment
				  },
				  type: 'post',
				  cache: false,
				  success: function(search_payment_html){
					  //if(screen.availWidth<=414){
						  console.log(search_payment_html);
						$('.resp_owners_table').html(search_payment_html);
						//document.write(search_owner_html);
					  //}
					  //else{
						//$('.resp_owners_table').load('search_results.php');
					  //}
				  }
				});
		}
		function show_payment_details(payment_id) {
			$('.record_details').html("<img src='images/preloader.gif'/>");
			//$('.right_content').html("<img src='images/preloader.gif'/>");
			 $.ajax({
			  url: "payment_details.php",
			  data: {
				id: payment_id
			  },
			  type: 'post',
			  cache: false,
			  success: function(html){
				  if(screen.availWidth<=414){
					$('.right_content').html(html);
				  }
				  else{
					$('.record_details').html(html);
				  }
			  }
			})
		  }
	</script>