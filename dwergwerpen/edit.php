<?php
include_once('files_to_include/main.php');
if(isset($_SESSION['username']) && $_SESSION['permissions'] >= 2)
{

	if(isset($_POST['toEdit']))
	{
		$toEdit = $_POST['toEdit'];
	}
	else
	{
		die('<script>window.location.href="'.$homepage.'";</script>');
	}

	$content = "";

	$servername = "localhost";
	$username = "root";
	$password = "";
	$database_name = "dwergwerpen";

	$connection = new mysqli($servername, $username, $password, $database_name);

	if($connection->connect_error)
	{
		return 'Error: Database not found';
	}

	$sqlString = "SELECT * FROM Maincontent WHERE id = '".$toEdit."'";

	$result = $connection->query($sqlString);

	if($result->num_rows != 1)
	{
		return "Primary key was either not found or gave multiple results";
	}

	if($row = $result->fetch_assoc())
	{
		$content .= "<form method=\"post\" action=\"editsubmit.php\">";
		$content .= "<input type=\"text\" value=\"".$row["id"]."\" class=\"w3-input\" disabled><br>";
		$content .= "<input type=\"hidden\" value=\"".$row["id"]."\" class=\"w3-input\" name=\"toEdit\"><br>";
		$content .= "<h3>Content</h3><br>";
		$content .= "<textarea class=\"w3-input w3-border\" style=\"max-width: 100%; min-width: 100%;\" name=\"content\">".$row["content"]."</textarea><br>";
		$content .= "<h3>Description</h3><br>";
		$content .= "<textarea class=\"w3-input w3-border\" style=\"max-width: 100%; min-width: 100%;\" name=\"description\">".$row["description"]."</textarea>";
		$content .= "<input type=\"submit\" value=\"Save\" class=\"button-generic w3-blue\">";
		$content .= "</form>";
	}
	$connection->close();

}
else
{
	$content = "<h1>Acces denied</h1>You do not have the required permissions to view this page.";
}

include_once('files_to_include/template.php');
?>