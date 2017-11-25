<?php
include_once("files_to_include/main.php");
if(isset($_SESSION['username']) && $_SESSION['permissions'] >= 2)
{
	$content = getContentFromDatabase("editpages")."<br><br>";

	$content .= "<form method=\"post\" action=\"edit.php\"><table class=\"w3-table-all\"><thead><tr class=\"w3-blue\"><th></th><th>ID</th><th>Description</th></tr></thead>";

	$servername = "localhost";
	$username = "root";
	$password = "";
	$database_name = "dwergwerpen";

	$connection = new mysqli($servername, $username, $password, $database_name);

	if($connection->connect_error)
	{
		return 'Error: Database not found';
	}

	$sqlString = "SELECT id, description FROM Maincontent";

	$result = $connection->query($sqlString);

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$content .= "<tr><td><input type=\"radio\" name=\"toEdit\" value=\"".$row['id']."\"</td><td>".$row['id']."</td><td>".$row['description']."</td></tr>";
		}
	}
	$connection->close();

	$content .= "</table><input type=\"submit\" value=\"Edit page\" class=\"button-generic w3-blue\"></form><br>";
}
else
{
	$content = "<h1>Acces denied</h1>You do not have the required permissions to view this page.";
}

include("files_to_include/template.php");
?>