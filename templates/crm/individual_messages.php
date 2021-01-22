<table class = "table messages">

		<tr>
			<th>Message ID</th>
			<th>Name</th>
			<th> Message</th>
		</tr>

		<?php if(isset($data_to_query)): ?>
		<?php foreach ($data_to_query as $data):  ?>

		<tr>
			<td>

			  <?php echo $data->message_id ?>

			</td>



			<td>
				<?php echo $data->name; ?>
			</td>


			<td>
				<?php echo $data->message; ?>
			</td>

		</tr>
		<?php endforeach; ?>

		<tr>
			<td>
				<?php if ($data->message_id):?>
				    <a href ="#"><button class = "btn btn-danger" >Reply</button></a>
			    <?php endif ?>
			</td>

		</tr>


	<?php endif; ?>

	</table>  ;