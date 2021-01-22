<?php
global $my_crm_db;
$all_students = $my_crm_db->get_results("select * from student_details join registration on registration.student_id = student_details.student_id");

$all_sources = $my_crm_db->get_results("select source from student_details join registration on registration.student_id = student_details.student_id group by source");

$all_branches = $my_crm_db->get_results("select branch_name from branches");

$all_courses = $my_crm_db->get_results("select coursename from courses");

$all_enrollments = $my_crm_db->get_results("Select name,coursename,start_date,end_date,desired_score,student_details.student_id,enrollment.course_id,enrollment_id from enrollment join student_details on student_details.student_id = enrollment.student_id join courses on courses.course_id = enrollment.course_id");

$all_leads = $my_crm_db->get_results("Select * from student_details LEFT OUTER JOIN  enrollment on enrollment.student_id = student_details.student_id join  registration on registration.student_id = student_details.student_id join student_tag on student_tag.student_id = student_details.student_id join tags on tags.tag_id = student_tag.tag_id");



























