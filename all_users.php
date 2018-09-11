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
<?php include 'db_config.php'; ?>
<?php include'headers.php'; ?>
<div class='row' id='all_users' style="margin:2%;">
	<h5>All Users</h5>
	<?php
		$get_all_users_sql = mysql_query("SELECT * from mprts_users where substr(user_access_code,1, 2) = ('AA') order by user_status ");
		$i=0;
		if (mysql_num_rows($get_all_users_sql)>0) {
			while ($i<mysql_num_rows($get_all_users_sql)) {
				$all_users = mysql_fetch_array($get_all_users_sql);
				$all_user_id = $all_users['user_id'];
				$all_user_name = $all_users['user_name'];
				$all_user_email = $all_users['user_email'];
				$all_user_mobile = $all_users['user_mobile'];
				$all_user_access_code = $all_users['user_access_code'];
				$all_user_status = $all_users['user_status'];
				$all_user_usc = $all_users['user_usc_no'];
				$all_user_pincode = $all_users['user_pincode'];
				if($all_user_status=='Initial'){
					$color = '#ffebcc';
					$button_text = 'ACTIVATE';
					$button_text_color = 'green';
					$action = 'Activated';
					$thread_color = 'orange';
				}
				else{
					$color = '#b3ffb3';
					$button_text = 'INACTIVATE';
					$button_text_color = 'red';
					$action = 'Initial';
					$thread_color = 'green';
				}
				
				echo "
				        <div class='col l3 m3 s12' style='margin-top:1%;'>
				          <div class='card' style='background-color:$color;cursor:pointer;' onclick=get_user_details('$all_user_email');>
				            <div class='card-content black-text' style='padding:0px;'>
				              <div class='status_indicator_div' style='background-color:$thread_color;width:100%;height:0.5%;'></div>
				              <div class='row' style='margin-top:2%;'>
				              	<div class='col l8 m8 s8' style='padding-left:0px;'>
				              		<div class='row'>
				              			<div class='col s12'>
				              				$all_user_name
				              			</div>
				              			<div class='col s12'>
				              				$all_user_mobile
				              			</div>
				              		</div>
				              	</div>
				              	<div class='col l4 m4 s4'>
				              		<img src='images/icons/user.png' style='width:50px;border-radius:50px;'>
				              	</div>
				              </div>
				              <div class='col s12 drilldown' style='margin-top:2%;text-align:left;'>
		              				$all_user_email
		              			</div>
				            </div>
				            <div class='card-action row' style='text-align:center;font-weight:bolder;background-color:#fff;height:10px;padding-top:1px;padding-bottom:18%;margin-top:30px;padding-left:0px;padding-right:0px;'>
				            	<div class='col s6' style='color:green;height:45px;padding-left:0px;cursor:pointer;'>
				            		<p id=$all_user_id class='activate_button' onclick='activate_backend(this.id, 1);' style='color:$button_text_color;'>$button_text</p>
				            	</div>
				            	<div class='col s6' style='color:orange;height:45px;'>
				            		<p>HOLD</p>
				            	</div>
				            </div>
				          </div>
				        </div>
				";
				$i++;
			}
		}
		
	?>
</div>

<div class='row' id="inactive_users" style="margin:2%;">
	<h5>Pending Users</h5>
	<?php
		$get_all_users_sql = mysql_query("SELECT * from mprts_users where substr(user_access_code,1, 2) = ('AA') and user_status = 'Initial'");
		$i=0;
		if (mysql_num_rows($get_all_users_sql)>0) {
			while ($i<mysql_num_rows($get_all_users_sql)) {
				$all_users = mysql_fetch_array($get_all_users_sql);
				$all_user_id = $all_users['user_id'];
				$all_user_name = $all_users['user_name'];
				$all_user_email = $all_users['user_email'];
				$all_user_mobile = $all_users['user_mobile'];
				$all_user_access_code = $all_users['user_access_code'];
				$all_user_status = $all_users['user_status'];
				$all_user_usc = $all_users['user_usc_no'];
				$all_user_pincode = $all_users['user_pincode'];
				if($all_user_status=='Initial'){
					$color = '#ffebcc';
					$thread_color = "orange";
				}
				else {
					$color = '#b3ffb3';
					$thread_color = "green";
				}
				echo "
				        <div class='col l3 m3 s12'>
				          <div class='card' style='background-color:$color;cursor:pointer;' onclick=get_user_details('$all_user_email');>
				            <div class='card-content black-text' style='padding:0px;'>
				              <div class='status_indicator_div' style='background-color:$thread_color;width:100%;height:0.5%;'></div>
				              <div class='row' style='margin-top:2%;'>
				              	<div class='col l8 m8 s8' style='padding-left:0px;'>
				              		<div class='row'>
				              			<div class='col s12'>
				              				$all_user_name
				              			</div>
				              			<div class='col s12'>
				              				$all_user_mobile
				              			</div>
				              		</div>
				              	</div>
				              	<div class='col l4 m4 s4'>
				              		<img src='images/icons/user.png' style='width:50px;border-radius:50px;'>
				              	</div>
				              </div>
				              <div class='col s12 drilldown' style='margin-top:2%;text-align:left;'>
		              				$all_user_email
		              			</div>
				            </div>
				            <div class='card-action row' style='text-align:center;font-weight:bolder;background-color:#fff;height:10px;padding-top:1px;padding-bottom:18%;margin-top:30px;padding-left:0px;padding-right:0px;'>
				            	<div class='col s6' style='color:green;height:45px;padding-left:0px;cursor:pointer;'>
				            		<p id=$all_user_id onclick='activate_backend(this.id, 2)'; >ACTIVATE</p>
				            	</div>
				            	<div class='col s6' style='color:orange;height:45px;'>
				            		<p>HOLD</p>
				            	</div>
				            </div>
				          </div>
				        </div>
				";
				$i++;
			}
		}
		else{
			echo "<h5><b>No Pending users..!</b></h5>";
		}
		
	?>
</div>