<?php
/**
 *	This file contains the configuration parameters of the application 
 */
date_default_timezone_set("Asia/Kolkata");

/**
 * The base application URL from where the application will be accessed.
 * 
 * This URL will be used for loading assets and accessing files whenever/wherever required.
 * @since 1.0.0
 * @author Niraj Gohel
 */
$application_url='http://localhost/formBuilder';


/**
 * The application sub-directory that is needed to redirect the routes.
 * 
 * Default should be '/';
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 * 
 */
$application_subdirectory='/formBuilder';


/**
 * The application logo uri (local) which
 * 
 * This URI will be used for login form and the left menu on homepage
 * @since 1.0.0
 * @author Niraj Gohel
 */
$logo_uri='/assets/images/header_logo.png';


/**
 * The application favicon uri (local) which
 * 
 * This URI will be used for favicon
 * @since 1.0.0
 * @author Niraj Gohel
 */
$favicon_uri='/assets/images/favicon.png';


/**
 * Database Host
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
$db_host = "localhost";

/**
 * Database User
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
$db_user = "root";

/**
 * Database Password for the above user
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
$db_password = "";

/**
 * Database Table Name
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
$db_table="formbuilder";

/**
 * Database Table Name
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
$db_enc_key='nywEGF08bs';

/**
 * Establishing Connection to the database according to the details mentioned above.
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
$conn = new mysqli($db_host, $db_user, $db_password, $db_table);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

/**
 * Defining Required Scripts Variables
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
$scripts_base_url=$application_url.'/assets/js/';
$enqued_scripts_footer=array();
$enqued_scripts_header=array();

/**
 * Defining Required Style Variables
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
$style_base_url=$application_url.'/assets/css/';
$enqued_style_header=array();

/**
 * Defining array of classes to be added in body tag
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
$body_classes=array();

 ?>