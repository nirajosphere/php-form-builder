<?php
/**
 * This file contains the footer of the application 
 * 
 * Basically all the scripts go here.
 */
global $enqued_scripts_footer;
foreach ($enqued_scripts_footer as $url) {
	?>
	<script src="<?=$url?>"></script>
	<?php
}
?>
</body>
</html>