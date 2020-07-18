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


$haku = $yhteys->prepare("SELECT id, etunimi, sukunimi, sposti, tunnus, koodikielet, koodauskokemus_sanallinen, koodauskokemus_arvio FROM kayttajat WHERE id=?");

if (!$haku) {
    die('<p>Tietokantahaussa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
}

$haku->bind_param("i", $id);

if (isset($_POST[id])) {

    $id = $_POST[id];
} else if (isset($_GET[id])) {

    $id = $_GET[id];
}


if (!$haku->execute()) {
    die('<p>Tietokantahaussa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($haku->error) . '</p>');
}

$haku->store_result();
$haku->bind_result($tulos1, $tulos2, $tulos3, $tulos4, $tulos5, $tulos6, $tulos7, $tulos8);

while ($haku->fetch()) {
    $id = $tulos1;
    $etunimi = $tulos2;
    $sukunimi = $tulos3;
    $sposti = $tulos4;

    $tunnus = $tulos5;

    $koodikielet = $tulos6;


    $kokemus_sanallinen = $tulos7;
    $kokemus_sanallinen = htmlspecialchars_decode($kokemus_sanallinen);
    $kokemus_arvio = $tulos8;
}




$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

$headers .= "From: " . $nimi . " <" . $email . ">\r\n";

$otsikko = "Viesti sivustolta syksy2020.tylykoodaa.fi";
$otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


$lahetys = mail($sposti, $otsikko, $viesti, $headers);
if ($lahetys) {
    header("location: lahetaviesti2.php");
} else {
    echo "<br>Viestin lähettäminen ei onnistunut. Yritä uudelleen!";
    echo '<br><br><a href="kayttajatviesti.php"><p style="font-size: 1.5em; display: inline-block; padding:0; margin: 0">&#8630</p> Palaa takaisin</a>';
}

$haku->close();

echo'</div>';
echo'</div>';

include("footer.php");
?>
</body>
</html>			