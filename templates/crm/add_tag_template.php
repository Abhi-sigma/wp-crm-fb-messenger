<div class="modal fade" id="add_tag_modal" tabindex="-1" data-template = "add_tag_modal" role="dialog" aria-labelledby="add_tag_modallabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add_tag_modal_title">ADD TAG</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id = "add_tag_form">
					<div class = "form-group">
						<label for="tag_name">Name of the tag</label>
						<input  name = "tag_name" required class ="form-control" id = "tag_name">
					</div>
					<div class = "form-group">
						<label for="tag_description">Describe the tag</label>
						<input  name = "tag_description" required class ="form-control" id = "tag_description">
					</div>
					<input type = "hidden" name = "action" value = "add_tag">
					<input type = "hidden" name = "nonce"
                  value = <?php echo wp_create_nonce("add_tag_nonce");
            ?> >
				</form>

			</div>
		</div>
	</div>
</div>
