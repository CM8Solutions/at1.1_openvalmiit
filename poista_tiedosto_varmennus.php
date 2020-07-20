<?php

ob_start();

include("tietokantayhteys.php");

echo'<!DOCTYPE html>

<html>
    <head>
        <title>Muokkaa tiedoston poisto</title>';
include("header.php");



echo '<body>';


echo'<div>';
echo'<div class="vali"></div>';

$haku = $yhteys->prepare("SELECT id, kohde, nimi FROM tiedostot WHERE id=?");

if (!$haku) {
    die('<p>Tietokantahaussa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
}

$haku->bind_param("i", $id);


$id = $_POST[id];



if (!$haku->execute()) {
    die('<p>Tietokantahaussa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($haku->error) . '</p>');
}

$haku->store_result();
$haku->bind_result($tulos1, $tulos2, $tulos3);

while ($haku->fetch()) {
    $id = $tulos1;
    $kohde = $tulos2;
    $nimi = $tulos3;
}



echo'<h3>Oletko varma, että haluat poistaa tiedoston ' . $nimi . '?</h3>';

echo'<form action = "poista_tiedosto.php" method = "post">';
echo'<input type = "hidden" name = "id" value = ' . $id . '>';
echo'<button type = "submit" value = "kylla" style = "margin-right: 20px" name = "valinta" class="nappula">Kyllä</button>';

echo'<button type = "submit" value = "en" name = "valinta" class="nappula">En</button>';

echo'</form>';


$haku->close();


echo'<div class = "vali"></div>';
echo'</div>';


include('footer.php');

echo '</body>
        </html>';
