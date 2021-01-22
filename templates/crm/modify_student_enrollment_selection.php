<?php ?>

 <!-- insert a bootstrapn modal here -->
<div class="modal fade" id="modify_student_enrollment_selection_modal" tabindex="-1" data-template = "modify_student_enrollment_selection" role="dialog" aria-labelledby="modify_student_enrollment_selection_modallabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modify_student_enrollment_modalLabel">Modify Enrollment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id ="modify_student_enrollment_form_selection">
        	<div class="form-group">
            <label for="student_name" class="col-form-label">Student Name</label>
            <select name ="name"  required class ="form-control" id = "student_name" >
            	 <?php  foreach ($all_enrollments as $data): ?>
                <option data-id = <?php echo $data->student_id ?>>

                     <?php

                     $student_name = $my_crm_db->get_results("Select name from student_details where student_id = '{$data->student_id}'");

                     $course_name = $my_crm_db->get_results("select coursename from courses join enrollment on courses.course_id = enrollment.course_id where student_id = {$data->student_id} and enrollment_id =
                      '{$data->enrollment_id}' ");
                     echo $student_name[0]->name  ."(". $course_name[0]->coursename .")";
                     // var_dump($course_name);
                    ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id = "modify_student_enrollment_selection_submit_button" class="btn btn-primary text-">Modify  Enrollment</button>
          </div>

          <input type = "hidden" name = "nonce"
                  value = <?php echo wp_create_nonce("modify_student_enrollment_selection_nonce");
           ?> >
          <input type = hidden id = "ajax_url_modify_student_enrollment_selection" data-href = <?php echo admin_url( 'admin-ajax.php' ) ?> >
          <input type="hidden" name = "action" value = "modify_student_enrollment_selection">
          <div class = "loader">
              <div class = "spinner-border"></div>
              <h1 class = "ajax_results" ></h1>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>