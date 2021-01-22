<?php
/* Template Name: ULA CRM Template DashBoard */
session_start();
include(get_stylesheet_directory() .'/templates/crm/includes/check_state.php');
if($verified_state == true){
	// echo "state_verified";
	if($_SESSION["logged_in"] == "true"){
		get_template_part("templates/crm/header-crm");
		get_template_part("templates/crm/dashboard");
		get_template_part("templates/crm/crm_footer");
	}
	else{
		echo "<h1 style='text-align:center'>you need to log in to continue</h1>";
		echo  "<h3 style='text-align:center'> Go to <a href = './ula-crm' > LOG IN</a></h3>";
	}
}
else{
	wp_die();
}

?>
