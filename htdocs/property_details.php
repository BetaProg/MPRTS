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
<title>MPRTS | Property Details</title>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
	
	<?php 
		$prop_id = $_POST['id'];
		$show_prop_sql = "SELECT * from mprts_property where prty_id='$prop_id'";
		$show_prop_execute = mysql_query($show_prop_sql);
		while ($row = mysql_fetch_array($show_prop_execute)) {
			$prty_id = $row['prty_id'];
			$prty_location = $row['prty_location'];
			$prty_image = $row['prty_image'];
			$prty_owner = $row['prty_owner'];
			$prty_rent = $row['prty_rent'];
			$prty_address = $row['prty_address'];
			$prty_no = $row['prty_no'];
			$prty_type = $row['prty_type'];
			$prty_rooms = $row['prty_rooms'];
			$prty_current_meter = $row['prty_current_meter'];
			$prty_gas_meter = $row['prty_gas_meter'];
			$prty_water_meter = $row['prty_water_meter'];
			// $prty_intercomm_meter = $row['prty_intercomm_meter'];
			// $prty_gas_meter = $row['prty_gas_meter'];
			// $prty_sqft = $row['prty_sqft'];
			$prty_building_id = $row['prty_building_id'];



			$get_ast_id_sql = mysql_query("SELECT concat('AST', prty_id) as prty_id from mprts_property where prty_id = $prty_id");
			$ast_id_row = mysql_fetch_array($get_ast_id_sql);
			$ast_id = $ast_id_row['prty_id'];
		}

		$show_owner_sql = "SELECT * from mprts_owner where owner_id='$prty_owner'";
		$show_owner_execute = mysql_query($show_owner_sql);
		while ($row_owner = mysql_fetch_array($show_owner_execute)) {
			$owner_name = $row_owner['owner_name'];
			$owner_email = $row_owner['owner_email'];
			$owner_mobile = $row_owner['owner_mobile'];
		}

		$show_building_sql = "SELECT * from mprts_buildings where building_id='$prty_building_id'";
		$show_building_execute = mysql_query($show_building_sql);
		while ($row_building = mysql_fetch_array($show_building_execute)) {
			$building_id = $row_building['building_id'];
			$building_type = $row_building['building_type'];
			$building_name = $row_building['building_name'];
			$building_phno = $row_building['building_phno'];
			$building_locality = $row_building['building_locality'];
			$building_city = $row_building['building_city'];
			$building_state = $row_building['building_state'];
			$building_pincode = $row_building['building_pincode'];


			$prty_address = $building_locality.'-'.$building_city.'-'.$building_state;
		}
	?>
<style type="text/css">
	.owner_assets_info .s12 .s4 .s4{
		padding-left: 0px !important;
		padding-right: 0px !important;
	}
