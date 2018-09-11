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
<style>
	.notification_content{
		min-height: 300px;
		border: 1px solid #000;
	}
	<style>
	.notifications_col{
		!box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3) !important;
		box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 1px 5px 0 rgba(0,0,0,0.12), 0 3px 1px -2px rgba(0,0,0,0.2) !important;
	}
	
	.notifications_icon{
		border-radius: 50%;
		border: 1px solid #16a085;
		padding: 6px 8px 9px 8px !important;
		margin: 10px 0px 10px 0px;
	}
	.details_container{
		padding-top:7%;
	}
	
</style>
</style>
<link rel="stylesheet" type="text/css" href="styles/font-awesome/css/font-awesome.min.css">
	<style>
		
	</style>
<body>
<title>MPRTS | Notification Details</title>
	<?php include 'db_config.php'; ?>
	<?php //include 'headers.php'; ?>
	<?php 
		$access_type = substr($user_access_code, 0, 2);
		if($access_type == 'OO'){
		echo "<style>
				.edit_expense, .delete_expense {
				display:none !important;
				}
				</style>";
		}
	?>
	<?php 
		$notification_id = $_POST['notification_id'];
		
		$show_notification_sql = mysql_query("SELECT * from mprts_notifications where notification_id='$notification_id'");
		while ($row = mysql_fetch_array($show_notification_sql)) {
			$notification_date = $row['notification_date'];
			$notification_id = $row['notification_id'];
			$notification_title = $row['notification_title'];
			$notification_text = $row['notification_text'];
			$notification_association = $row['notification_association'];
			
			$notification_day = substr($notification_date, 4, 2);
			$notification_month = substr($notification_date, 2, 2);
			$notification_year = '20'.substr($notification_date, 0, 2);
			$final_notification_date = $notification_day."-".$notification_month."-".$notification_year;			
			
			if($notification_association != "ALL ASSETS"){
				$get_asset_details = mysql_query("select * from mprts_property where prty_id = substr('$notification_association', 4, 4)");
				while($asset_row = mysql_fetch_array($get_asset_details)){
					$notification_asset_number = $asset_row['prty_no'];
					$notification_asset_owner = $asset_row['prty_owner'];
					
					$get_asset_owner = mysql_query("select * from mprts_owner where owner_id = '$notification_asset_owner'");
					while($owner_row = mysql_fetch_array($get_asset_owner)){
						$owner_name = $owner_row['owner_name'];
					}
					
				}
			}
			else {
				$notification_asset_number = "All Assets";
				$owner_name = "All Asset Owners";
			}
		}
	?>

	<div class="row main_sub_title_bar">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Admin Dashboard</a> - <a href="notifications_content.php">Notification Details</a> - <b><?php echo $notification_id; ?></b></h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
  			<button class="btn waves-effect waves-light delete_notification" title="Delete" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" id='<?php echo $notification_id; ?>' onclick="delete_notification(this.id);">Delete
    			<i class="material-icons right">delete</i>
  			</button>
  			<button class="btn waves-effect waves-light edit_button edit_notification" title="Edit" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" id='<?php echo $notification_id; ?>'  onclick="edit_notification(this.id);">
    			<i class="material-icons right">edit</i>Edit
  			</button>
		</div>
	</div>
	<!-- ---------------------------------------- Sub View Container Starts ------------------------------------------ -->

			<div class="resp_sub_title_bar">
				<div class="row details_container">
					<div class="row notification_details_container">
						<div class="col s9" style="padding-top: 2%;padding-left: 5%;">
							<h5 class="content_name"><b>NOT<?php echo $notification_id; ?></b></h5>					
						</div>
						<div class="col s3" style="padding-left:0px;padding-right: 0px;">
				  			<button class="btn waves-effect waves-light edit_button edit_owner" title="Edit" style="float: left;background-color: #f2f2f2;color:#000;margin:10% auto 10% 2%;border-radius: 5px;padding-left: 10px;padding-right: 10px;" id='<?php echo $notification_id; ?>'  onclick="edit_notification(this.id);">
				    			<i class="material-icons" style="font-size: 15px;">edit</i>
				  			</button>
				  			<button class="btn waves-effect waves-light delete_asset edit_owner" title="Delete" style="float: left;background-color: #f2f2f2;color:#000;margin:10% auto 10% 10%;border-radius: 5px;padding-left: 10px;padding-right: 10px;" id='<?php echo $notification_title; ?>'  onclick="">
				    			<i class="material-icons" style="font-size: 15px;color: red;">delete</i>
				  			</button>		
						</div>
					</div>
					
					
					
					
					
					
					
					
					
					
					
					
					<div class="row resp_edit_tite pagination" style='padding:2%;height:auto;'>
						<div class="col s2">
							<button class="btn waves-effect waves-light back_button" title="Back" style="float: left;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;background-color:#f2f2f2;" onclick="window.location.reload();">
							<i class="material-icons" style="font-size: 30px;">arrow_back</i>
							</button>
						</div>
						<div class="col s6" style="margin-top: 2%;">
							<h5 class="content_name" ><?php echo $owner_name ?></h5>
						</div>
					</div>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<div class="resp_owner_image z-depth-0" style='height:150px;color:#2980b9;'>
						<!--<center><img src="images/property1.jpg"></center>-->
						<center>
							<i class='material-icons notifications_icon'>notifications_none</i>
						</center>
						<center><h5 style='margin: 4% auto 2% auto;'><b style='font-size:15px;'><?php echo $notification_title ?></b></h5>
						<label style='margin: 8% auto 2% auto;'><b style='font-size:15px;'>Date:<?php echo $final_notification_date ?></b></label>
						</center>
						<!--<h5 style='margin: 2% auto auto 25%;'><label>Asset : </label><b style='font-size:15px;'><?php echo $notification_asset_number; ?></b></h5>-->
					</div>
					
					<div class="resp_owner_image z-depth-0" style='height:auto;min-height:150px;color:#2980b9;'>
					<label style='margin: 8% auto auto auto;'><b style='font-size:15px;'>Description :</b></label>
						<!--<center><img src="images/property1.jpg"></center>-->
						<p><h5 style="color:#000;font-weight: normal;font-size: 18px;padding:4%;background-color:#fff;"><?php echo $notification_text; ?></h5></p>
					</div>
				</div>
			</div>

	<!-- ---------------------------------------- Sub View Container Ends ------------------------------------------ -->

	<div class="notification_details_content" style="margin-top: 2%;">
		<div class="row owner_details">
			<div class="owner_info">
			<div class="row">
				<div class="col s12"> 
					<div class="row">
						<div class="col s12 notification_content">
							<label>Content:</label>
							<h5 class="" style="color:#000;font-weight: normal;font-size: 18px;"><?php echo $notification_text; ?></h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>


</body>
<script>
	function delete_notification(notification_id){
		$.ajax({
      url: "delete_notification.php",
      data: {
        notification_id: notification_id
      },
      type: 'post',
      cache: false,
      success: function(delete_notification_html){
          alert('Notification '+ notification_id +' Deleted successfully');
          window.location = 'notification_content.php';
      }
    })
	}
</script>


