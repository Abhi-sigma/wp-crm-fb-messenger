<?php
/**
 * This function is where we register our routes for our example endpoint.
 */
// need to protect this endpoint by session
function register_fb_route() {
    // register_rest_route() handles more arguments but we are going to stick to the basics for now.
    register_rest_route( 'hooks/v1', '/fb-hook', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => WP_REST_Server::ALLMETHODS,
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'get_fb_web_messages',
    ) );
}



?>