</style>
<div class="right_content2" title="Asset Details">
	<!-- <div class="sub_title_bar">
		<h5><a href='index.php'>Admin Dashboard</a> - <a href="property_content.php">Flat Details</a> - <b><?php echo $ast_id; ?></b></h5>
	</div> -->

	<div class="row main_sub_title_bar">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Dashboard</a> - <a href="building_content.php"><?php echo $prty_type; ?> Details</a> - <b><?php echo $prty_no; ?></b></h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
  			<button class="btn waves-effect waves-light delete_asset" title="Delete" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="">Delete
    			<i class="material-icons right">delete</i>
  			</button>
  			<button class="btn waves-effect waves-light edit_button edit_asset" title="Edit" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" id='<?php echo $prty_id; ?>'  onclick="edit_asset(this.id);">Edit
    			<i class="material-icons right">edit</i>
  			</button>
		</div>
	</div>

	<!-- ---------------------------------------- Sub Title Container Starts ------------------------------------------ -->

	<div class="resp_sub_title_bar">
				<div class="row details_container">
					<div class="row top_asset_details_bar">
						<div class="col s8">
							<h5 class="content_name"><b>Asset Details: <?php echo $prty_no; ?></b></h5>					
						</div>
						<div class="col s4">
				  			<button class="btn waves-effect waves-light edit_button edit_owner" title="Edit" style="float: left;background-color: #f2f2f2;color:#000;margin:10% auto 10% 2%;border-radius: 5px;padding-left: 10px;padding-right: 10px;" id='<?php echo $prty_id; ?>'  onclick="edit_asset(this.id);">
				    			<i class="material-icons" style="font-size: 15px;">edit</i>
				  			</button>
				  			<button class="btn waves-effect waves-light delete_asset edit_owner" title="Delete" style="float: left;background-color: #f2f2f2;color:#000;margin:10% auto 10% 10%;border-radius: 5px;padding-left: 10px;padding-right: 10px;" id='<?php echo $prty_id; ?>'  onclick="edit_asset(this.id);">
				    			<i class="material-icons" style="font-size: 15px;color: red;">delete</i>
				  			</button>		
						</div>
					</div>
					<h5 class="pagination"><a href="property_content.php">Asset Details</a> - <b><?php echo $prty_no.' - '.'<label style="font-size:15px;">'.$prty_rooms.'BHK'.'</label>'; ?></b></h5>
					<!--<h class="resp_asset_no"><b><?php echo $prty_no.' - '.'<label style="font-size:15px;">'.$prty_rooms.'BHK'.'</label>'; ?></b></h>-->
					<div class="resp_owner_image z-depth-2">
						<center>
							<img src="<?php echo $prty_image; ?>">
						</center>
					</div>

					<div class="border_it">
						<div class="row resp_owner_address_content">
							<div class="col s2 resp_location_icon">
								<i class='material-icons location_icon'>location_on</i>	
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $prty_address ?></h5> 
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
								<i class="material-icons person_outline">person_outline</i>
							</div>
							<div class="col s10 resp_building_address">
								<a href='#' id='<?php echo $prty_owner ?>' onclick='show_owner_details(this.id);'><h6><?php echo $owner_name; ?></h6></a>
							</div>
						</div>

						<div class="row resp_owner_address_content">
							<div class="col s2 resp_location_icon">
								<i class="material-icons location_city">location_city</i>
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $building_name ?></h5>
							</div>
						</div>
						
						<div class="row resp_owner_address_content">
							<div class="col s2 resp_location_icon">
								<i class="material-icons location_city">power</i>
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $prty_current_meter ?></h5>
							</div>
						</div>
						
						<div class="row resp_owner_address_content">
							<div class="col s2 resp_location_icon">
								<i class="material-icons location_city">local_gas_station</i>
								<!--<img src="images/icons/gas.png" />-->
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $prty_gas_meter ?></h5>
							</div>
						</div>
						
						<div class="row resp_owner_address_content">
							<div class="col s2 resp_location_icon">
								<i class="material-icons location_city">opacity</i>
								<!--<img src="images/icons/tap.png" />-->
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $prty_water_meter ?></h5>
							</div>
						</div>
					</div>

				</div>
				<!-- ---------------------------------------- Sub View Container Starts ------------------------------------------ -->
			<div class="resp_sub_view_container">
				<div class="row">
				    <div class="col s12">
				      <ul class="tabs">
				        <li class="tab col s3"><a class="active" href="#resp_asset_tenants">Tenants</a></li>
				        <li class="tab col s3"><a href="#resp_asset_payments">Payments</a></li>
				      </ul>
				    </div>
				    <div id="resp_asset_tenants" class="col s12"><!-- Assets -->
				    	

				    	<?php 

						$access_type = substr($user_access_code, 0, 2);
						$access_type = substr($user_access_code, 0, 2);
						if($access_type == 'MM'){

					    	$get_tenants_sql = "SELECT * from mprts_tenants where tenant_propid = '$prop_id'";
				    	}
						else if($access_type == 'AA'){

					    	$get_tenants_sql = "SELECT * from mprts_tenants where tenant_propid = '$prop_id'";
				    	}
				    	else if($access_type == 'OO'){

					    	$get_tenants_sql = "SELECT * from mprts_tenants where tenant_propid = '$prop_id'";
				    	}
						else if($access_type == 'TT'){

					    	$get_tenants_sql = "SELECT * from mprts_tenants where access_code = '$user_access_code'";
				    	}
				    	// $get_tenants_sql = "select * from mprts_tenants where tenant_propid = '$tenant_propid'";
				    	$get_tenants_execute = mysql_query($get_tenants_sql);
						$get_tenants_count = mysql_num_rows($get_tenants_execute);
						if($get_tenants_count==0){
							echo "<center><h5>No Tenants found..!</h5></center>";
						}
			    		// $i=0;
			    			while($row = mysql_fetch_array($get_tenants_execute)){
			    				$tenant_id = $row['tenant_id'];
			    				$tenant_name = $row['tenant_name'];
			    				$tenant_mobile = $row['tenant_mobile'];
			    				$tenant_propid = $row['tenant_propid'];
			    				$tenant_email = $row['tenant_email'];

			    				$get_tnt_id_sql = mysql_query("SELECT concat('TNT', tenant_id) as tenant_id, concat('AST', tenant_propid) as tenant_propid  from mprts_tenants where tenant_id = '$tenant_id' and tenant_propid = '$tenant_propid'");
							$tnt_id_row = mysql_fetch_array($get_tnt_id_sql);
							$tnt_id = $tnt_id_row['tenant_id'];
							$ast_id = $tnt_id_row['tenant_propid'];

							echo "
								<div class='resp_content resp_asset_content z-depth-1 drilldown' onclick='show_tenant_details(this.id);' id='$tenant_id'>
									<div class='row asset_list_row'>
										<div class='col s2 asset_no_col'>
											$prty_no
										</div>
										<div class='col s6'>
											<div class='row'>
												<div class='col s12 asset_owner_col'>
													<h5>$tenant_name</h5>
												</div>
												<div class='col s12 asset_id_col'>
													<h5>TNT$tenant_id</h5>
												</div>
											</div>
										</div>
										<div class='col s4 asset_rooms_col'>
											<h5>$prty_rooms</h5>BHK
										</div>
									</div>
								</div>
							";
							$i++;
						}
					?>


				    </div>
				    <div id="resp_asset_payments" class="col s12">



	    	<table class="striped payments_table" style="font-size: 13px;">
		        <thead>
		          <tr>
		          	  <th>Receipt No.</th>
		              <th>Asset</th>
		              <th>Payment Date</th>
		              <th>Amount Paid(₹)</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 
						//$get_pmt_details = mysql_query("SELECT * from mprts_payments where substr(mprts_access_code, 3, 4) = $building_id");
						$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_pmt_asset = '$prop_id'");
						if( mysql_num_rows($get_pmt_details)==0 ){
							echo "<center><h5>No Payments found..!</h5></center>";
							echo "<style>.payments_table{display:none;}</style>";
						}
						while($row_pmt=mysql_fetch_array($get_pmt_details)){
							$pmt_id = $row_pmt['mprts_pmt_id'];
							//$pmt_tnt = $row_pmt['mprts_pmt_tnt'];
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

							/*$get_asset_sql = mysql_query("SELECT * from mprts_property where prty_id = (select tenant_propid from mprts_tenants where tenant_id = $pmt_tnt) ");
							while($row_asset = mysql_fetch_array($get_asset_sql)){
								$asset_id = $row_asset['prty_id'];
								$asset_no = $row_asset['prty_no'];
							}*/
							if($get_asset_sql){
								echo "
								<tr>
									<td><a class='drilldown' id='$pmt_id' onclick='show_payment_details(this.id);'>$pmt_receipt_no</a></td>
									<td><a class='drilldown' id='$asset_id' onclick='show_property_details(this.id);'>$asset_no</a></td>
									<td>$pmt_date</td>
									<td>$pmt_paid_amt</td>
								</tr>
							";
							}
							else{
								echo $pmt_tnt;	
							}

							
						}
					?>
		        </tbody>
	      	</table>



				    </div>
				</div>
			</div>


		<!-- ---------------------------------------- Sub View Container Ends ------------------------------------------ -->
	</div>

	<!-- ---------------------------------------- Sub Title Container Ends -------------------------------------------- -->


	<!-- <?php echo $owner_name; ?> -->
	<div class="owner_details">
		<div class="owner_info">
			<div class="row">
				<div class="col s4">
					<div class="owner_image">
						<img src="<?php echo $prty_image; ?>" class="z-depth-4">
					</div>
				</div>
				<div class="col s4">
					<div class="owner_name">
						<label>House No: </label><h6><b><?php echo $prty_no; ?></b></h6>
					</div>
					<div class="owner_address">
						<label>Address: </label><h6><?php echo $prty_address; ?></h6>
					</div>
					<div class="owner_location">
						<label>Owner: </label>
						<a href='#' id='<?php echo $prty_owner ?>' onclick='show_owner_details(this.id);'><h6><?php echo $owner_name; ?></h6></a>
					</div>
					<!-- <div class="owner_location">
						<label>Location: </label><h6><?php echo $prty_location; ?></h6>
					</div> -->
				</div>
				<div class="col s4"> 
					<div class="row">
						<div class="col s12">
							<label>No. of Vacancies:</label>
							<h5 style="display: block;width: 20%;" class="btn tooltipped" data-position="bottom" data-delay="0" data-tooltip="Feature coming soon !">6</h5>
						</div>
						<div class="col s12">
							<label>Property Type:</label>
							<h5 class="prop_type"><?php echo $building_type; ?><span style="color:#C1BBB3;font-weight: normal;"> (Appartment/Individual House)</span></h5>
						</div>
						<div class="col s12">
							<label>Asset Type:</label>
							<h5 class="prop_type"><?php echo $prty_type; ?> - <?php echo $prty_rooms; ?></span> BHK</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="owner_assets_info">
			
			<div class="row">
			    <div class="col s12 z-depth-2">
			      <ul class="tabs">
			      	<li class="tab col s3"><a class="active" href="#test2">Tenants</a></li>
			        <li class="tab col s3"><a href="#test1">Payments</a></li>
			        <!-- <li class="tab col s3"><a href="#test3">Address & Contacts</a></li> -->
			        <li class="tab col s3"><a href="#test3">Asset Details</a></li>
			        <li class="tab col s3"><a href="#test4">Vendors</a></li>
			      </ul>
			    </div>


