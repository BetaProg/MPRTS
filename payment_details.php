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
		if($access_type == 'OO'){
			echo "<style>
					.payment_email {
					display:none !important;
					}
				</style>";
		}
		
		$payment_id = $_POST['id'];
		
		$show_payment_sql = "SELECT * from mprts_payments where mprts_pmt_id='$payment_id'";
		$show_payment_execute = mysql_query($show_payment_sql);
		while ($row = mysql_fetch_array($show_payment_execute)) {
			$mprts_pmt_date = $row['mprts_pmt_date'];
			$mprts_pmt_tnt = $row['mprts_pmt_tnt'];
			$mprts_pmt_asset = $row['mprts_pmt_asset'];
			$mprts_pmt_act_amt = $row['mprts_pmt_act_amt'];
			$mprts_pmt_paid_amt = $row['mprts_pmt_paid_amt'];
			$mprts_pmt_due = $row['mprts_pmt_due'];
			$mprts_receipt_no = $row['mprts_receipt_no'];
			$mprts_pmt_from_date = $row['mprts_pmt_from_date'];
			$mprts_pmt_to_date = $row['mprts_pmt_to_date'];
			$mprts_pmt_cause = $row['mprts_pmt_cause'];
			$mprts_access_code = $row['mprts_access_code'];

			$pmt_date = substr($mprts_receipt_no, 4, 2).'-'.substr($mprts_receipt_no, 2, 2).'-'.'20'.substr($mprts_receipt_no, 0, 2);



			if(substr($mprts_receipt_no, -1) == 1){

				$show_tenant_sql = "SELECT * from mprts_tenants where tenant_id='$mprts_pmt_tnt'";
				$show_tenant_execute = mysql_query($show_tenant_sql);
				while ($row = mysql_fetch_array($show_tenant_execute)) {
					$tenant_name = $row['tenant_name'];
					$tenant_owner_id = $row['tenant_owner_id'];
					$tenant_propid = $row['tenant_propid'];
					$tenant_mobile = $row['tenant_mobile'];
					$tenant_email = $row['tenant_email'];
					$tenant_id_temp = 'TNT'.$mprts_pmt_tnt;


				$show_owner_name_sql = "SELECT * from mprts_owner where owner_id = $tenant_owner_id";
		      			$show_owner_name_execute = mysql_query($show_owner_name_sql);
		      			while($row_owner_name = mysql_fetch_array($show_owner_name_execute)){
		      				$tenant_owner_name = $row_owner_name['owner_name'];
		      				$tenant_owner_id = $row_owner_name['owner_id'];
		      	}

		      	//$show_building_details = mysql_query("SELECT * from mprts_buildings where building_id = (select building_id from mprts_buildings where building_access_code = '$user_access_code')");
		      	$show_building_details = mysql_query("SELECT * from mprts_buildings where building_id = (select building_id from mprts_buildings where substr(building_access_code, 3, 4) = substr('$user_access_code', 3, 4))");
		      	while($building_row = mysql_fetch_array($show_building_details)){
		      		$building_name = $building_row['building_name'];
		      		$building_locality = $building_row['building_locality'];
		      		$building_city = $building_row['building_city'];
		      		$building_state = $building_row['building_state'];
		      		$building_pincode = $building_row['building_pincode'];
		      		$building_phno = $building_row['building_phno'];
		      		$building_email = $building_row['building_email'];
		      	}

		      	$show_asset_details = mysql_query("SELECT * from mprts_property where prty_id = '$mprts_pmt_asset'");
		      	while($asset_row = mysql_fetch_array($show_asset_details)){
		      		$asset_no = $asset_row['prty_no'];
		      	}


				}

			}

			else {
				$show_owner_sql = "SELECT * from mprts_owner where owner_id='$mprts_pmt_tnt'";
				$show_owner_execute = mysql_query($show_owner_sql);
				while ($row = mysql_fetch_array($show_owner_execute)) {
					$tenant_name = $row['owner_name'];
					$tenant_mobile = $row['owner_mobile'];
					$tenant_email = $row['owner_email'];
					$tenant_owner_id = $row['owner_id'];
					$tenant_id_temp = 'ONR'.$mprts_pmt_tnt;


				$show_owner_name_sql = "SELECT * from mprts_owner where owner_id = $tenant_owner_id";
		      			$show_owner_name_execute = mysql_query($show_owner_name_sql);
		      			while($row_owner_name = mysql_fetch_array($show_owner_name_execute)){
		      				$tenant_owner_name = $row_owner_name['owner_name'];
		      				$tenant_owner_id = $row_owner_name['owner_id'];
		      	}

		      	$show_building_details = mysql_query("SELECT * from mprts_buildings where building_id = (select building_id from mprts_buildings where substr(building_access_code, 3, 4) = substr('$user_access_code', 3, 4))");
		      	while($building_row = mysql_fetch_array($show_building_details)){
		      		$building_name = $building_row['building_name'];
					echo "<script>console.log('$building_name');</script>";
		      		$building_locality = $building_row['building_locality'];
		      		$building_city = $building_row['building_city'];
		      		$building_state = $building_row['building_state'];
		      		$building_pincode = $building_row['building_pincode'];
		      		$building_phno = $building_row['building_phno'];
		      		$building_email = $building_row['building_email'];
		      	}

		      	$show_asset_details = mysql_query("SELECT * from mprts_property where prty_id = '$mprts_pmt_asset'");
		      	while($asset_row = mysql_fetch_array($show_asset_details)){
		      		$asset_no = $asset_row['prty_no'];
		      	}


				}

			}
		

		
	}

		// echo $payment_id;
		// echo "<br>";
		// echo $mprts_pmt_date;
		// echo "<br>";
		// echo $mprts_pmt_tnt;
		// echo "<br>";
		// echo $mprts_pmt_amt;
		// echo "<br>";
		// echo $mprts_pmt_reciept;

		// echo "<br>";
		// echo $tenant_name;
		// echo "<br>";
		// echo $tenant_owner_id;
		// echo "<br>";
		// echo $tenant_propid;
		// echo "<br>";
		// echo $tenant_email;
		// echo "<br>";
		// echo $tenant_owner_name;

	?>
	<style type="text/css">
		.payment_title_bar{
			!background-color: #25414E;
			background-color: #fff;
			color: #000;
		}
		.payment_title_bar h5 a{
			!color:#f2f2f2;
			!color:#000;
		}
		.payment_title_bar h5{
			padding:1%;
			font-size: 20px;
		}
		.payment_content{
			background-color: #fff;
			margin: 2%;
			border:1px solid #f2f2f2;
		}
		.sub_head{
			font-size: 16px;
			font-weight: bolder;
			text-align: center;
		}
		.payment_content .payment_section, .payment_content .tenant_section{
			border:1px solid #ddd;
		}
		.payment_content .s6 label{
			margin-top: 10px;
		}
		.payment_content .s12 h5{
			font-size: 15px;
			margin: 10px;
		}
	</style>
	<div class="payment_details_div">
	
		<div class="payment_title_bar row">
			<div class="col s2">
				<button class="btn waves-effect waves-light back_button" title="Back" style="float: left;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;background-color:#f2f2f2;" onclick="window.location.reload();">
				<i class="material-icons" style="font-size: 30px;">arrow_back</i>
				</button>
			</div>
			<div class="col s6">
				<h5>Payment Details</h5>
				<!-- <a href="whatsapp://send?text=The text to share!" data-action="share/whatsapp/share">Share via Whatsapp</a> -->
			</div>
			<div class="col s2 pmt_download_btn">
				<div id="cmd" onclick="print_specific_div_content();"><i class="material-icons">file_download</i></div>
			</div>
			<div class="col s2 pmt_download_btn payment_email">
				<div id="cmd"  style='color:#eb4d4b !important;' onclick="send_payment_mail();"><i class="material-icons">mail_outline</i></div>
			</div>
			

			<!-- <div id="editor"></div> -->

		</div>


		<div class="payment_content" id="payment_content">
			<div class="payment_row row">
				<div class="col l12 m12 s12 logo_content">
					<div class="row logo_content_row">
						<div class="col l6 m6 s12">
							<div class="row">
								<div class="col s12 pmt_mprts_title">
									<center><p><label>Receipt No. : </label><b><?php echo $mprts_receipt_no ?></b></p></center>
								</div>
							</div>
						</div>
						<div class="col l3 m3 s6 pmt_receipt_div">
							<p><label>Building : </label><?php echo $building_name; ?></p>
						</div>
						<div class="col l3 m3 s6 pmt_receipt_div">
							<p><label>Paid Date : </label><b><?php echo $pmt_date ?></b></p>
						</div>

					</div>
				</div>

				<div class="payment_main_content row" id="payment_main_content" style="border:none;">
					<div class="col l4 m4 s12" id="payment_details">
						<p><b>Payment Details</b></p><hr>
						<table>
							<!-- <tr>
								<td><label>Receipt No.: </label></td><td><?php echo $mprts_receipt_no ?></td>
							</tr> -->
							<tr>
								<td><label>Amount Paid: </label></td><td><b><?php echo '₹ '.$mprts_pmt_paid_amt ?></b></td>
							</tr>
							<tr>
								<td><label>Due Amount: </label></td><td><b><?php echo '₹ '.$mprts_pmt_due ?></b></td>
							</tr>
							<tr>
								<td><label>Payment period: </label></td><td><?php echo $mprts_pmt_from_date ?> - <?php echo $mprts_pmt_to_date ?></td>
							</tr>
							<tr>
								<td><label>Payment Purpose: </label></td><td><?php echo $mprts_pmt_cause ?></td>
							</tr>
						</table>
					</div>
					<div class="col l4 m4 s12" id="payee_details">
						<p><b>Payee Details</b></p><hr>
						<table>
							<tr>
								<td style='width:82px;'><label>Paid By: </label></td><td><?php echo $tenant_name ?></td>
							</tr>
							<tr>
								<td><label>Payee Id: </label></td><td><?php echo $tenant_id_temp ?></td>
							</tr>
							<tr>
								<td><label>Asset No: </label></td><td><?php echo $asset_no ?></td>
							</tr>
							<tr>
								<td><label>Payee Mobile: </label></td><td><?php echo $tenant_mobile ?></td>
							</tr>
							<tr>
								<td><label>Payee Email: </label></td><td  id="payee_email"><?php echo $tenant_email ?></td>
							</tr>
							
						</table>
					</div>
					<div class="col l4 m4 s12">
						<p><b>Payment Address</b></p><hr>
						<p><?php echo 'D.No - '.$asset_no ?></p>
						<p><?php echo $building_name ?>, <?php echo $building_locality ?></p>
						<p><?php echo $building_city ?>, <p><?php echo $building_state ?>, <?php echo $building_pincode ?></p></p>
						<p><?php echo $building_phno ?>, <?php echo $building_email ?></p>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div id="payment_address" style='display:none;'>
		<p>
			<center>
				<h5><?php echo $building_name; ?></h5>
				<p>
					<?php echo $building_name ?>, <?php echo $building_locality ?>,
					<?php echo $building_city ?>, <p><?php echo $building_state ?>, <?php echo $building_pincode ?>,
					<?php echo $building_phno ?>, <?php echo $building_email ?></p>
				</p>
			</center>
			<hr>
			<center><h5>RECEIPT</h5></center>
			<center>
				<table>
					<tr>
						<td style='text-align:center;'><label>Receipt No. : </label><b id="mail_receipt_no"><?php echo $mprts_receipt_no ?></b></td>
						<td style='text-align:center;'><label>Paid Date : </label><b><?php echo $pmt_date ?></b></td>
					</tr>
				</table>
			</center>
		</p>
		<table>
			<tr>
				<td>
					<div class="col l4 m4 s12" id="payment_details">
						<p style='background-color:#ddd;color:#fff;width:100%;height:30px;text-align:center;'><b>Payment Details</b></p>
						<table border="1" style='border:1px solid #f2f2f2;'>
							<!-- <tr>
								<td><label>Receipt No.: </label></td><td><?php echo $mprts_receipt_no ?></td>
							</tr> -->
							<tr>
								<td><label>Amount Paid: </label></td><td><b><?php echo '₹ '.$mprts_pmt_paid_amt ?></b></td>
							</tr>
							<tr>
								<td><label>Due Amount: </label></td><td><b><?php echo '₹ '.$mprts_pmt_due ?></b></td>
							</tr>
							<tr>
								<td><label>Payment period: </label></td><td><?php echo $mprts_pmt_from_date ?> - <?php echo $mprts_pmt_to_date ?></td>
							</tr>
							<tr>
								<td><label>Payment Purpose: </label></td><td><?php echo $mprts_pmt_cause ?></td>
							</tr>
						</table>
					</div>
				</td>
				<td>
					<div class="col l4 m4 s12" id="payee_details">
						<p style='background-color:#ddd;color:#fff;width:100%;height:30px;text-align:center;'><b>Payee Details</b></p>
						<table border="1" style='border:1px solid #f2f2f2;'>
							<tr>
								<td><label>Paid By: </label></td><td><?php echo $tenant_name ?></td>
							</tr>
							<tr>
								<td><label>Payee Id: </label></td><td><?php echo $tenant_id_temp ?></td>
							</tr>
							<tr>
								<td><label>Asset No: </label></td><td><?php echo $asset_no ?></td>
							</tr>
							<tr>
								<td><label>Payee Mobile: </label></td><td><?php echo $tenant_mobile ?></td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>
	</div>
