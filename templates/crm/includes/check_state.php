<?php

// use this function in header to check if the state is same as in session
// if session gets hijacked,it will be hard to come up with state that server
// sends every time
global $state_ula_page_ver_1111;
// //var_dump($state_ula_page_ver_1111);

function check_state($state){
	if ($state == $_SESSION["state"]){
		return true;
	}
	else{
		return false;
	}

}

$verified_state = check_state($state_ula_page_ver_1111);
// //var_dump($verified_state);

?>