<?php

// this will serve as a footer


$js_file_location = get_stylesheet_directory_uri() .'/templates/crm/js' ;
// echo $js_file_location;
// echo get_stylesheet_directory_uri();

?>
<!-- load js files here -->

<script type="text/javascript" src = <?php echo $js_file_location . "/main.js" ?> ></script>
