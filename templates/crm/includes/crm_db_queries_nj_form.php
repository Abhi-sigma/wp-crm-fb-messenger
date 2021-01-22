<?php
// session_start();
require_once(get_stylesheet_directory() .'/templates/crm/includes/fb_student_registration.php');



function crm_user_login(){
    if ( !wp_verify_nonce($nonce, "login_admin_nonce") ){
      }

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {

        global $my_crm_db;
        $query = $my_crm_db->prepare("select * from db_users where user_name = %s
            and password = %s",$_POST["username"],$_POST["password"]);
        //var_dump($query);
        $results = $my_crm_db->get_results($query);
        var_dump($results);
        if ($results != null){
           // redirect the user to view page
            // these two functions are synchronisation functions
            insert_or_update_nj_form_main_page();
            get_fb_messages_and_register();
            // setting up session variable
            $_SESSION["logged_in"] = "true";
            $_SESSION["user"] = $_POST["username"];
            // get all the results from ninja form submissions
            return wp_redirect( "./ula-crm-dashboard/");
            exit;



        }



    }

    return wp_redirect(home_url("./ula-crm"));
}




// this is the funtion which has to be run if a different form is used on the webpage,
#TODO  use own form
function insert_or_update_nj_form_main_page(){
        // this function inserts the records from ninja forms
        // the key to synchronise is check for the email address
        // and only if the mail address is not present we,insert otherwise
        // we say that student has been already been added and we need to just add message
 global $wpdb;

 global $my_crm_db;
 global $id;

 $results = $wpdb->get_results("select * from wp_posts where post_type = 'nf_sub'");
            // //var_dump($results);
 foreach($results as $submissions){
     // echo "changing row";
    // making the global id so to insert the id in the synced posts.
   global $id;
   $id = $submissions->ID;
   echo "submitted_id  : " . $id ."<br>";
   $array_to_insert = array();
               // echo $id;
   $data = $wpdb->get_results("select * from wp_postmeta where post_id = '{$id}'");

   $sync_status = $my_crm_db->get_results("select post_id from synced_posts where post_id = '{$id}'");

   if($sync_status[0]->post_id ==$id){
    echo "true ";

   }
   else{
    echo "false";
   }
   // echo  "truth" .($sync_status[0]->post_id==$id);

   if($sync_status[0]->post_id != $id){
    $sql_sync = $my_crm_db->insert("synced_posts",array('post_id'=>$id));
               // //var_dump($data);
   foreach ($data as $customer) {
        // echo $customer->meta_key;
    switch($customer->meta_key){
        // this is the custom part,the title are to be guessed from field by looking at the db
        case '_field_1':
        echo "<br>Name :" .$customer->meta_value;
        $name = $customer->meta_value;
        $array_to_insert["name"] =$customer->meta_value;
        break;
        case '_field_2':
        echo "<br>Email :" .$customer->meta_value;
        $email = $customer->meta_value;
        $array_to_insert["email"] =$customer->meta_value;
        break;
        case '_field_3':
        echo "<br>Message :" .$customer->meta_value;
        $array_to_insert["message"] =$customer->meta_value;
        break;
    }
        echo "<br>" . "----------------------------------------------------------";
    }


                    // check if the email which sent the message  exists in main_page_inquiry table
                    // that is to say the customer has sent the message multiple times but crm hasn't synced it
                    // its possible that the customer is already registered or not registered
                    // so we check if the customer is in our ula crm db,that means that means that data
                    // has been inserted from inquiry on main page.

                    $result_student_registration = $my_crm_db->get_results(
                    "select * from main_page_inquiry where email = '{$email}'") ;

                     // if this results in not null than customer has sent us message before
                    // and have been  registered in previous synchronisations or
                      // he/she may have sent multiple messages without being registered.
                     // so we check for registration status by querying our student details table

            if(count($result_student_registration)>0){
                // //var_dump($result_student_registration);
                echo "email found in main enquiry page";
                // //var_dump($result_student_registration);
                $registration_status = get_registration_status($email);
                // this will return true or false

                if ($registration_status == true){
                    // sync  messages only
                    echo "<br>reg_status" . $registration_status;
                    echo "student already registered";
                    register_messages($array_to_insert,$email);

                }
                else{
                    // register student
                    $array_copy = $array_to_insert;
                    $array_copy["sync_status"] = true;
                    register_student($array_copy);
                    register_messages($array_to_insert,$email);



                }
            }


                else{

                    // register the student
                    $array_copy = $array_to_insert;
                    $array_copy["sync_status"] = true;
                    $my_crm_db->insert("main_page_inquiry",$array_copy);
                    register_student($array_copy);
                    register_messages($array_to_insert,$email);

                }
            }
        }
    }










function get_registration_status($email){
    global $my_crm_db;
    $result = $my_crm_db->get_results("select * from student_details where email = '{$email}'");
    if(count($result)>0){
        echo "student is registered";
        return true;
    }
    else{
        echo "student is not registered";
        return false;
    }

}


function register_student($array){

    // inserts the student into student details table and student registration table
    echo "<br>registering students";
    //var_dump($array["name"]);
    global $my_crm_db;
    global $id;
    echo "inside registration" .$id;
    // create a new array to insert fro old one
    $array_register =  array("name" => $array["name"],"email"=>$array["email"],"source"=>$array["ula-web-page"]);
    //var_dump($array_register);
    $result = $my_crm_db->insert("student_details",$array_register);
    $lastid = $my_crm_db->insert_id;
    //var_dump($lastid);
    $sql_reg = $my_crm_db->insert("registration",array('student_id' => $lastid));
    //var_dump(array('post_id'=>$id));
    //var_dump($sql_sync);


}

function register_messages($array,$email){
    global $my_crm_db;
    //var_dump($array["message"]);
    $insert_message = $my_crm_db->insert("messages",array(
                        "message"=>$array["message"]));
    //var_dump($insert_message);
    $message_id = $my_crm_db->insert_id;
    //var_dump($message_id);
    $student_id = $my_crm_db->get_row("select student_id from student_details where email = '{$email}'");
    // //var_dump($student);
    $result = $my_crm_db->insert("communication",array(
                        "student_id" =>$student_id->student_id,"message_id"=>$message_id));

    //var_dump($student_id->student_id);
    //var_dump($message_id);

    //var_dump($result);


}

function delete_from_ninja_form($id){
    global $my_crm_db;
    $del_result = $my_crm_db->get_results("DELETE FROM wp_posts where post_id={$id}");
}






