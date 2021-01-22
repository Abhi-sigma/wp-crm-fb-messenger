<?php

$my_crm_db;

function db_connection(){
    $database_name = 'ulacrm';
    global $my_crm_db;
    $my_crm_db = new wpdb(DB_USER, DB_PASSWORD, $database_name, DB_HOST);
    // echo "Database Connection Established";
    return $my_crm_db;
}
?>
