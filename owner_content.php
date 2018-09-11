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
<title>MPRTS | Owners</title>
<?php include 'db_config.php'; ?>
<?php include'headers.php'; ?>
<?php include 'left_content.php'; ?>
<script type="text/javascript">
	 $(document).ready(function() {
    $('select').material_select();
  });
</script>
<script type="text/javascript">
	
$('.drilldown').on('click', (function(){
  $('.resp_owners_table').css('display','none');
  $('.record_details').css('display','block');
}));
// $('.content_name').on('click', (function() {
//   $('.record_details').css('display','none');
//   $('.resp_owners_table ').css('display','block');
// }));

</script>
<div class="right_content">
	<?php include'nav_thread.php'; ?>
	<div class="title_bar">
		<h5><a href="index.php">Admin Dashboard</a> - <b>Owners List</b></h5>
	</div>
	<div class="owner_content">
		<div class="owner_content_actions">
			<div class="row">
				<!--<div class="col s2 show_all">
				    <p>
				      <input type="checkbox" id="show_all_owners" />
				      <label for="show_all_owners">Show All</label>
				    </p>
				</div>-->
				<div class="col s10 search_applet" style='min-width:80%;'>
					<div class="input-field" style="margin-top: 0px;">
			          <input placeholder="Search owners" id="search_owners" type="text" class="search_owners validate">
			          <!-- <label for="first_name">First Name</label> -->
					  <i class="material-icons search_icon"  onclick="search_results($('#search_owners').val());">search</i>
			        </div>
				</div>
				<!--<div class="col s2">
					<div class="applet_sort">
						<div class="input-field col s12">
						    <select>
						      <option value="" disabled selected>Sort by</option>
						      <option value="1">Location</option>
						      <option value="2"># Tenants</option>
						      <option value="3"># Properties</option>
						      <option value="4">Date added</option>
						    </select>
			    			<!-- <label>Sort By</label> -->
			  			<!-- </div>
					</div>
				</div>-->
				<!--<div class="col s2">
					<div class="record_count">
						<div class="input-field col s12">
						    <select>
						      <option value="" disabled selected>Rows per page</option>
						      <option value="1">10</option>
						      <option value="2">20</option>
						      <option value="3">35</option>
						      <option value="4">50</option>
						    </select>
			    			<!-- <label>Sort By</label> -->
			  			<!--</div>
					</div>
				</div>-->
				<div class="col s2">
					<div class="add_record">
						<i class="material-icons" title="Add Owner" id='add_owner' onclick='add_new_owner(this.id);'>add_box</i>
					</div>
				</div>
				
			</div>
		</div>
		
		<div class="owners_table z-depth-3">
			<table class="striped">
		        <thead class="main_head">
		          <tr>
		              <th>Owner Id</th>
		              <th>Name</th>
		              <th>Mobile</th>
		              <th>Address</th>
		              <th>Email</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 
					$access_type = substr($user_access_code, 0, 2);
					if($access_type == 'MM'){

						$owners_details_sql = "SELECT * from mprts_owner order by owner_id desc";
					}
					else if($access_type == 'AA'){

						$owners_details_sql = "SELECT * from mprts_owner where substr(access_code, 3, 4) = substr('$user_access_code', 3, 4) and substr(access_code, -1)!='D'";

					}

						$owners_details_execute = mysql_query($owners_details_sql);
			
						$owners_count = mysql_num_rows($owners_details_execute);

							while($row = mysql_fetch_array($owners_details_execute)){
							$owner_id = $row['owner_id'];
							$owner_name = $row['owner_name'];
							$owner_mobile = $row['owner_mobile'];
							$owner_address = $row['owner_address'];
							$owner_email = $row['owner_email'];
						
							$get_onr_id_sql = mysql_query("SELECT concat('ONR', owner_id) as owner_id  from mprts_owner where owner_id = $owner_id");
							$onr_id_row = mysql_fetch_array($get_onr_id_sql);
							$onr_id = $onr_id_row['owner_id'];
							
							echo "
								<tr class='table_content'>
									<td><a class='drilldown' id='$owner_id' onclick='show_details(this.id);'>$onr_id</a></td>
						            <td>$owner_name</td>
						            <td>$owner_mobile</td>
						            <td>$owner_address</td>
						            <td>$owner_email</td>
					          	</tr>
							";
							
						}

						
					?>
		        </tbody>
	      </table>
		</div>



		<div class="resp_owners_table z-depth-3">
			<table class="striped">
		        <thead>
		          <tr>
		              <th>Owner Id</th>
		              <th>Name</th>
		              <th>Mobile</th>
		          </tr>
		        </thead>
		        <tbody>
					<?php 
					$access_type = substr($user_access_code, 0, 2);
					if($access_type == 'MM'){

						$owners_details_sql = "select * from mprts_owner order by owner_id desc";
					}
					else if($access_type == 'AA'){

						$owners_details_sql = "SELECT * from mprts_owner where substr(access_code, 3, 4) = substr('$user_access_code', 3, 4) and  substr(access_code, -1)!='D'";

					}

						$owners_details_execute = mysql_query($owners_details_sql);
			
						$owners_count = mysql_num_rows($owners_details_execute);

							while($row = mysql_fetch_array($owners_details_execute)){
							$owner_id = $row['owner_id'];
							$owner_name = $row['owner_name'];
							$owner_mobile = $row['owner_mobile'];
							$owner_address = $row['owner_address'];
							$owner_email = $row['owner_email'];
						
							$get_onr_id_sql = mysql_query("select concat('ONR', owner_id) as owner_id  from mprts_owner where owner_id = $owner_id");
							$onr_id_row = mysql_fetch_array($get_onr_id_sql);
							$onr_id = $onr_id_row['owner_id'];
							
							echo "
								<tr class=''>
									<td><a class='drilldown' id='$owner_id' onclick='show_details(this.id);'>$onr_id</a></td>
						            <td>$owner_name</td>
						            <td>$owner_mobile</td>
					          	</tr>
							";
							
						}

						
					?>
		        </tbody>
	      </table>
		</div>



		<div class="record_details" title="Owner Details">
			
		</div>
	</div>
