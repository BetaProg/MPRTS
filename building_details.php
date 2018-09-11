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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MPRTS | Property Details</title>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
<script type="text/javascript">
	$(document).ready(function() {
    	// $('.resp_sub_view_container').load('edit_building.php');
  });
</script>
<style type="text/css">
	/*.right_content2 table.striped>tbody>tr:nth-child(odd), .right_content1 table.striped>tbody>tr:nth-child(odd) {
    	background-color: #fff !important;
	}*/
</style>	
	<?php 

	$access_type = substr($user_access_code, 0, 2);
	if($access_type == 'AA'){
		echo "<style>
				#add_building,  .delete_property {
				display:none !important;
				}
			</style>";
	}
	else if($access_type == 'OO'){
			echo "<style>
				#add_building, .edit_building, .delete_property {
				display:none !important;
				}
				</style>";
	}

		$building_id = $_POST['id'];
	 // $building_id = 0001;
		$show_building_sql = "select * from mprts_buildings where building_id='$building_id'";
		$show_building_execute = mysql_query($show_building_sql);
		while ($row = mysql_fetch_array($show_building_execute)) {
			$building_id = $row['building_id'];
			$building_locality = $row['building_locality'];
			$building_type = $row['building_type'];
			$building_image = $row['image_url'];
			$building_name = $row['building_name'];
			$building_units = $row['building_units'];
			$building_city = $row['building_city'];
			$building_state = $row['building_state'];
			$building_pincode = $row['building_pincode'];
			$building_phno = $row['building_phno'];
			$building_email = $row['building_email'];
			$building_current_meter = $row['building_current_meter'];
			$building_water_meter = $row['building_water_meter'];
			$building_note = $row['building_note'];


			$get_pty_id_sql = mysql_query("select concat('PTY', building_id) as building_id from mprts_buildings where building_id = $building_id");
							$pty_id_row = mysql_fetch_array($get_pty_id_sql);
							$pty_id = $pty_id_row['building_id'];
		}

	?>
<style type="text/css">
	.owner_assets_info .s12 .s4 .s4{
		padding-left: 0px !important;
		padding-right: 0px !important;
	}
	.edit_button{
		float: right;
		margin-right: 5%;
		color: #000;
	}
	.delete_button{
		float: right;
		margin-right: 5%;
		color: #000;
	}
