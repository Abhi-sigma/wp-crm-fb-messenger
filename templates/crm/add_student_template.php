<?php    ?>

<!-- insert a bootstrapn modal here -->

<div class="modal fade" id="add_student_modal" tabindex="-1" data-template = "add_student" role="dialog" aria-labelledby="add_student_modallabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_student_modalLabel">Add Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id ="add_student_form">
          <div class="form-group">
            <label for="student_name" class="col-form-label">Student Name</label>
            <input name ="name"  required class ="form-control" id = "add_student_student_name" >
          </div>
          <div class="form-group">
            <label for="email"  class="col-form-label">Email:</label>
            <input type = "email" required name = "email" class="form-control" id="add_student_email">
          </div>
          <div class="form-group">
            <label for="address"class="col-form-label">Address:</label>
            <textarea required class="form-control" name = "address" id="add_student_address"></textarea>
          </div>
          <div class="form-group">
            <label for="mobile" required class="col-form-label">Mobile:</label>
            <input type = "tel" required name = "mobile" class="form-control" id="add_student_mobile">
          </div>
          <div class="form-group" required id = "source-selector">
            <label for="source" class="col-form-label">Source:</label>
            <select  name="source" id ="add_student_source" class= "form-control">
            <?php foreach ($all_sources as $data):?>
            		<option><?php echo $data->source?></option>
            <?php endforeach ?>
        	 </select>
            <button id ="add_source_add_student" style = "margin: 10px 0px 10px 0px" class = "btn btn-primary">Add New Source</button>
            <input id="new_source_add_student" name="source" class = "form-control" placeholder="New Source" disabled>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id = "add_student_submit_button" class="btn btn-primary text-">Add  Student</button>
             <button id = "add_student_enroll_submit_button" class="btn btn-primary text-">
              <!-- <span data-enroll-add = false></span>Add and Enroll Student</button> -->
          </div>

          <input type = "hidden" name = "nonce"
                  value = <?php echo wp_create_nonce("add_student_nonce");
           ?> >
           <input type = hidden id = "ajax_url_add_student" data-href = <?php echo admin_url( 'admin-ajax.php' ) ?> >
          <input type="hidden" name = "action" value = "add_student">
          <div class = "loader">
              <div class = "spinner-border"></div>
              <h1 class = "ajax_results" ></h1>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

