<?php
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Cuulis - Viestin lähetys </title>';

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

include("ylatunniste.php");
echo '<div>';
if (empty($_POST[lahettaja]) || empty($_POST[viesti]) || empty($_POST[otsikko])) {
    echo'<p>Et täyttänyt kaikkia kenttiä!</p>';

    echo' <p><a href="muokkaa_kayttaja.php?id=' . $_POST[id] . '&viesti"> &#8617 &nbsp  Palaa takaisin </a></p>';
} else {
    $tunnisteet .= "Organization: AT1.1 Internet ja verkkosivut\r\n";
    $tunnisteet .= "MIME-Version: 1.0" . "\r\n";
    $tunnisteet .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $tunnisteet .= "From: <" . $_POST[lahettaja] . ">\r\n";
    $tunnisteet .= "X-Priority: 3\r\n";
    $tunnisteet .= "X-Mailer: PHP" . phpversion() . "\r\n";


    $otsikko = $_POST[otsikko];
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


    $viesti = $_POST[viesti];
    $viesti = str_replace("\n.", "\n..", $viesti);
    $viesti = nl2br($viesti);

    $sposti = $_POST[vastaanottaja];

    $lahetys = mail($sposti, $otsikko, $viesti, $tunnisteet);
    if ($lahetys) {
        header("location: viesti_lahetetty.php");
    } else {
        echo "<h3>Viestin lähettäminen ei onnistunut. Yritä uudelleen!</h3>";
        echo' <p><a href="muokkaa_kayttaja.php?id=' . $_POST[id] . '&viesti"> &#8617 &nbsp  Palaa takaisin </a></p>';
    }
}


echo'</div>';
echo'</div>';

include("alatunniste.php");
?>
</body>
</html>			