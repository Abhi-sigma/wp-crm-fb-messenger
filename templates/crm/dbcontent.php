<?php

global $my_crm_db;
$my_crm_db = db_connection();
// //var_dump($my_crm_db);

$results = $my_crm_db->get_results("SELECT  registration_id,name FROM `registration` join student_details on registration.student_id=student_details.student_id join communication on communication.");

foreach ($results as $data) {
	//var_dump($data);
	# code...
}





 ?>