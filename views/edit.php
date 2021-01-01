<?php 
/**
 * Template for displaying edit form page
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
$current_form=new Form($form_id);
?>
<script>var currentForm='<?=$current_form->id?>';</script>
<div class="container-fluid">
	<div class="row edit-form-header">
		<div class="col-12 p-5">
			<a href="<?=$application_url?>"><i class="fas fa-arrow-left mr-3"></i>Go Back</a>
		</div>
	</div>
</div>
<div class="container">
	<div class="container form-container">
		<form id="formConfig">
			<input type="text" class="form-control form-control-lg mb-2" name="title" id="title" value="<?=$current_form->title?>" placeholder="Form Title">
			<textarea type="text" class="form-control mb-5" name="description" id="description" placeholder="A short description of this form"><?=$current_form->description?></textarea>
			<div class="components">
				<?php 
				foreach ($current_form->form_obj as $key=>$value) {
					$args=array(
						'id'=>$key,
						'label'=>$value->label,
						'is_required'=> isset($value->is_required)?$value->is_required:false,
						'options'=> isset($value->options) ? $value->options : array(),
					);
					$comp=get_component_by_type($value->type);
					$comp->initialize($args);
					$comp->get_edit_template();
				}
				?>
			</div>
			<div class="py-4">
				<div class="add-component">
					<i class="fas fa-plus mb-2"></i>
					<h6>Add</h6>
				</div>
			</div>
			<div class="d-flex justify-content-between pt-4">
				<div>
					<div class="custom-control custom-switch">
						<input type="checkbox" class="custom-control-input" id="accept_responses" name="accept_responses"
						<?php
						if($current_form->status=='active'){
							echo 'checked';
						}
						?>
						>
						<label class="custom-control-label" for="accept_responses">Accept Responses</label>
					</div>
				</div>
				<div>
					<button class="btn btn-primary">Publish</button>
				</div>
			</div>
		</form>
	</div>
</div>