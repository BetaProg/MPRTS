<?php
	session_start();
	$user_name = $_SESSION["user_name"] ;
	$user_access_code = $_SESSION["user_access_code"];
?>
<body>
<script type="text/javascript">
	 $(document).ready(function() {
    	$('select').material_select();
		$('#asset_list').load('asset_list.php');
		$('.modal').modal();
		$('.modal-overlay').remove();
  	});
</script>
<title>MPRTS | Add Notification</title>
	<?php include 'db_config.php'; ?>
	<?php //include 'headers.php'; ?>
<div class="add_content_div" style="margin-top: 1%;" title="Add Notification">
<!--<form action="add_notification_backend.php" method="post">-->
	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5>Create a new Notification</h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
				<button class="btn waves-effect waves-light" title="Cancel" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="window.location.reload();">Cancel
    			<i class="material-icons right">cancel</i>
  			</button>
				<button class="btn waves-effect waves-light" title="Save record" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" type="submit" name="notificationsubmit">Save
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
		<div class="col s6" style="margin-top: 0%;padding-left: 10%;">
			<h5 class="content_name" ><b>Add Notification</b></h5>					
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light save_button save_owner" title="Save" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" name="notificationsubmit" id="notificationsubmit">
    			<i class="material-icons" style="font-size: 30px;">save</i>
  			</button>		
		</div>
		<div class="col s2">
  			<button class="btn waves-effect waves-light cancel_button cancel_edit_building" title="Cancel" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="window.location.reload();">
    			<i class="material-icons" style="font-size: 30px;">cancel</i>
  			</button>		
		</div>
	</div>

	<script>
	$(document).ready(function() {
		d = new Date();
		month = d.getMonth()+1;
		if(month<10){
			month='0'+month;
		}
		day = d.getDate();
		if(day<10){
			day='0'+day;
		}
		year = d.getFullYear().toString().substr(-2);
		date = year.toString()+month.toString()+day.toString();
		console.log(date);
		$('#notification_date').val(date);
	});
		
		
	</script>

	<div class="row add_owner_form">
		<div class="col l12 m6 s12 z-depth-3 notification_form" style="">
			<center><label style="font-weight: bolder;">Notification Details</label></center>
			<hr style="border-color: #2BBBAD;">

		    <div class="input-field col s12">
				<input type="text" name="notification_title" required="true" maxlength="30">
				<label for="owner_name">Title</label>
			</div>
			
			<label>Notification Association</label>
			<div class="row">
				<div class="col s9">
					<input type="text" id="notification_assc_id" name="notification_assc_id" placeholder="Ex: AST0001" required="true" title="Select from the search button">
				</div>
				<div class="col s3" style="padding: 0px;">
					<a class="btn" id='add_notification_btn' onclick="$('.load_assets_list').load('multiple_asset_list.php');" title="Search Asset No." style="padding-right: 10px;padding-left: 10px;"><i class="material-icons">search</i></a>
				</div>
			</div>
			
			<!------------------------------------------------------------------------------------------------------------------------------------------ -->

  <!-- Modal Structure -->
  <div id="modal2" class="modal modal-fixed-footer">
    <div class="modal-content" onclick="$('#asset_list').load('asset_list.php');" title="Assets List">
      <h4>Assets List</h4>
      <p id="asset_list"></p>
    </div>
    <div class="modal-footer">
      <a href="#!" id="asset_close" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
      <script type="text/javascript">
      	$('.drilldown').click(function(){
			//debugger;
      		document.getElementById('notification_assc_id').value = asset_id;
      	});

      </script>
      
    </div>
  </div>

<!------------------------------------------------------------------------------------------------------------------------------------------ -->
			
			<div class="input-field col s12">
				<textarea name="notification_text" class="materialize-textarea" required="true" maxlength="1800"></textarea>
				<label for="owner_address">Content</label>
			</div>
			<input type="hidden" name="notification_date" id="notification_date" />
			
		</div>
		<div class="col s6 load_assets_list">
		
		</div>
	</div>
<!--</form>-->
</div>
</body>
<script>

	$('#notificationsubmit').on("click", function(){
		var notification_title = $('[name="notification_title"]').val();
		var notification_text = $('[name="notification_text"]').val();
		var notification_date = $('#notification_date').val();
		var notification_assc_id = $('#notification_assc_id').val();
		
		var notification_content = notification_title+"#|#"+notification_text+"#|#"+notification_date+"#|#"+notification_assc_id;
		//$('.record_details').html("<center><img src='images/preloader.gif'/></center>");
		//$('.right_content').html("<center><img src='images/preloader.gif'/></center>");
		$.ajax({
			url: "add_notification_backend.php",
			data: {
				notification_data: notification_content
			},
			type: 'post',
			cache: false,
			success: function(add_notification_html){
				window.location = 'notifications_content.php';
			},
			timeout: 5000
		})
	});

    $('.drilldown').click(function(){
    	document.getElementById('notification_assc_id').value = asset_id;
    });

	$('#add_notification_btn').click(function(){
		$('.load_assets_list').html("<img src='images/preloader.gif'/>");
		$('.load_assets_list').css('display', 'block');
		$('.notification_form').css('width', '50%');
	});
	$('.notification_form').click(function(){
		if($('.id_field').is(":visible")){
			$('.notification_form').css('width', '100%');
			$('.load_assets_list').css('display', 'none');
		}
		
	});
</script>