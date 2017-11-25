<?php
include('files_to_include/main.php');

$content = "";

$correct = true;

if(!isset($_POST['username']) || empty($_POST['username']))
{
	$content .= alertDanger("Error","Username is not set");
	$correct = false;
}

if(!isset($_POST['password']) || empty($_POST['password']))
{
	$content .= alertDanger("Error","Password is not set");
	$correct = false;
}

if(!isset($_POST['permissions']) || empty($_POST['permissions']) || ($_POST['permissions'] != 1 && $_POST['permissions'] != 2))
{
	$content .= alertDanger("Error","Permissions are not set");
	$correct = false;
}

if(!$correct)
{
	include_once('files_to_include/form_medewerkers.php');
}
else
{
	$status = primaryKeyExists("Login","username",$_POST['username']); // Used a variable so I dont have to excecute the function twice
	if($status === false)
	{
		// Create account
		$salt = str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
		$password_hashed = hash("sha256", $_POST['password'].$salt);
		$username_dbsafe = addslashes(htmlentities($_POST['username']));

		$sqlString = "INSERT INTO Login VALUES('".$username_dbsafe."','".$password_hashed."','".$salt."','".$_POST['permissions']."');";

		if(excecuteSql($sqlString))
		{
			$content .= "User added.";
			logAction($_SESSION['username']." added user ".$_POST['username']." with permissions ".$_POST['permissions']);
		}
		else
		{
			$content .= "Something wrent wrong. Oops!";
			logAction($_SESSION['username']." failed adding user ".$_POST['username'].' $sqlstring = '.$sqlString);
		}

	}
	elseif($status === true)
	{
		$content .= alertDanger("Error","Username already exists, please pick another username.");
		include_once('files_to_include/form_medewerkers.php');
		logAction($_SESSION['username']." failed adding user ".$_POST['username'].", user already exists");
	}
	else
	{
		$content .= "Something went wrong connecting to the database";
		//$content .= primaryKeyExists("Login","username",$_POST['username']);
	}
}

include_once('files_to_include/template.php');
?>