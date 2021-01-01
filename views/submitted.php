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
	<div class="container form-container">
		<p>
			<h3>Thank You</h3>
			<div class="mb-2 mt-5">Your Response has been submitted. </div>
			<a href="<?=$application_url?>/form/<?=$current_form->id?>/submit" class="text-primary">Submit another response here</a>
		</p>
	</div>
</div>