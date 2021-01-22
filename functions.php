<?php
// this is the functions which connects to the database of the crm
session_start();
$db_connection = get_stylesheet_directory() .'/templates/crm/includes/db_connection.php';
$db_queries = get_stylesheet_directory() .'/templates/crm/includes/crm_db_queries_nj_form.php';
$fb_functions = get_stylesheet_directory() .'/templates/crm/includes/fb_functions.php';
$routes = get_stylesheet_directory() .'/templates/crm/includes/routes.php';



require_once($fb_functions);
require_once($db_connection);
require_once($db_queries);
require_once($routes);
// require_once($fb_registrations);

// the idea is to run this every time the page is loaded and store it in session so
// that it will prevent session hijacks
$state_ula_page_ver_1111;


// function to generate random string and pass it in the state
function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $_SESSION["state"] = $randomString;
    return $randomString;
}

function form_handler_admin_login(){
    crm_user_login();
    get_fb_messages_and_register();

}

$state_ula_page_ver_1111 = generateRandomString();

// initialise db cconnection
// add_action("init","generateRandomString");
add_action("init","db_connection");


// handle forms

// Use your hidden "action" field value when adding the actions
add_action( 'admin_post_nopriv_login_form', 'form_handler_admin_login' );
add_action( 'admin_post_login_form', 'form_handler_admin_login' );

// handle ajax forms

// -----------------------------------------------------------------------------------------------------

function handle_ajax_add_student(){
	$nonce = $_REQUEST["nonce"];
	if ( !wp_verify_nonce($nonce, "add_student_nonce") ){
			exit();
      }
    else{
    	$array_to_process = $_REQUEST;
    	unset($array_to_process["nonce"]);
    	unset($array_to_process["action"]);
        $email =$array_to_process["email"];
    	global $my_crm_db;
    	$status=array("error"=>false);
    	foreach ($array_to_process as $key => $value) {
    		// check if all the values are present
    		if(!empty($value)){

    			$form_validation = true;
    			$status["error"] = false;
    		}
    		else{
    			$form_validation = false;
    			$status["error"] = true;
    			break;
    		}
    	}

    	if($form_validation == true){
            $check_if_email_exists = $my_crm_db->get_results("select email from student_details where email = '{$email}' ");
            if($check_if_email_exists){
                 $status["error"] = true;
                 $status["error_data"]= "Email Already Exists";
                 echo json_encode($status);

            }
            else{
                $result = $my_crm_db->insert("student_details",$array_to_process);
                $lastid = $my_crm_db->insert_id;
                // var_dump($lastid);
                $my_crm_db->insert("registration",array("student_id"=>$lastid));
                echo json_encode($status);

            }

		}
		else{
			echo json_encode($status);
		}


        die();

    }
}


// -----------------modify students---------------------------------------------------------------------------------
// the first ajax sends the request which populates the form to modify

function handle_ajax_modify_student_selection(){
	$nonce = $_REQUEST["nonce"];
	if ( !wp_verify_nonce($nonce, "modify_student_selection_nonce") ){
			exit();
      }
    else{

    	$array_to_process = $_REQUEST;
    	// this gets the option in wiered format that we have passed for ease
    	// we break that by using regexp into registration_id
    	$registration_id_request = $_REQUEST["registration_id"];
        // var_dump($_REQUEST["registration_id"]);
		$pattern = '/(?<=:)[\d]+/';
		preg_match($pattern,$registration_id_request,$matches,PREG_UNMATCHED_AS_NULL);
		$registration_id = $matches[0];
        // var_dump($registration);
        // var_dump($registration_id);
		// now we make request
		global $my_crm_db;
		$query = $my_crm_db->prepare("select * from student_details join registration on registration.student_id = student_details.student_id where registration_id = %s ",$registration_id);
        // var_dump($query);
		$results = $my_crm_db->get_results($query);
        if (!empty($results)) {
            $response=array("error"=>false);

            $response["data"] = $results;
            // var_dump($results);

            echo json_encode($response);

        }
        else{
            $response = array("error"=>false);
            echo json_encode($response);
        }


    }
    die();
}


