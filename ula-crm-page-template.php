<?php
 /* Template Name: ULA CRM Template */

include(get_stylesheet_directory() .'/templates/crm/includes/check_state.php');

if($verified_state == true){
	echo "state_verfied";
	get_template_part("templates/crm/header-crm");
	get_template_part("templates/crm/admin-loginform");
}
else{
	wp_die();
}

 // if admin-user not logged on
 //
 // if admin user-logged in
 // get_template_part("templates/crm/dashboard");



?>





