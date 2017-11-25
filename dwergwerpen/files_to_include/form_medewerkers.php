<?php

$content .= "<br><br>";
$content .= "<form method=\"post\" action=\"add_medewerker_submit.php\">";
$content .= "<input type=\"text\" name=\"username\" maxlength=\"16\" class=\"w3-input\" placeholder=\"Gebruikersnaam\" required><br>" ;
$content .= "<input type=\"password\" name=\"password\" class=\"w3-input\" placeholder=\"Wachtwoord\" required><br>";
$content .= "Functie:<br>";
$content .= "<select name=\"permissions\" class=\"w3-input\" required><br>";
$content .= "<option value=\"1\">Docent</option>";
$content .= "<option value=\"2\">Administrator</option>";
$content .= "</select><br>";
$content .= "<input type=\"submit\" value=\"Toevoegen\" class=\"button-generic w3-blue\">";
$content .= "</form>";

?>