function handle_ajax_modify_students(){
    $nonce = $_REQUEST["nonce"];
    if ( !wp_verify_nonce($nonce, "modify_student_nonce") ){
        var_dump(wp_verify_nonce($nonce, "modify_student_nonce"));
            exit();
      }
    else
        global $my_crm_db;
        $array_to_process = $_REQUEST;
        unset($array_to_process["nonce"]);
        unset($array_to_process["action"]);
        unset($array_to_process["previous_source"]);
        $student_id = $array_to_process["id"];
        unset($array_to_process["id"]);
        // var_dump($array_to_process);
        // var_dump($my_crm_db);

        var_dump($student_id);
        $update_results = $my_crm_db->update(
            'student_details', $array_to_process, array('student_id'=>$student_id));
        // var_dump($array_to_process);
        var_dump($update_results);
        $status = array("error"=>true);
        if(!$update_results){
            $status["error"] = false;
            echo json_encode($status);

        }
        else{
             $status["error"] = false;
            echo json_encode($status);

        }


         die();
    }





// add student  actions----------------------------------------------------------
add_action("wp_ajax_add_student", "handle_ajax_add_student");
add_action("wp_ajax_nopriv_add_student", "handle_ajax_add_student");

add_action("wp_ajax_modify_student_selection", "handle_ajax_modify_student_selection");
add_action("wp_ajax_nopriv_modify_student_selection", "handle_ajax_modify_student_selection");

add_action("wp_ajax_modify_student", "handle_ajax_modify_students");
add_action("wp_ajax_nopriv_modify_student", "handle_ajax_modify_students");



// ------------------ add enrollment----------------------------------------------------------

function handle_ajax_add_student_enrollment(){
    $nonce = $_REQUEST["nonce"];
    if ( !wp_verify_nonce($nonce, "add_student_enrollment_nonce") ){
            exit();
      }
    else{
        global $my_crm_db;
        $student_id_request = $_REQUEST["name"];
        // check the upper functions to see what we are doing here
        $pattern = '/(?<=:)[\d]+/';
        preg_match($pattern,$student_id_request,$matches,PREG_UNMATCHED_AS_NULL);
        $student_id = $matches[0];
        $course  = $_REQUEST["course"];
        $array_to_process = $_REQUEST;
        // unset extra values
        unset($array_to_process["nonce"]);
        unset($array_to_process["action"]);
        unset($array_to_process["course"]);
        unset($array_to_process["name"]);

        // add values to be passed in db
        $array_to_process["student_id"] =  (int) $student_id;
         // get branch
        $array_to_process["branch"] = (int) $my_crm_db->get_results($my_crm_db->prepare(
            "select branch_id from branches where branch_name = %s",$array_to_process["branch"]))[0]->branch_id;

        // get course query
        $course_query = $my_crm_db->get_results($my_crm_db->prepare(
            "select course_id from courses where coursename = %s",$course));

        $course_id = (int) $course_query[0]->course_id;

        // var_dump($course_id);

        $array_to_process["course_id"] = $course_id;

        // var_dump($array_to_process);




        $query_record_for_same_student = $my_crm_db->get_results($my_crm_db->prepare(
            "select course_status from enrollment where course_id = %s and student_id = %d " ,$course_id,$student_id));

        // var_dump($my_crm_db->prepare(
        //     "select course_id,end_date from enrollment where course_id = %s and end_date < %d",$course_id,$end_date));

        // var_dump($query_record_for_same_student);


        // check if table is empty
        $query_empty = $my_crm_db->get_results("SELECT count(*) FROM enrollment");
        // if table not empty
        if($query_empty>0){
            if(!empty($query_record_for_same_student)){
            // var_dump(strtotime($query_end_date));
            // var_dump(strtotime($_REQUEST["end_date"]));
                if($query_record_for_same_student[0]->course_status = "active" ){
                        $student_already_enrolled = true;
                }
            }
            else{
                $student_already_enrolled = false;
            }

        }




        // var_dump($student_already_enrolled,$query_end_date,$_REQUEST["end_date"]);
        // initialise status to pass in ajax response with data

        $status=array("error"=>false);

        // check if all the values are set when sent from browser
        foreach ($array_to_process as $key => $value) {
            // check if all the values are present
            if(!empty($value)){

                $form_validation = true;
                $status["error"] = false;
            }
            else{
                $form_validation = false;
                $status["error"] = true;
                break;
            }
        }

        // var_dump($form_validation,$student_already_enrolled);

        if($form_validation == true and $student_already_enrolled == false){
                 $result = $my_crm_db->insert("enrollment",$array_to_process);
                 echo json_encode($status);
             }


        else{
                 $status["error"] = true;
                 $status["error_data"]= "Student Already Enrolled in same course";
                 echo json_encode($status);

            }
        }

        die();
    }


    // modify student enrollment----------------------------------------------------------------


