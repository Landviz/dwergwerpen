<?php
include_once('files_to_include/main.php');

$content = getContentFromDatabase("addMedew");

// Form to add co-workers
include_once('files_to_include/form_medewerkers.php');

include_once('files_to_include/template.php');
?>