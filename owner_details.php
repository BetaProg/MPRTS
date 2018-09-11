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
	
	<?php 
	$access_type = substr($user_access_code, 0, 2);
	if($access_type == 'AA'){
		
	}
	else if($access_type == 'OO'){
			echo "<style>
				.edit_owner, .delete_owner {
				display:none !important;
				}
				</style>";
	}

		$accno = $_POST['id'];
		// echo $accno;
		$show_user_sql = "select * from mprts_owner where owner_name='$accno' or owner_id='$accno'";
		$show_user_execute = mysql_query($show_user_sql);
		while ($row = mysql_fetch_array($show_user_execute)) {
			$owner_id = $row['owner_id'];
			$owner_name = $row['owner_name'];
			$owner_photo = $row['owner_photo'];
			$owner_mobile = $row['owner_mobile'];
			$owner_address = $row['owner_address'];
			$owner_location = $row['owner_location'];
			$owner_email = $row['owner_email'];
			$owner_id_proof = $row['owner_id_proof'];
			// echo $owner_name;

		}
	?>
<div class="right_content1">
	<!-- <div class="sub_title_bar">
		<h5><a href='index.php'>Admin Dashboard</a> - <a href="owner_content.php">Owner Details</a> - <b><?php echo $owner_name; ?></b></h5>
	</div> -->

	<div class="row main_sub_title_bar">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Admin Dashboard</a> - <a href="owner_content.php">Owner Details</a> - <b><?php echo $owner_name; ?></b></h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
  			<button class="btn waves-effect waves-light delete_owner" title="Delete" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" id='<?php echo $owner_id; ?>' onclick="delete_owner(this.id);">In-Activate
    			<i class="material-icons right">delete</i>
  			</button>
  			<button class="btn waves-effect waves-light edit_button edit_owner" title="Edit" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" id='<?php echo $owner_id; ?>'  onclick="edit_owner(this.id);">Edit
    			<i class="material-icons right">edit</i>
  			</button>
		</div>
	</div>
	
	<!-- ---------------------------------------- Sub View Container Starts ------------------------------------------ -->

			<div class="resp_sub_title_bar">
				<div class="row details_container">
					<div class="row details_title_container">
						<div class="col s9" style="padding-top: 2%;padding-left: 5%;">
							<h5 class="content_name"><b><?php echo $owner_name; ?></b></h5>					
						</div>
						<div class="col s3" style="padding-left:0px;padding-right: 0px;">
				  			<button class="btn waves-effect waves-light edit_button edit_owner" title="Edit" style="float: left;background-color: #f2f2f2;color:#000;margin:10% auto 10% 2%;border-radius: 5px;padding-left: 10px;padding-right: 10px;" id='<?php echo $owner_id; ?>'  onclick="edit_owner_resp(this.id);">
				    			<i class="material-icons" style="font-size: 15px;">edit</i>
				  			</button>
				  			<button class="btn waves-effect waves-light delete_asset edit_owner" title="Delete" style="float: left;background-color: #f2f2f2;color:#000;margin:10% auto 10% 10%;border-radius: 5px;padding-left: 10px;padding-right: 10px;" id='<?php echo $owner_id; ?>'  onclick="delete_owner(this.id);">
				    			<i class="material-icons" style="font-size: 15px;color: red;">delete</i>
				  			</button>		
						</div>
					</div>
					<h5 class="pagination"><a href="owner_content.php">Owner Details</a> / <b><?php echo $owner_name; ?></b></h5>
					<!--<p class="resp_owner_name"><b><?php echo $owner_name; ?></b></p>-->
					
					<div class="resp_owner_image z-depth-2">
						<center>
							<img src="<?php echo $owner_photo; ?>">
						</center>
					</div>
					<div class="border_it">
						<div class="row resp_owner_address_content">
							<div class="col s2 resp_location_icon">
								<i class='material-icons location_icon'>location_on</i>	
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $owner_address ?></h5> 
							</div>
						</div>


						<div class="row resp_owner_address_content">
							<div class="col s2 resp_location_icon">
								<i class='material-icons phone_android'>phone_android</i>	
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $owner_mobile ?></h5> 
							</div>
						</div>

						<div class="row resp_owner_address_content">
							<div class="col s2 resp_location_icon">
								<i class='material-icons mail_outline'>mail_outline</i>
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $owner_email ?></h5>
							</div>
						</div>
					</div>
				</div>

				<div class="resp_sub_view_container">
					
					<div class="row">
					    <div class="col s12">
					      <ul class="tabs">
					        <li class="tab col s3"><a class="active" href="#resp_owner_tenants">Tenants</a></li>
					        <li class="tab col s3"><a href="#resp_owner_assets">Assets</a></li>
					        <li class="tab col s3"><a href="#resp_owner_payments">Payments</a></li>
					        <li class="tab col s3"><a href="#resp_owner_image">Owner ID</a></li>
					      </ul>
					    </div>
					    <div id="resp_owner_tenants" class="col s12">
					    	<table class="striped tenants_table" style="font-size: 13px;">
						        <thead>
						          <tr>
						              <th>Tenant Id</th>
						              <th>Name</th>
						              <th>Mobile</th>
						              <th>Flat</th>
						          </tr>
						        </thead>
						        <tbody>
									<?php
							    	$get_tenants_sql = "select * from mprts_tenants where tenant_owner_id = $owner_id and substr(access_code, -1)!='D'";
							    	$get_tenants_execute = mysql_query($get_tenants_sql);
									$get_tenants_count = mysql_num_rows($get_tenants_execute);
									if($get_tenants_count==0){
										echo "<center><h5>No Tenants found..!</h5></center>";
										echo "<style>.tenants_table{display:none;}</style>";
									}
						    		$i=0;
						    			while($row = mysql_fetch_array($get_tenants_execute)){
						    				$tenant_id = $row['tenant_id'];
						    				$tenant_name = $row['tenant_name'];
						    				$tenant_mobile = $row['tenant_mobile'];
						    				$tenant_email = $row['tenant_email'];
						    				$tenant_propid = $row['tenant_propid'];

						    				$get_tnt_id_sql = mysql_query("select concat('TNT', tenant_id) as tenant_id, concat('AST', tenant_propid) as tenant_propid  from mprts_tenants where tenant_id = $tenant_id");
											$tnt_id_row = mysql_fetch_array($get_tnt_id_sql);
											$tnt_id = $tnt_id_row['tenant_id'];
											$ast_id = $tnt_id_row['tenant_propid'];
											

										echo "
											<tr>
									            <td><a class='drilldown' id='$tenant_id' onclick='show_tenant_details(this.id);'>$tnt_id</a></td>
									            <td>$tenant_name</td>
									            <td>$tenant_mobile</td>
									            <td><a class='drilldown' id='$tenant_propid' onclick='show_property_details(this.id);'>$ast_id</a></td>
								          	</tr>
										";
										$i++;
										}
									?>
						        </tbody>
						     </table>
					    </div>
					    <div id="resp_owner_assets" class="col s12">
					    	<div class="row owner_properties_card">
						    	<?php 
						    		$show_property_sql = "select * from mprts_property where prty_owner = $owner_id";
						    		$show_property_execute = mysql_query($show_property_sql);
									if(mysql_num_rows($show_property_execute)==0){
										echo "<center><h5>No Assets found..!</h5></center>";
									}
						    		if(mysql_num_rows($show_property_execute)>0){
						    			while($row = mysql_fetch_array($show_property_execute)){
						    				$prty_id = $row['prty_id'];
						    				$prty_image = $row['prty_image'];
						    				$prty_location = $row['prty_location'];
						    				$prty_address = $row['prty_address'];

							$get_ast_id_sql = mysql_query("select concat('AST', prty_id) as prty_id  from mprts_property where prty_id = $prty_id");
										$ast_id_row = mysql_fetch_array($get_ast_id_sql);
										$ast_id = $ast_id_row['prty_id'];



						    			echo "<div class='col s6 z-depth-2'>
						    			<div class='row property_card'>
						    				<div class='col s12 owner_property_image'>
						    					<img src='images/property1.jpg'>
						    				</div>
						    				<div class='col s12 owner_property_id'>
						    					<div class='row'>
						    						<div class='col s4'>
						    							<label>Id:</label>
						    						</div>
						    						<div class='col s8'>
						    							<a href='#' id='$prty_id' onclick='show_property_details(this.id);'>$ast_id</a>
						    						<!--<a href='#' id='$prty_id'>$prty_id</a>	-->
						    						</div>
						    					</div>
						    				</div>
						    				<div class='col s12 owner_property_location'>
						    					<div class='row'>
						    						<div class='col s4'>
						    							<label>Location:</label>
						    						</div>
						    						<div class='col s8'>
						    							<a href='#'>$prty_location</a>	
						    						</div>
						    					</div>
						    				</div>
						    				<!--<div class='col s12 owner_property_address'>
						    					<div class='row'>
						    						<div class='col s4'>
						    							<label>Address:</label>
						    						</div>
						    						<div class='col s8'>
						    							<a href='#' style='text-align:justify;'>$prty_address</a>	
						    						</div>
						    					</div>
						    				</div>-->
						    			</div>
						    		</div>";
						    			}
						    		}
						    	?>
			    			</div>
					    </div>
					    <div id="resp_owner_payments" class="col s12">
					    	<table class="striped payments_table" style="font-size: 13px;">
						        <thead>
						          <tr>
						          	  <th>Receipt No</th>
						          	  <th>Payee Id</th>
						              <th>Payment Date</th>
						              <th>Amount Paid</th>
						          </tr>
						        </thead>
						        <tbody>
									<?php 
										//$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_pmt_tnt in (select tenant_id from mprts_tenants where tenant_owner_id = '$accno') ");
										//$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_pmt_asset in (select prty_id from mprts_property where prty_owner = '$accno') ");
										$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_pmt_asset in (select prty_id from mprts_property where prty_owner = '$owner_id') ");

										$get_payments_count = mysql_num_rows($get_pmt_details);
										if($get_payments_count==0){
											echo "<center><h5>No Payments found..!</h5></center>";
											echo "<style>.payments_table{display:none;}</style>";
										}

										while($row_pmt=mysql_fetch_array($get_pmt_details)){
											$pmt_id = $row_pmt['mprts_pmt_id'];
											//$pmt_tnt = $row_pmt['mprts_pmt_tnt'];
											$pmt_receipt_no = $row_pmt['mprts_receipt_no'];
											if(substr($pmt_receipt_no, -1)=='0'){
												$pmt_tnt = 'ONR'.$row_pmt['mprts_pmt_tnt'];
											}
											else if(substr($pmt_receipt_no, -1)=='1'){
												$pmt_tnt = 'TNT'.$row_pmt['mprts_pmt_tnt'];
											}
											
											$pmt_tnt_occupant = substr($pmt_tnt, 3, 4);
											
											$pmt_date = substr($pmt_receipt_no, 4, 2).'-'.substr($pmt_receipt_no, 2, 2).'-'.'20'.substr($pmt_receipt_no, 0, 2);
											$pmt_act_amt = $row_pmt['mprts_pmt_act_amt'];
											$pmt_paid_amt = $row_pmt['mprts_pmt_paid_amt'];
											$pmt_paid_due = $row_pmt['mprts_pmt_due'];

											$get_asset_sql = mysql_query("SELECT * from mprts_property where prty_id = (select tenant_propid from mprts_tenants where tenant_id = '$pmt_tnt') ");
											while($row_asset = mysql_fetch_array($get_asset_sql)){
												$asset_id = $row_asset['prty_id'];
											}

											echo "
												<tr>
													<td><a class='drilldown' id='$pmt_id' onclick='show_payment_details(this.id);'>$pmt_receipt_no</a></td>
													<td><a class='drilldown' id='$pmt_tnt_occupant' title='$pmt_tnt' onclick='if(((this.title).substr(0,3)==\"ONR\")){show_owner_details(this.id);}else{show_tenant_details(this.id);}'>$pmt_tnt</a></td>
													<td>$pmt_date</td>
													<td>$pmt_paid_amt</td>
												</tr>
											";
										}
									?>
						        </tbody>
					      </table>
					    </div>
					    <div id="resp_owner_image" class="col s12">
					    	<div class="owner_id_image">
								<img src="<?php echo $owner_id_proof; ?>" class="z-depth-4">
							</div>
					    </div>
					</div>

				</div>

			</div>

	<!-- ---------------------------------------- Sub View Container Ends ------------------------------------------ -->






	<div class="owner_details">
		<div class="owner_info">
			<div class="row">
				<div class="col l4">
					<div class="owner_image">
						<img src="<?php echo $owner_photo; ?>" class="z-depth-4">
					</div>
				</div>
				<div class="col l4">
					<div class="owner_name">
						<h5><?php echo $owner_name; ?></h5>
					</div>
					<div class="owner_mobile">
						<h6><?php echo $owner_mobile; ?></h6>
					</div>
					<div class="owner_address">
						<h6><?php echo $owner_address; ?></h6>
					</div>
					<div class="owner_location">
						<h6><?php echo $owner_location; ?></h6>
					</div>
					<div class="owner_email">
						<h6><?php echo $owner_email; ?></h6>
					</div>
				</div>
				<div class="col l4">
					<div class="owner_id_image">
						<img src="<?php echo $owner_id_proof; ?>" class="z-depth-4">
					</div>
				</div>
			</div>
		</div>
		<div class="owner_assets_info">
			
			<div class="row">
			    <div class="col s12 z-depth-2">
			      <ul class="tabs">
			      	<li class="tab col s3"><a class="active" href="#test2">Tenants</a></li>
			        <li class="tab col s3"><a href="#test1">Assets</a></li>
			        <li class="tab col s3"><a href="#test4">Payments</a></li>
			        <li class="tab col s3"><a href="#test3">Vendors</a></li>
			      </ul>
			    </div>
			    <div id="test1" class="col s12 z-depth-3"><!-- Properties -->
			    	<div class="row owner_properties_card">
			    	<?php 
			    		$show_property_sql = "select * from mprts_property where prty_owner = $owner_id";
			    		$show_property_execute = mysql_query($show_property_sql);
			    		if(mysql_num_rows($show_property_execute)>0){
			    			while($row = mysql_fetch_array($show_property_execute)){
			    				$prty_id = $row['prty_id'];
			    				$prty_image = $row['prty_image'];
			    				$prty_location = $row['prty_location'];
			    				$prty_address = $row['prty_address'];

				$get_ast_id_sql = mysql_query("select concat('AST', prty_id) as prty_id  from mprts_property where prty_id = $prty_id");
							$ast_id_row = mysql_fetch_array($get_ast_id_sql);
							$ast_id = $ast_id_row['prty_id'];



			    			echo "<div class='col s3 z-depth-2'>
			    			<div class='row property_card'>
			    				<div class='col s12 owner_property_image'>
			    					<img src='images/property1.jpg'>
			    				</div>
			    				<div class='col s12 owner_property_id'>
			    					<div class='row'>
			    						<div class='col s4'>
			    							<label>Id:</label>
			    						</div>
			    						<div class='col s8'>
			    							<a href='#' id='$prty_id' onclick='show_property_details(this.id);'>$ast_id</a>
			    						<!--<a href='#' id='$prty_id'>$prty_id</a>	-->
			    						</div>
			    					</div>
			    				</div>
			    				<div class='col s12 owner_property_location'>
			    					<div class='row'>
			    						<div class='col s4'>
			    							<label>Location:</label>
			    						</div>
			    						<div class='col s8'>
			    							<a href='#'>$prty_location</a>	
			    						</div>
			    					</div>
			    				</div>
			    				<!--<div class='col s12 owner_property_address'>
			    					<div class='row'>
			    						<div class='col s4'>
			    							<label>Address:</label>
			    						</div>
			    						<div class='col s8'>
			    							<a href='#' style='text-align:justify;'>$prty_address</a>	
			    						</div>
			    					</div>
			    				</div>-->
			    			</div>
			    		</div>";
			    			}
			    		}
			    	?>
			    	</div>
			    </div>
			    <div id="test2" class="col s12 z-depth-3">



				<table class="striped" style="font-size: 13px;">
			        <thead>
			          <tr>
			              <th>Tenant Id</th>
			              <th>Name</th>
			              <th>Mobile</th>
			              <th>Asset</th>
			              <th>Email</th>
			          </tr>
			        </thead>
			        <tbody>
						<?php
				    	$get_tenants_sql = "select * from mprts_tenants where tenant_owner_id = '$owner_id'  and substr(access_code, -1)!='D'";
				    	$get_tenants_execute = mysql_query($get_tenants_sql);
			    		$i=0;
			    			while($row = mysql_fetch_array($get_tenants_execute)){
			    				$tenant_id = $row['tenant_id'];
			    				$tenant_name = $row['tenant_name'];
			    				$tenant_mobile = $row['tenant_mobile'];
			    				$tenant_email = $row['tenant_email'];
			    				$tenant_propid = $row['tenant_propid'];

			    				$get_tnt_id_sql = mysql_query("select concat('TNT', tenant_id) as tenant_id, concat('AST', tenant_propid) as tenant_propid  from mprts_tenants where tenant_id = $tenant_id and tenant_owner_id = '$owner_id'");
								$tnt_id_row = mysql_fetch_array($get_tnt_id_sql);
								$tnt_id = $tnt_id_row['tenant_id'];
								$ast_id = $tnt_id_row['tenant_propid'];
								
								$get_asset_no_sql = mysql_query("SELECT * from mprts_property where prty_id = '$tenant_propid'");
								$asset_no_row = mysql_fetch_array($get_asset_no_sql);
								$tenant_asset_no = $asset_no_row['prty_no'];
								

							echo "
								<tr>
						            <td><a class='drilldown' id='$tenant_id' onclick='show_tenant_details(this.id);'>$tnt_id</a></td>
						            <td>$tenant_name</td>
						            <td>$tenant_mobile</td>
						            <td><a class='drilldown' id='$tenant_propid' onclick='show_property_details(this.id);'>$tenant_asset_no</a></td>
						            <td>$tenant_email</td>
					          	</tr>
							";
							$i++;
							}
						?>
			        </tbody>
			     </table>

			    </div>
			    <div id="test3" class="col s12">Vendors</div>


	<div id="test4" class="col s12 z-depth-3">
			    	
		<div class="row owner_properties_card">
			    		


				<table class="striped" style="font-size: 13px;">
		        <thead>
		          <tr>
		          	  <th>Payment ID</th>
		          	  <th>Payee Id</th>
		              <th>Asset</th>
		              <th>Payment Date</th>
		              <th>Actual Amount</th>
		              <th>Amount Paid</th>
		              <th>Due Amount</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 
						//$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_pmt_tnt in (select tenant_id from mprts_tenants where tenant_owner_id = '$accno') ");
						//$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_pmt_asset in (select prty_id from mprts_property where prty_owner = '$accno') ");
						$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_pmt_asset in (select prty_id from mprts_property where prty_owner = '$owner_id') ");
						while($row_pmt=mysql_fetch_array($get_pmt_details)){
							$pmt_id = $row_pmt['mprts_pmt_id'];
							$pmt_receipt_no = $row_pmt['mprts_receipt_no'];
							if(substr($pmt_receipt_no, -1)=='0'){
								$pmt_tnt = 'ONR'.$row_pmt['mprts_pmt_tnt'];
								$pmt_tnt_ast = substr($pmt_tnt, 3, 4);
								
								$get_asset_sql = mysql_query("SELECT * from mprts_property where prty_owner = $pmt_tnt_ast");
								while($row_asset = mysql_fetch_array($get_asset_sql)){
									$asset_id = $row_asset['prty_id'];
									$asset_no = $row_asset['prty_no'];
								}
							}
							else if(substr($pmt_receipt_no, -1)=='1'){
								$pmt_tnt = 'TNT'.$row_pmt['mprts_pmt_tnt'];
								$pmt_tnt_ast = substr($pmt_tnt, 3, 4);
								
								$get_asset_sql = mysql_query("SELECT * from mprts_property where prty_id = (select tenant_propid from mprts_tenants where tenant_id = $pmt_tnt_ast) ");
								while($row_asset = mysql_fetch_array($get_asset_sql)){
									$asset_id = $row_asset['prty_id'];
									$asset_no = $row_asset['prty_no'];
								}
							}
							$pmt_date = substr($pmt_receipt_no, 4, 2).'-'.substr($pmt_receipt_no, 2, 2).'-'.'20'.substr($pmt_receipt_no, 0, 2);
							$pmt_act_amt = $row_pmt['mprts_pmt_act_amt'];
							$pmt_paid_amt = $row_pmt['mprts_pmt_paid_amt'];
							$pmt_paid_due = $row_pmt['mprts_pmt_due'];
							
							$pmt_tnt_occupant = substr($pmt_tnt, 3, 4);
							

							echo "
								<tr>
									<td><a class='drilldown' id='$pmt_id' onclick='show_payment_details(this.id);'>PMT$pmt_id</a></td>
									<td><a class='drilldown' id='$pmt_tnt_occupant' title='$pmt_tnt' onclick='if(((this.title).substr(0,3)==\"ONR\")){show_owner_details(this.id);}else{show_tenant_details(this.id);}'>$pmt_tnt</a></td>
									<td><a class='drilldown' id='$asset_id' onclick='show_property_details(this.id);'>$asset_no</a></td>
									<td>$pmt_date</td>
									<td>$pmt_act_amt</td>
									<td>$pmt_paid_amt</td>
									<td>$pmt_paid_due</td>
								</tr>
							";
						}
					?>
		        </tbody>
	      </table>
		</div>
	

			    </div>
			</div>

		</div>
	</div>
</div>
<script type='text/javascipt' src='scripts/major_navigate.js'>
</body>
