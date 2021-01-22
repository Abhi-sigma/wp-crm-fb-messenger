<?php
$modify_student_selection_nonce = wp_create_nonce("modify_student_selection_nonce");
    ?>

<!-- insert a bootstrapn modal here -->
<div class="modal fade" id="modify_student_selection" tabindex="-1" data-template = "modify_student_selection" role="dialog" aria-labelledby="modify_student_modallabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modify_student_modalLabel">Modify Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id ="modify_student_select_form">
          <div class="form-group">
            <label for="student_name" class="col-form-label">Select Student</label>
            <select class = "form-control" >
              <?php  foreach ($all_students as $data): ?>
                <option>

                     <?php echo $data->name ." | Registration ID :" .$data->registration_id ?>

                </option>
              <?php endforeach ?>

            </select>
          </div>
             <input type = "hidden" name = "nonce"
                  value = <?php echo wp_create_nonce("modify_student_selection_nonce"); ?> >
           <input type = "hidden" name = "action" value = "modify_student_selection">
            <input type = hidden id = "ajax_url_modify_select_student" data-href = <?php echo admin_url( 'admin-ajax.php' ) ?> >
            <button class = "btn btn-success form" style = "margin: 10px 0px 10px 0px" >Confirm</button>
            <div class = "loader">
              <div class = "spinner-border"></div>
              <h1 class = "ajax_results" ></h1>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>






<div class="modal fade" id="modify_student_modal" tabindex="-1" data-template = "add_student" role="dialog" aria-labelledby="modify_student_modallabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modify_student_modalLabel">Modify Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id ="modify_student_form">
          <div class="form-group">
            <label for="student_name" class="col-form-label">Selected Student</label>
            <input type = "hidden" name = "id" value = "">
            <input name = "name" disabled placeholder="">
          </div>
          <div class="form-group">
            <label for="email"  class="col-form-label">Email:</label>
            <input type = "email" required name = "email" class="form-control" placeholder="">
          </div>
          <div class="form-group">
            <label for="address"class="col-form-label">Address:</label>
            <textarea required class="form-control" name = "address" id="address" placeholder=""></textarea>
          </div>
          <div class="form-group">
            <label for="mobile" required class="col-form-label">Mobile:</label>
            <input type = "tel" required name = "mobile" class="form-control" id="mobile" placeholder="">
          </div>
          <div class="form-group">
            <label for="previous_source" required class="col-form-label">Previous Source:</label>
            <input disabled  required name = "previous_source" class="form-control" id="previous_source" placeholder="">
          </div>

          <div class="form-group" required id = "source-selector">
            <label for="source" class="col-form-label">Source:</label>
            <select  name="source" id ="source" class= "form-control">
            <?php foreach ($all_sources as $data):?>
            		<option><?php echo $data->source?></option>
            <?php endforeach ?>
        	 </select>
            <button id ="add_source_modify_student" style = "margin: 10px 0px 10px 0px" class = "btn btn-primary">Add New Source</button>
            <input id="new_source_modify_student" name="source" class = "form-control" placeholder="New Source" disabled>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id = "modify_student_submit_button" class="btn btn-primary text-">Modify  Student</button>
          </div>

          <input type = "hidden" name = "nonce"
                  value = <?php echo wp_create_nonce("modify_student_nonce");
           ?> >
           <input type = hidden id = "ajax_url_modify_student" data-href = <?php echo admin_url( 'admin-ajax.php' ) ?> >
          <input type="hidden" name = "action" value = "modify_student">
          <div class = "loader">
              <div class = "spinner-border"></div>
              <h1 class = "ajax_results" ></h1>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>