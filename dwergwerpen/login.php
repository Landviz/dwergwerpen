<?php
include_once("files_to_include/main.php");

if(isset($_POST['username']) && isset($_POST['password'])) // Checks whether the login form was filled in, then excecutes the login(username, password) function
{
	$login = login($_POST['username'], $_POST['password']);
	if($login !== true)
	{
		$content = $login.$loginForm;
	}
}

if(!isset($_POST['username']) && !isset($_POST['password']) && !isset($_SESSION['username']))
{
	$content = "<center>Log in door hieronder je gebruikersnaam en wachtwoord in te voeren</center><br><br>".$loginForm;
}

if(!isset($content))
{
	$content = getContentFromDatabase("login");
}

include_once('files_to_include/template.php');

?>