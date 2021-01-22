<?php
// admin-functions to add students,edit students,delete students




function add_student(){
// open up a form,add student and confirm
}


function delete_student($id){
// present a list of student and select one


}

function edit_student(){
	// open up a form and select student and
	// display attrubutes and let them change it

}

?>

<h2>Welcome to the Admin Center</h2>

<form>
	<div>
		<label>Please select your action</label>
		<select id = "action_selector">
			<option value = "0">Select Action</option>
			<option value="1">Add student</option>
			<option value="2">Modify student</option>
			<option value ="3">Update review table</option>
			<option value = "4">Add enrollment</option>
		</select>
		<button  type = "submit" id ="option_selector_button" disabled class = "btn btn-success">Confirm</button>
	</div>
</form>
<!-- js function to make ajax request when the item is seleccted -->

<?php
include(get_stylesheet_directory() .'/templates/crm/add_student_template.php');
include(get_stylesheet_directory() .'/templates/crm/modify_student_template.php');
include(get_stylesheet_directory() .'/templates/crm/add_enrollment.php');

 ?>
