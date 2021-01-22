<?php
function get_fb_messages_and_register(){
global $my_crm_db;
// //var_dump($my_crm_db);
$results = $my_crm_db->get_results("select * from fb_messenger_messages
    where message_status = 'not_replied'");
    foreach ($results as $data) {
        // //var_dump($data);
        $scope_id = (int) $data->scope_id;
        $name = $data->name;
        // //var_dump($name);

        $db_query = $my_crm_db->get_var("Select id from synced_posts where post_id = '{$scope_id}'");
        //var_dump($scope_id);
        //var_dump($db_query);
        if($db_query == null ){
            register_fb_students($name,$scope_id);
        }

    }
}

function register_fb_students($name,$scope_id){

        // inserts the student into student details table and student registration table
    echo "<br>registering students";
    global $my_crm_db;
    // create a new array to insert from old one
    // to make email unique ,a unique identifier is needed so used scopeid for that,should be unique
    // will figure it out in during trial
    $array_register =  array("name" => $name,"email"=>"dummy" . $scope_id ."@email.com","source" =>"facebook","scope_id" => $scope_id);
    // insert into student details
    $result = $my_crm_db->insert("student_details",$array_register);
    $lastid = $my_crm_db->insert_id;
    // insert into registration
    $sql_reg = $my_crm_db->insert("registration",array('student_id' => $lastid));
    // insert into synced posts
    $db_synced_posts = $my_crm_db->insert("synced_posts",
        array('post_id'=> $scope_id));

}


?>
