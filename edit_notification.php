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
		$notification_id = $_POST['notification_id'];
		$show_notification_sql = mysql_query("SELECT * from mprts_notifications where notification_id='$notification_id'");
		while ($row = mysql_fetch_array($show_notification_sql)) {
			$notification_id = $row['notification_id'];
			$notification_title = $row['notification_title'];
			$notification_date = $row['notification_date'];
			$notification_text = $row['notification_text'];
		}
	?>

	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Dashboard</a> - <a href="notifications_content.php">Edit Notification Details</a> - <b><?php echo $notification_id; ?></b></h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
			<button class="btn waves-effect waves-light" title="Cancel" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="window.location.reload();">Cancel
    			<i class="material-icons right">cancel</i>
  			</button>
  			<button class="btn waves-effect waves-light" title="Save" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" onclick="save_notification();">Save
    			<i class="material-icons right">save</i>
  			</button>
		</div>
	</div>

	<div class="row resp_edit_tite">
		<div class="col s2">
			<button class="btn waves-effect waves-light back_button" title="Back" style="float: left;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
			<i class="material-icons" style="font-size: 30px;">arrow_back</i>
			</button>		
		</div>
		<div class="col s6" style="margin-top: 2%;padding-left: 15%;">
			<h5 class="content_name" ><b><?php echo $owner_name ?></b></h5>					
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light save_button save_building" title="Save" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="save_notification();">
    			<i class="material-icons" style="font-size: 30px;">save</i>
  			</button>		
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light cancel_button cancel_edit_building" title="Cancel" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
    			<i class="material-icons" style="font-size: 30px;">cancel</i>
  			</button>		
		</div>
	</div>


	<div class="edit_content">
		<div class="row">
		<center>
			<div class="col  l6 m6 s12 z-depth-3" style="height: 60%;">
				<table>
					<tr>
						<td><label>Notification Title</label></td>
						<td><input type="text" name="notification_title" value="<?php echo $notification_title; ?>" required="true"></td>
					</tr>
					<tr>
						
						<td><label>Notification Text</label></td>
						<td><input type="text" name="notification_text" value="<?php echo $notification_text; ?>" required="true"></td>
						
					</tr>
				</table>
			</div>
		</center>	
		</div>
	</div>
</body>
<script type="text/javascript">
	function save_notification(){
	 	new_notification_title = $("[name='notification_title']").val();
	 	new_notification_text = $("[name='notification_text']").val();

	 	data_to_edit = new_notification_title+'#$#'+new_notification_text+'#$#'+'<?php echo $notification_id; ?>';

	 	$.ajax({
	      url: "edit_notification_backend.php",
	      data: {
	        data_passed: data_to_edit
	      },
	      type: 'post',
	      cache: false,
	      success: function(save_edit_notification_html){
	          // $('.record_details').html(save_edit_building_html);
	          alert('Updation Successful');
	          window.location.reload();
	      }
	    })

	}
</script>
<script type="text/javascript">
	// if('<?php echo $building_type ?>'=='Appartment'){
	// 	$('#b_apt').prop("checked", true);
	// }
	// else {
	// 	$('#b_hse').prop("checked", true);
	// }
</script>