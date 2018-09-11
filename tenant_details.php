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
<title>MPRTS | Tenant Details</title>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
	<?php //include 'left_content.php'; ?>
	<?php 
		$access_type = substr($user_access_code, 0, 2);
		if($access_type == 'OO'){
		echo "<style>
				.edit_tenant, .delete_owner {
				display:none !important;
				}
				</style>";
		}
	?>
	
	<?php 
		$accno = $_POST['id'];
		// echo $accno;
		$show_tenant_sql = "SELECT * from mprts_tenants where tenant_name='$accno' or tenant_id='$accno'";
		$show_tenant_execute = mysql_query($show_tenant_sql);
		while ($row = mysql_fetch_array($show_tenant_execute)) {
			$tenant_id = $row['tenant_id'];
			$tenant_propid = $row['tenant_propid'];
			$tenant_owner_id = $row['tenant_owner_id'];
			$tenant_name = $row['tenant_name'];
			$tenant_image = $row['tenant_image'];
			$tenant_mobile = $row['tenant_mobile'];
			$tenant_address = $row['tenant_address'];
			$tenant_email = $row['tenant_email'];
			// $tenant_id_type = $row['tenant_id_type'];
			$tenant_id_no = $row['tenant_id_no'];
			$tenant_joining_date = $row['tenant_joining_date'];
			$tenant_vacating_date = $row['tenant_vacating_date'];
		}

		$show_owner_name_sql = "SELECT * from mprts_owner where owner_id = $tenant_owner_id";
      			$show_owner_name_execute = mysql_query($show_owner_name_sql);
      			while($row_owner_name = mysql_fetch_array($show_owner_name_execute)){
      				$tenant_owner_name = $row_owner_name['owner_name'];
      				$tenant_owner_id = $row_owner_name['owner_id'];
      	}
	?>
