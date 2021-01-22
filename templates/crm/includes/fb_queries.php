<?php

// get all facebook messages
global $my_crm_db;

$fb_messages_all = $my_crm_db->get_results("SELECT registration_id,fb_messenger_messages.name,profile_pic,count(fb_messenger_messages.scope_id) as 'unreplied_msgs',source from fb_messenger_messages join student_details on student_details.scope_id = fb_messenger_messages.scope_id join registration on registration.student_id=student_details.student_id where message_status = 'not_replied' group by fb_messenger_messages.scope_id");
	// //var_dump($fb_messages_all);


if (!empty($_GET["id"] && $_GET["type"] =='all' && $_GET["source"] =='facebook')){
	$set_query = $my_crm_db->query("set @row = 0");
 	$results_fb_messages_individual_all = $my_crm_db->get_results("select @row := @row + 1 as message_id,fb_messenger_messages.name as name,message from fb_messenger_messages join student_details on student_details.scope_id=fb_messenger_messages.scope_id join registration on registration.student_id=student_details.student_id where registration.registration_id='{$_GET['id']}'");


 }

 if (!empty($_GET["id"] && $_GET["type"] =='unreplied' && $_GET["source"] =='facebook')){
	$set_query = $my_crm_db->query("set @row = 0");
	// //var_dump($set_query);
 	$results_fb_messages_individual_unreplied = $my_crm_db->get_results( "select @row := @row + 1 as message_id,fb_messenger_messages.name as name,message from fb_messenger_messages join student_details on student_details.scope_id=fb_messenger_messages.scope_id join registration on registration.student_id=student_details.student_id where message_status = 'not_replied' and registration.registration_id = '{$_GET['id']}' ");
 	// //var_dump($results_fb_messages_individual_unreplied);


 }
?>

