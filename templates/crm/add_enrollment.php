<?php ?>
 <!-- insert a bootstrapn modal here -->
<div class="modal fade" id="add_student_enrollment_modal" tabindex="-1" data-template = "add_student_enrollment" role="dialog" aria-labelledby="add_student_enrollment_modallabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_student_enrollment_modalLabel">Enroll Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id ="add_student_enrollment_form">
        	<div class="form-group">
            <label for="student_name" class="col-form-label">Student Name</label>
            <select name ="name"  required class ="form-control" id = "student_name_add_enrollment" >
            	 <?php  foreach ($all_students as $data): ?>
                <option>

                     <?php echo $data->name ." | Student ID :" .$data->student_id ?>

                </option>
              <?php endforeach ?>
            </select>
          </div>


          <div class="form-group">
            <label for="branch_name" class="col-form-label">Branch</label>
            <select name ="branch"  required class ="form-control" id = "add_enrollment_branch_name" >
            	 <?php foreach ($all_branches as $data): ?>
            		<option> <?php echo $data->branch_name ?></option>
         		 <?php endforeach ?>

            </select>
          </div>
          <div class="form-group">
            <label for="course"  class="col-form-label">Course:</label>
            <select required name = "course" class="form-control" id="course">
            	<?php foreach ($all_courses as $data): ?>
            		<option> <?php echo $data->coursename ?></option>
         		 <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="desired_score"class="col-form-label">Desired Score:</label>
            <input type="number" required class="form-control" name = "desired_score" id="add_enrollment_desired_score">
          </div>
          <div class="form-group">
            <label for="start_date" required class="col-form-label">Start Date:</label>
            <input type = "date" required name = "start_date" class="form-control" id="add_enrollment_start_date">
          </div>
          <div class="form-group">
            <label for="end_date" required class="col-form-label">End Date:</label>
            <input type = "date" required name = "end_date" class="form-control" id="add_enrollment_end_date">
          </div>
          <div class="form-group">
            <label for="course_status" required class="col-form-label">Course Status:</label>
           <select required name = "course_status" class="form-control" id="add_enrollment_course_status">
           	<option>Active</option>
           	<option>Inactive</option>
           </select>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id = "add_student_enrollment_submit_button" class="btn btn-primary text-">ADD  Enrollment</button>
          </div>

          <input type = "hidden" name = "nonce"
                  value = <?php echo wp_create_nonce("add_student_enrollment_nonce");
           ?> >
          <input type = hidden id = "ajax_url_add_student_enrollment" data-href = <?php echo admin_url( 'admin-ajax.php' ) ?> >
          <input type="hidden" name = "action" value = "add_student_enrollment">
          <div class = "loader">
              <div class = "spinner-border"></div>
              <h1 class = "ajax_results" ></h1>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>