<div class="right_content1">
	<!-- <div class="sub_title_bar">
		<h5><a href='index.php'>Admin Dashboard</a> - <a href="tenant_content.php">Tenant Details</a> - <b><?php echo $tenant_name; ?></b></h5>
	</div> -->

	<div class="row main_sub_title_bar">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Admin Dashboard</a> - <a href="tenant_content.php">Tenant Details</a> - <b><?php echo $tenant_name; ?></b></h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
  			<button class="btn waves-effect waves-light delete_owner" title="Delete" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" id='<?php echo $tenant_id; ?>' onclick="delete_tenant(this.id);">In-Activate
    			<i class="material-icons right">delete</i>
  			</button>
  			<button class="btn waves-effect waves-light edit_button edit_tenant" title="Edit" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" id='<?php echo $tenant_id; ?>'  onclick="edit_tenant(this.id);">Edit
    			<i class="material-icons right">edit</i>
  			</button>
		</div>
	</div>

	<!-- ---------------------------------------- Sub View Container Starts ------------------------------------------ -->

			<div class="resp_sub_title_bar">
				<div class="row details_container">
					<div class="row details_title_container">
						<div class="col s9" style="padding-top: 2%;padding-left: 5%;">
							<h5 class="content_name"><b><?php echo $tenant_name; ?></b></h5>
						</div>
						<div class="col s3" style="padding-left:0px;padding-right: 0px;">
				  			<button class="btn waves-effect waves-light edit_button edit_owner" title="Edit" style="float: left;background-color: #f2f2f2;color:#000;margin:10% auto 10% 2%;border-radius: 5px;padding-left: 10px;padding-right: 10px;" id='<?php echo $tenant_id; ?>'  onclick="edit_tenant_resp(this.id);">
				    			<i class="material-icons" style="font-size: 15px;">edit</i>
				  			</button>
				  			<button class="btn waves-effect waves-light delete_asset edit_owner" title="Delete" style="float: left;background-color: #f2f2f2;color:#000;margin:10% auto 10% 10%;border-radius: 5px;padding-left: 10px;padding-right: 10px;" id='<?php echo $tenant_id; ?>'  onclick="delete_tenant(this.id);">
				    			<i class="material-icons" style="font-size: 15px;color: red;">delete</i>
				  			</button>		
						</div>
					</div>
					<h5 class="pagination"><a href="tenant_content.php">Tenant Details</a> / <b><?php echo $tenant_name; ?></b></h5>
					<!--<h class="resp_tenant_name"><b><?php echo $tenant_name; ?></b></h>-->
					<div class="resp_tenant_image z-depth-2">
						<center>
							<img src="<?php echo $tenant_image; ?>">
						</center>
					</div>

					<div class="border_it">
						<div class="row resp_tenant_address_content">
							<div class="col s2 resp_location_icon">
								<i class='material-icons location_icon'>location_on</i>	
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $tenant_address ?></h5> 
							</div>
						</div>


						<div class="row resp_tenant_address_content">
							<div class="col s2 resp_location_icon">
								<i class='material-icons phone_android'>phone_android</i>	
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $tenant_mobile ?></h5> 
							</div>
						</div>

						<div class="row resp_tenant_address_content">
							<div class="col s2 resp_location_icon">
								<i class='material-icons mail_outline'>mail_outline</i>
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $tenant_email ?></h5>
							</div>
						</div>
					</div>

					<div class="resp_sub_view_container">
						<div class="row">
						    <div class="col s12">
						      <ul class="tabs">
						      	<li class="tab col s3"><a class="active" href="#resp_tenant_payments">Payments</a></li>
						        <li class="tab col s3"><a href="#resp_cotenants">Co-Tenants</a></li>
						        <li class="tab col s3"><a href="#resp_tenant_image">Tenant ID</a></li>
						      </ul>
						    </div>

						    <div id="resp_tenant_payments" class="col s12">
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
										$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_pmt_tnt = '$accno' and substr(mprts_receipt_no, -1)='1'");
										if( mysql_num_rows($get_pmt_details)==0 ){
											echo "<center><h5>No Payments found..!</h5></center>";
											echo "<style>.payments_table{display:none;}</style>";
										}
										while($row_pmt=mysql_fetch_array($get_pmt_details)){
											$pmt_id = $row_pmt['mprts_pmt_id'];
											$pmt_tnt = $row_pmt['mprts_pmt_tnt'];
											$pmt_receipt_no = $row_pmt['mprts_receipt_no'];
											$pmt_date = substr($pmt_receipt_no, 4, 2).'-'.substr($pmt_receipt_no, 2, 2).'-'.'20'.substr($pmt_receipt_no, 0, 2);
											$pmt_act_amt = $row_pmt['mprts_pmt_act_amt'];
											$pmt_paid_amt = $row_pmt['mprts_pmt_paid_amt'];
											$pmt_paid_due = $row_pmt['mprts_pmt_due'];

											$get_asset_sql = mysql_query("SELECT * from mprts_property where prty_id = (select tenant_propid from mprts_tenants where tenant_id = $pmt_tnt) ");
											while($row_asset = mysql_fetch_array($get_asset_sql)){
												$asset_id = $row_asset['prty_id'];
											}

											echo "
												<tr>
													<td><a class='drilldown' id='$pmt_id' onclick='show_payment_details(this.id);'>$pmt_receipt_no</a></td>
													<td><a class='drilldown' id='$pmt_tnt' onclick='show_tenant_details(this.id);'>TNT$pmt_tnt</a></td>
													<td>$pmt_date</td>
													<td>$pmt_paid_amt</td>
												</tr>
											";
										}
									?>
						        </tbody>
					      </table>
					    </div>

					    <div id="resp_cotenants" class="col s12">
					    	<?php
			    		$get_co_tenants_sql = "SELECT * from mprts_tenants where tenant_propid = $tenant_propid and tenant_id != $tenant_id";
			    		$get_co_tenants_execute = mysql_query($get_co_tenants_sql);
			    		$count = mysql_num_rows($get_co_tenants_execute);

			    		if ($count>0) {
				    		while ($co_row_resp = mysql_fetch_array($get_co_tenants_execute)) {
								$tenant_id = $co_row_resp['tenant_id'];
								$tenant_co_name = $co_row_resp['tenant_name'];
								$tenant_image = $co_row_resp['tenant_image'];
								$tenant_propid = $co_row_resp['tenant_propid'];

								$get_tnt_id_sql = mysql_query("SELECT concat('TNT', tenant_id) as tenant_id, concat('AST', tenant_propid) as tenant_propid  from mprts_tenants where tenant_id = $tenant_id");
							$tnt_id_row = mysql_fetch_array($get_tnt_id_sql);
							$tnt_id = $tnt_id_row['tenant_id'];
							$ast_id = $tnt_id_row['tenant_propid'];
							$ast_id_sbstr = substr($ast_id, 3, 4);

								echo "<div class='col l3 m3 s6 z-depth-2'>
				    			<div class='row property_card' style='margin:5%;'>
				    				<div class='col s12 owner_property_image'>
				    					<img src='$tenant_image' style='width:100%;padding:5%;'>
				    				</div>
				    				<div class='col s12 owner_property_id'>
				    					<div class='row'>
				    						<div class='col s4'>
				    							<label>Id:</label>
				    						</div>
				    						<div class='col s8'>
				    							<a href='#' id='$tenant_id' onclick='show_tenant_details(this.id);'>$tnt_id</a>
				    						<!-- <a href='#' id='$tenant_id'>$tenant_id</a>	-->
				    						</div>
				    					</div>
				    				</div>
				    				<div class='col s12 owner_property_location'>
				    					<div class='row'>
				    						<div class='col s4'>
				    							<label>Name:</label>
				    						</div>
				    						<div class='col s8'>
				    							<a href='#' id='$tenant_id' onclick='show_tenant_details(this.id);'>$tenant_co_name</a>	
				    						</div>
				    					</div>
				    				</div>
				    				<div class='col s12 owner_property_location'>
				    					<div class='row'>
				    						<div class='col s4'>
				    							<label>Flat No:</label>
				    						</div>
				    						<div class='col s8'>
				    							<a href='#' id='$ast_id_sbstr' onclick='show_property_details(this.id);'>$ast_id</a>	
				    						</div>
				    					</div>
				    				</div>
				    			</div>
				    		</div>";
							}
						}
						else {
							echo "<center><h5>Single Tenant..!</h5></center>";
						}
			    	?>
					    </div>
					    <div id="resp_tenant_image" class="col s12">
					    	<div class="owner_id_image">
								<img src="<?php echo $tenant_id_no; ?>" class="z-depth-4">
							</div>
					    </div>

						</div>
					</div>

				</div>
			</div>

	<!-- ---------------------------------------- Sub View Container Ends ------------------------------------------ -->

	<!-- <?php echo $owner_name; ?> -->
	<div class="owner_details">
		<div class="owner_info">
			<div class="row">
				<div class="col s4">
					<div class="owner_image">
						<img src="<?php echo $tenant_image; ?>" class="z-depth-4">
					</div>
				</div>
				<div class="col s4">
					<div class="owner_name">
						<h5><?php echo $tenant_name; ?></h5>
					</div>
					<div class="owner_mobile">
						<label>Tenant Mobile: </label><h6><?php echo $tenant_mobile; ?></h6>
					</div>
					<div class="owner_mobile">
						<label>Tenant's Owner: </label><h6><a class='drilldown' id='<?php echo $tenant_owner_id ?>' onclick='show_owner_details(this.id);'><?php echo $tenant_owner_name; ?></a></h6>
					</div>
					<div class="owner_address">
						<label>Address: </label><h6><?php echo $tenant_address; ?></h6>
					</div>
					<div class="owner_email">
						<label>Email Id: </label><h6><?php echo $tenant_email; ?></h6>
					</div>
				</div>
				<div class="col s4"> 

					<div class="owner_id_image">
						<img src="<?php echo $tenant_id_no; ?>" class="z-depth-4">
					</div>


				</div>
			</div>
		</div>





		<?php 
		$show_property_sql = "SELECT * from mprts_property where prty_id = $tenant_propid";
		$show_property_execute = mysql_query($show_property_sql);
		while ($row = mysql_fetch_array($show_property_execute)) {
			$prty_no = $row['prty_no'];
			$prty_owner = $row['prty_owner'];
			$prty_building_id = $row['prty_building_id'];
		}

		$show_address_sql = "SELECT * from mprts_buildings where building_id = $prty_building_id";
      			$show_address_execute = mysql_query($show_address_sql);
      			while($row_address = mysql_fetch_array($show_address_execute)){
      				$building_id = $row_address['building_i'];
      				$building_name = $row_address['building_name'];
      				$building_locality = $row_address['building_locality'];
      				$building_city = $row_address['building_city'];
      				$building_state = $row_address['building_state'];
      	}
	?>


		<div class="owner_assets_info">
			
			<div class="row">
			    <div class="col s12 z-depth-2">
			      <ul class="tabs">
			      	<li class="tab col s4"><a class="active" href="#test4">Payments</a></li>
			        <li class="tab col s4"><a href="#test1">Details</a></li>
			        <li class="tab col s4"><a href="#test2">Co-Tenants</a></li>
			        <!-- <li class="tab col s3"><a href="#test3">Maintenance</a></li> -->
			      </ul>
			    </div>
			    <div id="test1" class="col s12 z-depth-3" title="Tenant Address" style="border:1px solid #A8A8A8;margin-top:1%;">
			    	<div class="row" style="margin:2%;">
			    		<div class="col s4">
			    			<div class="row">
			    			<h5 style="font-size: 15px;color: #867A58;text-decoration: underline;">Building & Address</h5>
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Building No :</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $building_name ?></h5>
			    				</div>
			    			</div>

			    			<div class="row">
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Asset Id:</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;" id=<?php echo $tenant_propid ?> class="drilldown" onclick="show_property_details(this.id);"><a><?php echo 'AST'.$tenant_propid ?></a></h5>
			    				</div>
			    			</div>

			    			<div class="row">
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Flat No:</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $prty_no ?></h5>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Locality:</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $building_locality ?></h5>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">City:</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $building_city ?></h5>
			    				</div>
			    			</div>
			    		</div>
			    		
			    		<div class="col s4">
			    			<div class="row">
			    			<h5 style="font-size: 15px;color: #867A58;text-decoration: underline;">Contact Details</h5>
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Mobile No.</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $tenant_mobile ?></h5>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Email :</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $tenant_email ?></h5>
			    				</div>
			    			</div>
			    		</div>

			    		<div class="col s4">
			    			<div class="row">
			    			<h5 style="font-size: 15px;color: #867A58;text-decoration: underline;">ID Details</h5>
			    				<!-- <div class="col s4">
			    					<h6 style="color: #867A58;">Proof Submitted:</h6>
			    				</div> -->
			    				<!-- <div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $tenant_id_type; ?></h5>
			    				</div> -->
			    			</div>
			    			<!-- <div class="row">
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Id No.</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $tenant_id_no; ?></h5>
			    				</div>
			    			</div> -->
			    			<div class="row">
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Joining Date:</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $tenant_joining_date; ?></h5>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col s4">
			    					<h6 style="color: #867A58;">Vacating Date:</h6>
			    				</div>
			    				<div class="col s8">
			    					<h5 style="font-size: 15px;"><?php echo $tenant_vacating_date; ?></h5>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
			    </div>
			    <div id="test2" class="col s12 z-depth-3">
			    	<?php
					$access_type = substr($user_access_code, 0, 2);
						if($access_type == 'AA'){
							$get_co_tenants_sql = mysql_query("SELECT * from mprts_tenants where tenant_propid = $tenant_propid and tenant_id NOT IN ($accno) and access_code = '$user_access_code'");
						}
						if($access_type == 'OO'){
							$get_co_tenants_sql = mysql_query("SELECT * from mprts_tenants where tenant_propid = $tenant_propid and tenant_id NOT IN ($accno) and substr(access_code, 3, 8) = substr('$user_access_code', 3, 8)");
						}
			    	// echo "<script>alert('$user_access_code');</script>";
			    		// $get_co_tenants_execute = mysql_query($get_co_tenants_sql);
			    		$co_count = mysql_num_rows($get_co_tenants_sql);
			    		if ($co_count>0) {
				    		while ($co_row = mysql_fetch_array($get_co_tenants_sql)) {
								$tenant_co_id = $co_row['tenant_id'];
								$tenant_co_name = $co_row['tenant_name'];
								$tenant_coimage = $co_row['tenant_image'];
								$tenant_propid = $co_row['tenant_propid'];
								$tenant_co_code = $co_row['access_code'];
							// echo "<script>alert('$tenant_co_code');</script>";
							// 	$get_tnt_id_sql = mysql_query("SELECT concat('TNT', tenant_id) as tenant_id, concat('AST', tenant_propid) as tenant_propid  from mprts_tenants where tenant_id = $tenant_co_id");
							// $tnt_id_row = mysql_fetch_array($get_tnt_id_sql);
							// $tnt_id = $tnt_id_row['tenant_id'];
							// $ast_id = $tnt_id_row['tenant_propid'];
							// $ast_id_sbstr = substr($ast_id, 3, 4);

								echo "<div class='col s3 z-depth-2'>
				    			<div class='row property_card' style='margin:5%;'>
				    				<div class='col s12 owner_property_image'>
				    					<img src='$tenant_coimage' style='width:100%;padding:5%;'>
				    				</div>
				    				<div class='col s12 owner_property_id'>
				    					<div class='row'>
				    						<div class='col s4'>
				    							<label>Id:</label>
				    						</div>
				    						<div class='col s8'>
				    							<a href='#' id='$tenant_co_id' onclick='show_tenant_details(this.id);'>TNT$tenant_co_id</a>
				    						<!-- <a href='#' id='$tenant_id'>$tenant_id</a>	-->
				    						</div>
				    					</div>
				    				</div>
				    				<div class='col s12 owner_property_location'>
				    					<div class='row'>
				    						<div class='col s4'>
				    							<label>Name:</label>
				    						</div>
				    						<div class='col s8'>
				    							<a href='#' id='$tenant_id' onclick='show_tenant_details(this.id);'>$tenant_co_name</a>	
				    						</div>
				    					</div>
				    				</div>
				    				<div class='col s12 owner_property_location'>
				    					<div class='row'>
				    						<div class='col s4'>
				    							<label>Flat No:</label>
				    						</div>
				    						<div class='col s8'>
				    							<a href='#' id='$ast_id_sbstr' onclick='show_property_details(this.id);'>AST$tenant_propid</a>	
				    						</div>
				    					</div>
				    				</div>
				    			</div>
				    		</div>";
							}
						}
						else {
							echo "<center><h5>Single Tenant!</h5></center>";
						}
			    	?>


			    </div>
			    <!-- <div id="test3" class="col s12">Maintenance Details</div> -->
			    <div id="test4" class="col s12 z-depth-3">
			    	<table class="striped" style="font-size: 13px;">
		        <thead>
		          <tr>
		          	  <th>Payment ID</th>
		          	  <th>Payee Id</th>
		              <th>Asset Id</th>
		              <th>Payment Date</th>
		              <th>Actual Amount</th>
		              <th>Amount Paid</th>
		              <th>Due Amount</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 
						$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_pmt_tnt = '$accno' and substr(mprts_receipt_no, -1)='1'");
						while($row_pmt=mysql_fetch_array($get_pmt_details)){
							$pmt_id = $row_pmt['mprts_pmt_id'];
							$pmt_tnt = $row_pmt['mprts_pmt_tnt'];
							$pmt_receipt_no = $row_pmt['mprts_receipt_no'];
							$pmt_date = substr($pmt_receipt_no, 4, 2).'-'.substr($pmt_receipt_no, 2, 2).'-'.'20'.substr($pmt_receipt_no, 0, 2);
							$pmt_act_amt = $row_pmt['mprts_pmt_act_amt'];
							$pmt_paid_amt = $row_pmt['mprts_pmt_paid_amt'];
							$pmt_paid_due = $row_pmt['mprts_pmt_due'];

							$get_asset_sql = mysql_query("SELECT * from mprts_property where prty_id = (select tenant_propid from mprts_tenants where tenant_id = $pmt_tnt) ");
							while($row_asset = mysql_fetch_array($get_asset_sql)){
								$asset_id = $row_asset['prty_id'];
							}

							echo "
								<tr>
									<td><a class='drilldown' id='$pmt_id' onclick='show_payment_details(this.id);'>PMT$pmt_id</a></td>
									<td><a class='drilldown' id='$pmt_tnt' onclick='show_tenant_details(this.id);'>TNT$pmt_tnt</a></td>
									<td><a class='drilldown' id='$asset_id' onclick='show_property_details(this.id);'>AST$asset_id</a></td>
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
<script type='text/javascipt' src='scripts/major_navigate.js'>
</body>