</div>
</body>
<script type="text/javascript">

	function search_results(search_owner){
		//alert(search_owner);
		$('.resp_owners_table').html("<img src='images/preloader.gif'/>");
			$.ajax({
			  url: "search_results.php",
			  data: {
				search_owner: search_owner
			  },
			  type: 'post',
			  cache: false,
			  success: function(search_owner_html){
				  //if(screen.availWidth<=414){
					$('.resp_owners_table').html(search_owner_html);
					//document.write(search_owner_html);
				  //}
				  //else{
					//$('.resp_owners_table').load('search_results.php');
				  //}
			  }
			});
	}
	
	function show_details(cid) {
		// $('.right_content').load('owner_details.php', {var:x, var2:y, var3:z});
		 $.ajax({
      url: "owner_details.php",
      data: {
        // id: $('.drilldown').attr('id')
        id: cid
        // id: '<?php echo $owner_name; ?>'
      },
      type: 'post',
      cache: false,
      success: function(html){
          // $('.right_content').load('owner_details.php');
          //$('.right_content').html(html);
		  if(screen.availWidth<=414){
			$('.right_content').html(html);  
		  }
		  else{
			$('.record_details').html(html);  
		  }
          // console.log(html);
      }
    })
	}


	function add_new_owner(owner_id) {
     $.ajax({
      url: "add_owner.php",
      data: {
        id: owner_id
      },
      type: 'post',
      cache: false,
      success: function(add_owner_html){
          //$('.record_details').html(add_owner_html);
		  if(screen.availWidth<=414){
			$('.right_content').html(add_owner_html);
		  }
		  else{
			$('.record_details').html(add_owner_html);
		  }
      }
    })
  }

</script>
