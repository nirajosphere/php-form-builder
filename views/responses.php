<?php 
$current_form=new Form($form_id);
$response_id = isset($response_id) ? $response_id : 1;
$response=$current_form->get_response($response_id);
$labels=$current_form->get_labels();
?>
<script>var currentForm='<?=$current_form->id?>';</script>
<div class="container-fluid">
	<div class="row edit-form-header">
		<div class="col-12 p-5">
			<a href="<?=$application_url?>"><i class="fas fa-arrow-left mr-3"></i>Go to Home</a>
		</div>
	</div>
</div>
<div class="container">
	<div class="container form-container">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h1><?=$current_form->title?></h1>
			<a href="<?=$application_url.'/form/'.$current_form->id.'/edit';?>">
				<i class="fas text-primary fa-pencil-alt fa-lg"></i>
			</a>
		</div>
		<p><?=$current_form->description?></p>
		<div class="mt-5">
			<?php 
			if($response_id<=$current_form->get_responses_count() && $response_id>0){
				?>
				<div class="d-flex justify-content-center align-items-center my-5">
					<div class="mr-4">
						<?php 
						if($response->has_prev){
							?>
							<a href="<?=$application_url?>/form/<?=$form_id?>/responses/<?=$response->prev_id?>">
								<i class="fas fa-chevron-left fa-lg"></i>
							</a>
							<?php
						}
						?>
					</div>
					<div>
						<?=$response_id?> / <?=$current_form->get_responses_count()?>
					</div>
					<div class="ml-4">
						<?php 
						if($response->has_next){
							?>
							<a href="<?=$application_url?>/form/<?=$form_id?>/responses/<?=$response->next_id?>">
								<i class="fas fa-chevron-right fa-lg"></i>
							</a>
							<?php
						}
						?>
					</div>
				</div>
				<div class="mb-2">
					<small>Submitted : <?=$response->timestamp?></small>
				</div>

				<table class="table table-bordered table-striped mb-4">
					<?php
					foreach ($labels as $label) {
						$value=isset($response->response[$label]) ? $response->response[$label] : '';
						?>
						<tr>
							<td><?=$label?></td>
							<td><?=$value?></td>
						</tr>
						<?php 
					}
					?>
				</table>
			<?php }
			else{
				?>
				<div>
					Invalid Response URL. 
					<a href="<?=$application_url?>/form/<?=$form_id?>/responses/" class="text-primary font-weight-bold">
						Click here
					</a>
				</div>
				<?php
			} ?>
		</div>
	</div>
</div>
