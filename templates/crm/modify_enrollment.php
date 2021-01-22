<?php ?>
 <!-- insert a bootstrapn modal here -->
<div class="modal fade" id="modify_student_enrollment_modal" tabindex="-1" data-template = "modify_student_enrollment" role="dialog" aria-labelledby="modify_student_enrollment_modallabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modify_student_enrollment_modalLabel">Modify Enrollment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id ="modify_student_enrollment_form">

          <div class="form-group">
            <label for="student_name" class="col-form-label">Student Name</label>
            <input name =  "name" id = "modify_student_enrollment_student_name" disabled placeholder="">
          </div>
           <input type = "hidden" name = "enrollment_id" id = "student_id_modal_enrollment_modify" value="">

         <div class="form-group">
            <label for="course_name" class="col-form-label">Course Name</label>
            <input name =  "course" id = "course_name" disabled placeholder="">
            <input type = "hidden" id = "course_id" value="">
          </div>

          <div class="form-group">
            <label for="desired_score"class="col-form-label">Desired Score:</label>
            <input type="number" required class="form-control" name = "desired_score" id="enrollment_modify_desired_score">
          </div>

          <div class="form-group">
            <label for="course_status" required class="col-form-label">Course Status:</label>
            <select required name = "course_status" class="form-control" id="enrollment_modify_course_status">
             	<option>Active</option>
             	<option>Inactive</option>
           </select>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id = "modify_student_enrollment_submit_button" class="btn btn-primary text-">Modify Enrollment</button>
          </div>

          <input type = "hidden" name = "nonce"
                  value = <?php echo wp_create_nonce("modify_student_enrollment_nonce");
           ?> >
          <input type = hidden id = "ajax_url_modify_student_enrollment" data-href = <?php echo admin_url( 'admin-ajax.php' ) ?> >
          <input type="hidden" name = "action" value = "modify_student_enrollment">
          <div class = "loader">
              <div class = "spinner-border"></div>
              <h1 class = "ajax_results" ></h1>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
