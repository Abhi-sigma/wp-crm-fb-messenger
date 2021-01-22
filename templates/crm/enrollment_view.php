<?php //var_dump($all_enrollments)

 ?>
<section>
	<div>
		<input type="text" id="search_input_enrollment"  placeholder="Search for names..">
		<button class = "btn btn-primary"class = add_tag_modal_displayer >Add Tag</button>
	</div>
	<div class="table-responsive">
		<table class ="table enrollment">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Course Name</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Desired Score</th>
				</tr>
			</thead>
			<tbody id ="enrollment_table_body">
					<?php foreach ($all_enrollments as $data): ?>
						<tr>
							<input type = "hidden" name = "student_id" value = <?php echo $data->student_id ?>>
							<input type = "hidden" name = "course_id" value = <?php echo $data->course_id ?>>
							<td><?php echo $data->enrollment_id ?></td>
							<td><?php echo $data->name ?></td>
							<td><?php echo $data->coursename ?></td>
							<td><?php echo $data->start_date ?></td>
							<td><?php echo $data->end_date ?></td>
							<td><?php echo $data->desired_score ?></td>
							<td></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<!-- we will add pagination here -->

		</div>
	</section>







