<?php
/**
 * Including the required files in the priority
 */
include('config.php');
include('./inc/classes/Autoload.php');
include('./components/Autoload.php');
include('./inc/core.php');

/**
 * Adding Scripts
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
enque_script('jquery.min.js');
enque_script('jquery-ui.min.js');
enque_script('popper.min.js');
enque_script('bootstrap.min.js');
enque_script('bootstrap-select.min.js');
enque_script('form-builder.js');

/**
 * Adding Styles
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
enque_style('bootstrap.min.css');
enque_style('roboto.css');
enque_style('jquery-ui.css');
enque_style('https://use.fontawesome.com/releases/v5.7.2/css/all.css',true);
enque_style('bootstrap-select-daemonite.min.css');
enque_style('form-builder.css');

include_once('functions.php');


session_start();

/**
 * Routing for Application Home.
 * 
 * If the user is logged in, homepage will be displayed or else he will be redirected to the homepage.
 * @since 1.0.0
 * @author Niraj Gohel
 */
Route::add('/',function(){
	if(Login::is_user_logged_in()){
		add_class_to_body('home');
		include_once('./views/header.php');
		include_once('./views/home.php');
		include_once('./views/footer.php');
	}
	else{
		add_class_to_body('login');
		header('Location:./login');
	}
});

/**
 * Routing for Creating a new form
 * 
 * when user will click on new button this route will check if the key is passed correctly or not
 * @since 1.0.0
 * @author Niraj Gohel
 */
Route::add('/',function(){
	if(
		Login::is_user_logged_in()
		&& isset($_POST['new_form'])
		&& ($_POST['new_form']==encrypt_decrypt('encrypt',$_SESSION['username']))
	){
		add_class_to_body('edit-form');
		$new_form_id=randomString();
		$currentForm=new Form($new_form_id);
		header('Location:./form/'.$new_form_id.'/edit');
	}
	else{
		header('Location:./');
	}
},'post');

/**
 * Routing for Editing a form
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
Route::add('/form/([a-zA-Z0-9]*)/edit',function($form_id){
	if(current_user_can_edit($form_id)){
		add_class_to_body('edit-form');
		include_once('./views/header.php');
		include_once('./views/edit.php');
		include_once('./views/footer.php');
	}
	else{
		global $application_url;
		header('Location:'.$application_url);
	}
});

Route::add('/form/([a-zA-Z0-9]*)/edit/',function($form_id){
	if(current_user_can_edit($form_id)){
		add_class_to_body('edit-form');
		include_once('./views/header.php');
		include_once('./views/edit.php');
		include_once('./views/footer.php');
	}
	else{
		global $application_url;
		header('Location:'.$application_url);
	}
});

/**
 * Routing for Submitting a form
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
Route::add('/form/([a-zA-Z0-9]*)/submit',function($form_id){
	add_class_to_body('submit-form');
	include_once('./views/header.php');
	include_once('./views/submit.php');
	include_once('./views/footer.php');
});

Route::add('/form/([a-zA-Z0-9]*)/submit/',function($form_id){
	add_class_to_body('submit-form');
	include_once('./views/header.php');
	include_once('./views/submit.php');
	include_once('./views/footer.php');
});

Route::add('/form/([a-zA-Z0-9]*)/submit',function($form_id){
	$form_data=$_POST;
	public_form_submit($form_id,$form_data);
	add_class_to_body('submit-form');
	include_once('./views/header.php');
	include_once('./views/submitted.php');
	include_once('./views/footer.php');
},'post');

Route::add('/form/([a-zA-Z0-9]*)/submit/',function($form_id){
	$form_data=$_POST;
	public_form_submit($form_id,$form_data);
	add_class_to_body('submit-form');
	include_once('./views/header.php');
	include_once('./views/submitted.php');
	include_once('./views/footer.php');
},'post');


/**
 * Routing for viewing responses of a form
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
Route::add('/form/([a-zA-Z0-9]*)/responses',function($form_id){
	global $application_url;
	header('Location:'.$application_url.'/form/'.$form_id.'/responses/1');
});

Route::add('/form/([a-zA-Z0-9]*)/responses/',function($form_id){
	global $application_url;
	header('Location:'.$application_url.'/form/'.$form_id.'/responses/1');
});

Route::add('/form/([a-zA-Z0-9]*)/responses/([0-9]*)',function($form_id,$response_id){
	if(current_user_can_view_responses($form_id)){
		add_class_to_body('view-responses');
		$response_id= $response_id==''?1: $response_id;
		include_once('./views/header.php');
		include_once('./views/responses.php');
		include_once('./views/footer.php');
	}
	else{
		global $application_url;
		header('Location:'.$application_url);
	}
});


/**
 * Routing Login View.
 * 
 * The default login form and the logic when user submits the form using post method
 * @since 1.0.0
 * @author Niraj Gohel
 */
Route::add('/login',function(){
	if(Login::is_user_logged_in()){
		header('Location:./');
	}
	else{
		add_class_to_body('login');
		include_once('./views/header.php');
		Login::get_login_form();
		include_once('./views/login.php');
		include_once('./views/footer.php');
	}
});

Route::add('/login/',function(){
	if(Login::is_user_logged_in()){
		header('Location:./');
	}
	else{
		add_class_to_body('login');
		include_once('./views/header.php');
		Login::get_login_form();
		include_once('./views/login.php');
		include_once('./views/footer.php');
	}
});

Route::add('/login',function(){
	Login::validate_login();
	header('Location:./');
},'post');

Route::add('/login/',function(){
	Login::validate_login();
	header('Location:./');
},'post');


/**
 * Routing Logout function
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
Route::add('/logout',function(){
	Login::logout();
	header('Location:./');
});

Route::add('/logout/',function(){
	Login::logout();
	header('Location:./');
});


Route::pathNotFound( function(){
	add_class_to_body('404');
	include_once('./views/header.php');
	include_once('./views/404.php');
	include_once('./views/footer.php');
});










Route::add('/test.html',function(){
	include_once('details.php');
});

Route::add('/contact-form',function(){
	echo '<form method="post"><input type="text" name="test" /><input type="submit" value="send" /></form>';
},'get');

Route::add('/contact-form',function(){
	echo 'Hey! The form has been sent:<br/>';
	print_r($_POST);
},'post');

Route::add('/foo/([0-9]*)/bar',function($var1){
	echo $var1.' is a great number!';
});

Route::run($application_subdirectory);

?>