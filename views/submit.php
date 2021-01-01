<?php 
$current_form=new Form($form_id);
?>
<script>var currentForm='<?=$current_form->id?>';</script>
<div class="container-fluid">
	<div class="row edit-form-header">
		<div class="col-12 p-5">
		</div>
	</div>
</div>
<div class="container">
	<div class="container form-container submit-container">
		<form id="formSubmit" method="POST">
			<h1 class="mb-4"><?=$current_form->title?></h1>
			<p><?=$current_form->description?></p>
			<?php 
			if($current_form->status=='inactive'){
				?>
				<p class="my-5"><strong>This form does not accept reposnses anymore. Thanks.</strong></p>
			<?php }
			else{
				foreach ($current_form->form_obj as $key=>$value) {
					$args=array(
						'id'=>$key,
						'label'=>$value->label,
						'is_required'=> isset($value->is_required)?$value->is_required:false,
						'options' => isset($value->options)?$value->options: array(),
					);
					$comp=get_component_by_type($value->type);
					$comp->initialize($args);
					$comp->get_view_template();
				}
				?>
				<div class="d-flex justify-content-between pt-4">
					<div>
						<button class="btn btn-primary">Submit</button>
					</div>
				</div>
			<?php } ?>
		</form>
	</div>
</div>