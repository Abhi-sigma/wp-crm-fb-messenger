<?php

function get_fb_web_messages(){
	 // validate verify token needed for setting up web hook */
    $fb_message_array = array();
    if (isset($_GET['hub_verify_token'])) {
        if ($_GET['hub_verify_token'] === 'goodboy') {
            $challenge =  $_GET['hub_challenge'];
            return intval($challenge) ;
        } else {
            return "invalid verify Token";
        }
    }


    $db_results = get_message_from_fb_messenger($fb_message_array);
    // request to make fb api to get profile pic

// curl -X GET "https://graph.facebook.com/2763688380391976?fields=first_name,last_name,profile_pic&access_token=EAAb7rYyZAEboBAJpOaXmFgi7Ayg7PZBDjYESQvQcS1Wuw1plyRqlPA0JjL1XthqmgYsIfpjtZC5GS0tPJe6axQGJDOZBZCG9sA5SOfdxeACIeZAGNHHO72MoA0a8KwZBk9X7pvgCS9wGn8CyZB5Dk3uZBSnJbZBu9eWut0wD6utuLE5AZDZD"


    /* receive and send messages */
// $input = json_decode(file_get_contents('php://input'), true);
// if (isset($input['entry'][0]['messaging'][0]['sender']['id'])) {

//     $sender = $input['entry'][0]['messaging'][0]['sender']['id']; //sender facebook id
//     $message = $input['entry'][0]['messaging'][0]['message']['text']; //text that user sent

//     $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=EAAb7rYyZAEboBAJpOaXmFgi7Ayg7PZBDjYESQvQcS1Wuw1plyRqlPA0JjL1XthqmgYsIfpjtZC5GS0tPJe6axQGJDOZBZCG9sA5SOfdxeACIeZAGNHHO72MoA0a8KwZBk9X7pvgCS9wGn8CyZB5Dk3uZBSnJbZBu9eWut0wD6utuLE5AZDZD';

//     /*initialize curl*/
//     $ch = curl_init($url);
//     /*prepare response*/
//     $jsonData = '{
//     "recipient":{
//         "id":"' . $sender . '"
//         },
//         "message":{
//             "text":"You said, ' . $message . '"
//         }
//     }';
//     /* curl setting to send a json post data */
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//     if (!empty($message)) {
//         $result = curl_exec($ch); // user will get the message
//     }
// }


    return $db_results;
    // http_response_code(200);
}


function get_message_from_fb_messenger($fb_message_array){
    // get the raw post data received from facebook
    $input = json_decode(file_get_contents('php://input'), true);
    // get the id and message
    if (isset($input['entry'][0]['messaging'][0]['sender']['id'])) {

            $sender = $input['entry'][0]['messaging'][0]['sender']['id']; //sender facebook id
            $message_id = $input['entry'][0]['id']; //message_id
            $message = $input['entry'][0]['messaging'][0]['message']['text'];//text that user sent
            $timestamp = $input['entry'][0]['messaging'][0]['timestamp']; //timestamp
            $fb_message_array["scope_id"] = $sender;
            $fb_message_array["message"] = $message;
            $fb_message_array["timestamp"] = $timestamp;
            $token = "EAAb7rYyZAEboBAJpOaXmFgi7Ayg7PZBDjYESQvQcS1Wuw1plyRqlPA0JjL1XthqmgYsIfpjtZC5GS0tPJe6axQGJDOZBZCG9sA5SOfdxeACIeZAGNHHO72MoA0a8KwZBk9X7pvgCS9wGn8CyZB5Dk3uZBSnJbZBu9eWut0wD6utuLE5AZDZD";
            $url = "https://graph.facebook.com/{$sender}?fields=first_name,last_name,profile_pic&access_token={$token}";
            $response = wp_remote_get($url);
            if ( is_wp_error( $response ) ) {
                    echo "Error occured";
             }

             else {
                 $body = wp_remote_retrieve_body( $response );
                 $data = json_decode( $body );
                 $fb_message_array["name"] = $data->first_name ." ".$data->last_name;

                 $image_request_response = wp_remote_get($data->profile_pic);
                 $image =  wp_remote_retrieve_body( $image_request_response);
                 $fb_message_array["profile_pic"] =  $image;
                 // when we bring the data back from mysql
                 // echo '<img src="data:image/jpeg;base64,'.base64_encode( $image).'"/>';
             }
                global $my_crm_db;
                $db_results = $my_crm_db->insert("fb_messenger_messages" ,$fb_message_array);
             return ;



    }
}
?>