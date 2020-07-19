<?php
ob_start();
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title> Cuulis - Viestin lähetys </title>';

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

//TYHJÄ LÄHETTÄJÄ TAI TYHJÄ VIESTI:
include("header.php");
echo '<div>';
if (empty($_POST[lahettaja]) || empty($_POST[viesti]) || empty($_POST[otsikko])){
    echo'<p>Et täyttänyt kaikkia kenttiä!</p>';

    echo' <p><a href="muokkaa_kayttaja.php?id='.$_POST[id].'&viesti"> &#8617 &nbsp  Palaa takaisin </a></p>';
}
else{
    $headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

$headers .= "From: <" . $_POST[lahettaja] . ">\r\n";

$otsikko = $_POST[otsikko];
$viesti = $_POST[viesti];
 $viesti = str_replace("\n.", "\n..", $viesti);
$viesti = nl2br($viesti);

$sposti = $_POST[vastaanottaja];

$lahetys = mail($sposti, $otsikko, $viesti, $headers);
if ($lahetys) {
    header("location: viesti_lahetetty.php");
} else {
    echo "<br>Viestin lähettäminen ei onnistunut. Yritä uudelleen!";
    echo' <p><a href="muokkaa_kayttaja.php?id='.$_POST[id].'&viesti"> &#8617 &nbsp  Palaa takaisin </a></p>';
}
}


echo'</div>';
echo'</div>';

include("footer.php");
?>
</body>
</html>			