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
<title>MPRTS | Vendors</title>
<?php include 'db_config.php'; ?>
<?php include'headers.php'; ?>
<style>
	.vndr_title_bar{
		padding-top:7% !important;
	}
</style>
<link rel='stylesheet' href='styles/vendors.css' />
<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
<?php 
	$access_type = substr($user_access_code, 0, 2);
	if($access_type == 'OO'){
	echo "<style>
			.vendor_add_btn {
			display:none !important;
			}
			</style>";
	}
?>
<?php include 'left_content.php'; ?>
<script type="text/javascript">
	 $(document).ready(function() {
	 	$('#vendor_add_box').load('add_vendors.php');
		//$('#vendor_edit_box').load('edit_vendors.php');
    $('select').material_select();
    $('.modal').modal();
     $('.modal-overlay').remove();
  });
</script>
<div class="right_content">
	<?php include'nav_thread.php'; ?>
	<div class="vndr_title_bar" style="display:block !important;padding-top:7% !important;">
		<center><h5><b>Vendors</b>
		<a class="btn vendor_add_btn" href="#add_vendor_modal"><i class="material-icons left">add_box</i><span>Add Vendor</span></a>
		</h5>
		</center>
	</div>
	
	<div class="vendor_records_content">

		<div class="row vendor_records">
			<?php
				//$get_vendor_record_sql = mysql_query("SELECT * FROM mprts_vendors where access_code = '$user_access_code'");
				$sub_access_code = substr($user_access_code, 2, 4);
				//echo $sub_access_code;
				$get_vendor_record_sql = mysql_query("SELECT * FROM mprts_vendors where substr(access_code, 3, 4) = '$sub_access_code'");
				
				$vendors_count = mysql_num_rows($get_vendor_record_sql);
				if($vendors_count==0){
					echo "<center class='no_records'><i class='fas fa-binoculars'></i><h6>No Records found..!</h6></center>";
							echo "<style>
								table, .record_details{
									display:none;
								}
							</style>";
				}
				else {
				
				while($vendors_array = mysql_fetch_array($get_vendor_record_sql)){
					$vndr_id = $vendors_array['vndr_id'];
					$vndr_name = $vendors_array['vndr_name'];
					$vndr_profession = $vendors_array['vndr_profession'];
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
					
					
					echo "<div class='col l2 s4 vendor_cards' id='$vndr_id' onclick='show_vndr_details(this.id);'>
							<center>
								<p><img src='$vendor_icon'/></p>
								<p><b>$vndr_name</p></b>
								<p><label>$vndr_profession</label></p></b>
							</center>
						</div>";
				}
				}
			?>
		</div>
	</div>
	<div class="edit_expense_details">
		
	</div>
</div>


<!------------------------------------------------------------------------------------------------------------------------------------------ -->

  <!-- Modal Structure -->
  <div id="add_vendor_modal" class="modal modal-fixed-footer">
    <div class="modal-content" title="Vendors">
      <center><h5>Add Vendor</h5></center>
      <div id="vendor_add_box"></div>
    </div>
	<script type="text/javascript">
      	$('#vendors_close').click(function(){
      		//document.getElementById('tenant_asset_id').value = asset_id;
      	});
		var esc = $.Event("keydown", { keyCode: 27 });
		$(".modal-close").trigger(esc);
    </script>
	<div class="modal-footer" style="position:unset;">
      <a href="#!" id="vendors_close" class="main_vendor_close modal-action modal-close waves-effect waves-green btn-flat">Close</a>
      <a href="#!" id="vendors_close" class="resp_vendor_close modal-action modal-close waves-effect waves-green btn-flat"><i class="material-icons left">close</i></a>
    </div>
  </div>

<!------------------------------------------------------------------------------------------------------------------------------------------ -->

<script>
	function show_vndr_details(vndr_id){
		$('.vendor_records_content').html("<img src='images/preloader.gif'/>");
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
				//$('.vendor_records_content').html("<img src='images/preloader.gif'/>").html(response);
				//$('.record_details').html(add_tenant_html);
			}
		}); 
	}
</script>
</body>












