<?php
require_once(get_stylesheet_directory() .'/templates/crm/includes/dashboard_queries.php');
require_once(get_stylesheet_directory() .'/templates/crm/includes/fb_queries.php');
// //var_dump($results_unreplied_messages);
?>


<section>
	<h1>Communication Center</h1>
 <table class ="table registration">
 	<tr>
 		<th>Profile</th>
	 	<th>Registration ID</th>
	 	<th>Name</th>
	 	<th>Messages_Unreplied</th>
	 	<th>Source</th>
   </tr>
<?php foreach ($results_unreplied_messages as $data):
	// //var_dump($data);
 ?>
 	<tr>
 		<td>
 			<img style = width:50px;height:50px class = rounded-circle src="https://cdn.pixabay.com/photo/2016/04/01/10/11/avatar-1299805_960_720.png">
 		</td>
 		<td>
 			<?php echo $data->registration_id ?>
 		</td>

 		<td>
 			<?php echo $data->name ?>
 		</td>
 	    <td>
 	  	  <?php echo $data->unreplied_messages ?>
 	  	</td>
 	  	<td>
 	  		ULA-WEB-SITE
 	  	</td>
 	  	<td>
 	  		<a
	 	  		href = <?php echo esc_attr( add_query_arg(array("id"=>$data->registration_id,"type"=>'unreplied','source'=>$data->source) ) ); ?> >
	 	  		<button class = "btn btn-primary">View Unreplied Messages</button>
	 	  	</a>
 	  	</td>
 	  	<td>
 	  		<a
 	  			href= <?php echo esc_attr( add_query_arg(array("id"=>$data->registration_id,"type"=>'all','source'=>$data->source) ) ); ?> >
	 	  		<button class = "btn btn-success">View All Messages</button>
	 	  	</a>
 	  	</td>
 	</tr>
<?php endforeach; ?>
<?php foreach ($fb_messages_all as $data): ?>
	<tr>
		<td>
			<?php echo '<img style = width:50px;height:50px class = rounded-circle src="data:image/jpeg;base64,'.base64_encode($data->profile_pic).'"/>' ;?>
		</td>
		<td>
			<?php echo $data->registration_id ?>
		</td>
		<td>
			<?php echo $data->name ?>
		</td>
		<td>
			<?php echo $data->unreplied_msgs ?>
		</td>
		<td>
			Facebook
		</td>
		<td>
 	  		<a
	 	  		href = <?php echo esc_attr( add_query_arg(array("id"=>$data->registration_id,"type"=>'unreplied','source'=>$data->source) ) ); ?> >
	 	  		<button class = "btn btn-primary">View Unreplied Messages</button>
	 	  	</a>
 	  	</td>
 	  	<td>
 	  		<a
 	  			href= <?php echo esc_attr( add_query_arg(array("id"=>$data->registration_id,"type"=>'all','source'=>$data->source) ) ); ?> >
	 	  		<button class = "btn btn-success">View All Messages</button>
	 	  	</a>
 	  	</td>
	</tr>

<?php endforeach; ?>
</table>


<!-- table start for individual messages -->

<!-- table section for individual messages  received by form -->


<?php if (!empty($_GET["id"]) && $_GET["type"] =='unreplied' && $_GET["source"] =='ula-web-page') {


		$data_to_query = $results_messages_individual_unreplied;
		// //var_dump($data_to_query);
		include(get_stylesheet_directory() .'/templates/crm/individual_messages.php');


	}


 if (!empty($_GET["id"]) && $_GET["type"] =='all' && $_GET["source"] =='ula-web-page' ){


		$data_to_query = $results_all_messages_individual;
		// //var_dump($data_to_query);
		include(get_stylesheet_directory() .'/templates/crm/individual_messages.php');

	}

if (!empty($_GET["id"]) && $_GET["type"] =='unreplied' && $_GET["source"] =='facebook'){


		$data_to_query = $results_fb_messages_individual_unreplied;
		// //var_dump($data_to_query);
		include(get_stylesheet_directory() .'/templates/crm/individual_messages.php');
	}

if (!empty($_GET["id"]) && $_GET["type"] =='all' && $_GET["source"] =='facebook' ){

		$data_to_query = $results_fb_messages_individual_all;
		// //var_dump($data_to_query);
		include(get_stylesheet_directory() .'/templates/crm/individual_messages.php');
}

?>


</section>