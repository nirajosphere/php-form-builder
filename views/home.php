<?php 
/**
 * Tamplate file for homepage where all the forms will be displayed.
 */
global $application_url,$logo_uri;
$current_user=Login::get_current_user();

?>
<div class="container-fluid">
	<div class="row p-3 align-items-center header-row">
		<div class="col-2">
			<a href="<?=$application_url?>">
				<img src="<?=$application_url.$logo_uri?>" id="logo">
			</a>
		</div>
		<div class="col-7">
			<div class="search-wrap">
				<input type="text" id="search" class="form-control-lg form-control" placeholder="Search">
			</div>
		</div>
		<div class="col-3">
			<div class="d-flex justify-content-end align-items-center">
				<!-- <i class="fas fa-bell mr-4 fa-lg text-muted"></i> -->
				<div class="dropdown">
					<a class="dropdown-toggle f18" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
						<?php echo $current_user->fname.' '.$current_user->lname;?>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
						<a class="dropdown-item" href="<?=$application_url?>/logout">Logout</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row py-4 main-container">
		<div class="col-2 px-0 pr-4">
			<form action="" method="post" class="px-4">
				<button class="btn btn-lg btn-white new-button" name="new_form" value="<?=encrypt_decrypt('encrypt',$current_user->username)?>">
					<img src="<?=$application_url?>/assets/images/plus.png" width="25" class="mr-2">
					New
				</button>
			</form>
			<ul class="nav nav-pills flex-column pt-4">
				<li class="nav-item">
					<a href="<?=$application_url?>" class="nav-link active">
						<i class="fas fa-file-alt mr-3"></i>
						Forms
					</a>
				</li>
				<!-- <li class="nav-item">
					<a href="<?=$application_url?>" class="nav-link text-muted">
						<i class="fas fa-users mr-3"></i>
						Shared Forms
					</a>
				</li> -->
			</ul>
		</div>
		<div class="col-10 form-listing">
			<div class="row">
				<?php 
				$forms=get_forms_by_user('active');
				if(count($forms)){
					?>
					<div class="col-12">
						<div class="mb-3 mt-4">Active Forms</div>
						<div class="row">
							<?php

							foreach ($forms as $form) {
								?>
								<div class="col-3 mb-4">
									<div data-id='<?=$form->id?>' class="form-thumb">
										<img src="<?=$application_url?>/assets/images/thumb.png">
										<span><?=$form->title?></span>
									</div>
								</div>
								<?php
							}
							?>
						</div>		
					</div>
					<?php 
				}
				$forms=get_forms_by_user('inactive'); 
				if(count($forms)){
					?>
					<div class="col-12">
						<div class="mb-3 mt-4">Inactive Forms</div>
						<div class="row">
							<?php
							
							foreach ($forms as $form) {
								?>
								<div class="col-3 mb-4">
									<div data-id='<?=$form->id?>' class="form-thumb inactve">
										<img src="<?=$application_url?>/assets/images/thumb.png">
										<span><?=$form->title?></span>
									</div>
								</div>
								<?php
							}
							?>
						</div>		
					</div>
				<?php } ?>
			</div>
			
		</div>
		<div class="detail-column d-none"></div>
	</div>
</div>

<div id="contextMenu" class="dropdown-menu">
	<a class="dropdown-item" href="#" id='edit-form-right-click'>Edit</a>
	<a class="dropdown-item" href="#" id='get-link-right-click'>Get Submission Link</a>
	<a class="dropdown-item" href="#" id='view-responses-right-click'>View Responses</a>
</div>

<div class="modal fade" id="shareLinkModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Share Form Link</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="mb-3">Heya !! You are just one step away from sharing your form with everyone to get started and recieve the responses.</div>
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Form Link" id="shareLinkInput" autofocus>
					<div class="input-group-append">
						<button class="btn btn-primary" id="copyShareLink" type="submit">Copy</button> 
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>
<?php include('./views/footer.php'); ?>