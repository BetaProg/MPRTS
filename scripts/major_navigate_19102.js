
// // $('.drilldown').on('click', (function(){
//   // alert('1');
//   // $('.resp_owners_table').css('display','none !important');
//   // alert('2');
//   // $('.record_details').css('display','block');
// }));
// $('.content_name').on('click', (function() {
//   $('.record_details').css('display','none');
//   $('.resp_owners_table ').css('display','block');
// }));

function aa_register(){
    if(($('#user_conf_pass').val()==$('#user_pass').val()) && ($('[name="user_type"]').val()!="") &&  ($('#user_name').val() != "")  &&   ($('#user_email').val()!="")   &&  ($('#user_mobile').val()!="") &&  ($('#user_pass').val()!="")    ){
    var data_to_pass = $('[name="user_type"]').val()+'|'+$('#user_name').val()+'|'+$('#user_email').val()+'|'+$('#user_mobile').val()+'|'+$('#user_pass').val()+'|'+$('#user_usc_no').val()+'|'+$('#user_pincode').val();
    //alert(data_to_pass);
    $.ajax({
          url: "register_backend.php",
          data: {
            register_data: data_to_pass
          },
          type: 'post',
          cache: false,
          success: function(value){
                 //alert('Your Account will be activated with in next 24 Hours');
				 if(value!="1"){
					 //alert(value);
					 alert("Your Account will be activated with in next 24 Hours. Please check your inbox.");
					 window.location = 'login.php';
				 }
				 else{
					 alert(value);
					 //alert("Some Another account exists with the same credentials. Please try with some other credentials or contact administrator");
				 }
                 
            },
          error:function(failedMessage) {
              alert("Some Another account exists with the same credentials. Please recheck or contact administrator");
           }
        });
		
    }
    else {
      alert("Please ensure proper inputs");
    }
  }


  function show_payment_details(payment_id) {
    // console.log('Hi');
     $.ajax({
      url: "payment_details.php",
      data: {
        id: payment_id
      },
      type: 'post',
      cache: false,
      success: function(payment_html){
          $('.record_details').html(payment_html);
      }
    })
  }

  function show_building_details(building_id) {
     $.ajax({
      url: "building_details.php",
      data: {
        id: building_id
      },
      type: 'post',
      cache: false,
      success: function(building_html){
          $('.record_details').html(building_html);
      }
    })
  }

  function show_building_details_resp(building_id) {
     $.ajax({
      url: "building_details.php",
      data: {
        id: building_id
      },
      type: 'post',
      cache: false,
      success: function(building_html){
          $('.owner_content').html(building_html);
      }
    })
  }



	function show_property_details(prop_id) {
		 $.ajax({
      url: "property_details.php",
      data: {
        id: prop_id
      },
      type: 'post',
      cache: false,
      success: function(prop_html){
          $('.record_details').html(prop_html);
      }
    })
	}

    function show_building_details(building_id) {
     $.ajax({
      url: "building_details.php",
      data: {
        id: building_id
      },
      type: 'post',
      cache: false,
      success: function(building_html){
          $('.record_details').html(building_html);
      }
    })
  }


  function add_new_record(content_id) {
     $.ajax({
      url: "add_building_master.php",
      data: {
        id: content_id
      },
      type: 'post',
      cache: false,
      success: function(add_content_html){
          $('.record_details').html(add_content_html);
      }
    })
  }

  function add_new_property(property_id) {
     $.ajax({
      url: "add_property.php",
      data: {
        id: property_id
      },
      type: 'post',
      cache: false,
      success: function(add_property_html){
          $('.record_details').html(add_property_html);
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
          $('.record_details').html(add_owner_html);
      }
    })
  }

  function add_new_payment(payment_id) {
     $.ajax({
      url: "add_payment.php",
      data: {
        id: payment_id
      },
      type: 'post',
      cache: false,
      success: function(add_payment_html){
          $('.record_details').html(add_payment_html);
      }
    })
  }


  function add_new_tenant(tenant_id) {
     $.ajax({
      url: "add_tenant.php",
      data: {
        id: tenant_id
      },
      type: 'post',
      cache: false,
      success: function(add_tenant_html){
          $('.record_details').html(add_tenant_html);
      }
    })
  }


  function add_new_expense(expense_id) {
     $.ajax({
      url: "add_expense.php",
      data: {
        id: expense_id
      },
      type: 'post',
      cache: false,
      success: function(add_expense_html){
          $('.record_details').html(add_expense_html);
      }
    })
  }


    function show_owner_details(cid) {
     $.ajax({
      url: "owner_details.php",
      data: {
        id: cid
      },
      type: 'post',
      cache: false,
      success: function(html){
          $('.record_details').html(html);
          // console.log(html);
      }
    })
  }

  function show_expense_details(cid) {
     $.ajax({
      url: "expense_details.php",
      data: {
        id: cid
      },
      type: 'post',
      cache: false,
      success: function(html){
          $('.record_details').html(html);
          // console.log(html);
      }
    })
  }


    function show_tenant_details(cid) {
     $.ajax({
      url: "tenant_details.php",
      data: {
        id: cid
      },
      type: 'post',
      cache: false,
      success: function(html){
          $('.record_details').html(html);
      }
    })
  }




  // function show_property_details(prop_id) {
  //   console.log(prop_id);
  //   // $('.right_content').load('owner_details.php', {var:x, var2:y, var3:z});
  //    $.ajax({
  //     url: "property_details.php",
  //     data: {
  //       // id: $('.drilldown').attr('id')
  //       id: prop_id
  //       // id: '<?php echo $owner_name; ?>'
  //     },
  //     type: 'post',
  //     cache: false,
  //     success: function(prop_html){
  //         // $('.right_content').load('owner_details.php');
  //         $('.right_content').html(prop_html);
  //         // console.log(html);
  //     }
  //   })
  // }


    function get_all_details() {
     $.ajax({
      url: "add_payment_backend.php",
      data: {
        id: tenant_id
      },
      type: 'post',
      cache: false,
      success: function(value){
             var data = value.split(",");
            $('#pmt_tenant_name').val(data[0]);
            $('#pmt_prty_id').val(data[1]);
        }
    }); 
  };

  function get_all_tenant_details() {
     $.ajax({
      url: "add_tenant_backend.php",
      data: {
        id: house_id
      },
      type: 'post',
      cache: false,
      success: function(value){
             var data = value.split(",");
            $('#pmt_tenant_name').val(data[0]);
            $('#pmt_prty_id').val(data[1]);
        }
    }); 
  };


  function edit_building(building_id) {
     $.ajax({
      url: "edit_building.php",
      data: {
        id: building_id
      },
      type: 'post',
      cache: false,
      success: function(edit_building_html){
          $('.record_details').html(edit_building_html);
      }
    })
  }

  function edit_building_resp(building_id) {
     $.ajax({
      url: "edit_building.php",
      data: {
        id: building_id
      },
      type: 'post',
      cache: false,
      success: function(edit_building_html){
          $('.owner_content').html(edit_building_html);
      }
    })
  }


  function edit_asset(asset_id) {
     $.ajax({
      url: "edit_asset.php",
      data: {
        id: asset_id
      },
      type: 'post',
      cache: false,
      success: function(edit_asset_html){
          $('.record_details').html(edit_asset_html);
      }
    })
  }

  function edit_owner(owner_id) {
     $.ajax({
      url: "edit_owner.php",
      data: {
        id: owner_id
      },
      type: 'post',
      cache: false,
      success: function(edit_owner_html){
          $('.record_details').html(edit_owner_html);
      }
    })
  }

  function delete_owner(owner_id) {
    // alert(owner_id);
     $.ajax({
      url: "delete_owner.php",
      data: {
        id: owner_id
      },
      type: 'post',
      cache: false,
      success: function(delete_owner_html){
          // $('.record_details').html(delete_owner_html);
          alert(owner_id+' Deleted successfully');
          window.location = 'owner_content.php';
      }
    })
  }

  function delete_tenant(tenant_id) {
    // alert(owner_id);
     $.ajax({
      url: "delete_tenant.php",
      data: {
        id: tenant_id
      },
      type: 'post',
      cache: false,
      success: function(delete_tenant_html){
          // $('.record_details').html(delete_owner_html);
          alert(tenant_id+' Deleted successfully');
          window.location = 'tenant_content.php';
      }
    })
  }

  function edit_expense(expense_id) {
     $.ajax({
      url: "edit_expense.php",
      data: {
        id: expense_id
      },
      type: 'post',
      cache: false,
      success: function(edit_expense_html){
          $('.record_details').html(edit_expense_html);
      }
    })
  }

  function edit_owner_resp(owner_id) {
     $.ajax({
      url: "edit_owner.php",
      data: {
        id: owner_id
      },
      type: 'post',
      cache: false,
      success: function(edit_owner_html){
          $('.record_details').html(edit_owner_html);
      }
    })
  }

  function edit_tenant(tenant_id) {
     $.ajax({
      url: "edit_tenant.php",
      data: {
        id: tenant_id
      },
      type: 'post',
      cache: false,
      success: function(edit_tenant_html){
          $('.record_details').html(edit_tenant_html);
      }
    })
  }

  function edit_tenant_resp(tenant_id) {
     $.ajax({
      url: "edit_tenant.php",
      data: {
        id: tenant_id
      },
      type: 'post',
      cache: false,
      success: function(edit_tenant_html){
          $('.record_details').html(edit_tenant_html);
      }
    })
  }


  function get_all_details() {
     $.ajax({
      url: "add_payment_backend.php",
      data: {
        id: tenant_id
      },
      type: 'post',
      cache: false,
      success: function(value){
             var data = value.split(",");
            $('#pmt_tenant_name').val(data[0]);
            $('#pmt_prty_id').val(data[1]);
        }
    }); 
  };
