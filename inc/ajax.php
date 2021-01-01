<?php
/**
 *	This file handles the ajax calls made from the javascript file
 */

/**
 * Includes required files
 */
include_once('../config.php');
include_once('core.php');
include_once('./classes/Autoload.php');
include_once('../components/Autoload.php');
session_start();

$action=$_POST['action'];

/**
 * Saving a form from edit template
 * 
 * @param formdata - posted form fields
 * @param id - ID of the form
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
if($action=='save_form'){
	$args=array();
	parse_str($_POST['form'], $args);
	$form=new Form($_POST['id']);
	$form->update_form_object($args);
}

/**
 * gets the edit template
 * When user clicks on add component block in the edit template
 * 
 * @return the default editor component block
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
else if($action=='get_edit_template'){
	$comp=new Component();
	echo $comp->get_edit_template();
}

/**
 * get the specific edit template
 * When user changes the dropdown of component type, this will return the specific editor block
 * 
 * @param type - type of the template
 * @param component_id - id of the component (so that it does not get updated in database)
 * 
 * @return the type specific editor component block
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
else if($action=='change_template'){
	$comp=get_component_by_type($_POST['type']);
	$args=array(
		'id'	=>	$_POST['component_id'],
	);
	$comp->initialize($args);
	echo $comp->get_edit_template();
}

/**
 * adding radio option
 * 
 * @param id - the component id
 * 
 * @return the additional radio option block
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
else if($action=='add_radio_option'){
	$comp=new Radio();
	$args=array(
		'id'	=> $_POST['component_id'],
	);
	$comp->initialize($args);
	echo $comp->get_edit_radios();
}

/**
 * adding checkbox option
 * 
 * @param id - the component id
 * 
 * @return the additional radio option block
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
else if($action=='add_checkbox_option'){
	$comp=new Checkbox();
	$args=array(
		'id'	=> $_POST['component_id'],
	);
	$comp->initialize($args);
	echo $comp->get_edit_checkboxes();
}


?>