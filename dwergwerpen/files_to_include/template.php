<?php

if(!isset($_SESSION['username']))
{
	$medewerkerTopmenuOption = '<a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-right topmenu-item">Medewerkers</a>';
}
else
{
	$medewerkerTopmenuOption = '<div class="w3-dropdown-hover w3-right"><button class="w3-button" style="min-width: 150px;">Welkom, '.$_SESSION['username'].'</button><div class="w3-dropdown-content w3-bar-block w3-card-4">'.getContentFromDatabase("medewMenu");
	if($_SESSION['permissions'] > 1)
	{
		$medewerkerTopmenuOption .= getContentFromDatabase("adminMenu");
	}
	$medewerkerTopmenuOption .= '</div></div>';
}

if(!isset($content))
{
	$content = "No text here, sorry!";
}

if(!isset($head))
{
	$head = "";
}

$replace = array("{medewerkers_dropdown}","{content}","{head}");
$with = array($medewerkerTopmenuOption,$content,$head);

echo str_replace($replace,$with,file_get_contents("template_stuff/template.html"));

?>
