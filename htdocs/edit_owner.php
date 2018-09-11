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
		$owner_id = $_POST['id'];
		$show_owner_sql = "select * from mprts_owner where owner_id='$owner_id'";
		$show_owner_execute = mysql_query($show_owner_sql);
		while ($row = mysql_fetch_array($show_owner_execute)) {
			$owner_id = $row['owner_id'];
			$owner_name = $row['owner_name'];
			$owner_mobile = $row['owner_mobile'];
			$owner_address = $row['owner_address'];
			$owner_email = $row['owner_email'];

		}
		// echo $building_id.'-'.$building_locality.'-'.$building_type;

	?>

	<div class="row main_edit_title">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Dashboard</a> - <a href="owner_content.php">Edit Owner Details</a> - <b><?php echo $owner_id; ?></b></h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
			<button class="btn waves-effect waves-light" title="Cancel" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" onclick="window.location.reload();">Cancel
    			<i class="material-icons right">cancel</i>
  			</button>
  			<button class="btn waves-effect waves-light" title="Save" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" onclick="save_edit();">Save
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
  			<button class="btn waves-effect waves-light save_button save_building" title="Save" style="float: right;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;" onclick="save_edit();">
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
						<td>Name</td>
						<td><input type="text" name="owner_name" value="<?php echo $owner_name; ?>" required="true" maxlength="30"></td>
					</tr>
					
					<tr>
						<td>Mobile No.</td>
						<td><input type="number" name="owner_mobile" value="<?php echo $owner_mobile; ?>" required="true" maxlength="12"></td>
					</tr>
					<tr>
						<td>Email Id</td>
						<td><input type="email" name="owner_email" value="<?php echo $owner_email; ?>" required="true"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" name="owner_address" value="<?php echo $owner_address; ?>" required="true" maxlength="300"></td>
					</tr>
				</table>
			</div>
		</center>	
		</div>
	</div>
</body>
<script type="text/javascript">
	function save_edit(){
	 	new_owner_name = $("[name='owner_name']").val();
	 	new_owner_mobile = $("[name='owner_mobile']").val();
	 	new_owner_email = $("[name='owner_email']").val();
	 	new_owner_address = $("[name='owner_address']").val();


	 	data_to_edit = new_owner_name+'|'+new_owner_mobile+'|'+new_owner_email+'|'+new_owner_address+'|'+'<?php echo $owner_id; ?>';
	 	
	 	// console.log(data_to_edit);

	 	$.ajax({
	      url: "edit_owner_backend.php",
	      data: {
	        data_passed: data_to_edit
	      },
	      type: 'post',
	      cache: false,
	      success: function(save_edit_owner_html){
	          // $('.record_details').html(save_edit_building_html);
	          alert('Updation Successful');
	          window.location.reload();
	      }
	    })

	}
</script>
<script type="text/javascript">
	if('<?php echo $building_type ?>'=='Appartment'){
		$('#b_apt').prop("checked", true);
	}
	else {
		$('#b_hse').prop("checked", true);
	}
</script>