<?php
/**
 * This file contains the header of the application 
 * 
 * Basically all the stylesheets go here.
 */
global $application_url,$enqued_style_header,$favicon_uri,$body_classes;
$ajax_url=$application_url.'/inc/ajax.php';
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Form Builder</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?=$application_url.$favicon_uri?>">
	<?php 
	foreach ($enqued_style_header as $style) {
		?>
		<link rel="stylesheet" href="<?=$style?>">
		<?php
	}
	?>
</head>
<body
<?php
if(count($body_classes)){
	echo 'class="'.implode(" ",$body_classes).'"';
}
?>
>
	<script>
		var application_url='<?=$application_url?>';
		var ajax_url='<?=$ajax_url?>';
	</script>