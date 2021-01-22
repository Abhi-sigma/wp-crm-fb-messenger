<?php ;?>
<?php $all_tags = $my_crm_db->get_results("select * from tags");
$student_object = array();
// var_dump($student_object);
 foreach ($all_leads as $data) {
 	if($student_object[$data->student_id]["student_id"] == $data->student_id){
 		array_push($student_object[$data->student_id]["tags"],$data->tag_name);
 	}
 	else{

 		$student_object[$data->student_id] = array(
 			"student_id"=>$data->student_id,
 			"email"=>$data->email,
 			"course_id"=>$data->course_id,
 			"name"=>$data->name ,
 			"course_name" =>$data->coursename,
 			"tags"=> array($data->tag_name,
 			));

 	}

 }

// var_dump($student_object);


 ?>
 <div class = "tag_cloud">
 	 <button class ="btn btn-primary tagcloud_entries active">All Students</button>
 <?php foreach ($all_tags as $tagcloud_entries): ?>
        <button class ="btn btn-primary tagcloud_entries"><?php  echo $tagcloud_entries->tag_name ?>
        <input type ="hidden"
        name = <?php echo "tag_cloud".$tagcloud_entries->tag_id ?> >
        <input type = "hidden" action = "tag_handler">
    </button>
<?php endforeach ?>
</div>
<div>
		<input type="text" id="search_input_leads"  placeholder="Search for names..">
		<button class = "btn btn-primary"class = add_tag_modal_displayer >Add Tag</button>
	</div>
	<section>
	<div class="table-responsive">
		<table class ="table registration" id = "leads_table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Tags</th>
				</tr>
			</thead>
			<tbody id ="leads_table_body">
				 <?php //var_dump($all_leads); ?>
					<?php foreach ($student_object as $data): ?>


						<tr>
							<input type = "hidden" name = "student_id" value = <?php echo $data["student_id"] ?>>
							<input type = "hidden" name = "course_id" value = <?php echo $data["course_id"] ?>>
							<td><?php echo $data["student_id"]  ?></td>
							<td><?php echo $data["name"] ?></td>
							<td><?php echo $data["email"] ?></td>
							<td>
								<?php foreach ($data["tags"] as $tags): ?>

									<span class = "tag_single"><?php echo $tags ?> </span>

		                        <?php endforeach ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</section>