</style>
<div class="right_content2"  title="Property Details">
	<!-- <div class="sub_title_bar">
		<h5><a href='index.php'>Admin Dashboard</a> - <a href="building_content.php">Property Details</a> - <b><?php echo $pty_id; ?></b><button class="delete_button">Delete</button><button class="edit_button" id='<?php echo $building_id; ?>'  onclick="edit_building(this.id);">Edit</button></h5>
	</div> -->

	<div class="row main_sub_title_bar">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Admin Dashboard</a> - <a href="building_content.php">Property Details</a> - <b><?php echo $building_name; ?></b></h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
  			<button class="btn waves-effect waves-light delete_property" title="Delete" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" onclick="">Delete
    			<i class="material-icons right">delete</i>
  			</button>
  			<button class="btn waves-effect waves-light edit_button edit_building" title="Edit" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" id='<?php echo $building_id; ?>'  onclick="edit_building(this.id);">
    			<i class="material-icons right">edit</i>Edit
  			</button>
		</div>
	</div>
	<!-- ----------------------------------------------------   Sub Title Content Starts ---------------------------------------------------- -->
	<div class="resp_sub_title_bar">
		<div class="row details_container building_resp">
			<div class="row top_asset_details_bar">
				<div class="col s10" style="padding-top: 2%;padding-left: 5%;">
					<h5 class="content_name"><b><?php echo $building_name; ?></b></h5>					
				</div>
				<div class="col s2">
		  			<button class="btn waves-effect waves-light edit_button edit_building" title="Edit" style="float: right;background-color: #f2f2f2;color:#000;margin:10% auto 10% 2%;border-radius: 5px;padding-left: 10px;padding-right: 10px;" id='<?php echo $building_id; ?>'  onclick="edit_building_resp(this.id);">
		    			<i class="material-icons" style="font-size: 15px;">edit</i>
		  			</button>		
				</div>
			</div>


			<h5 class="pagination"><a href="building_content.php">Property Details</a> / <b><?php echo $pty_id; ?></b></h5>
			<!--<h5 class="resp_building_name"><b><?php echo $building_name; ?></b></h5>-->
			<div class="resp_owner_image">
				<center><img src="<?php echo $building_image; ?>"></center>
			</div>
			<div class="border_it">
				<div class="row resp_building_address_content">
					<div class="col s2 resp_location_icon">
						<i class='material-icons location_icon'>location_on</i>	
					</div>
					<div class="col s10 resp_building_address">
						<h5><?php echo $building_locality ?>, <?php echo $building_city ?>, <?php echo $building_state ?>, <?php echo $building_pincode ?></h5> 
					</div>
				</div>


				<div class="row resp_building_address_content">
					<div class="col s2 resp_location_icon">
						<i class='material-icons phone_android'>phone_android</i>	
					</div>
					<div class="col s10 resp_building_address">
						<h5><?php echo $building_phno ?></h5> 
					</div>
				</div>

				<div class="row resp_building_address_content">
					<div class="col s2 resp_location_icon">
						<i class='material-icons mail_outline'>mail_outline</i>
					</div>
					<div class="col s10 resp_building_address">
						<h5><?php echo $building_email ?></h5>
					</div>
				</div>
				<div class="row resp_building_address_content">
					<div class="col s2 resp_location_icon">
						<i class="material-icons location_power">power</i>
					</div>
					<div class="col s10 resp_building_address">
						<h5><?php echo $building_current_meter ?></h5>
					</div>
				</div>
				<div class="row resp_building_address_content">
					<div class="col s2 resp_location_icon">
						<i class="material-icons location_opacity">opacity</i>
					</div>
					<div class="col s10 resp_building_address">
						<h5><?php echo $building_water_meter ?></h5>
					</div>
				</div>
			</div>
		</div>
		<!-- ---------------------------------------- Sub View Container Starts ------------------------------------------ -->
			<div class="resp_sub_view_container">
				<div class="row">
				    <div class="col s12">
				      <ul class="tabs">
				        <li class="tab col s3"><a class="active" href="#resp_building_assets">Assets</a></li>
				        <li class="tab col s3"><a href="#resp_building_payments">Payments</a></li>
				      </ul>
				    </div>
				    <div id="resp_building_assets" class="col s12"><!-- Assets -->
				    	

				    	<?php 

						$access_type = substr($user_access_code, 0, 2);
						if($access_type == 'MM'){
							$prty_details_sql = "SELECT * from mprts_property where prty_building_id = $building_id;";
						}
						else if($access_type == 'AA'){
							//$prty_details_sql = "SELECT * from mprts_property where prty_building_id = substr('$user_access_code', 3, 4);";
							$prty_details_sql = "SELECT * from mprts_property where prty_building_id = '$building_id'";
						}
						else if($access_type == 'OO'){
							$prty_details_sql = "SELECT * from mprts_property where prty_building_id = $building_id and prty_owner = (select owner_id from mprts_owner where access_code = '$user_access_code')";
						}
						$prty_details_execute = mysql_query($prty_details_sql);
			
						$prty_count = mysql_num_rows($prty_details_execute);

						// while($row = mysql_fetch_array($owners_details_execute)){
						$i=0;
						while($i<$prty_count){
							$row = mysql_fetch_array($prty_details_execute);
							$prty_id = $row['prty_id'];
							$prty_no = $row['prty_no'];
							$prty_rooms = $row['prty_rooms'];
							$prty_owner = $row['prty_owner'];
							$prty_location = $row['prty_location'];
							$prty_image = $row['prty_image'];
							$prty_address = $row['prty_address'];
							$prty_vendors = $row['prty_vendors'];
							$prty_building_id = $row['prty_building_id'];


							$get_ast_id_sql = mysql_query("SELECT concat('AST', prty_id) as prty_id from mprts_property where prty_id = $prty_id");
							$ast_id_row = mysql_fetch_array($get_ast_id_sql);
							$ast_id = $ast_id_row['prty_id'];

							$owner_name_sql = "SELECT * from mprts_owner where owner_id= $prty_owner and substr(access_code, -1) != 'D'";
							$owner_name_execute = mysql_query($owner_name_sql);
							// while($row2 = mysql_fetch_array($owner_name_execute)){
							// 	$owner_name = $row2['owner_name'];
							// }
							$row2 = mysql_fetch_array($owner_name_execute);
							$owner_name = $row2['owner_name'];

							echo "
								<div class='resp_content resp_asset_content z-depth-1 drilldown' onclick='show_property_details(this.id);' id='$prty_no'>
									<div class='row asset_list_row'>
										<div class='col s2 asset_no_col'>
											$prty_no
										</div>
										<div class='col s8'>
											<div class='row'>
												<div class='col s12 asset_owner_col'>
													<h5>$owner_name</h5>
												</div>
												<div class='col s12 asset_id_col'>
													<h5>AST$prty_id</h5>
												</div>
											</div>
										</div>
										<div class='col s2 asset_rooms_col'>
											<h5>$prty_rooms</h5>BHK
										</div>
									</div>
								</div>
							";
							$i++;
						}
					?>


				    </div>
				    <div id="resp_building_payments" class="col s12">



	    	<table class="striped" style="font-size: 13px;">
		        <thead>
		          <tr>
		          	  <th>Receipt No.</th>
		              <th>Asset Id</th>
		              <th>Payment Date</th>
		              <th>Amount Paid(₹)</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 
						//$get_pmt_details = mysql_query("SELECT * from mprts_payments where substr(mprts_access_code, 3, 4) = $building_id");
						$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_access_code = '$user_access_code'");
						while($row_pmt=mysql_fetch_array($get_pmt_details)){
							$pmt_id = $row_pmt['mprts_pmt_id'];
							$pmt_receipt_no = $row_pmt['mprts_receipt_no'];
							//$pmt_tnt = $row_pmt['mprts_pmt_tnt'];
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
							//$pmt_receipt_no = $row_pmt['mprts_receipt_no'];
							$pmt_date = substr($pmt_receipt_no, 4, 2).'-'.substr($pmt_receipt_no, 2, 2).'-'.'20'.substr($pmt_receipt_no, 0, 2);
							$pmt_act_amt = $row_pmt['mprts_pmt_act_amt'];
							$pmt_paid_amt = $row_pmt['mprts_pmt_paid_amt'];
							$pmt_paid_due = $row_pmt['mprts_pmt_due'];

							/*$get_asset_sql = mysql_query("SELECT * from mprts_property where prty_id = (select tenant_propid from mprts_tenants where tenant_id = $pmt_tnt) ");
							while($row_asset = mysql_fetch_array($get_asset_sql)){
								$asset_id = $row_asset['prty_id'];
							}
							*/
							if($get_asset_sql){
								echo "
								<tr>
									<td><a class='drilldown' id='$pmt_id' onclick='show_payment_details(this.id);'>$pmt_receipt_no</a></td>
									<td><a class='drilldown' id='$asset_id' onclick='show_property_details(this.id);'>AST$asset_id</a></td>
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
	<!-- ----------------------------------------------------   Sub Title Content Ends   ---------------------------------------------------- -->


	<div class="owner_details">
		<div class="owner_info">
			<div class="row">
				<div class="col s4">
					<div class="owner_image">
						<img src="<?php echo $building_image; ?>" class="z-depth-4">
					</div>
				</div>
				<div class="col s4">
					<div class="owner_name">
						<label>Property Id: </label><h6><b><?php echo $pty_id; ?></b></h6>
					</div>
					<div class="owner_address">
						<label>Locality: </label><h6><?php echo $building_locality; ?></h6>
					</div>
					<div class="owner_location">
						<label>Property Name: </label><h6><?php echo $building_name; ?></h6>
					</div>
				</div>
				<div class="col s4"> 
					<div class="row">
						<div class="col s12">
							<label>No. of Vacancies:/No. of Units:</label>
							<h5 style="display: block;width: 40%;" class="btn tooltipped" data-position="bottom" data-delay="0" data-tooltip="Feature coming soon !">12/<?php echo $building_units; ?></h5>
						</div>
						<div class="col s12">
							<label>Property Type:</label>
							<h5 class="prop_type" style="color:#000;font-weight: normal;font-size: 18px;"><?php echo $building_type; ?></h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="owner_assets_info">
			
			<div class="row">
			    <div class="col s12 z-depth-2">
			      <ul class="tabs">
			      	<li class="tab col s3"><a class="active" href="#test2" id='property_type'>Flats/Portions</a></li>
			        <li class="tab col s3"><a href="#test1">Payments</a></li>
			        <li class="tab col s3"><a href="#test3">Address & Contacts</a></li>
			        <li class="tab col s3"><a href="#test4">Vendors</a></li>
			      </ul>
			    </div>






			    <div id="test1" class="col s12 z-depth-3"><!-- Properties -->
			    	<div class="row owner_properties_card">
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
						//$get_pmt_details = mysql_query("SELECT * from mprts_payments where substr(mprts_access_code, 3, 4) = $building_id");
						$get_pmt_details = mysql_query("SELECT * from mprts_payments where mprts_access_code = '$user_access_code'");
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
							
							//$pmt_tnt_ast = substr($pmt_tnt, 3, 4);
							$pmt_tnt_occupant = substr($pmt_tnt, 3, 4);

							/*$get_asset_sql = mysql_query("SELECT * from mprts_property where prty_id = (select tenant_propid from mprts_tenants where tenant_id = $pmt_tnt_ast) ");
							while($row_asset = mysql_fetch_array($get_asset_sql)){
								$asset_id = $row_asset['prty_id'];
								$asset_no = $row_asset['prty_no'];
							}*/
							if($get_asset_sql){
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


	<div id="test2" class="col s12">
		<div class="owners_table z-depth-3" id='tableit1' title="Assets List in Property" style="height: auto;">
			<table class="striped" style="font-size: 13px;">
		        <thead>
		          <tr>
		          	  <th>Asset ID</th>
		              <th>Owner's Name</th>
		              <th>Location</th>
		              <th>Address</th>
		              <th>Property</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 

						$access_type = substr($user_access_code, 0, 2);
						if($access_type == 'MM'){
							$prty_details_sql = "SELECT * from mprts_property where prty_building_id = $building_id;";
						}
						else if($access_type == 'AA'){
							//$prty_details_sql = "SELECT * from mprts_property where prty_building_id = substr('$user_access_code', 3, 4);";
							$prty_details_sql = "SELECT * from mprts_property where prty_building_id = $building_id;";
						}
						else if($access_type == 'OO'){
							$prty_details_sql = "SELECT * from mprts_property where prty_building_id = $building_id and prty_owner = (select owner_id from mprts_owner where access_code = '$user_access_code')";
						}
						$prty_details_execute = mysql_query($prty_details_sql);
			
						$prty_count = mysql_num_rows($prty_details_execute);

						// while($row = mysql_fetch_array($owners_details_execute)){
						$i=0;
						while($i<$prty_count){
							$row = mysql_fetch_array($prty_details_execute);
							$prty_id = $row['prty_id'];
							$prty_owner = $row['prty_owner'];
							$prty_location = $row['prty_location'];
							$prty_image = $row['prty_prty'];
							$prty_address = $row['prty_address'];
							$prty_vendors = $row['prty_vendors'];
							$prty_building_id = $row['prty_building_id'];
							
							echo "<script>console.log('$prty_owner');</script>";

							$get_ast_id_sql = mysql_query("SELECT concat('AST', prty_id) as prty_id from mprts_property where prty_id = $prty_id");
							$ast_id_row = mysql_fetch_array($get_ast_id_sql);
							$ast_id = $ast_id_row['prty_id'];
							
							$prty_owner = substr($prty_owner, 3, 4);
							$owner_name_sql = "SELECT * from mprts_owner where owner_id = $prty_owner and substr(access_code, -1) != 'D'";
							$owner_name_execute = mysql_query($owner_name_sql);
							// while($row2 = mysql_fetch_array($owner_name_execute)){
							// 	$owner_name = $row2['owner_name'];
							// }
							$row2 = mysql_fetch_array($owner_name_execute);
							$owner_name = $row2['owner_name'];

							echo "
								<tr>
						            <td><a class='drilldown' id='$prty_id' onclick='show_property_details(this.id);'>$ast_id</a></td>
						            <td><a class='drilldown' id='$owner_name' onclick='show_owner_details(this.id);'>$owner_name</a></td>
						            <td>$prty_location</td>
						            <td>$prty_address</td>
						            <td><a class='drilldown' id='$prty_building_id' onclick='show_building_details(this.id);'>$pty_id</a></td>
					          	</tr>
							";
							$i++;
						}
					?>
		        </tbody>
	      </table>
		</div>
	</div>
	



    <div id="test3" class="col s12 z-depth-3" style="border:1px solid #A8A8A8;margin-top: 1%;" title="Property Address">
    	<div class="row" style="margin:1%;">
    		<div class="col s4">
    			<div class="row">
    			<h5 style="font-size: 15px;color: #867A58;text-decoration: underline;">Contact</h5>
    				<div class="col s4">
    					<h6 style="color: #867A58;">Locality :</h6>
    				</div>
    				<div class="col s8">
    					<h5 style="font-size: 15px;"><?php echo $building_locality ?></h5>
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
    					<h5 style="font-size: 15px;"><?php echo $building_email; ?></h5>
    				</div>
    			</div>
    		</div>
    		
    		<div class="col s4">
    			<div class="row">
    			<h5 style="font-size: 15px;color: #867A58;text-decoration: underline;">Address</h5>
    				<div class="col s6">
    					<h6 style="color: #867A58;">City</h6>
    				</div>
    				<div class="col s4">
    					<h5 style="font-size: 15px;"><?php echo $building_city; ?></h5>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col s6">
    					<h6 style="color: #867A58;">State</h6>
    				</div>
    				<div class="col s4">
    					<h5 style="font-size: 15px;"><?php echo $building_state; ?></h5>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col s6">
    					<h6 style="color: #867A58;">Postal Code</h6>
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
    					<h6 style="color: #867A58;">Current Meter :</h6>
    				</div>
    				<div class="col s4">
    					<h5 style="font-size: 15px;"><?php echo $building_current_meter; ?></h5>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col s8">
    					<h6 style="color: #867A58;">Water Meter:</h6>
    				</div>
    				<div class="col s4">
    					<h5 style="font-size: 15px;"><?php echo $building_water_meter; ?></h5>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <div id="test4" class="col s12">Vendors</div>
	</div>

		</div>
	</div>
</div>
</body>