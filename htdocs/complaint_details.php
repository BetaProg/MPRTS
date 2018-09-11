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
<script>
	$(document).ready(function() {
		$('select').material_select();
	});
</script>
<style>
	.complaint_content{
		min-height: 300px;
		border: 1px solid #000;
	}
	<style>
	.complaints_col{
		!box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3) !important;
		box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 1px 5px 0 rgba(0,0,0,0.12), 0 3px 1px -2px rgba(0,0,0,0.2) !important;
	}
	
	.complaints_icon{
		border-radius: 50%;
		border: 1px solid #16a085;
		padding: 6px 8px 9px 8px !important;
		margin: 10px 10px 10px 0px;
	}
	.details_container{
		padding-top:6%;
	}
	.resp_edit_tite{
		padding-top:5px;
		background-color:#fff;
	}
	.resp_owner_image, .resp_tenant_image{
		border:none;
		border-radius:0px;
		box-shadow:none;
	}
	.caret {
		margin-top:15px !important;
	}
	.select-dropdown{
		margin-bottom:0px !important;
		!height:30px !important;
		height:auto !important;
		border-bottom: 0px !important;
	}
	.select-dropdown li{
		min-height:30px;
	}
	.select-dropdown li span{
		padding:2px 4px;
		color:#757575;
	}
	.complaint_status_select{
		height:30px;
	}
	
</style>
</style>
<link rel="stylesheet" type="text/css" href="styles/font-awesome/css/font-awesome.min.css">
	<style>
		
	</style>
