<?php

$formCorrect = true;

if(
	!isset($_POST['voornaam']) ||
	!isset($_POST['achternaam']) ||
	!isset($_POST['initialen']) ||
	!isset($_POST['geslacht']) ||
	!isset($_POST['mail']) ||
	!isset($_POST['woonplaats']) ||
	!isset($_POST['straat']) ||
	!isset($_POST['huisnummer']) ||
	!isset($_POST['postcode']) ||
	!isset($_POST['tel']) ||
	!isset($_POST['postcode']) ||
	!isset($_POST['vooropleiding']) ||
	!isset($_POST['medischeachtergrond']) ||
	!isset($_POST['dob']) ||
	!isset($_POST['mob']) ||
	!isset($_POST['yob']) ||
	!isset($_POST['hobby']) ||
	!isset($_POST['foto']) ||
	!isset($_POST['schooljaar']) ||
	!isset($_POST['bsn']) ||
	empty($_POST['voornaam']) ||
	empty($_POST['achternaam']) ||
	empty($_POST['initialen']) ||
	empty($_POST['geslacht']) ||
	empty($_POST['mail']) ||
	empty($_POST['woonplaats']) ||
	empty($_POST['straat']) ||
	empty($_POST['huisnummer']) ||
	empty($_POST['postcode']) ||
	empty($_POST['tel']) ||
	empty($_POST['postcode']) ||
	empty($_POST['vooropleiding']) ||
	empty($_POST['medischeachtergrond']) ||
	empty($_POST['dob']) ||
	empty($_POST['mob']) ||
	empty($_POST['yob']) ||
	empty($_POST['hobby']) ||
	empty($_POST['foto']) ||
	empty($_POST['schooljaar']) ||
	empty($_POST['bsn'])
)
{
	$formCorrect = false;
}

if(
	!settype($_POST['dob'], "int") &&
	!settype($_POST['mob'], "int") && 
	!settype($_POST['yob'], "int") &&
	!settype($_POST['huisnummer'], "int")
)
{
	$formCorrect = false;
}

if($_POST['geslacht'] != "Man" && $_POST['geslacht'] != "Vrouw" && $_POST['geslacht'] != "Anders")
{
	$formCorrect = false;
}


if($formCorrect)
{
	echo "Banaan";
}



?>