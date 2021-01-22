
jQuery(document).ready(function( $ ) {

  // ajax setup
	$.ajaxSetup({
  	beforeSend: function() {
      $("div.loader .ajax_results").text(" ");
     $('.loader').show();

  	},
  	complete: function(){
     $('.loader').hide(3000);
  	}
  })
	// close setup

  // hide the loader inside modal
	$('.loader').hide();

	// create a object that will hold values
		action_object = {"action":[{"1":"add_student","2":"modify_student","3":"update_review",
		"4":"add_enrollment","5":"update_enrollmet"}]};

		$("#action_selector").on("change",function(){
			var selected_value = this.value;
			if(selected_value != 0){
				$("#option_selector_button").removeAttr("disabled");
			}
			if(selected_value == 0){
				$("#option_selector_button").attr("disabled","true");
			}
		});

  // function that triggers on confirm action button
	function option_selector(event){
		event.preventDefault();
		var selected_value = $("#action_selector").val();
		show_modal(selected_value);

	}

  // attach a click event on selector button
	$("#option_selector_button").on("click",option_selector);

	// Source selector functions
	$("#add_source_add_student").on("click",function(event){
			event.preventDefault();
			this.previousElementSibling.disabled=true;
			$("#new_source_add_student").attr("disabled",false);
	});

$("#add_source_modify_student").on("click",function(event){
      event.preventDefault();
      this.previousElementSibling.disabled=true;
      $("#new_source_modify_student").attr("disabled",false);
  });

	// we provide the option number and correct modal is displayed
	// the modal has data attribute,which willl be checked against
	var show_modal = function(selection){
	if(selection == "0"){
			// do nothing
	}
    else{
    	// empty ajax results from previous query
    	$("#ajax_results").html("");
    	var modal = action_object["action"][0][selection];
    	switch(modal){
    		case("add_student"):
        $("#add_student_form")[0].reset();
    		$('#add_student_modal').modal('show');
    		// alert(modal);
    		break;
    		case("modify_student"):
    		// alert(modal);
        $("#modify_student_select_form")[0].reset();
        $("#modify_student_form")[0].reset();
    		$('#modify_student_selection').modal('show');
    		break;
    		case("update_review"):
    		// alert(modal);
    		break;
    		case("update_enrollment"):
    		// alert(modal);
    		break;
    		case("add_enrollment"):
        $("#add_student_enrollment_form")[0].reset();
        $("#add_student_enrollment_modal").modal("show");

    		// alert(modal);
    		}
    	// look for modal that matches href with the option
    	}

	}





$("#add_student_enroll_submit_button span").on("click",function(){
   $("#add_student_enroll_submit_button span").data().enrollAdd = true;
})



// ------------------------------------------------------------------------------------------------------------
	$("#add_student_form").submit(function(e){
    e.preventDefault();
		let data_to_send = $("#add_student_form").serializeArray();
    let ajaxurl = $("#ajax_url_add_student").data().href;
      $.ajax({
         type : "post",
         dataType : "json",
         url : ajaxurl,
         data : data_to_send,
         success: function(data) {

            if(!data.error) {

                $("#add_student_modal .ajax_results").html("<span>Successfully added to database</span>");
                 $('#add_student_modal').modal('hide');
                  window.location.reload(true);



            }

            else {
            	$("#add_student_modal .ajax_results").html("<span>"+ data["error_data"]+"</span>");

            }
         }
      })
      e.preventDefault();
  })

// ----------------------------------------------------------------------------------------------------------------

$("#modify_student_select_form").submit(function(e){
		// alert("form is about to be submitted")
    e.preventDefault();
		let data_to_send = $("#modify_student_select_form").serializeArray();
    let ajaxurl = $("#ajax_url_modify_select_student").data().href;
    var select_value = $("#modify_student_select_form select").val();
    // the action and nonce are getting serialized first,so we put on position 2
    data_to_send[2]= {"name": "registration_id","value":select_value};
    console.log(data_to_send);


      $.ajax({
         type : "post",
         dataType : "json",
         url : ajaxurl,
         data : data_to_send,
         success: function(data) {
              // alert("success");
            if(!data.error) {
              console.log(data);
            	$("#modify_student_selection .ajax_results").html("<span>Data Retrieved..Opening Form</span>");
              // console.log(data)
            	// add js to insert response as placeholders in modify student selection
              $('#modify_student_form input[name = "name"]').attr("placeholder",data["data"][0]["name"]);
              // console.log(data["data"][0]["email"]);
              $('#modify_student_form input[name = "id"]').attr("value",data["data"][0]["student_id"]);
              // console.log(data["data"][0]["email"]);
              $('#modify_student_form input[name = "email"]').attr("placeholder",data["data"][0]["email"]);
              $('#modify_student_form input[name = "address"]').attr("placeholder",data["data"][0]["address"]);
              $('#modify_student_form input[name = "mobile"]').attr("placeholder",data["data"][0]["mobile"]);
              $('#modify_student_form input[name = "previous_source"]').attr("placeholder",data["data"][0]["source"]);
              $("#modify_student_modal").modal("show");
              $('#modify_student_selection').modal('hide');
            }

            else {
            	$("#modify_student_selection .ajax_results").html("<span>"+ data["error_data"]+"</span>");

            }
         },
         error: function(xhr, textStatus, error){
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
            console.log(xhr.response)
          }
      })
  })


// -----------------------------------------------------------------------------------------------------------------

$("#modify_student_form").submit(function(e){
   e.preventDefault();
   let data_to_send = $("#modify_student_form").serializeArray();
   let ajaxurl = $("#ajax_url_modify_student").data().href;
   $.ajax({
         type : "post",
         dataType : "json",
         url : ajaxurl,
         data : data_to_send,
         success:function(data){

             if(!data.error) {
              $("#modify_student_modal .ajax_results").html("<span>Successfully added to database</span>");
              // $('#modify_student_modal').modal('hide');
              // window.location.reload(true);
            }

            else {
              $("#modify_student_modal .ajax_results").html("<span>"+ data["error_data"]+"</span>");

            }

         }

      })
 })


// ------------------------------------------------------------------------
// enrollment ajax handler

$("#add_student_enrollment_form").submit(function(e){
    // alert("form is about to be submitted")
     e.preventDefault();
    let data_to_send = $("#add_student_enrollment_form").serializeArray();
    let ajaxurl = $("#ajax_url_add_student_enrollment").data().href;
      $.ajax({
         type : "post",
         dataType : "json",
         url : ajaxurl,
         data : data_to_send,
         success: function(data) {

            if(!data.error) {
              $("#add_student_enrollment_modal .ajax_results").html("<span>Successfully added to database</span>");
              $('#add_student_enrollment_modal').modal('hide');
               window.location.reload(true);
            }

            else {
              $("#add_student_enrollment_modal .ajax_results").html("<span>"+ data["error_data"]+"</span>");

            }
         }
      })

  })


// -----------------------------------------------------------------------------------------------------------
// modify student form handler
$("#modify_student_enrollment_form_selection").submit(function(e){
    // alert("form is about to be submitted")
     e.preventDefault();
    let data_to_send = $("#modify_student_enrollment_form_selection").serializeArray();
    // add student id from data-value of option
    data_to_send[3] = {"name":"id","value":$(( "#modify_student_enrollment_form_selection select option:selected" )).data().id};
    let ajaxurl = $("#ajax_url_modify_student_enrollment_selection").data().href;
    console.log(data_to_send);
      $.ajax({
         type : "post",
         dataType : "json",
         url : ajaxurl,
         data : data_to_send,
         success: function(data) {

            if(!data.error) {
              $("#modify_student_enrollment_modal_selection .ajax_results").html(
                                                              "<span>Retrieving data....Opening form</span>");
              $('#modify_student_enrollment_selection_modal').modal('hide');
              // add js to insert response as placeholders in modify student selection
              $('#modify_student_enrollment_form input[name = "name"]').attr("placeholder",data["data"][0]["name"]);

              $("#student_id_modal_enrollment_modify").attr("value",data["data"][0]["enrollment_id"]);

              $('#modify_student_enrollment_form input[name = "course"]').attr("placeholder",data["data"][0]["coursename"]);
              // console.log(data["data"][0]["email"]);
              $('#modify_student_enrollment_form input[name = "desired_score"]').attr("placeholder",data["data"][0]["desired_score"]);
              $("#modify_student_enrollment_modal").modal("show");
            }
            else {
              $("#modify_student_enrollment_modal .ajax_results").html("<span>"+ data["error_data"]+"</span>");

            }
         }
      })

  })

// ------------------------------------------------------------------------------------------------------------------

$("#modify_student_enrollment_form").submit(function(e){
    // alert("form is about to be submitted")
    e.preventDefault();
    let data_to_send = $("#modify_student_enrollment_form").serializeArray();
    // add student id from data-value of option
    let ajaxurl = $("#ajax_url_modify_student_enrollment").data().href;
    let id =
      $.ajax({
         type : "post",
         dataType : "json",
         url : ajaxurl,
         data : data_to_send,
         success: function(data) {

            if(!data.error) {
              $("#modify_student_enrollment_modal .ajax_results").html("<span>Successfully Modified</span>");
              $('#modify_student_enrollment_modal').modal('hide');
               window.location.reload(true);
            }

            else {
              $("#modify_student_enrollment_modal .ajax_results").html("<span>"+ data["error_data"]+"</span>");

            }
         }
      })

  })

// search box on enrollments page
$("#search_input_enrollment").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#enrollment_table_body tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });

$("#search_input_leads").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#leads_table_body tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });



$("#modify_enrollment_button_all").on("click",function(){
   $("#modify_student_enrollment_selection_modal").modal("show");

})





// end jquery ready function
})


















