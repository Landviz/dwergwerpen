<?php
include_once("files_to_include/main.php");

if(isset($_SESSION['username']) && $_SESSION['permissions'] >= 2)
{

	if(isset($_POST['toEdit']) && isset($_POST['content']) && isset($_POST['description']))
	{
		$sqlstring = "UPDATE Maincontent SET content='".addslashes(htmlentities($_POST['content']))."', description='".addslashes(htmlentities($_POST['description']))."' WHERE id='".$_POST['toEdit']."'";
		if(excecuteSql($sqlstring))
		{
			$content = "Saved.";
			logAction($_SESSION['username']." edited value(s) of primary key '".$_POST['toEdit']."' in Maincontent");
		}
		else
		{
			$content = "Something went wrong saving to the database.";
			logAction($_SESSION['username']." failed editing value(s) of primary key '".$_POST['toEdit']."' in Maincontent ".'$sqlstring = '.$sqlstring);

		}
	}

}
else
{
	$content = "<h1>Acces denied</h1>You do not have the required permissions to view this page.";
}

include_once('files_to_include/template.php');
?>