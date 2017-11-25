<?php

session_start();

$loginForm = '<div id="login"><form method="post" action="login.php"><input type="text" name="username" placeholder="Gebruikersnaam"><input type="password" name="password" placeholder="Wachtwoord"><input type="submit" value="Login" class="w3-blue"><br><br><a class="w3-text-gray"><small>Gegevens kwijt?</small></a></form></div>';
$homepage = "http://localhost/dwergwerpen/";

function login($usernameSubmitted, $passwordSubmitted)
{
	if(empty($usernameSubmitted))
	{
		die('Please enter your username');
	}

	if(empty($passwordSubmitted))
	{
		die('Please enter your password');
	}

	$servername = "localhost";
	$username = "root";
	$password = "";
	$database_name = "dwergwerpen";

	$connection = new mysqli($servername, $username, $password, $database_name);

	if($connection->connect_error)
	{
		die('Error: Database not found');
	}

	$sqlString = "SELECT * FROM Login WHERE lower(username) = '".strtolower($usernameSubmitted)."'";

	$result = $connection->query($sqlString);

	if($result->num_rows == 1)
	{
		if($row = $result->fetch_assoc())
		{
			if(hash('sha256', $passwordSubmitted.$row['salt']) == $row['hashed_password'])
			{
				$_SESSION['username'] = $row['username'];
				$_SESSION['permissions'] = $row['permissions'];
				logAction($_SESSION['username']." logged in.");
				return true;
			}
			else
			{
				return '<center>Password incorrect, please try again.</center><br>';
			}
		}
	}
	else
	{
		return '<center>Username not found, please try again.</center><br>';
	}
	$connection->close();
}

function getContentFromDatabase($primaryKeyContent)
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database_name = "dwergwerpen";

	$connection = new mysqli($servername, $username, $password, $database_name);

	if($connection->connect_error)
	{
		return 'Error: Database not found';
	}

	$sqlString = "SELECT content FROM Maincontent WHERE id = '".$primaryKeyContent."'";

	$result = $connection->query($sqlString);

	if($result->num_rows != 1)
	{
		return "Primary key was either not found or gave multiple results";
	}

	if($row = $result->fetch_assoc())
	{
		return stripslashes(html_entity_decode($row['content']));
	}
	$connection->close();
}

function excecuteSql($sqlstring)
{
	if(empty($sqlstring))
	{
		return false;
	}

	$servername = "localhost";
	$username = "root";
	$password = "";
	$database_name = "dwergwerpen";

	$connection = new mysqli($servername, $username, $password, $database_name);

	if($connection->connect_error)
	{
		return false;
	}

	if ($connection->query($sqlstring) === TRUE)
	{
		return true;
	}
	else
	{
		return false;
	}

	$connection->close();

}

function logAction($logInput) // Logs the $logInput combined with time in UTC
{
	$file = "logs/".date("Y-m-d").".txt";
	
	$openedFile = fopen($file, "a"); // fopen() also creates the file if it doesnt exist

	fwrite($openedFile, date("h:i:s")."|".$logInput."\n");

	fclose($openedFile);
}

function primaryKeyExists($table,$primaryKey,$primaryKeyValue)
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database_name = "dwergwerpen";

	//logAction("Function got excecuted fam");

	$connection = new mysqli($servername, $username, $password, $database_name);
	//logAction($servername.":".$username.":".$password.":".$database_name);

	if($connection->connect_error)
	{
		return "Error with database";
	}

	$sqlString = "SELECT ".$primaryKey." FROM ".$table." WHERE lower(".$primaryKey.") = '".strtolower($primaryKeyValue)."';";

	$result = $connection->query($sqlString);

	$result_rows = $result->num_rows;
	//logAction($result_rows);

	if($result_rows > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
	$connection->close();
}

function alertDanger($title, $text)
{
	return "<div class=\"w3-container w3-red w3-card-4 w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"
class=\"w3-button w3-display-topright\">&times;</span><h3>".$title."</h3><p>".$text."</p></div>";
}

function alertWarning($title, $text)
{
	return "<div class=\"w3-container w3-red w3-card-4 w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"
class=\"w3-button w3-display-topright\">&times;</span><h3>".$title."</h3><p>".$text."</p></div>";
}

function alertInfo($title, $text)
{
	return "<div class=\"w3-container w3-red w3-card-4 w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"
class=\"w3-button w3-display-topright\">&times;</span><h3>".$title."</h3><p>".$text."</p></div>";
}

function alertGood($title, $text)
{
	return "<div class=\"w3-container w3-red w3-card-4 w3-display-container\"><span onclick=\"this.parentElement.style.display='none'\"
class=\"w3-button w3-display-topright\">&times;</span><h3>".$title."</h3><p>".$text."</p></div>";
}

?>