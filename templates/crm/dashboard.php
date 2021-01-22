<?php

// require_once(get_stylesheet_directory() .'/templates/crm/includes/dashboard_queries.php');
// require_once(get_stylesheet_directory() .'/templates/crm/includes/fb_queries.php');
// //var_dump($fb_messages_all);
// //var_dump($results_messages_individual);
// //var_dump($fb_messages_all);



include(get_stylesheet_directory() .'/templates/crm/includes/admin_queries.php');
include(get_stylesheet_directory() .'/templates/crm/add_tag_template.php');

if(isset($_GET['logout'])) {
    session_destroy();
    echo "<h1>You have been logged out</h1>" ;
    echo "<h1 style='text-align:center'>you need to log in to continue</h1>";
    echo  "<h3 style='text-align:center'> Go to <a href = './ula-crm' > LOG IN</a></h3>";
    exit;
}


?>

<nav class = "navbar navbar-expand-lg bg-light">
   <ul class = "navbar-nav">
      <?php if( $_SESSION["logged_in"] = "true"): ?>
        <button id = "btn-logout" class = "btn btn-primary"><a class = "log-out-link" href = <?php echo home_url() ."/ula-crm-dashboard/?logout=true" ?> >LOG OUT</a></button>
      <?php endif ?>
    </ul>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">-</span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="nav nav-tabs nav-fill" id="dashboard_tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="communication-tab" data-toggle="tab" href="#communication" role="tab" aria-controls="home" aria-selected="true">Communication</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="leads-tab" data-toggle="tab" href="#leads-panel" role="tab" aria-controls="leads-panel" aria-selected="false">Leads</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="enrollment-tab" data-toggle="tab" href="#enrollment-panel" role="tab" aria-controls="enrollment-panel" aria-selected="false">Enrollment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="conversion-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Conversion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="attendance-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Attendance</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pending-review-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Pending Reviews</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="admin-center-tab" data-toggle="tab" href="#admin-center" role="tab" aria-controls="contact" aria-selected="false">Admin Center</a>
      </li>
    </ul>
  </div>
</nav>
<div class = "container">
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="communication" role="tabpanel" aria-labelledby="communication-tab">
  	<?php
    include( get_stylesheet_directory() .'/templates/crm/communication.php'); ?>

  </div>
  <div class="tab-pane fade" id="leads-panel" role="tabpanel" aria-labelledby="leads-panel">
    <?php
    include( get_stylesheet_directory() .'/templates/crm/leads.php'); ?>
  </div>
  <div class="tab-pane fade" id="enrollment-panel" role="tabpanel" aria-labelledby="enrollment-tab">
    <?php
    include( get_stylesheet_directory() .'/templates/crm/enrollment_view.php');
    include( get_stylesheet_directory() .'/templates/crm/modify_student_enrollment_selection.php');
    include( get_stylesheet_directory() .'/templates/crm/modify_enrollment.php');
    ?>
  </div>
  <div class="tab-pane fade" id="admin-center" role="tabpanel" aria-labelledby="admin-center-tab">

   <?php
   include( get_stylesheet_directory() .'/templates/crm/admin-functions.php');
   ?>
 </div>

</div>
</div>