</body>
<script type="text/javascript">
	// var doc = new jsPDF();
	// var specialElementHandlers = {
	//     '#editor': function (element, renderer) {
	//         return true;
	//     }
	// };

	// $('#cmd').click(function () {
	//     doc.fromHTML($('.table_it').html(), 15, 15, {
	//         'width': 170,
	//             'elementHandlers': specialElementHandlers
	//     });
	//     doc.save('sample-file.pdf');
	// });
content = "";
content = "<html style='border:1px solid black !important;'>";
    content += "<link rel=\"stylesheet\" href=\"styles/materialize.min.css\">";
    content += "<link rel=\"stylesheet\" href=\"styles/index_style.css\"><link rel=\"stylesheet\" href=\"styles/owner_styles.css\"><link rel=\"stylesheet\" href=\"styles/owner_page.css\"><link rel=\"stylesheet\" href=\"styles/enhance.css\"><link rel=\"stylesheet\" href=\"styles/resp.css\">";
    content += "<body onload=\"window.print();\">";
    //content += document.getElementById("payment_content").innerHTML ;
	content += document.getElementById("payment_address").innerHTML;
	//content += document.getElementById("payment_details").innerHTML;
	//content += document.getElementById("payee_details").innerHTML;
	//content += document.getElementById("payment_main_content").innerHTML ;
    content += "<span style='padding:5px;'><hr><h5 style='font-size:10px;margin-left:15px;'>Authorized Signatory</h5>";
    content += "<b style='margin-left:15px;'><?php echo $building_name ?></b>";
    content += "<p style='text-align:center;'>This is a system generated Invoice or Receipt and does not require a signature.In case of any discrepancy in the Invoice or Receipts, immediately inform the issuing authority.</p>";
    content += "<div style='float:right;'>Genarated by";
    content += "<p><img src='images/rounded_logo.png' width='50px'></p><p style='margin-right:25px;font-weight:bolder;'>MaaProperties.com</p></div></span>";
    content += "</body>";
    content += "</html>";
	function print_specific_div_content(){
    var win = window.open('','','left=0,top=0,width=auto,height=477,toolbar=0,scrollbars=0,status =0');
    
    win.document.write(content);
    win.document.close();
}

function send_payment_mail(){
    var r = confirm("Are you sure you want to mail this payment!");
    if (r == true) {
        var mail_sub = "Maa Properties Payment | "+document.getElementById('mail_receipt_no').innerText;
	var message = "<h5><p>Hi Sir/Madam,</p><p> You have a new payment notification from Maa Properties. Please find the details below</p></h5>"+content;
	var user_email = document.getElementById('payee_email').innerText;
	var mail_data_to_pass = mail_sub+"#$#"+message+"#$#"+user_email;
	$.ajax({
		      url: "send_payment_mail.php",
		      data: {
		        payment_details_to_mail: mail_data_to_pass
		      },
		      type: 'post',
		      cache: false,
		      success: function(value){
		             //alert('Payment Added Successfully');
		             //location.reload();
					 console.log(value);
		        }
		    });
    } 
	
}
</script>