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
<script type="text/javascript">
	 $(document).ready(function() {
	 	//$('#vendor_edit_box').load('edit_vendors.php');
		$('select').material_select();
		//$('.modal').modal();
		//$('.modal-overlay').remove();
  });
</script>
<script>
	function show_vndr_details(vndr_id){
		$.ajax({
			url: "vendor_details.php",
			data: {
				vndr_id_passed: vndr_id
			},
			type: 'post',
			cache: false,
			success: function(response){
				//alert(response);
				$('.vendor_records_content').html(response);
				//$('.record_details').html(add_tenant_html);
			}
		}); 
	}
</script>
<body>
<title>MPRTS | Vendor Details</title>

	<?php include 'db_config.php'; ?>
	<?php 
		$access_type = substr($user_access_code, 0, 2);
		if($access_type == 'OO'){
		echo "<style>
				.update, .delete_asset {
				display:none !important;
				}
				</style>";
		}
	?>
	<script>
		$('.show_all_vndrs').on('click', (function() {
			if($('#all_prty_vndrs').css('display')=='none'){
				$('#all_prty_vndrs').css('display', 'block');
			}
			else if($('#all_prty_vndrs').css('display')=='block'){
				$('#all_prty_vndrs').css('display', 'none');
			}
		}));
	</script>
	<a class="show_all_vndrs"><i class="material-icons">arrow_drop_down_circle</i></a>
	<div class='all_prty_vndrs' id='all_prty_vndrs'>
		<?php 
			echo "<div class='row upper_row'>";
			$get_vendor_record_sql = mysql_query("SELECT * FROM mprts_vendors where substr(access_code, 3, 4) = substr('$user_access_code', 3, 4)");
			
			 while($vendors_array = mysql_fetch_array($get_vendor_record_sql)){
				$vndr_id = $vendors_array['vndr_id'];
				$vndr_name = $vendors_array['vndr_name'];
				$vndr_profession = $vendors_array['vndr_profession'];
				
				$get_icon_all = set_icon($vndr_profession);
				
				echo "<div class='col l1 s6' id='$vndr_id' onclick='show_vndr_details(this.id);'>
						<center>
							<p><img src='$get_icon_all' width='30px;'/></p>
							<p>$vndr_profession</p>
						</center>
					</div>";
			}
			echo "</div>";
		?>
	</div>
	<?php 
		function set_icon($vndr_profession) {
			if($vndr_profession == "Carpenter"){
				$vendor_icon = 'images/icons/saw.png';
			}
			else if($vndr_profession == "Current Line Man"){
				$vendor_icon = 'images/icons/electric_tower.png';
			}
			else if($vndr_profession == "Driver Services"){
				$vendor_icon = 'images/icons/driver.png';
			}
			else if($vndr_profession == "Painter"){
				$vendor_icon = 'images/icons/painter.png';
			}
			else if($vndr_profession == "Carpet Cleaner"){
				$vendor_icon = 'images/icons/carpet.png';
			}
			else if($vndr_profession == "Key Makers"){
				$vendor_icon = 'images/icons/keys.png';
			}
			else if($vndr_profession == "Electricians"){
				$vendor_icon = 'images/icons/electrician.png';
			}
			else if($vndr_profession == "Maid"){
				$vendor_icon = 'images/icons/maid.png';
			}
			else if($vndr_profession == "Masons"){
				$vendor_icon = 'images/icons/worker.png';
			}
			else if($vndr_profession == "Pest Control"){
				$vendor_icon = 'images/icons/spray.png';
			}
			else if($vndr_profession == "Plumber"){
				$vendor_icon = 'images/icons/faucet.png';
			}
			else if($vndr_profession == "Repairs"){
				$vendor_icon = 'images/icons/wrench.png';
			}
			else if($vndr_profession == "Tyre - Punctures"){
				$vendor_icon = 'images/icons/tyre_expert.png';
			}
			else if($vndr_profession == "Others"){
				$vendor_icon = 'images/icons/cogwheel.png';
			}
			else if($vndr_profession == "Watchman"){
				$vendor_icon = 'images/icons/policeman.png';
			}
			else if($vndr_profession == "Water Tanker Services"){
				$vendor_icon = 'images/icons/tanker.png';
			}
			return $vendor_icon;
		}
	?>

	<?php 
		$vndr_id = $_POST['vndr_id_passed'];
		$show_vndr_details = mysql_query("SELECT * from mprts_vendors where vndr_id = '$vndr_id'");
		while($vndr_details_row = mysql_fetch_array($show_vndr_details)){
			$vndr_name = $vndr_details_row['vndr_name'];
			$vndr_profession = $vndr_details_row['vndr_profession'];
			$vndr_company = $vndr_details_row['vndr_company'];
			$vndr_website = $vndr_details_row['vndr_website'];
			$vndr_locality = $vndr_details_row['vndr_locality'];
			$vndr_city = $vndr_details_row['vndr_city'];
			$vndr_state = $vndr_details_row['vndr_state'];
			$vndr_pincode = $vndr_details_row['vndr_pincode'];
			$vndr_phone1 = $vndr_details_row['vndr_phone1'];
			$vndr_phone2 = $vndr_details_row['vndr_phone2'];
			$vndr_email = $vndr_details_row['vndr_email'];
			
			
			$get_icon = set_icon($vndr_profession);
			//----------------------------------------------------------------------------------------------------------
			/* echo "<div class='row upper_row'>";
			$get_vendor_record_sql = mysql_query("SELECT * FROM mprts_vendors where access_code = '$user_access_code'");
			
			 while($vendors_array = mysql_fetch_array($get_vendor_record_sql)){
				$vndr_id = $vendors_array['vndr_id'];
				$vndr_name = $vendors_array['vndr_name'];
				$vndr_profession = $vendors_array['vndr_profession'];
				
				$get_icon_all = set_icon($vndr_profession);
				
				echo "<div class='col s2' id='$vndr_id' onclick='show_vndr_details(this.id);'><center><p><img src='$get_icon_all' width='50px;'/></p><p><b>$vndr_profession</p></b></center></div>";
			}
			echo "</div>";
			 */
			
			//----------------------------------------------------------------------------------------------------------
			
			echo "<hr style='color:#f2f2f2;'>";
			echo "<div class='row'>
					<div class='col l2 s12 vndr_icon'>
						<div class='row show-image'>
							<div class='col s12'>
								<center><p><img src='$get_icon'/></p></center>
							</div>
							<div class='col s12'>
								<center><p>$vndr_profession</p></center>
							</div>
						</div>
<a class='btn update' id=$vndr_id onclick='edit_vndr_details(this.id);'><i class='material-icons' style='font-size: 15px;'>edit</i></a>
<button class='btn delete_asset edit_owner delete' href='#delete_vendor_modal' title='Delete' id='<?php echo $vndr_id; ?>'  >
	<i class='material-icons' style='font-size: 15px;'>delete</i>
</button>
					</div>
					<div class='col l3 s12'>
						<table class='bordered striped'>
							<tr><td style='width:120px;'>Name</td><td>$vndr_name</td></tr>
							<tr><td>Email</td><td>$vndr_email</td></tr>
							<tr><td>Type</td><td>$vndr_company</td></tr>
							<tr><td>Website</td><td>$vndr_website</td></tr>
						</table>
					</div>
					<div class='col l4 s12'>
						<div class='row'>
							<table class='bordered striped'>
							<tr><td style='width:120px;'>Locality</td><td>$vndr_locality</td></tr>
							<tr><td>City</td><td>$vndr_city</td></tr>
							<tr><td>Mobile</td><td>$vndr_phone1</td></tr>
							<tr><td>2nd Number</td><td>$vndr_phone2</td></tr>
						</table>
						</div>
					</div>
				</div>";
		}
	?>
	

	
<script>
	/*function edit_vndr_details(vndr_id){
		sessionStorage.setItem('Vndr_id', vndr_id);
		$.ajax({
		  url: "edit_vendors.php",
		  data: {
			vndr_id_passed: vndr_id
		  },
		  type: 'POST',
		  cache: false,
		  success: function(edit_vndr_html){
			  //$('.record_details').html(add_owner_html);
			  $('.edit_expense_details').load('edit_vendors.php');
		  }
		})
	}*/
	
	function edit_vndr_details(vndr_id) {
	 $('.record_details').html("<img src='images/preloader.gif'/>");
     $.ajax({
      url: "edit_vendors.php",
      data: {
        vndr_id_passed: vndr_id
      },
      type: 'post',
      cache: false,
      success: function(edit_vndr_html){
          //$('.edit_expense_details').html('edit_vndr_html');
          $('.vendor_records_content').html(edit_vndr_html);
      }
    })
  }
</script>

	
	
	
	
	
	
	
	
	
	
	
	
	
	