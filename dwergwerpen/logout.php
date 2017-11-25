<?php
	include_once('files_to_include/main.php');
	session_destroy();
	echo '<script>window.location.href="'.$homepage.'";</script>';
?>