<div id="test1" class="col s12 z-depth-3"><!-- Properties -->
	<div class="row owner_properties_card">
			    		


			<table class="striped" style="font-size: 13px;">
		        <thead>
		          <tr>
		          	  <th>Payment ID</th>
		          	  <th>Payee</th>
		              <th>Asset</th>
		              <th>Payment Date</th>
		              <th>Actual Amount</th>
		              <th>Amount Paid</th>
		              <th>Due Amount</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 
						//$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_pmt_tnt in (select tenant_id from mprts_tenants where tenant_propid = '$prop_id') ");
						//$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_pmt_asset in (select prty_id from mprts_property where prty_building_id = (select building_id from mprts_buildings where building_access_code = '$user_access_code')) order by mprts_pmt_id desc");
						$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_pmt_asset = '$prop_id'");
						while($row_pmt=mysql_fetch_array($get_pmt_details)){
							$pmt_id = $row_pmt['mprts_pmt_id'];
							$pmt_receipt_no = $row_pmt['mprts_receipt_no'];
							//$pmt_tnt = $row_pmt['mprts_pmt_tnt'];
							/* if(substr($pmt_receipt_no, -1)=='0'){
								$pmt_tnt = 'ONR'.$row_pmt['mprts_pmt_tnt'];
							}
							else if(substr($pmt_receipt_no, -1)=='1'){
								$pmt_tnt = 'TNT'.$row_pmt['mprts_pmt_tnt'];
							} */
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
							$pmt_tnt_ast = substr($pmt_tnt, 3, 4);
							$pmt_tnt_occupant = substr($pmt_tnt, 3, 4);

							/*$get_asset_sql = mysql_query("SELECT * from mprts_property where prty_id = (select tenant_propid from mprts_tenants where tenant_id = $pmt_tnt) ");
							while($row_asset = mysql_fetch_array($get_asset_sql)){
								$asset_id = $row_asset['prty_id'];
								$asset_no = $row_asset['prty_no'];
							}*/

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
						$access_type = substr($user_access_code, 0, 2);
						if($access_type == 'MM'){

					    	$get_tenants_sql = "SELECT * from mprts_tenants where tenant_propid = '$prop_id'";
				    	}
						else if($access_type == 'AA'){

					    	$get_tenants_sql = "SELECT * from mprts_tenants where tenant_propid = '$prop_id'";
				    	}
				    	else if($access_type == 'OO'){

					    	$get_tenants_sql = "SELECT * from mprts_tenants where tenant_propid = '$prop_id'";
				    	}
				    	else if($access_type == 'TT'){

					    	$get_tenants_sql = "SELECT * from mprts_tenants where access_code = '$user_access_code'";
				    	}
				    	// $get_tenants_sql = "select * from mprts_tenants where tenant_propid = '$tenant_propid'";
				    	$get_tenants_execute = mysql_query($get_tenants_sql);
			    		// $i=0;
			    			while($row = mysql_fetch_array($get_tenants_execute)){
			    				$tenant_id = $row['tenant_id'];
			    				$tenant_name = $row['tenant_name'];
			    				$tenant_mobile = $row['tenant_mobile'];
			    				$tenant_propid = $row['tenant_propid'];
			    				$tenant_email = $row['tenant_email'];

			    				$get_tnt_id_sql = mysql_query("SELECT concat('TNT', tenant_id) as tenant_id, concat('AST', tenant_propid) as tenant_propid  from mprts_tenants where tenant_id = '$tenant_id' and tenant_propid = '$tenant_propid'");
							$tnt_id_row = mysql_fetch_array($get_tnt_id_sql);
							$tnt_id = $tnt_id_row['tenant_id'];
							$ast_id = $tnt_id_row['tenant_propid'];
							
							$ast_id_sub = substr($ast_id, 3, 4);
							$get_asset_no_sql = mysql_query("SELECT * from mprts_property where prty_id = '$ast_id_sub'");
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
							// $i++;
							}
						?>
			        </tbody>
			     </table>

			    </div>
			    <div id="test3" class="col s12 z-depth-3" style="border:1px solid #A8A8A8;margin-top: 1%;" title="Asset Address">
			    	<div class="row" style="margin:2%;">
			    		<div class="col s4">
			    			<div class="row">
			    			<h5 style="font-size: 15px;color: #867A58;text-decoration: underline;">Building Details</h5>
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Property Id:</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $building_id; ?></h5>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Building :</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $building_name; ?></h5>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Contact No. :</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $building_phno; ?></h5>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Owner Email:</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $owner_email; ?></h5>
			    				</div>
			    			</div>
			    		</div>
			    		
			    		<div class="col s4">
			    			<div class="row">
			    			<h5 style="font-size: 15px;color: #867A58;text-decoration: underline;">Address</h5>
			    				<div class="col s6">
			    					<h6 style="color: #867A58;">City :</h6>
			    				</div>
			    				<div class="col s4">
			    					<h5 style="font-size: 15px;"><?php echo $building_city; ?></h5>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col s6">
			    					<h6 style="color: #867A58;">State :</h6>
			    				</div>
			    				<div class="col s4">
			    					<h5 style="font-size: 15px;"><?php echo $building_state; ?></h5>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col s6">
			    					<h6 style="color: #867A58;">Postal Code :</h6>
			    				</div>
			    				<div class="col s4">
			    					<h5 style="font-size: 15px;"><?php echo $building_pincode; ?></h5>
			    				</div>
			    			</div>
			    		</div>

			    		<div class="col s4">
			    			<div class="row">
			    			<h5 style="font-size: 15px;color: #867A58;text-decoration: underline;">Details</h5>
			    				<div class="col s8">
			    					<h6 style="color: #867A58;">Asset Current Meter :</h6>
			    				</div>
			    				<div class="col s4">
			    					<h5 style="font-size: 15px;"><?php echo $prty_current_meter ?></h5>
			    				</div>
								<div class="col s8">
			    					<h6 style="color: #867A58;">Asset Gas Meter :</h6>
			    				</div>
			    				<div class="col s4">
			    					<h5 style="font-size: 15px;"><?php echo $prty_gas_meter ?></h5>
			    				</div>
								<div class="col s8">
			    					<h6 style="color: #867A58;">Asset Water Meter :</h6>
			    				</div>
			    				<div class="col s4">
			    					<h5 style="font-size: 15px;"><?php echo $prty_water_meter ?></h5>
			    				</div>
			    			</div>
							
			    			<div class="row">
			    				<div class="col s8">
			    					<h6 style="color: #867A58;">Asset Rent :</h6>
			    				</div>
			    				<div class="col s4">
			    					<h5 style="font-size: 15px;"><?php echo $prty_rent; ?></h5>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
			    </div>
			    <div id="test4" class="col s12 z-depth-3">Vendors</div>
			</div>

		</div>
	</div>
</div>
</body>