function handle_ajax_modify_student_enrollment_selection(){
    $nonce = $_REQUEST["nonce"];
    if ( !wp_verify_nonce($nonce, "modify_student_enrollment_selection_nonce") ){

            exit();
      }
    else{
        $array_to_process = $_REQUEST;
        global $my_crm_db;
        // extract course name
        $pattern = '/\((.*?)\)/';
        // var_dump($array_to_process["name"]);
        preg_match($pattern,$array_to_process["name"],$matches,PREG_UNMATCHED_AS_NULL);
        $course_name  = $matches[1];
        // var_dump($course_name);
        $query = $my_crm_db->prepare("select student_details.name,student_details.student_id,enrollment.desired_score,enrollment_id,courses.coursename from enrollment join student_details on enrollment.student_id = student_details.student_id join courses on enrollment.course_id = courses.course_id join branches on branches.branch_id = enrollment.branch where enrollment.student_id = %s and courses.coursename = %s ",$array_to_process["id"],$course_name);
        // var_dump($query);
        $results = $my_crm_db->get_results($query);
        // var_dump($results);
        if (!empty($results)) {
            $response=array("error"=>false);
            $response["data"] = $results;
            echo json_encode($response);
        }
        else{
            $response = array("error"=>false);
            echo json_encode($response);
        }
    }
    die();

}


function handle_ajax_modify_student_enrollment(){
    $nonce = $_REQUEST["nonce"];
    if ( !wp_verify_nonce($nonce, "modify_student_enrollment_nonce") ){
            exit();
      }
    else
        global $my_crm_db;
        $array_to_process = $_REQUEST;
        unset($array_to_process["nonce"]);
        unset($array_to_process["action"]);
        // var_dump($array_to_process);
        // var_dump($my_crm_db);
        $update_results = $my_crm_db->update(
            'enrollment', $array_to_process, array('enrollment_id'=>$array_to_process["enrollment_id"]));
        // var_dump($array_to_process);
        $status = array("error"=>true);
        if(!$update_results){
            $status["error"] = false;
            echo json_encode($status);

        }
        else{
             $status["error"] = false;
            echo json_encode($status);

        }


         die();
    }



// handle add and modify enrollments

add_action("wp_ajax_add_student_enrollment","handle_ajax_add_student_enrollment");
add_action("wp_ajax_nopriv_add_student_enrollment", "handle_ajax_add_student_enrollment");

add_action("wp_ajax_modify_student_enrollment_selection","handle_ajax_modify_student_enrollment_selection");
add_action("wp_ajax_nopriv_modify_student_enrollment_selection", "handle_ajax_modify_student_enrollment_selection");

add_action("wp_ajax_modify_student_enrollment","handle_ajax_modify_student_enrollment");
add_action("wp_ajax_nopriv_modify_student_enrollment", "handle_ajax_modify_student_enrollment");


// --------------------------------------------------------------------------------------

// tag handler



function handle_tag_cloud(){


}

add_action("wp_ajax_tag_handler","handle_tag_cloud");
add_action("wp_ajax_nopriv_tag_handler","handle_tag_cloud");






// enqueue style and scripts

$csspath = get_stylesheet_uri();

function my_theme_enqueue_styles() {
    wp_enqueue_style( 'pangja-child', get_stylesheet_uri(),array(),filemtime($csspath) );
}


function my_custom_scripts() {
 wp_enqueue_script('my-custom-script', get_stylesheet_directory_uri() .'/js/custom.js', array('jquery'), null, true);
}


add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', 11 );
add_action( 'wp_enqueue_scripts', 'my_custom_scripts' );

// register routes
add_action( 'rest_api_init', 'register_fb_route' );
