<body>
<title>MPRTS | Complaint Details</title>
	<?php include 'db_config.php'; ?>
	<?php //include 'headers.php'; ?>
	<?php 
		$access_type = substr($user_access_code, 0, 2);
		if($access_type == 'OO'){
		echo "<style>
				.edit_complaint, .delete_complaint {
				display:none !important;
				}
				</style>";
		}
	?>
	<?php 
		$complaint_id = $_POST['complaint_id'];
		
		$_SESSION["complaint_id"] = $complaint_id;
		
		$show_complaint_sql = mysql_query("SELECT * from mprts_complaints where complaint_id='$complaint_id'");
		while ($row = mysql_fetch_array($show_complaint_sql)) {
			$complaint_date = $row['complaint_date'];
			$complaint_id = $row['complaint_id'];
			$complaint_title = $row['complaint_title'];
			$complaint_desc = $row['complaint_desc'];
			$complaint_status = $row['complaint_status'];
			$complaint_association = $row['complaint_association'];
			
			echo "<script>sessionStorage.setItem('complaint_id', '$complaint_id')</script>";
			
			if($complaint_status == '111'){
				$complaint_status_text = "Read";
				echo "<script>$('.complaint_status_select').css('color', '#fed330');</script>";
			}
			else if($complaint_status == '222'){
				$complaint_status_text = "In Progress";
				echo "<script>$('.complaint_status_select').css('color', '#45aaf2');</script>";
			}
			else if($complaint_status == '333'){
				$complaint_status_text = "Completed";
				echo "<script>$('.complaint_status_select').css('color', '#26de81');</script>";
			}
			/*$complaint_day = substr($complaint_date, 4, 2);
			$complaint_month = substr($complaint_date, 2, 2);
			$complaint_year = '20'.substr($complaint_date, 0, 2);
			$final_complaint_date = $complaint_day."-".$complaint_month."-".$complaint_year;
			*/
			
			//if($complaint_association != "ALL ASSETS"){
				//$get_asset_details = mysql_query("select * from mprts_property where prty_id = substr('$complaint_association', 4, 4)");
				$get_asset_details = mysql_query("select * from mprts_property where prty_id = '$complaint_association'");
				while($asset_row = mysql_fetch_array($get_asset_details)){
					$complaint_asset_number = $asset_row['prty_no'];
					$complaint_asset_owner = $asset_row['prty_owner'];
					
					$get_asset_owner = mysql_query("select * from mprts_owner where owner_id = '$complaint_asset_owner'");
					while($owner_row = mysql_fetch_array($get_asset_owner)){
						$owner_name = $owner_row['owner_name'];
						$owner_mobile = $owner_row['owner_mobile'];
						$owner_image = $owner_row['owner_photo'];
					}
					
				}
			//}
			/*else {
				$complaint_asset_number = "All Assets";
				$owner_name = "All Asset Owners";
			}*/
		}
	?>

	<div class="row main_sub_title_bar">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Admin Dashboard</a> - <a href="complaints_content.php">Complaint Details</a> - <b><?php echo $complaint_id; ?></b></h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
  			<button class="btn waves-effect waves-light delete_complaint" title="Delete" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" id='<?php echo $complaint_id; ?>' onclick="delete_complaint(this.id);">Delete
    			<i class="material-icons right">delete</i>
  			</button>
  			<button class="btn waves-effect waves-light edit_button edit_complaint" title="Edit" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" id='<?php echo $complaint_id; ?>'  onclick="edit_complaint(this.id);">
    			<i class="material-icons right">edit</i>Edit
  			</button>
		</div>
	</div>
	<!-- ---------------------------------------- Sub View Container Starts ------------------------------------------ -->

			<div class="resp_sub_title_bar">
				<div class="row details_container">
					<div class="row resp_edit_tite">
						<div class="col s2">
							<button class="btn waves-effect waves-light back_button" title="Back" style="float: left;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;background-color:#f2f2f2;" onclick="window.location.reload();">
							<i class="material-icons" style="font-size: 30px;">arrow_back</i>
							</button>
						</div>
						<div class="col s6" style="margin-top: 2%;">
							<h5 class="content_name" ><?php echo $complaint_date ?></h5>
						</div>
						<div class="col s4" style="margin-top: 0%;">
							<h6 style='float:right;margin-right:15%;font-size:15px;'>
							
							
							<!--<?php echo $complaint_status_text; ?>-->
							<div class='row'>
								<div class="input-field col s12 m6 complaint_status_select" style='margin-top:0px;'>
									<select class="icons complaint_status_select">
									  <option value="" disabled selected><?php echo $complaint_status_text; ?></option>
									  <option value="read" >Read</option>
									  <option value="inprogress" >In Progress</option>
									  <option value="completed" >Completed</option>
									</select>
								</div>
							</div>
							
							</h6>
						</div>
						
					</div>
					<div class="row" style='background-color:#fff;margin:2% auto 2% auto;'>
						<div class="col s2" style='margin:5% 0% 5% 5%;'>
							<img width='40px' style='border-radius:50%;' src="<?php echo $owner_image ?>">
						</div>
						<div class="col s6" style="margin: 4% 1% 4% 4%;">
							<h5 style='color:#000 !important;margin:' class="content_name" ><?php echo $owner_name ?></h5>
							<p style='margin:0px;color:grey;'><?php echo $complaint_asset_number; ?></p>
							<!--<p style='margin:0px;'><?php echo $owner_mobile; ?></p>-->
						</div>
					</div>
					<div class="resp_owner_image" style='height:80px;color:#2980b9;margin-top:1px;margin-bottom:1px;'>
						<!--<center><img src="images/property1.jpg"></center>-->
						
						<h5 style='height:40px;margin: 2% auto 2% auto;'><i class='material-icons complaints_icon' style='margin-left:21px;margin-top:0px;'>format_quote</i><b style='font-size:20px;margin-left:24px;'><?php echo $complaint_title ?></b></h5>
						<!--<h5 style='margin: 2% auto auto 25%;'><label>Asset : </label><b style='font-size:15px;'><?php echo $complaint_asset_number; ?></b></h5>-->
					</div>
					
					<div class="resp_owner_image" style='height:auto;min-height:50px;color:#2980b9;'>
					<label style='margin: 8% auto auto auto;'><h style='font-size:15px;color:grey;'>Complaint Details</h></label>
						<!--<center><img src="images/property1.jpg"></center>-->
						<p><h5 style="color:#000;font-weight: normal;font-size: 18px;padding:4%;background-color:#fff;"><?php echo $complaint_desc; ?></h5></p>
					</div>
				</div>
			</div>

	<!-- ---------------------------------------- Sub View Container Ends ------------------------------------------ -->

	<div class="complaint_details_content" style="margin-top: 2%;">
		<div class="row owner_details">
			<div class="owner_info">
			<div class="row">
				<div class="col s12"> 
					<div class="row">
						<div class="col s12 complaint_content">
							<label>Content:</label>
							<h5 class="" style="color:#000;font-weight: normal;font-size: 18px;"><?php echo $complaint_desc; ?></h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>


</body>
<script>
	$('.complaint_status_select').on("change", function(){
		if($(this).val()=='read'){
			$('.complaint_status_select').css('color', '#fed330');
			update_complaint($(this).val());
		}
		else if($(this).val()=='inprogress'){
			$('.complaint_status_select').css('color', '#45aaf2');
			update_complaint($(this).val());
		}
		else if($(this).val()=='completed'){
			$('.complaint_status_select').css('color', '#26de81');
			update_complaint($(this).val());
		}
	});
	function delete_complaint(complaint_id){
		$.ajax({
      url: "delete_complaint.php",
      data: {
        complaint_id: complaint_id
      },
      type: 'post',
      cache: false,
      success: function(delete_complaint_html){
          alert('Complaint '+ complaint_id +' Deleted successfully');
          window.location = 'complaints_content.php';
      }
    })
	}
	
	function update_complaint(complaint_status){
		var complaint_data = complaint_status;
		$.ajax({
      url: "add_complaint_backend.php",
      data: {
        complaint_data: complaint_data
      },
      type: 'post',
      cache: false,
      success: function(complaint_status){
          alert("Complaint updated Successfully");
          //window.location = 'complaint_content.php';
      }
    })
	}
</script>


