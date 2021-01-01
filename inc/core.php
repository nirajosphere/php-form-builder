<?php
/**
 * This file contains the core functions of the application.
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */


/**
 * Function to encrypt-decrypt the given string
 * @since 1.0.0
 * @author Niraj Gohel
 *
 * @param $action - Encrypt/Decrypt
 * @param $string - String to perform action upon
 *
 * @return encrypted/decrypted String 
 */
function encrypt_decrypt($action, $string) {
  $output = false;
  $encrypt_method = "AES-256-CBC";
  $secret_key = 'formBuilder2019';
  $secret_iv = 'form2019';
  $key = hash('sha256', $secret_key);
  $iv = substr(hash('sha256', $secret_iv), 0, 16);
  if ( $action == 'encrypt' ) {
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
  } else if( $action == 'decrypt' ) {
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
  }
  return $output;
}

/**
 * Generate Random 12 Character Long Random String 
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
function randomString() {
  static $generated_strings=array();
  $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  $pass = array(); 
  $alphaLength = strlen($alphabet) - 1; 
  for ($i = 0; $i < 12; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
  }
  $string=implode($pass);
  while (in_array($string,$generated_strings)){
    $string= randomString();
  }
  $generated_strings[]=$string;
  return $string;
}

/**
 * Get all forms for current user
 * 
 * @param $status get forms with by specific status
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
function get_forms_by_user($status='active'){
  global $conn;
  $get_forms=$conn->prepare('SELECT * from form where username=? and status=?');
  $get_forms->bind_param('ss',$_SESSION['username'],$status);
  $get_forms->execute();
  $results=$get_forms->get_result();
  $forms=array();
  while($row=$results->fetch_assoc()){
    $forms[]=(object)$row;
  }
  return $forms;
}

/**
 * Generates the dropdown options for component header 
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
function get_component_options($type='short_answer'){
  $types=array(
    'short_answer'    => array(
      'name'  =>  'Short Answer',
      'icon'  =>  'fas fa-font'
    ),
    'long_answer'     => array(
      'name'  =>  'Paragraph',
      'icon'  =>  'fas fa-align-left'
    ),
    'multiple_choice' => array(
      'name'  =>  'Multiple Choice',
      'icon'  =>  'fas fa-dot-circle'
    ),
    'checkboxes'      => array(
      'name'  =>  'Checkboxes',
      'icon'  =>  'fas fa-check'
    ),
    'dropdown'        =>array(
      'name'  =>  'Dropdown',
      'icon'  =>  'fas fa-chevron-circle-down'
    )
  );
  foreach ($types as $key => $value) {
    echo '<option value="'.$key.'"';
    if($key==$type){
      echo ' selected ';
    }
    echo 'data-icon="'.$value['icon'].'" '; 
    echo '>'.$value['name'].'</option>';
  }
}

/**
 * Inserts the response in the database
 * 
 * @param $form_id ID of the form submitted
 * @param $form_data array of respective values submitted;
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
function public_form_submit($form_id,$form_data,$response_id=false){
  global $conn;
  $form_data=json_encode($form_data);
  if(!$response_id){
    $insert_response=$conn->prepare('INSERT INTO `response`(`form_id`, `response`) VALUES (?,?)');
    $insert_response->bind_param('ss',$form_id,$form_data);
    if($insert_response->execute()){
      return true;
    }
    else{
      return false;
    }
  }
  else{
    $update_response=$conn->prepare('UPDATE `response` SET `response`=? WHERE `form_id`=?');
    $update_response->bind_param('ss',$form_data,$form_id);
    if($update_response->execute()){
      return true;
    }
    else{
      return false;
    }
  }
}

/**
 * checks if the current user can edit the given form
 * 
 * @param $form_id ID of the form
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
function current_user_can_edit($form_id){
  global $conn;
  if(Login::is_user_logged_in()){
    $get_form_details=$conn->prepare('SELECT username,meta from form where id=?');
    $get_form_details->bind_param('s',$form_id);
    $get_form_details->execute();
    $result=$get_form_details->get_result();
    $row=$result->fetch_assoc();
    if($row['username']==$_SESSION['username']){
      return true;
    }
    else{
      return false;
    }
  }
  else{
    return false;
  }
}

/**
 * checks if the current user can view the responses of given form
 * 
 * @param $form_id ID of the form
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
function current_user_can_view_responses($form_id){
  global $conn;
  if(Login::is_user_logged_in()){
    $get_form_details=$conn->prepare('SELECT username,meta from form where id=?');
    $get_form_details->bind_param('s',$form_id);
    $get_form_details->execute();
    $result=$get_form_details->get_result();
    $row=$result->fetch_assoc();
    if($row['username']==$_SESSION['username']){
      return true;
    }
    else{
      return false;
    } 
  }
  else{
    return false;
  }
}

/**
 * returns the component object by type
 * 
 * @param $type type of the component
 * 
 * @return $comp the object of the required
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
function get_component_by_type($type='short_answer'){
  $comp='';
  switch ($type) {
    case 'short_answer':
    $comp=new Component();
    break;

    case 'long_answer':
    $comp=new Paragraph();
    break;

    case 'multiple_choice':
    $comp=new Radio();
    break;

    case 'checkboxes':
    $comp=new Checkbox();
    break;            

    default:
    $comp=new Component();
    break;
  }
  return $comp;  
}


/**
 * function to add scripts
 * 
 * @param filename - name of the file to be included
 * @param is_cdn - if the link is cdn or not
 * @param header - if the file should be included in header (default included in footer)
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
function enque_script($filename,$is_cdn=false,$header=false){
  global $enqued_scripts_footer,$enqued_scripts_header,$scripts_base_url;
  if($header){
    $enqued_scripts_header[] = $is_cdn?$filename:$scripts_base_url.$filename;
  }
  else{
    $enqued_scripts_footer[] = $is_cdn?$filename:$scripts_base_url.$filename;
  }
}

/**
 * function to add styles
 * 
 * @param filename - name of the file to be included
 * @param is_cdn - if the link is cdn or not
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
function enque_style($filename,$is_cdn=false){
  global $style_base_url,$enqued_style_header;
  $enqued_style_header[] = $is_cdn?$filename:$style_base_url.$filename;
}

/**
 * function to add classes to body tag
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
function add_class_to_body($class){
  global $body_classes;
  $body_classes[]=$class;
  $body_classes=array_unique($body_classes);
}
?>