
<?php
 global $my_crm_db;
 // query all the messages recieved in form
 $results_unreplied_messages = $my_crm_db->get_results("SELECT count(communication.student_id) as 'unreplied_messages',message,source,student_details.name,registration.registration_id from messages join communication on messages.message_id=communication.message_id join student_details on communication.student_id=student_details.student_id join registration on registration.student_id=student_details.student_id where messages.status='not_replied' group by registration.registration_id");




// query individual messages unreplied
 if (!empty($_GET["id"] && $_GET["type"] =='unreplied' && $_GET["source"] =='ula-web-page')){
 	$results_messages_individual_unreplied = $my_crm_db->get_results("SELECT messages.message_id,messages.message,student_details.name,registration.registration_id from messages join communication on messages.message_id=communication.message_id join student_details on communication.student_id=student_details.student_id join registration on registration.student_id=student_details.student_id where messages.status='not_replied' and registration.registration_id='{$_GET['id']}'");



 }
 if(!empty($_GET["id"] && $_GET["type"] =='all' && $_GET["source"] =='ula-web-page')){
 $results_all_messages_individual = $my_crm_db->get_results("SELECT message,student_details.name,registration.registration_id from messages join communication on messages.message_id=communication.message_id join student_details on communication.student_id=student_details.student_id join registration on registration.student_id=student_details.student_id where registration.registration_id ='{$_GET['id']}'");

}