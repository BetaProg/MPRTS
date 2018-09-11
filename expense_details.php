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
<title>MPRTS | Expense Details</title>
	<?php include 'db_config.php'; ?>
	<?php include 'headers.php'; ?>
	<link rel="stylesheet" type="text/css" href="styles/font-awesome/css/font-awesome.min.css">
	<style>
		.resp_sub_title_bar, .resp_owner_address_content, .resp_location_icon, .location_icon, .material-icons {
			padding-top:0px !important;
		}
		.resp_owner_address_content h5{
			margin-top:4px;
		}
		.resp_owner_address_content{
			margin:5% 20% 5% 30%;
			text-align:center;
		}
		.details_container{
			padding-top:7%;
		}
	</style>
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
		$expense_id = $_POST['id'];
		
		$show_expense_sql = mysql_query("SELECT * from mprts_expenses where expense_id='$expense_id'");
		while ($row = mysql_fetch_array($show_expense_sql)) {
			$expense_date = $row['expense_date'];
			$expense_id = $row['expense_id'];
			$expense_amount = $row['expense_amount'];
			$expense_cause = $row['expense_cause'];
			$expense_description = $row['expense_description'];
			$expense_access_code = $row['expense_access_code'];
			$expense_association = $row['expense_association'];

	      	$show_building_details = mysql_query("SELECT * from mprts_buildings where building_id = substr('$expense_access_code', 3, 4)");
	      	while($building_row = mysql_fetch_array($show_building_details)){
	      		$building_id = $building_row['building_id'];
	      		$building_name = $building_row['building_name'];
	      		$building_image = $building_row['image_url'];
	      		$building_locality = $building_row['building_locality'];
	      		$building_city = $building_row['building_city'];
	      		$building_state = $building_row['building_state'];
	      		$building_pincode = $building_row['building_pincode'];
	      		$building_phno = $building_row['building_phno'];
	      		$building_email = $building_row['building_email'];
	      	}
			
			$show_asset_details = mysql_query("SELECT * from mprts_property where prty_id = substr('$expense_association', 4, 4)");
	      	while($asset_row = mysql_fetch_array($show_asset_details)){
	      		$prty_id = $asset_row['prty_id'];
	      		$prty_no = $asset_row['prty_no'];
	      	}
		}
	?>

	<div class="row main_sub_title_bar">
		<div class="col s8 sub_title_bar" style="background-color: #25414E;height: 49px;color: #f2f2f2;">
			<h5><a href='index.php'>Admin Dashboard</a> - <a href="expense_content.php">Expense Details</a> - <b><?php echo 'EXP'.$expense_id; ?></b></h5>
		</div>
		<div class="col s4" style="background-color: #25414E;height: 49px;">
  			<button class="btn waves-effect waves-light delete_expense" title="Delete" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;" id='<?php echo $expense_id; ?>' onclick="delete_expense(this.id);">Delete
    			<i class="material-icons right">delete</i>
  			</button>
  			<button class="btn waves-effect waves-light edit_button edit_expense" title="Edit" style="float: right;background-color: #f2f2f2;color:#000;margin-top: 2%;margin-left: 2%;" id='<?php echo $expense_id; ?>'  onclick="edit_expense(this.id);">
    			<i class="material-icons right">edit</i>Edit
  			</button>
		</div>
	</div>
	<!-- ---------------------------------------- Sub View Container Starts ------------------------------------------ -->

			<div class="resp_sub_title_bar">
				<div class="row details_container">
					<div class="row expense_details_container">
						<div class="col s9" style="padding-top: 2%;padding-left: 5%;">
							<h5 class="content_name"><b><?php echo 'EXP'.$expense_id; ?></b></h5>					
						</div>
						<div class="col s3" style="padding-left:0px;padding-right: 0px;">
				  			<button class="btn waves-effect waves-light edit_button edit_owner" title="Edit" style="float: left;background-color: #f2f2f2;color:#000;margin:10% auto 10% 2%;border-radius: 5px;padding-left: 10px;padding-right: 10px;" id='<?php echo $expense_id; ?>'  onclick="edit_expense(this.id);">
				    			<i class="material-icons" style="font-size: 15px;">edit</i>
				  			</button>
				  			<button class="btn waves-effect waves-light delete_asset edit_owner" title="Delete" style="float: left;background-color: #f2f2f2;color:#000;margin:10% auto 10% 10%;border-radius: 5px;padding-left: 10px;padding-right: 10px;" id='<?php echo $owner_id; ?>'  onclick="">
				    			<i class="material-icons" style="font-size: 15px;color: red;">delete</i>
				  			</button>		
						</div>
					</div>
					<!--<h5 class="pagination"><a href="expense_content.php">Expense Details</a> / <b><?php echo 'EXP'.$expense_id; ?></b></h5>-->
					
					
					
					<div class="row resp_edit_tite pagination" style='padding:2%;height:auto;'>
						<div class="col s2">
							<button class="btn waves-effect waves-light back_button" title="Back" style="float: left;margin-top: 10%;border-radius: 40px;padding-left: 2px;padding-right: 3px;padding-top: 1px;padding-bottom: 2px;background-color:#f2f2f2;" onclick="window.location.reload();">
							<i class="material-icons" style="font-size: 30px;">arrow_back</i>
							</button>
						</div>
						<div class="col s10" style="margin-top: 2%;">
							<h5 class="content_name" >Expense Details - <?php echo $prty_no ?></h5>
						</div>
					</div>
					
					
					<!--<h class="resp_owner_name"><b><?php echo 'EXP'.$expense_id; ?></b></h>-->
					<div class="resp_owner_image z-depth-0" style='height:150px;color:#2980b9;'>
						<!--<center><img src="images/property1.jpg"></center>-->
						<center><i style="margin:3% auto 1% auto;font-size:20px;border: 1px solid #2980b9;border-radius:50%;padding:3%;color:#16a085;" class="fa fa-credit-card"></i></center>
						<center><h5 style='margin: 8% auto auto auto;'>₹&nbsp&nbsp<b style='font-size:35px;'><?php echo $expense_amount ?></b></h5></center>
					</div>
				</div>
				<div class="border_it">
					<div class="row resp_owner_address_content">
							<div class="col s2 resp_location_icon">
								<i class='material-icons location_icon'>date_range</i>	
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $expense_date ?></h5> 
							</div>
						</div>


						<div class="row resp_owner_address_content">
							<div class="col s2 resp_location_icon">
								<i class="material-icons mail_outline">home</i>
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $prty_no ?></h5>
							</div>
						</div>

						<div class="row resp_owner_address_content">
							<div class="col s2 resp_location_icon">
								<i class='material-icons mail_outline'>lightbulb_outline</i>
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $expense_cause ?></h5>
							</div>
						</div>
						<div class="row resp_owner_address_content">
							<div class="col s2 resp_location_icon">
								<i class='material-icons mail_outline'>description</i>
							</div>
							<div class="col s10 resp_building_address">
								<h5><?php echo $expense_description ?></h5>
							</div>
						</div>
				</div>
			</div>

	<!-- ---------------------------------------- Sub View Container Ends ------------------------------------------ -->

	<div class="expense_details_content" style="margin-top: 2%;">
		<div class="row owner_details">
			<div class="owner_info">
			<div class="row">
				<div class="col s3">
					<div class="owner_image">
						<img src="<?php echo $building_image; ?>" class="z-depth-4">
					</div>
				</div>
				<div class="col s4"> 
					<div class="row">
						<div class="col s12">
							<label>Expense Date:</label>
							<h5 style="display: block;width: 40%;font-size: 18px;"><?php echo $expense_date; ?></h5>
						</div>
						<div class="col s12">
							<label>Amount:</label>
							<h5 class="prop_type" style="color:#000;font-weight: normal;font-size: 18px;"><?php echo '₹ '.$expense_amount; ?></h5>
						</div>
						<div class="col s12">
							<label>Cause:</label>
							<h5 class="prop_type" style="color:#000;font-weight: normal;font-size: 18px;"><?php echo $expense_cause; ?></h5>
						</div>
					</div>
				</div>
				<div class="col s5">
					<div class="owner_name">
						<label>Expense Id: </label><h6><b><?php echo 'EXP'.$expense_id; ?></b></h6>
					</div>
					<div class="owner_location">
						<label>Property Name: </label><h6><?php echo $building_name; ?></h6>
					</div>
					<div class="owner_location">
						<label>Description:</label>
						<h5 class="prop_type" style="color:#000;font-weight: normal;font-size: 18px;"><?php echo $expense_description; ?></h5>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>


</body>
<script>
	function delete_expense(expense_id){
		$.ajax({
      url: "delete_expense.php",
      data: {
        id: expense_id
      },
      type: 'post',
      cache: false,
      success: function(delete_expense_html){
          alert('Expense '+ expense_id +' Deleted successfully');
          window.location = 'expense_content.php';
      }
    })
	}
</script>


